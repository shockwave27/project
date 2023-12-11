<?php
session_start();
echo $_SESSION['user_id'];

// Check if the form has been submitted
if (isset($_POST['resetPassword'])) {
    // Get the new password and confirm password from the form
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if the passwords match
    if ($newPassword === $confirmPassword) {
        // Database connection configuration (modify as per your setup)
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'nimbus_island';

        // Create a database connection
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize the input to prevent SQL injection (you should use prepared statements for better security)
        $newPassword = $conn->real_escape_string($newPassword);


        // Update the user's password in the signin table
        $user_id = $_SESSION['user_id'];
        $sql_signin = "UPDATE signin SET user_password = ' $newPassword' WHERE user_id = $user_id";

        // Update the user's password in the login table
        $sql_login = "UPDATE login SET user_password = '$newPassword' WHERE user_id = $user_id";
        

        if ($conn->query($sql_signin) === TRUE && $conn->query($sql_login) === TRUE) {
            echo "Password has been successfully reset!";
        } else {
            echo "Error updating password: " . $conn->error;
            header("Location:/nimbus_v3/userdashboard/userdetails.php");
            exit();
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "New Password and Confirm New Password do not match. Please try again.";
    }
}
?>
