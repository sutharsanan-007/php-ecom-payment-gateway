<?php
require("../../database/db.php");

// SQL query to select cart items along with user details
$query = "
    SELECT cart.*, users.name AS user_name, users.email AS user_email, users.address AS user_address
    FROM cart
    JOIN users ON cart.user_id = users.id GROUP BY cart.random_key
";

$result = mysqli_query($db, $query);

if ($result) {
    $cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Process the $cartItems array as needed
    // echo "<pre>";print_r($cartItems);
    echo json_encode(['cart' => $cartItems]);
} else {
    echo "Error: " . mysqli_error($db);
}

mysqli_close($db);
?>
