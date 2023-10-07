<?php
// Replace these with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nimbus_island";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform the SQL query to fetch data from the "ride" table
// Perform the SQL query to fetch data from the "ride" table
$sql = "SELECT `ride_id`, `ride_name`, `ride_details`, `ride_availability`, `ride_price`, `ride_photo`, `ride_type` FROM `ride` WHERE 1";
$result = $conn->query($sql);


// Check if there are rows returned
if ($result->num_rows > 0) {
    $products = []; // Initialize an empty array to store the products

    // Fetch data and store it in the $products array
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Close the database connection
    $conn->close();
} else {
    $products = []; // If no data is returned, initialize an empty array
}
?>
