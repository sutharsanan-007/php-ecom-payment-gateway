<?php
require("../../../database/db.php");

$query = "SELECT * FROM events ORDER BY id";
$result = mysqli_query($db, $query);
if ($result) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($data);
}
?>