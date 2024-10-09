<?php
include '../db.php';

$stmt = $conn->prepare("SELECT * FROM orders_user");
$stmt->execute();

$orders_user = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($orders_user);
?>
