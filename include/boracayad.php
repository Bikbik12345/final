<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UserName"])) {
    header("location: ../crud/boracayadmin.php");
    exit();
}

require_once '../connect/dbcon.php';
require_once '../connect/dbcon1.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    echo "<h3>Welcome, Boracay Management " . $_SESSION["UserName"] . '</h3>';

} else {
    // Handle the case where the ID is not provided or invalid
    // You can redirect or display an error message
}

try {
    // Fetch user information based on the provided ID
    $pdoQuery = "SELECT * FROM bookings WHERE id = :id";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute(['id' => $userId]);
    $user = $pdoResult->fetch();
} catch (PDOException $error) {
    echo $error->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="../style/admin.css">
   
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"
    />
    
    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
</head>

<body>

    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>A<span>dmin</span></h3>
        </div>

       

            <div class="side-menu">
                <ul>
                    <li>
                        <a href="" class="active">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                        <a href="../include/admin.html?id=<?php echo $_SESSION['id'] ?>">
                        <span> <i class="fa-solid fa-file-waveform"></i> </span> <br>

                            <small>Annoucement</small>
                        </a>
                    </li>

                    <li>
                        <a href="edit.php?id=<?php echo $_SESSION['id'] ?>">
                            <span class="las la-user-alt"></span>
                            <small>Personal Info</small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">

        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                    <div class="user">
                        <span><a href="../include/logout.php"><i
                                    class="fa-solid fa-right-from-bracket"></i>Logout</a></span>
                    </div>
                </div>
            </div>
        </header>


       


    <main>
        <form id="admin-form">
            <label for="title">Type of Announcement:</label>
            <input type="text" id="title" name="title"><br><br>
            
            <label for="image">Image URL:</label>
            <input type="text" id="image" name="image"><br><br>
            
            <label for="history">Annoucement:</label>
            <textarea id="history" name="history"></textarea><br><br>
            
            <button type="submit">Update Content</button>
        </form>
    </main>
    <script src="../js/admin.js"></script>

        
        
</body>

</html>











































