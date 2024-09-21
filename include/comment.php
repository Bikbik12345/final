<?php
session_start();
require '../connect/dbcon.php';

if (isset($_SESSION['id']) && isset($_POST['post_id']) && isset($_POST['comment_text'])) {
    $id = $_SESSION['id'];
    $post_id = $_POST['post_id'];
    $comment_text = $_POST['comment_text'];

    try {
        // Insert comment into database
        $stmt = $pdo->prepare("INSERT INTO comments (post_id, id, comment_text) VALUES (:post_id, :id, :comment_text)");
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':comment_text', $comment_text, PDO::PARAM_STR);
        $stmt->execute();

        echo json_encode(['status' => 'success']);
        exit();
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit();
}
?>
