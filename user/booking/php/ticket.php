<?php
session_start();
if (isset($_SESSION['selectedRides']) && is_array($_SESSION['selectedRides'])) {
    $rides = json_encode($_SESSION['selectedRides']); // Get the selected rides from the session and encode them as JSON
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect billing and payment information from the form
    $full_name = $_POST['fullname'];
    $email = $_POST['email'];
    $name_on_card = $_POST['cardname'];
    $card_number = $_POST['cardnumber'];
    $exp_month = $_POST['expmonth'];
    $exp_year = $_POST['expyear'];
    $cvv = $_POST['cvv'];
    $total_price = $_SESSION['totalPrice']; // You may need to adjust this to fetch the total price

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nimbus_island"; // Assuming your database name is "nimbus_island"

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the information into the database
    $sql = "INSERT INTO ticket (full_name, email, name_on_card, card_number, price, rides, date)
            VALUES ('$full_name', '$email', '$name_on_card', '$card_number', $total_price, '$rides', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Form not submitted.";
}
?>
