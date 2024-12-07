<?php
require("../../database/db.php");

// SQL query to select cart items along with user details
$random_key = $_POST['random_key'];
// $random_key = '628ccd9b47f8f2a59144f776b';
 
$query = "SELECT * FROM cart WHERE cart.random_key = '".$random_key."'";
$result = mysqli_query($db, $query);
if ($result) {
    $cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    $user_id = $cartItems[0]['user_id'];
    $res = "SELECT * FROM users WHERE id = '".$user_id."'";
    $user_res = mysqli_query($db, $res);
    $user_details = mysqli_fetch_all($user_res, MYSQLI_ASSOC);

    echo json_encode(['cart' => $cartItems, 'user' => $user_details]);
} else {
    echo "Error: " . mysqli_error($db);
}

mysqli_close($db);
?>
