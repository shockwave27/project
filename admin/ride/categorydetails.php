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

// Perform the SQL query to fetch data from the "ridecategory" table
$sql = "SELECT `category_id`, `category_type`, `category_description` FROM `ridecategory` WHERE 1";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    $categories = []; // Initialize an empty array to store the categories

    // Fetch data and store it in the $categories array
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    // Close the database connection
    $conn->close();
} else {
    $categories = []; // If no data is returned, initialize an empty array
}


?>
