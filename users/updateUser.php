<?php
include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->user_id, $data->name, $data->email)) {
    $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email WHERE user_id = :user_id");
    $stmt->bindParam(':name', $data->name);
    $stmt->bindParam(':email', $data->email);
    $stmt->bindParam(':user_id', $data->user_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        echo json_encode(["message" => "User update failed"]);
    }
}
?>
