<?php
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

    $checkLoginQuery = "SELECT * FROM login WHERE (user_name='$loginUsername' AND user_email='$loginEmail') AND user_password='$loginPassword'";
    $loginResult = $conn->query($checkLoginQuery);

    if ($loginResult->num_rows > 0) {
        echo "Login successful!";
        // You can redirect the user to the desired page after successful login
        // For example: header("Location: dashboard.php");
    } else {
        echo "Invalid login credentials.";
    }
}

$conn->close();
?>

