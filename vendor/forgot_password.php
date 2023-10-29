<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'autoload.php';

// Function to send an OTP email
function sendOTPEmail($recipient, $otp) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;  // Disable debug output (set to 2 for debugging)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'islandnimbus@gmail.com';  // Replace with your Gmail email address
        $mail->Password = 'cezy gcvg zooq fjms';        // Replace with your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('islandnimbus@gmail.com', 'Mailer');
        $mail->addAddress($recipient, 'Recipient Name'); // Use the user's email

        // Email content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Your OTP Code';
        $mail->Body = 'Your OTP code is: ' . $otp; // Include the OTP code

        // Send the email
        $mail->send();
        echo 'OTP email has been sent';
    } catch (Exception $e) {
        echo "OTP email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

session_start();
$userID = $_SESSION['user_id'];

// Database configuration
$servername = "localhost";
$dbUsername = "root";
$dbPassword = ""; // No password
$database = "nimbus_island";

// Create a connection to the database
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the user's email based on the user ID
$sql = "SELECT `user_email` FROM `login` WHERE `user_id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $userEmail = $row['user_email'];

    // Generate and send an OTP to the user's email
    $otp = generateRandomOTP(); // Implement your OTP generation logic
    sendOTPEmail($userEmail, $otp);

    // Store the OTP in the database or session for verification
      // Store the OTP in the session for verification
    $_SESSION['storeotp'] = $otp;
    // Redirect the user to an OTP verification page
    header("Location: otp_verification.php");
} else {
    echo "User not found";
}

// Close the database connection
mysqli_close($conn);

// Function to generate a random OTP
function generateRandomOTP() {
    return rand(100000, 999999); // Generates a 6-digit OTP
}
?>
