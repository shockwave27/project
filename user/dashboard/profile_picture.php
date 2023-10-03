<?php
// Initialize the session
session_start();

// Check if the user is authenticated, if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Replace these with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nimbus_island"; // Change the database name to "nimbus_island"

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    echo 'Connection failed: ' . $conn->connect_error;
    exit;
}

// Get user ID from the session
$userID = $_SESSION['user_id'];

// Retrieve the user's profile picture from the `signin` table
$selectSql = "SELECT `user_pic` FROM `signin` WHERE `user_id` = $userID";
$result = $conn->query($selectSql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userPic = $row['user_pic'];

    // Define the directory where profile pictures are stored
    $profilePictureDirectory = '../user/colorlib-regform-18/uploads/';

    // Construct the full path to the user's profile picture
    $profilePicturePath = $profilePictureDirectory . $userPic;

    // Check if the profile picture file exists
    if (file_exists($profilePicturePath)) {
        // Display the user's profile picture
        header('Content-Type: image/jpeg'); // Change content type based on file type
        readfile($profilePicturePath);
         // Echo the image source URL for debugging
         echo '<br>';
         echo 'Image Source URL: ' . $profilePicturePath;
    } else {
        // Profile picture file does not exist
        http_response_code(404); // Not Found
        echo 'Profile picture not found';
    }
} else {
    // User not found in the database
    http_response_code(404); // Not Found
    echo 'User not found';
}

// Close the database connection
$conn->close();
?>
