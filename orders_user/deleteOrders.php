<?php
include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    $stmt = $conn->prepare("DELETE FROM orders_user WHERE id = :id");
    $stmt->bindParam(':id', $data->id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Orders User deleted successfully"]);
    } else {
        echo json_encode(["message" => "Orders User deletion failed"]);
    }
} else {
    echo json_encode(["message" => "Invalid ID"]);
}
?>
