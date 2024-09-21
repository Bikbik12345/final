<?php
session_start();

require_once './connect/dbcon.php';

try {
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST["login"])) {
        if (empty($_POST["UserName"]) || empty($_POST["PassWord"])) {
            $message = '<label>All fields are required</label>';
        } else {
            $pdoQuery = "SELECT * FROM tbuser WHERE UserName = :UserName ";
            $pdoResult = $pdoConnect->prepare($pdoQuery);
            $pdoResult->execute(['UserName' => $_POST["UserName"]]);

            $user = $pdoResult->fetch();

            if ($user && password_verify($_POST["PassWord"], $user["PassWord"])) {
                $_SESSION["UserName"] = $user["UserName"];
                $_SESSION["UserRole"] = $user["UserRole"]; // Assuming there's a column named 'UserRole' in your 'tbuser' table
                $_SESSION["id"] = $user["id"];
                // audit
                $loggedInUser = $_SESSION["UserName"];
                $pdoQuery = "INSERT INTO `audit_trail` (`action`, `user`) VALUES ('User logged in', :user)";
                $pdoResult = $pdoConnect->prepare($pdoQuery);
                $pdoResult->execute([':user' => $loggedInUser]);


                if ($_SESSION["UserRole"] == "admin") {
                    // Fetch the user ID from the database result
                    $userId = $user["id"];
                    // Redirect to the user dashboard with the user ID as a parameter
                    header("Location: ./crud/index.php?id=" . $userId);
                    exit(); // Make sure to exit after sending the header to prevent further execution

                } else {
                    header("location: ./include/home.php"); // Redirect to the user dashboard
                    
                }
            } else {
                $message = "<label>Wrong Data</label>";
            }
        }
    }

} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>


<!doctype html>

<html lang="en">
<head>

    <meta charset="UTF-8">
     
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style/index.css">

</head>



<body> 
      <div class="wrapper">
        <form class="form" method="post">

          <h1 class="title"  > <img src="./img/travel.png" alt="">Login</h1>
        <div class="inp">
        <input type="text"  name="UserName" class="input" required> <i>Username</i>
        
      </div>
      <div class="inp">
      <input type="PassWord" class="input" name="PassWord" required>  <i class="bi bi-lock">Password</i>
     
</div>
        <button class="submit" type="submit" name="login" value="Login">Login</button>
       
         <p class="footer">Don't have an account?<a href=" ./include/register.php" class="link">Signup</a></p>
         
        </form>

           <div></div>
              <div class="banner">
                <h1 class="wel_text">Travel Hunter</h1>
                <p class="para">Hidden Treasure of Philippines<br/><br/></p>
            

            </div>

        </div>
</body>

</html>