<?php
// Connect to your database
$db = new mysqli('localhost', 'root', '', 'nimbus_island');

// Check for connection errors
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get the posted data from the AJAX request
$rideId = $_POST['ride_id'];
$rideName = $_POST['ride_name'];
$rideDetails = $_POST['ride_details'];
$ridePrice = $_POST['ride_price'];

// Prepare the SQL query to update the ride
$sql = "UPDATE ride SET ride_name = ?, ride_details = ?, ride_price = ? WHERE ride_id = ?";
$stmt = $db->prepare($sql);

// Bind parameters to the prepared statement
$stmt->bind_param("sssi", $rideName, $rideDetails, $ridePrice, $rideId);

// Execute the query
if ($stmt->execute()) {
    // Prepare success response
    $response = array(
        'success' => true,
        'message' => 'Product updated successfully'
    );
} else {
    // Prepare error response
    $response = array(
        'success' => false,
        'message' => 'Failed to update product: ' . $stmt->error
    );
}

// Close the statement and database connection
$stmt->close();
$db->close();

// Send JSON response back to the client
header('Content-Type: application/json');
echo json_encode($response);
?>