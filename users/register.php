<?php

include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->name, $data->email, $data->password, $data->phone, $data->address)) {
    $name = $data->name;
    $email = $data->email;
    $password = password_hash($data->password, PASSWORD_DEFAULT);
    $phone = $data->phone;
    $address = $data->address;

    $checkStmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $checkStmt->bindParam(':email', $email);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        echo json_encode(["message" => "This email is already in use"]);
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, address) VALUES (:name, :email, :password, :phone, :address)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);

        if ($stmt->execute()) {
            echo json_encode(["message" => "User registered successfully"]);
        } else {
            echo json_encode(["message" => "User registration failed"]);
        }
    }
} else {
    echo json_encode(["message" => "Invalid input"]);
}
?>
