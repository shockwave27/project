<?php
// Database connection parameters
$servername = "localhost"; // Replace with your database server name
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "nimbus_island"; // Replace with your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected ride data from the POST request
$data = json_decode(file_get_contents("php://input"));

// Extract data
$user_id = $data->user_id; // You need to pass the user ID from the client side
$selected_rides = json_encode($data->selectedRides);
$total_price = $data->totalPrice; // You need to calculate the total price on the client side

// Insert data into the userridebooking table
$sql = "INSERT INTO userridebooking (user_id, selected_rides, total_price, order_date)
        VALUES ('$user_id', '$selected_rides', '$total_price', NOW())";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("message" => "Ride booking successful"));
} else {
    echo json_encode(array("message" => "Error: " . $conn->error));
}

// Close the database connection
$conn->close();
?>
