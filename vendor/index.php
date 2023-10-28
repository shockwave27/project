<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'autoload.php';

// Create an instance; passing `true` enables exceptions
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
    $mail->addAddress('johnprasad2733@gmail.com', 'Recipient Name');

    // Email content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Invoice Receipt';
    $mail->Body = file_get_contents('invoice.php'); // Load your HTML content
    $mail->AltBody = 'If you cannot view this email, please contact support.';

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
