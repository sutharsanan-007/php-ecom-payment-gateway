<?php
require("../../../database/db.php");

$id = $_POST['id']; // Or $_GET['id'] depending on how you send it

// Prepare the SQL DELETE query
$sql = "DELETE FROM events WHERE id = $id";

// Execute the query
if (mysqli_query($db, $sql)) {
    // Return success response
    echo json_encode([
        'event' => 'success',
        'message' => 'Event deleted successfully!'
    ]);
} else {
    // Return error if deletion failed
    echo json_encode([
        'event' => 'error',
        'message' => 'Failed to delete event'
    ]);
}

?>