<?php
require("../../database/db.php");
// Count records in the users table
$queryUsers = "SELECT COUNT(*) AS user_count FROM users WHERE role = 2";
$resultUsers = mysqli_query($db, $queryUsers);
$rowUsers = mysqli_fetch_assoc($resultUsers);
$userCount = $rowUsers['user_count'];

// Count records in the cart table
$queryCart = "SELECT COUNT(*) AS cart_count FROM cart";
$resultCart = mysqli_query($db, $queryCart);
$rowCart = mysqli_fetch_assoc($resultCart);
$cartCount = $rowCart['cart_count'];

echo json_encode(['users' => $userCount, 'carts' => $cartCount]);
?>