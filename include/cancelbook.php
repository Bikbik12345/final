<?php
require_once '../connect/dbcon1.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookings_id = $_POST['Booking_Id'];   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $request = $_POST['request'];
    $reason = $_POST['reason'];
    $refund = $_POST['refundmethod'];
    $recievernum = $_POST['receivernum'];
    $rebooking = $_POST['rebooking'];
   

    $stmt = $pdo->prepare("INSERT INTO cancelbook (Booking_id, name, email, phone, Request, Reason, refundmethod, recievernum, rebooking) VALUES (?, ?, ?, ?,?,?, ?, ?, ?)");
    $stmt->execute([$bookings_id, $name, $email, $phone, $request, $reason, $refund, $recievernum,$rebooking ]);

    $Request_id = $pdo->lastInsertId();

    header("Location: requestreceipt.php?id=" . $Request_id);
}
?>
