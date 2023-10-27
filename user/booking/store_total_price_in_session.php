<?php
session_start();

if (isset($_POST['totalPrice'])) {
    $totalPrice = floatval($_POST['totalPrice']);
    $_SESSION['totalPrice'] = $totalPrice;
    echo "Total price has been stored in the session.";
} else {
    echo "Total price not provided.";
}
?>
