<?php
// Create connection
$conn = new mysqli('localhost', 'root', '', 'nimbus_island');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT `complaint_id`, `user_id`, `title`, `statement`, `type`, `reply`, `date`, `email` FROM `complaint` WHERE 1";
$result = $conn->query($sql);

// Close connection
$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($result->fetch_all(MYSQLI_ASSOC));
?>
