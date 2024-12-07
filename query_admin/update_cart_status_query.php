<?php
require("../../database/db.php");

$random_key = $_POST['random_key'];
$status = 2;

$query = "UPDATE `cart` SET `status` = '".$status."' WHERE `random_key` = '".$random_key."'";

$result = mysqli_query($db, $query);

if ($result) {
    echo json_encode(['event' => 'success', 'message' => 'Status updated successfully']);
} else {
    echo "Error updating record: " . mysqli_error($db);
}

?>