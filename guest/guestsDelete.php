<?php
include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->guest_id)) {
    $stmt = $conn->prepare("DELETE FROM guests WHERE guest_id = :guest_id");
    $stmt->bindParam(':guest_id', $data->guest_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Guest deleted successfully"]);
    } else {
        echo json_encode(["message" => "Guest deletion failed"]);
    }
}
?>
