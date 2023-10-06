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

// Perform the SQL query to fetch data from the "food" table
$sql = "SELECT `food_id`, `food_name`, `food_details`, `food_availability`, `food_price`, `food_photo` FROM `food`";
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
