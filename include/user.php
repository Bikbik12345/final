<?php
require_once '../connect/dbcon1.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $days = $_POST['days'];
    $checkin = $_POST['checkin'];
    $package = $_POST['package'];
    $guests = $_POST['guests'];
    $amount = $_POST['amount'];
    $payment = $_POST['payment'];
    $Reference = $_POST['Reference'];

    $stmt = $pdo->prepare("INSERT INTO bookings (name, email, phone, days, checkin, package, guests, amount, payment, Reference) VALUES (?, ?, ?, ?,?,?, ?, ?, ?,?)");
    $stmt->execute([$name, $email, $phone, $days, $checkin, $package, $guests,$amount,$payment,$Reference  ]);

    $booking_id = $pdo->lastInsertId();

    header("Location: receipt.php?id=" . $booking_id);
}
?>
