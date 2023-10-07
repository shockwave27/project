<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nimbus_island"; // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $category_type = $_POST['category_type'];
    $category_description = $_POST['category_description'];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO ridecategory (category_type, category_description)
            VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $category_type, $category_description);

    if ($stmt->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
