<?php
session_start();

if (isset($_SESSION['selectedRides']) && is_array($_SESSION['selectedRides'])) {
    echo "Rides in Session: ";
    echo implode(', ', $_SESSION['selectedRides']);
} else {
    echo "No rides in session.";
}
?>
