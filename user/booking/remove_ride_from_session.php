<?php
session_start();
echo "Rides in Session: ";
        echo implode(', ', $_SESSION['selectedRides']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rideName = $_POST['rideName'];
    if (isset($_SESSION['selectedRides']) && is_array($_SESSION['selectedRides'])) {
        // Find the index of the ride to remove
        echo($rideName);
        echo("working");
        $index = array_search($rideName, $_SESSION['selectedRides']);
        if ($index !== false) {
            // Store the session data in a temporary variable
            $temp = $_SESSION['selectedRides'];

            // Clear all values from the session
            $_SESSION['selectedRides'] = [];

            // Remove the ride from the temporary array
            unset($temp[$index]);

             // Assign the $temp variable as the new session data
             $_SESSION['selectedRides'] = $temp;

            echo "removed";
        }
    }else{
        echo "invalid";
    }
}
?>

