<?php
include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->email, $data->password)) {
    $email = $data->email;
    $newPassword = $data->password; // Get the new password from the request

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $updateStmt = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
        $updateStmt->bindParam(':password', $hashedPassword);
        $updateStmt->bindParam(':email', $email);
        $updateStmt->execute();

        echo json_encode(["message" => "Password changed successfully."]);
    } else {
        echo json_encode(["message" => "Email not found."]);
    }
} else {
    echo json_encode(["message" => "Email and password are required."]);
}
?>
