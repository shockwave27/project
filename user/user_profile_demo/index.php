<?php
session_start();

// Check if the user is logged in (user_id exists in the session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not authenticated
    header('Location: ../login.php'); // Adjust the URL as needed
    exit;
}

$host = "localhost";
$username = "root";
$password = "";
$database = "nimbus_island"; // Change to your database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userID = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];

// SQL query to retrieve user's profile picture
$sql = "SELECT `user_pic` FROM `signin` WHERE `user_id` = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageData = $row["user_pic"];
    
    if (!empty($imageData)) {
   
         $imageSrc = "../colorlib-regform-18/$imageData";
    } else {
        // Default image if no image is found
        $imageSrc = "../colorlib-regform-18/uploads/defaultprofile.jpeg"; // Replace with your default image path
    }
} else {
    // User not found or no image found
    // You can handle this case as needed (e.g., display a message)
    $imageSrc = "../colorlib-regform-18/uploads/defaultprofile.jpeg"; // Replace with your default image path
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile_image_button.css">
    <title>User Profile</title>
</head>
<body>
<div class="container">

<div class="profile-button">

    <a href="#profile" class="scroll">

        <img src="<?php echo $imageSrc; ?>"alt="Avatar" class="avatar">
    </a>
</div>

    <div class="content">
        <!-- Your content goes here -->
        <?php echo $userID; ?> <!-- Display the user's name -->
        <?php echo $userName; ?> 
       
    </div>
</div>

</body>
</html>
