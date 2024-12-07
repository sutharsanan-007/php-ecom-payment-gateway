<?php 
require("../../PHPMailer/mail.php");
$user_data = $_POST['user_data'];
$subject_name = $_POST['subject_name'];
$body_content = $_POST['body_content'];
$image = $_FILES['file'];

if (empty($subject_name) || empty($image) || empty($body_content)) {
    echo json_encode(['event' => 'error','message' => 'All fields are required']);
    exit;
}

$uploadDir = "../../uploads/email/";
$newFileName = time() . '_' . basename($image['name']);
$filePath = $uploadDir . $newFileName;

// Move the uploaded file to the target directory
if (move_uploaded_file($image['tmp_name'], $filePath)) {
    sendMail($user_data,$subject_name,$body_content,$newFileName);
} else {
    // Return error if file upload failed
    echo json_encode(['event' => 'error', 'message' => 'File upload failed']);
}
?>