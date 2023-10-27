<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userid = $_POST["userid"];
    $nameOnCard = $_POST["name"];
    $cardNumber = $_POST["cardnumber"];
    $expirationDate = $_POST["expirationdate"];
    $securityCode = $_POST["securitycode"];
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $numberOfTickets = $_POST["ticket-quantity"];
    $ticketPrice = $_POST['total-price'];
    $bookdate = $_POST["bookdate"];


    echo "User ID: " . $userid . "<br>";
    echo "Name on Card: " . $nameOnCard . "<br>";
    echo "Card Number: " . $cardNumber . "<br>";
    echo "Expiration Date: " . $expirationDate . "<br>";
    echo "Security Code: " . $securityCode . "<br>";
    echo "Username: " . $username . "<br>";
    echo "Full Name: " . $fullname . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Number of Tickets: " . $numberOfTickets . "<br>";
    echo "Total Price: $" . $ticketPrice . "<br>";
    echo "book date". $bookdate . "<br>";

    // Set up your database connection
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "nimbus_island";

    // Create a connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Format the date to the correct MySQL date format
    $formattedDate = date('Y-m-d', strtotime($bookdate));

    $currentDate = date('Y-m-d H:i:s');

    // Create a unique ID using current date, formatted date, and user ID
    $uniqueID = date('ymdHis', strtotime($currentDate)) . str_pad($userid, 4, '0', STR_PAD_LEFT);

    echo "booked date". $formattedDate . "<br>";
    echo "current date". $currentDate . "<br>";
    
    echo "unique id". $uniqueID . "<br>";

    // Use $uniqueID in your INSERT statement
    $sql = "INSERT INTO ticket (t_uniq_id, user_id, user_name, full_name, email, name_on_card, card_number, price, rides, pay_date, book_date)
            VALUES ('$uniqueID', '$userid', '$username', '$fullname', '$email', '$nameOnCard', '$cardNumber', '$ticketPrice', '$numberOfTickets', '$currentDate', '$formattedDate')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted into the database successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
$_SESSION['userid'] = $userid;
$_SESSION['nameOnCard'] = $nameOnCard;
$_SESSION['cardNumber'] = $cardNumber;
$_SESSION['expirationDate'] = $expirationDate;
$_SESSION['securityCode'] = $securityCode;
$_SESSION['username'] = $username;
$_SESSION['fullname'] = $fullname;
$_SESSION['email'] = $email;
$_SESSION['numberOfTickets'] = $numberOfTickets;
$_SESSION['ticketPrice'] = $ticketPrice;
$_SESSION['bookdate'] = $formattedDate;
$_SESSION['uniqueid'] = $uniqueID;
$_SESSION['currentdate'] = $currentDate;

// Redirect to index.php or any other page you want
header("Location: index.php");
exit;
?>
