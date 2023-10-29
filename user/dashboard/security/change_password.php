<?php
session_start();
$userid = $_SESSION['user_id'];

// Database configuration
$servername = "localhost";
$dbUsername = "root";
$dbPassword = ""; // No password
$database = "nimbus_island";

// Create a connection to the database
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve current password and new password from the form (replace these with your form field names)
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];

// Prepare the SQL statements for updating both tables
$updateLoginSql = "UPDATE `login` SET `user_password` = ? WHERE `user_id` = ?";
$updateSigninSql = "UPDATE `signin` SET `user_password` = ? WHERE `user_id` = ?";

// Start a transaction
mysqli_begin_transaction($conn);

// Initialize a flag to track the success of both updates
$success = true;

// Prepare and execute the update statement for the login table
if ($stmt = mysqli_prepare($conn, $updateLoginSql)) {
    mysqli_stmt_bind_param($stmt, "si", $newPassword, $userid);
    if (!mysqli_stmt_execute($stmt)) {
        $success = false;
    }
    mysqli_stmt_close($stmt);
} else {
    $success = false;
}

// Prepare and execute the update statement for the signin table
if ($stmt = mysqli_prepare($conn, $updateSigninSql)) {
    mysqli_stmt_bind_param($stmt, "si", $newPassword, $userid);
    if (!mysqli_stmt_execute($stmt)) {
        $success = false;
    }
    mysqli_stmt_close($stmt);
} else {
    $success = false;
}

// Commit the transaction if all updates were successful, or roll back if any failed
if ($success) {
    mysqli_commit($conn);
    echo json_encode(array("message" => "Password changed successfully"));
} else {
    mysqli_rollback($conn);
    echo json_encode(array("message" => "Failed to update the password"));
}

// Close the database connection
mysqli_close($conn);
?>
