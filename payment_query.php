<?php 

require('../database/db.php');

$payment_id = $_POST['payment_id'];
$order_id = $_POST['order_id'];
$signature = ($_POST['signature'] == "") ? null : $_POST['signature'];
$status = $_POST['status'];
$description = ($_POST['description'] == "") ? null : mysqli_real_escape_string($db, $_POST['description']);
$code = ($_POST['code'] == "") ? null : mysqli_real_escape_string($db, $_POST['code']);
$source = ($_POST['source'] == "") ? null : mysqli_real_escape_string($db, $_POST['source']);
$step = ($_POST['step'] == "") ? null : mysqli_real_escape_string($db, $_POST['step']);
$reason = ($_POST['reason'] == "") ? null : mysqli_real_escape_string($db, $_POST['reason']);

$paymentTable = 0;
$paymentHistoryTable = 0;

if($signature != null){
    $update_query = "UPDATE payments SET signature = '$signature', status = '$status' WHERE order_id = '$order_id'";

    // Execute the update query
    if (mysqli_query($db, $update_query)) {
        $paymentTable = 1;
        // echo "Payment table updated successfully.<br>";
    } else {
        echo "Error updating payment table: " . mysqli_error($db) . "<br>";
    }
}

// Insert into the payment_history table
$insert_query = "INSERT INTO payment_history (`payment_id`, `order_id`, `signature`, `status`, `description`, `code`, `source`, `step`, `reason`) 
                 VALUES ('$payment_id', '$order_id' , '$signature','$status', '$description', '$code', '$source', '$step', '$reason')";

// Execute the insert query
if (mysqli_query($db, $insert_query)) {
    $paymentHistoryTable = 1;
    // echo "Payment history inserted successfully.<br>";
} else {
    echo "Error inserting into payment history: " . mysqli_error($db) . "<br>";
}

if($paymentTable == 1 && $paymentHistoryTable == 1){
    echo json_encode(['event' => 'success','message' => 'Paid successfully']);
}
if($paymentTable == 0 && $paymentHistoryTable == 1){
    echo json_encode(['event' => 'error','message' => 'Payment failed']);
}
if($paymentTable == 0 && $paymentHistoryTable == 0){
    echo json_encode(['event' => 'error','message' => 'Record not updated']);
}



?>