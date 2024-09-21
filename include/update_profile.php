<?php
require '../connect/dbcon.php';
session_start();

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    // Validate and sanitize user inputs
    $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // File upload handling for profile image
    if ($_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['profile_image']['tmp_name'];
        $file_name = $_FILES['profile_image']['name'];
        $upload_dir = '../uploads/';
        $file_path = $upload_dir . $file_name;
        move_uploaded_file($file_tmp_name, $file_path);
        $profile_image = $file_path;
    } else {
        // Handle file upload errors if any
        $profile_image = null;
    }

    try {
        // Verify the old password first
        $stmt = $pdoConnect->prepare("SELECT PassWord FROM user WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "User not found.";
            exit();
        }

        // Verify the old password against the stored hash
        $hashed_password = $user['PassWord'];
        if (!password_verify($old_password, $hashed_password)) {
            echo "Incorrect old password.";
            exit();
        }

        // Hash the new password if provided
        $hashed_new_password = $new_password ? password_hash($new_password, PASSWORD_DEFAULT) : $hashed_password;

        // Update user information in the database
        if ($profile_image) {
            $stmt = $pdoConnect->prepare("UPDATE user SET FullName = :full_name, UserName = :email, PassWord = :password, image = :profile_image WHERE id = :user_id");
            $stmt->bindParam(':profile_image', $profile_image, PDO::PARAM_STR);
        } else {
            $stmt = $pdoConnect->prepare("UPDATE user SET FullName = :full_name, UserName = :email, PassWord = :password WHERE id = :user_id");
        }
        $stmt->bindParam(':full_name', $full_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_new_password, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect to profile page after successful update
        header("Location: profile.php");
        exit();
    } catch (PDOException $e) {
        // Handle database connection error or query failure
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
