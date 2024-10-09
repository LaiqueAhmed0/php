<?php
include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->product_name, $data->price, $data->stock)) {
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, price, discount, stock, image_url) VALUES (:name, :description, :price, :discount, :stock, :image_url)");
    
    $stmt->bindParam(':name', $data->product_name);
    $stmt->bindParam(':description', $data->product_description);
    $stmt->bindParam(':price', $data->price);
    $stmt->bindParam(':discount', $data->discount);
    $stmt->bindParam(':stock', $data->stock);
    $stmt->bindParam(':image_url', $data->image_url);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Product added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add product']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Required fields are missing']);
}
?>
