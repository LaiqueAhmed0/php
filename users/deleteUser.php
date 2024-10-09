<?php
include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->user_id)) {
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $data->user_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User deleted successfully"]);
    } else {
        echo json_encode(["message" => "User deletion failed"]);
    }
}
?>
