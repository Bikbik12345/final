<?php
require '../connect/dbcon.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UserName'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: ../include/index.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['post-text'])) {
        // Retrieve post data
        $post_text = $_POST['post-text'];
        $id = $_SESSION['id'];
        
        // Check if a file was uploaded
        if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_size = $_FILES['file']['size'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Check file extension
            $allowed_extensions = array("jpg", "jpeg", "png", "gif", "mp4", "avi", "mov");
            if(in_array($file_ext, $allowed_extensions)) {
                // Upload file to server
                $file_destination = "uploads/" . uniqid('', true) . "." . $file_ext;
                move_uploaded_file($file_tmp, $file_destination);
            } else {
                echo "Error: Unsupported file format.";
                exit();
            }
        } else {
            // No file uploaded
            $file_destination = NULL;
        }

        // Insert post into the database using prepared statements
        $sql = "INSERT INTO posts (id, post_text, post_image) VALUES (:id, :post_text, :post_image)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':post_text' => $post_text,
            ':post_image' => $file_destination
        ]);

        // Redirect back to feed page
        header("Location: ../include/socmed.php");
        exit();
    } else {
        echo "Error: Post text is missing.";
    }
}
?>
