<?php

include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->name, $data->email, $data->phone, $data->address)) {
    $name = $data->name;
    $email = $data->email;
    $phone = $data->phone;
    $address = $data->address;

    $stmt = $conn->prepare("INSERT INTO guests (name, email, phone, address) VALUES (:name, :email, :phone, :address)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Guest registered successfully"]);
    } else {
        echo json_encode(["message" => "Guest registration failed"]);
    }
} else {
    echo json_encode(["message" => "Missing required fields"]);
}
?>
