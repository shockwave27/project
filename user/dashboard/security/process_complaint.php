<?php
session_start();
echo $_SESSION['user_id'];
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
$userID = $_SESSION['user_id'];  // Fix: use 'user_id' instead of 'userID'
$userEmail = $_SESSION['user_email'];  // Fix: use 'user_email' instead of 'userEmail'
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    
    $complaintSubject = $_POST['complaintSubject'];
    $complaintText = $_POST['complaintText'];

    // Sanitize and validate user input (consider using prepared statements for better security)

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nimbus_island";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming $type and $reply are set elsewhere in your code
    $type = 'General'; // Adjust as needed
    $reply = ''; // Adjust as needed

    $sql = "INSERT INTO `complaint` (`user_id`, `title`, `statement`, `type`, `reply`, `date`, `email`)
            VALUES ('$userID', '$complaintSubject', '$complaintText', '$type', '$reply', NOW(), '$userEmail')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Complaint submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    // Redirect to the index page if accessed directly
    header('Location: ../index.php');
    exit;
}
?>
