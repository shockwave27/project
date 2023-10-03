<?php
require '../../connect.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["suspend"])) {
    $userId = $_POST['user_id'];

    // Update the user's status to "inactive"
    $updateQuery = "UPDATE login SET user_status = 'inactive' WHERE user_id = '$userId'";
    
    if (mysqli_query($conn, $updateQuery)) {
        // User status updated successfully
        header('Location: userview.php'); // Redirect back to the dashboard page
        exit();
    } else {
        // Error updating user status
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
