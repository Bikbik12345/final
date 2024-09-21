<?php
require '../connect/dbcon.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['id'];
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

if ($post_id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid post ID']);
    exit();
}

try {
    // Check if the user already liked the post
    $stmt = $pdo->prepare("SELECT * FROM likes WHERE post_id = :post_id AND id = :id");
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $like = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($like) {
        // If liked, remove the like
        $stmt = $pdo->prepare("DELETE FROM likes WHERE like_id = :like_id");
        $stmt->bindParam(':like_id', $like['like_id'], PDO::PARAM_INT);
        $stmt->execute();
        echo json_encode(['status' => 'success', 'action' => 'unlike']);
    } else {
        // If not liked, add a new like
        $stmt = $pdo->prepare("INSERT INTO likes (post_id, id) VALUES (:post_id, :id)");
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        echo json_encode(['status' => 'success', 'action' => 'like']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
