<?php
require("../../../database/db.php");
$id = $_POST['id'];

$sqlUpdate = "UPDATE categories SET deleted_at = 1 WHERE id = $id";

if (mysqli_query($db, $sqlUpdate)) {
    echo json_encode(['event' => 'success', 'message' => 'Category deleted successfully!']);
} else {
    echo json_encode(['event' => 'error', 'message' => 'Failed to deleted category']);
}
?>