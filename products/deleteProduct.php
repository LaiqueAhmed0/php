<?php
include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->product_id)) {
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = :product_id");
    $stmt->bindParam(':product_id', $data->product_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Product deleted successfully"]);
    } else {
        echo json_encode(["message" => "Product deletion failed"]);
    }
}
?>
