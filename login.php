<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "nimbus_island"; // Change to your database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginUsername = $_POST['loginUsername'];
    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];

    $checkLoginQuery = "SELECT * FROM login WHERE (user_name='$loginUsername' OR user_email='$loginEmail') AND user_password='$loginPassword' AND user_status='active'";

    $loginResult = $conn->query($checkLoginQuery);

    if ($loginResult->num_rows > 0) {
        // Fetch user data from the database
        $userData = $loginResult->fetch_assoc();

        // Store user data in session
        $_SESSION['user_id'] = $userData['user_id'];
        $_SESSION['user_name'] = $userData['user_name'];
        $_SESSION['user_email'] = $userData['user_email'];
        $_SESSION['user_type'] = $userData['user_type']; // Add user_type to the session

        // Check user_type and redirect accordingly
        if ($_SESSION['user_type'] == 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: user/index.php");
        }

        exit;  
    } else {
        echo '<script>alert("Invalid login credentials.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
    }
}

$conn->close();
?>
