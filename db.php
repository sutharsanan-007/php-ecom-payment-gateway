<?php
$servername = "db160.pair.com";  // Replace with your live server host
$username = "angvps11_44";  // Replace with your database username
$password = "rGJJJEFZr9ChgtrQ";  // Replace with your database password
$database = "angvps11_srilalitamecommerce";      // Replace with your database name

// Create a connection
$db = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// echo "success";
?>
