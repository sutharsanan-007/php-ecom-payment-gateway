<?php
require("../../../database/db.php");
$id = $_POST['id'];
$name = $_POST['name'];
$image = $_FILES['file'];
if (empty($name)) {
    echo json_encode(['event' => 'error','message' => 'Category name is required']);
    exit;
}
// Check if the category name already exists
$sqlCheck = "SELECT * FROM categories WHERE name = '$name' AND deleted_at = 0 AND id != $id";
$result = mysqli_query($db, $sqlCheck);

if (mysqli_num_rows($result) > 0) {
    // Return error if the category name already exists
    echo json_encode(['event' => 'error', 'message' => 'Category name already exists']);
    exit;
}

$sqlUpdate = "UPDATE categories SET name = '$name'";

if (!empty($image['name'])) {
    // If a new image is uploaded, handle the file upload first
    $uploadDir = "../../uploads/categories/";
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
    echo json_encode(['event' => 'success', 'message' => 'Category updated successfully!']);
} else {
    echo json_encode(['event' => 'error', 'message' => 'Failed to update category']);
}
?>