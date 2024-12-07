<?php
    require("../../database/db.php");
    session_start();
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = md5($password);
    // Basic validation to check if fields are empty
    if (empty($email) || empty($password)) {
        echo json_encode(['event' => 'error','message' => 'All fields are required']);
        exit;
    }

    // Check if email already exists
    $email_check_query = "SELECT * FROM users WHERE email = '$email' AND role = 1";
    $result = mysqli_query($db, $email_check_query);
    if (mysqli_num_rows($result) > 0) {
        $check_query = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$hashed_password."'";
        $res = mysqli_query($db, $check_query);
        if (mysqli_num_rows($res) === 1) {
            $user = mysqli_fetch_assoc($res);
            // $response = ['name' => $user['name'], 'email' => $user['email'], 'phone' => $user['phone_number']];
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            echo json_encode(['event' => 'success','message' => 'Logged in successfully']);
        }else{
            echo json_encode(['event' => 'error','message' => 'Password is incorrect']);
        }

    }else{
        echo json_encode(['event' => 'error','message' => 'Email is incorrect']);

    }
?>