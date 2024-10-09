<?php
include '../db.php';

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($users);
?>
