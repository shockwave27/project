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
    $food_name = $_POST['food_name'];
    $food_details = $_POST['food_details'];
    $food_price = $_POST['food_price'];

    // Handle image upload (similar to your previous code)
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["food_pic"]["name"]);

    if (move_uploaded_file($_FILES["food_pic"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["food_pic"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO food (food_name, food_details, food_price, food_photo)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $food_name, $food_details, $food_price, $target_file);

    if ($stmt->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
