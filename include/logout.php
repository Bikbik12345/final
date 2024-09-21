<?php
session_start();

require_once '../connect/dbcon.php';

if(isset ($_SESSION['UserName'])){
    $loggedInUser = $_SESSION["UserName"];
    $pdoQuery = "INSERT INTO `audit_trail`(`action`, `user`) VALUES('User logged out', :user)";
    $pdoResult = $pdoConnect ->prepare($pdoQuery);
    $pdoResult ->execute([':user' => $loggedInUser]);
}

unset($_SESSION['user']);
session_destroy();
header('location: index.php');
?>