<?php
include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    // Prepare the SQL statement to update the order
    $stmt = $conn->prepare("
        UPDATE orders_user 
        SET 
            order_id = :order_id,
            user_name = :user_name,
            user_email = :user_email,
            user_address = :user_address,
            user_phone = :user_phone,
            user_gender = :user_gender,
            product_name = :product_name,
            product_price = :product_price,
            product_total = :product_total,
            product_quantity = :product_quantity,
            product_discount = :product_discount,
            product_image = :product_image,
            order_status = :order_status
        WHERE id = :id
    ");

    // Bind parameters
    $stmt->bindParam(':id', $data->id);
    $stmt->bindParam(':order_id', $data->order_id);
    $stmt->bindParam(':user_name', $data->user_name);
    $stmt->bindParam(':user_email', $data->user_email);
    $stmt->bindParam(':user_address', $data->user_address);
    $stmt->bindParam(':user_phone', $data->user_phone);
    $stmt->bindParam(':user_gender', $data->user_gender);
    $stmt->bindParam(':product_name', $data->product_name);
    $stmt->bindParam(':product_price', $data->product_price);
    $stmt->bindParam(':product_total', $data->product_total);
    $stmt->bindParam(':product_quantity', $data->product_quantity);
    $stmt->bindParam(':product_discount', $data->product_discount);
    $stmt->bindParam(':product_image', $data->product_image);
    $stmt->bindParam(':order_status', $data->order_status);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["message" => "Order updated successfully"]);
    } else {
        echo json_encode(["message" => "Order update failed"]);
    }
} else {
    echo json_encode(["message" => "Invalid ID"]);
}
?>
