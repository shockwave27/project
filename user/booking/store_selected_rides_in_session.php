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

    // Check if the session variable 'selectedRides' exists
    if (isset($_SESSION['selectedRides'])) {
        // Initialize an array to store unique rides
        $uniqueRides = array();

        // Loop through the selected rides and add them to the uniqueRides array
        foreach ($selectedRides as $ride) {
            if (!in_array($ride, $uniqueRides)) {
                $uniqueRides[] = $ride;
            }
        }

        // Merge the unique rides with the existing selected rides
        $_SESSION['selectedRides'] = array_merge($_SESSION['selectedRides'], $uniqueRides);
    } else {
        // Initialize the session variable with the new selected rides
        $_SESSION['selectedRides'] = $selectedRides;
    }

    // Ensure only unique rides are stored in the session
    $_SESSION['selectedRides'] = array_unique($_SESSION['selectedRides']);

    echo "Selected Rides: " . implode(', ', $_SESSION['selectedRides']);
} else {
    // Handle the request method (e.g., display an error message)
    echo "Invalid request method.";
}
?>
