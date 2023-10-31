<?php
session_start();

if (isset($_POST['totalPrice'])) {
    $totalPrice = floatval($_POST['totalPrice']);
    if (isset($_SESSION['totalPrice'])) {
        unset($_SESSION['totalPrice']);
    }
    $_SESSION['totalPrice'] = $totalPrice;

    if (isset($_SESSION['ticketType'])) {
        unset($_SESSION['ticketType']);
    }
    $_SESSION['ticketType'] =  "special";
    echo "Total price has been stored in the session.";
} else {
    echo "Total price not provided.";
}
?>
