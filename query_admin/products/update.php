<?php
require("../../../database/db.php");
$id = $_POST['id'];
$category_id = $_POST['category_id'];
$name = $_POST['name'];
$image = $_FILES['file'];
$price = $_POST['price'];

if (empty($name) || empty($category_id) || empty($price)) {
    echo json_encode(['event' => 'error','message' => 'All fields are required']);
    exit;
}
// Check if the product name already exists
$sqlCheck = "SELECT * FROM products WHERE name = '$name' AND category_id = $category_id AND deleted_at = 0 AND id != $id";
$result = mysqli_query($db, $sqlCheck);

if (mysqli_num_rows($result) > 0) {
    // Return error if the product name already exists
    echo json_encode(['event' => 'error', 'message' => 'Product name already exists']);
    exit;
}

$sqlUpdate = "UPDATE products SET name = '$name', category_id = $category_id, price = $price";

if (!empty($image['name'])) {
    // If a new image is uploaded, handle the file upload first
    $uploadDir = "../../uploads/products/";
    $newFileName = time() . '_' . basename($image['name']);
    $filePath = $uploadDir . $newFileName;

    if (move_uploaded_file($image['tmp_name'], $filePath)) {
        $sqlUpdate .= ", image = '$newFileName'";
    } else {
        echo json_encode(['event' => 'error', 'message' => 'File upload failed']);
        exit;
    }
}

$sqlUpdate .= " WHERE id = $id";

// Execute the update query using mysqli_query()
if (mysqli_query($db, $sqlUpdate)) {
    echo json_encode(['event' => 'success', 'message' => 'Product updated successfully!']);
} else {
    echo json_encode(['event' => 'error', 'message' => 'Failed to update product']);
}
?>