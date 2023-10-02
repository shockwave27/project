<?php
// Replace these with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nimbus_island"; // Change the database name to "nimbus_island"

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform the SQL query to fetch data from the "login" table
$sql = "SELECT `user_id`, `user_name`, `user_email`, `user_password`, `user_type`, `user_status`, `user_pic` FROM `login` WHERE 1";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    $users = []; // Initialize an empty array to store the user data

    // Fetch data and store it in the $users array
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    // Close the database connection
    $conn->close();
} else {
    $users = []; // If no data is returned, initialize an empty array
}
?>
