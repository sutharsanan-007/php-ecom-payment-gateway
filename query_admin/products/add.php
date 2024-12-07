<?php
require("../../../database/db.php");
$category_id = $_POST['category_id'];
$name = $_POST['name'];
$image = $_FILES['file'];
$price = $_POST['price'];

if (empty($name) || empty($image) || empty($category_id) || empty($price)) {
    echo json_encode(['event' => 'error','message' => 'All fields are required']);
    exit;
}
// Check if the product name already exists
$sqlCheck = "SELECT * FROM products WHERE name = '$name' AND category_id = '$category_id' AND deleted_at = 0";
$result = mysqli_query($db, $sqlCheck);

if (mysqli_num_rows($result) > 0) {
    // Return error if the product name already exists
    echo json_encode(['event' => 'error', 'message' => 'Product name already exists']);
    exit;
}

// Define the upload directory
$uploadDir = "../../uploads/products/";
$newFileName = time() . '_' . basename($image['name']);
$filePath = $uploadDir . $newFileName;

// Move the uploaded file to the target directory
if (move_uploaded_file($image['tmp_name'], $filePath)) {
    // Prepare the INSERT query
    $sql = "INSERT INTO products (category_id, name, image, price) VALUES ('$category_id', '$name', '$newFileName', '$price')";

    // Execute the query
    if (mysqli_query($db, $sql)) {
        // Return success response
        echo json_encode(['event' => 'success','message' => 'Products inserted successfully!']);
    } else {
        // Return error if insertion failed
        echo json_encode(['event' => 'error', 'message' => 'Failed to insert into database']);
    }
} else {
    // Return error if file upload failed
    echo json_encode(['event' => 'error', 'message' => 'File upload failed']);
}
?>
