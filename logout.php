<?php
session_start(); // Start the session

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['role']);

header("Location: login.php");
exit(); // Always exit after a redirect
?>
