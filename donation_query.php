<?php
require('../database/db.php');
require('../admin/PHPMailer/mail.php');

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pan = $_POST['pan'];
$address = $_POST['address'];
$remarks = $_POST['remarks'];
$amount = $_POST['amount'];
$title = $_POST['title'];
$sub_title = $_POST['sub_title'];
$order_id = $_POST['order_id'];

$sql = "INSERT INTO `donation` (`first_name`, `last_name`, `phone_number`, `email`, `pan`, `address`, `remarks`, `title`, `sub_title`, `amount`, `order_id`) 
        VALUES ('$first_name', '$last_name', '$phone', '$email', '$pan', '$address', '$remarks', '$title', '$sub_title', '$amount','$order_id')";

if (mysqli_query($db, $sql)) {
    if($title == "vedic-courses-online-residential" || $title == "astrology-courses-online-residential"){
        $subject_name = "Request for Information on Time Course Availability";
        $body_content = " I would like to suggest a convenient time for us to discuss further or for the course slot. Would work for you? If not, please feel free to suggest an alternative time that suits your schedule.";
        $newFileName = "";
        sendMail($email,$subject_name,$body_content,$newFileName);
        echo json_encode(['event' => 'success','message' => 'Donated successfully']);
    }
} else {
    echo json_encode(['event' => 'error','message' => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}

?>