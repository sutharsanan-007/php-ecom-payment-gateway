<?php

session_start();
require('razorpay-php/Razorpay.php');
require('razorpay-php/src/Api.php');
require('../database/db.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$keyId = 'rzp_test_z3RNGPAyf5y1SH';
$keySecret = 'dyBxcRKgrS6B0Xzvn9s4NY2L';
$success = true;
$payment_id = $_POST['payment_id'];
$order_id = $_POST['order_id'];
$signature = $_POST['signature'];

$api = new Api($keyId, $keySecret);
$error = "Payment Failed";
$attributes = array(
    'razorpay_order_id' => $order_id,
    'razorpay_payment_id' => $payment_id,
    'razorpay_signature' => $signature
);
// echo json_encode(['data' => print_r($_POST)]);die;
try {
    // Verify the payment signature
    $api->utility->verifyPaymentSignature($attributes);
    $payment_status = 'Success'; // Assuming the payment is successful

    // $sql = "UPDATE payments SET payment_id = '$payment_id', signature = '$signature', status = '$payment_status' WHERE order_id = '$order_id'";

    // if ($db->query($sql) === TRUE) {
    //     // echo "Payment details stored successfully!";
    //     echo json_encode(['event' => 'success','message' => 'payment record inserted Successfully']);
    // } else {
    //     echo "Error: " . $db->error;
    // }

} catch (SignatureVerificationError $e) {
    // Handle payment verification error
    $success = false;
    // $payment_status = 'failed';
    // $sql = "UPDATE payments SET payment_id = '$payment_id', signature = '$signature', status = '$payment_status' WHERE order_id = '$order_id'";

    // if ($db->query($sql) === TRUE) {
    //     echo json_encode(['event' => 'error','message' => 'Paid Unsuccessfully']);
    // } else {
    //     echo "Error: " . $db->error;
    // }

    // // Log the error
    // error_log("Payment verification failed: " . $e->getMessage());
    // echo "Payment verification failed: " . $e->getMessage();
}

if ($success === true)
{
   echo json_encode(['event' => 'success','message' => 'signature Successfully']);
}
else
{
   echo json_encode(['event' => 'success','message' => 'signature not Successfully']);
}
