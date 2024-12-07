<?php
require("../../database/db.php");

$query = "SELECT * FROM categories WHERE deleted_at = 0";
$result = mysqli_query($db, $query);
if ($result) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode(['data' => $data]);
}
?>