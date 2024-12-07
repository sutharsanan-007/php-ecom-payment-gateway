<?php
require("../../database/db.php");
$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true); // Decode JSON to associative array
session_start(); // Start the session

$user_id = $_SESSION['id'];
$key_value = bin2hex(random_bytes(16));
// echo json_encode(['data' => $data]);
if (isset($data['cart'])) {
    $cart = $data['cart'];

    // Process each item in the cart
    foreach ($cart as $item) {
       
        $product_id = $item['id'];
        $image = $item['image'];
        $name = $item['name'];
        $price = $item['price'];
        $quantity = $item['quantity'];
        $total = $price * $quantity;
        $payment_id = $item['payment_id'];
        $order_id = $item['order_id'];
        $signature = $item['signature'];
        
        // Prepare your SQL query to insert into the cart table
        $insert_query = "INSERT INTO cart (user_id, product_id, image, name, price, quantity,random_key,`payment_id`,`order_id`,`signature`)
                         VALUES ('$user_id', '$product_id', '$image', '$name', '$price', '$quantity','$key_value','$payment_id','$order_id','$signature')";

        if (!mysqli_query($db, $insert_query)) {
            echo json_encode(['event' => 'error', 'message' => 'Error inserting cart item: ' . mysqli_error($db)]);
            exit; // Stop further processing if there is an error
        }
    }

    echo json_encode(['event' => 'success', 'message' => 'Items added to cart successfully']);
} else {
    echo json_encode(['event' => 'error', 'message' => 'No cart data received']);
}

?>