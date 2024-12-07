<?php
require("../../../database/db.php");

$name = $_POST['name'];
$image = $_FILES['file'];
if (empty($name) || empty($image)) {
    echo json_encode(['event' => 'error','message' => 'All fields are required']);
    exit;
}
// Check if the category name already exists
$sqlCheck = "SELECT * FROM categories WHERE name = '$name' AND deleted_at = 0";
$result = mysqli_query($db, $sqlCheck);

if (mysqli_num_rows($result) > 0) {
    // Return error if the category name already exists
    echo json_encode(['event' => 'error', 'message' => 'Category name already exists']);
    exit;
}

// Define the upload directory
$uploadDir = "../../uploads/categories/";
$newFileName = time() . '_' . basename($image['name']);
$filePath = $uploadDir . $newFileName;

// Move the uploaded file to the target directory
if (move_uploaded_file($image['tmp_name'], $filePath)) {
    // Prepare the INSERT query
    $sql = "INSERT INTO categories (name, image) VALUES ('$name', '$newFileName')";

    // Execute the query
    if (mysqli_query($db, $sql)) {
        // Return success response
        echo json_encode(['event' => 'success','message' => 'Category inserted successfully!']);
    } else {
        // Return error if insertion failed
        echo json_encode(['event' => 'error', 'message' => 'Failed to insert into database']);
    }
} else {
    // Return error if file upload failed
    echo json_encode(['event' => 'error', 'message' => 'File upload failed']);
}
?>
