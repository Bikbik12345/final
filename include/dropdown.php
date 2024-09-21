<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Page</title>
    <link rel="stylesheet" type="text/css" href="../style/drop.css">

    
</head>
<body>
    <div class="container">
        <h1>Welcome to Dropdown Page</h1>
        <p>This is the Dropdown Page for your project.This page select the data from your table and display is to a dropdown list. You can customize it as needed.</p>
    </div>
</body>
</html>

<?php
session_start(); // Start or resume the session

if(isset($_SESSION["UserName"])){
    echo '<h3> Login Success Welcome - '.$_SESSION["UserName"].'</h3>';
    echo '<br/><br/><a href="../crud/read.php">Home</a>';
    echo '<br/><br/><a href="../crud/read.php">Add User</a>';
    echo '<br/><br/><a href="Logout.php">Logout</a>';
    echo "<br><br><br><br><br><br><br>";
    echo "Select Username:";

    $pdoConnect = new PDO("mysql:host=localhost;dbname=dbtest","root","");
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $pdoQuery = "SELECT username FROM tbuser";
    $pdoResult = $pdoConnect->query($pdoQuery);

    $dropdown = "<select name='users'>";
    foreach($pdoResult as $row){
        $dropdown .= "\r\n<option value='{$row['username']}'>{$row['username']}</option>";
    }
    $dropdown .= "</select>";

    echo $dropdown; // Echo the dropdown HTML
}
else
{
    header("location:index.php");
}
?>
