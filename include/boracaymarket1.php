<?php
require_once '../connect/dbcon1.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $product = $_POST['Product'];
    $amount = $_POST['amount'];
    $payments = $_POST['payments'];
    $reference = $_POST['reference'];

    $stmt = $pdo->prepare("INSERT INTO boracaymarket (name, email, phone, address, Product, amount, payments, reference) VALUES (?, ?, ?, ?,?,?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $address, $product,$amount,$payments,$reference  ]);

    $booking_id = $pdo->lastInsertId();

    header("Location: productreceiptb.php?id=" . $booking_id);
}
?>
