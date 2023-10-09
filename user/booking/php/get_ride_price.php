<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Replace with your database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nimbus_island";

// Get the ride name from the AJAX request
$rideName = $_GET['rideName'];

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute an SQL query to fetch the details of the ride (name, price, and photo)
$sql = "SELECT `ride_name`, `ride_price`, `ride_photo` FROM `ride` WHERE `ride_name` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $rideName);
$stmt->execute();
$stmt->bind_result($rideName, $ridePrice, $ridePhoto);

// Fetch the result
if ($stmt->fetch()) {
    // Create an associative array with ride details
    $rideDetails = array(
        'name' => $rideName,
        'price' => $ridePrice,
        'photo' => $ridePhoto
    );

    // Return ride details as JSON response
    echo json_encode($rideDetails);
} else {
    // Return an error message if the ride is not found
    echo json_encode(array('error' => 'Ride not found'));
}

// Close the database connection
$stmt->close();
$conn->close();
?>
