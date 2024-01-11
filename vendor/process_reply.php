<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'autoload.php';

// Function to send an email
function sendEmail($recipient, $subject, $message) {
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
        $mail->addAddress($recipient);

        // Email content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch data from the form
    $complaint_id = $_POST['complaint_id'];
    $user_id = $_POST['user_id'];
    $reply = $_POST['reply'];
    $conn = new mysqli('localhost', 'root', '', 'nimbus_island');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    // Fetch user email
    $query = "SELECT `user_email` FROM `login` WHERE `user_id` = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        $user_email = $user['user_email'];

        // Send reply to the user's email
        $subject = "Reply to your Complaint";
        $message = "Your complaint has been reviewed. Here is the reply:\n\n$reply";
        
        if (sendEmail($user_email, $subject, $message)) {
            // Update the database with the reply
            $update_query = "UPDATE `complaint` SET `reply` = ? WHERE `complaint_id` = ?";
            $update_stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($update_stmt, "si", $reply, $complaint_id);
            
            if (mysqli_stmt_execute($update_stmt)) {
                echo "Reply sent successfully.";
            } else {
                echo "Error updating database: " . mysqli_error($conn);
            }
        } else {
            echo "Error sending email.";
        }
    } else {
        echo "Error fetching user details: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
