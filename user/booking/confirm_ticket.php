<?php
session_start();

// Check if the 'selectedRides' session variable exists
if (isset($_SESSION['selectedRides'])) {
    $selectedRides = $_SESSION['selectedRides'];
} else {
    // Handle the case where there are no selected rides in the session
    $selectedRides = array(); // Empty array or any other default value you prefer
}

// Process the form data if it's submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected rides data from the POST request
    $selectedRides = $_POST['selectedRides'];

    // Store the selected rides in a session variable
    $_SESSION['selectedRides'] = $selectedRides;

    // Send a response to the client (you can customize the response)
    echo "Selected rides have been stored in the session.";
    echo '<pre>'; // Use <pre> tags to format the array for display
    print_r($selectedRides); // Display the selected rides
    
}
?>
