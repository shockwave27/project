<?php
// Check if the "printInvoice" button was clicked
if (isset($_POST['printInvoice'])) {
    // Obtain the unique ID and username from the POST request
    $uniqueID = $_POST['uniqueID'];
    $username = $_POST['username'];
    echo "Unique ID: " . $uniqueID . "<br>";
    // Establish a database connection (you should have a database connection setup)
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "nimbus_island";

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Check the database connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to retrieve invoice data
    $sql = "SELECT `ticket_id`, `t_uniq_id`, `user_id`, `user_name`, `full_name`, `email`, `name_on_card`, `card_number`, `price`, `rides`, `pay_date`, `book_date` FROM `ticket` WHERE `t_uniq_id` = '$uniqueID' AND `user_name` = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Retrieve data from the database
            $ticketID = $row['ticket_id'];
            $tUniqID = $row['t_uniq_id'];
            $userID = $row['user_id'];
            $fullName = $row['full_name'];
            $email = $row['email'];
            $nameOnCard = $row['name_on_card'];
            $cardNumber = $row['card_number'];
            $ticketPrice = $row['price'];
            $numberOfTickets = $row['rides'];
            $payDate = $row['pay_date'];
            $bookDate = $row['book_date'];

            // Now, you can echo these variables in your HTML template
            echo "Ticket ID: " . $ticketID . "<br>";
            echo "Unique ID: " . $tUniqID . "<br>";
            echo "User ID: " . $userID . "<br>";
            echo "Full Name: " . $fullName . "<br>";
            echo "Email: " . $email . "<br>";
            echo "Name on Card: " . $nameOnCard . "<br>";
            echo "Card Number: " . $cardNumber . "<br>";
            echo "Ticket Price: " . $ticketPrice . "<br>";
            echo "Number of Tickets: " . $numberOfTickets . "<br>";
            echo "Payment Date: " . $payDate . "<br>";
            echo "Book Date: " . $bookDate . "<br>";      
          }
    } else {
        echo "No records found for the given criteria.";
    }

    // Close the database connection
    $conn->close();
}

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'autoload.php';

// Create an instance; passing `true` enables exceptions

try {
    // Create a PHPMailer instance
    $mail = new PHPMailer(true);

    // Server settings
    $mail->SMTPDebug = 0;  // Disable debug output (set to 2 for debugging)
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'islandnimbus@gmail.com';  // Replace with your Gmail email address
    $mail->Password = 'cezy gcvg zooq fjms';  // Replace with your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender and recipient
    $mail->setFrom('islandnimbus@gmail.com', 'Mailer');
    $mail->addAddress($email, 'Recipient Name');

    // Email content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Invoice Receipt';

    // Include your generated HTML content from invoice.php
   

    $message = file_get_contents('invoice.php'); // Load your HTML content

#
    // Replace placeholders with actual dynamic data
   
    #$currentDate = date('Y-m-d');
    $message = str_replace('[USERNAME]', $fullName, $message);
    $message = str_replace('[UNIQID]', $tUniqID, $message);
    $message = str_replace('[PAYDATE]', $payDate, $message);
    $message = str_replace('[NUMBEROFTICKETS]', $numberOfTickets, $message);
    $message = str_replace('[TICKETPRICE]', $ticketPrice, $message);
 #   $dynamicContent = str_replace('[DATE]', $currentDate, $dynamicContent);

    $mail->Body = $message;
// #die();
//     $mail->Body = $message;
    $mail->AltBody = 'If you cannot view this email, please contact support.';

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
