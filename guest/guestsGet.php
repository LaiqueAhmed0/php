<?php
include '../db.php';

$stmt = $conn->prepare("SELECT * FROM guests");
$stmt->execute();

$guests = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($guests);
?>
