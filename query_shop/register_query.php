<?php
require("../../database/db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$number = $_POST['number'];
$address = $_POST['address'];
$role = 2;
// Basic validation to check if fields are empty
if (empty($name) || empty($email) || empty($password) || empty($number) || empty($address)) {
    echo json_encode(['event' => 'error','message' => 'All fields are required']);
    exit;
}

// Check if email already exists
$email_check_query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($db, $email_check_query);

if (mysqli_num_rows($result) > 0) {
    // Email already exists
    echo json_encode(['event' => 'error','message' => 'Email already exists']);
} else {
    $hashed_password = md5($password);
    $insert_query = "INSERT INTO users (name, email, password, phone_number, address, role) VALUES ('".$name."', '".$email."', '".$hashed_password."', '".$number."', '".$address."','".$role."')";

    if (mysqli_query($db, $insert_query)) {
        echo json_encode(['event' => 'success', 'message' => 'User registered successfully']);
    } else {
        echo json_encode(['event' => 'Error inserting user: ' . mysqli_error($db)]);
    }
}
?>
