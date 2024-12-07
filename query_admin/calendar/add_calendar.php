<?php
require("../../../database/db.php");
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

// print_r($_POST);
$sql = "INSERT INTO events (title, start, end) VALUES ('$title', '$start', '$end')";

// Execute the query
if (mysqli_query($db, $sql)) {
    // Return success response
    echo json_encode([
        'event' => 'success',
        'message' => 'Event inserted successfully!'
    ]);
} else {
    // Return error if insertion failed
    echo json_encode([
        'event' => 'error',
        'message' => 'Failed to insert into database'
    ]);
}

?>