<?php
require("../../database/db.php");
$role = 2;
$query = "SELECT * FROM users WHERE role = '".$role."'";
$result = mysqli_query($db, $query);
if ($result) {
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode(['user' => $users]);
}
?>