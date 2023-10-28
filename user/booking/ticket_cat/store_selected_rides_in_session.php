<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected rides data from the POST request
    $selectedRidesData = $_POST['selectedRides'];

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

    echo "Selected Rides: " . implode(', ', $selectedRides);
} else {
    // Handle the request method (e.g., display an error message)
    echo "Invalid request method.";
}
?>