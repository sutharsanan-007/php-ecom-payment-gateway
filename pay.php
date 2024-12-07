<?php
// Include the Razorpay SDK
require('razorpay-php/Razorpay.php');
require('razorpay-php/src/Api.php');
require('../database/db.php');
session_start(); // Start the session

use Razorpay\Api\Api;

$keyId = 'rzp_test_z3RNGPAyf5y1SH';
$keySecret = 'dyBxcRKgrS6B0Xzvn9s4NY2L';

$api = new Api($keyId, $keySecret);
// $api->client->setCurlOption(CURLOPT_SSL_VERIFYPEER, false);
$amount = $_POST['amount'];
// Data for the payment order (you can pass dynamic data like amount, currency, etc.)
$orderData = [
    'amount'         => $amount * 100, // Amount in paise (1000 paise = 10 INR)
    'currency'       => 'INR',
    'receipt'        => 'order_rcptid_123',
    'payment_capture'=> 1 // 1 for auto capture, 0 for manual
];

$order = $api->order->create($orderData);

$order_id = $order['id'];
$payment_status = 'pending';
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$payment_id = null;
$signature = null;
$err_code = null;
$err_description = null;
$err_source = null;
$err_step = null;
$err_reason = null;

        $sql = "INSERT INTO payments (`user_id`, `email`, `payment_id`, `order_id`, `signature`, `amount`, `status`, `err_code`, `err_description`, `err_source`, `err_step`, `err_reason`) 
            VALUES ('$user_id', '$email','$payment_id', '$order_id', '$signature', '$amount', '$payment_status','$err_code','$err_description','$err_source','$err_step','$err_reason')";

    if ($db->query($sql) === TRUE) {
        // echo "Payment details stored successfully!";
    } else {
        // echo "Error: " . $db->error;
    }




echo json_encode(['order_id' => $order_id,'keyId' => $keyId,'amount' => $amount]);
?>