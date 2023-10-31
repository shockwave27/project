<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected rides data from the POST request
    if (isset($_POST['selectedRides']) && isset($_POST['ticketType'])) {
        // Retrieve the selected rides data and ticket type from the POST request
        $selectedRidesData = $_POST['selectedRides'];
        $ticketType = $_POST['ticketType'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "nimbus_island";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $latestTicketQuery = "SELECT `$ticketType` FROM `ticket_cat_price` ORDER BY `ticket_cat_price_id` DESC LIMIT 1";
        $result = mysqli_query($conn, $latestTicketQuery);
        if ($result) {
            $row= mysqli_fetch_assoc($result);
            $ticketPrice=$row[$ticketType];
            // Now you have the basic and fast values in the $basicValue and $fastValue variables
            // You can use them as needed
            // echo "Basic Value: " . $basicValue . "<br>";
            // echo "Fast Value: " . $fastValue . "<br>";
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }
        // Rest of your code to handle selected rides and store them in the session

        // Close the database connection
        $conn->close();
    } else {
        echo "Invalid POST data."; // Handle missing POST data
    }
    if (isset($_SESSION['ticketType'])) {
        unset($_SESSION['ticketType']);
    }
    $_SESSION['ticketType'] =  $ticketType; 

    if (isset($_SESSION['totalPrice'])) {
        unset($_SESSION['totalPrice']);
    }
    $_SESSION['totalPrice'] = $ticketPrice;
    if (is_array($selectedRidesData)) {
        // Data is already an array, no need for json_decode
        $selectedRides = $selectedRidesData;
    } else {
        // Data is a JSON-encoded string, decode it
        $selectedRides = json_decode($selectedRidesData);
    }

    // Check if the session variable 'selectedRides' exists and unset it if it does
    if (isset($_SESSION['selectedRides'])) {
        unset($_SESSION['selectedRides']);
    }

    // Store the new selected rides data in the session
    $_SESSION['selectedRides'] = $selectedRides;

    echo "Selected Rides: " . implode(', ', $selectedRides) . ' ' . $ticketType . ', ' . $ticketPrice;


} else {
    // Handle the request method (e.g., display an error message)
    echo "Invalid request method.";
}
?>