<?php
include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->email, $data->password)) {
    $email = $data->email;
    $password = $data->password;

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        echo json_encode(["message" => "Login successful", "user" => $user]);
    } else {
        echo json_encode(["message" => "Invalid email or password"]);
    }
}
?>
