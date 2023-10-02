<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User is not authenticated, handle accordingly (e.g., redirect to login)
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // This script should only handle POST requests
    http_response_code(400); // Bad Request
    echo 'Invalid request method';
    exit;
}

// Replace these with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nimbus_island"; // Change the database name to "nimbus_island"

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    echo 'Connection failed: ' . $conn->connect_error;
    exit;
}

// Get user ID from the session
$userID = $_SESSION['user_id'];

// Handle profile picture upload
if (isset($_FILES['user_pic']) && $_FILES['user_pic']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['user_pic']['tmp_name'];
    $fileName = $_FILES['user_pic']['name'];
    $fileSize = $_FILES['user_pic']['size'];

    // Check if the uploaded file is an image (you can add more checks for file type and size)
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $fileInfo = pathinfo($fileName);
    $fileExtension = strtolower($fileInfo['extension']);

    echo 'File Extension: ' . $fileExtension;

    if (in_array($fileExtension, $allowedExtensions)) {
        // Define the directory where you want to store uploaded profile pictures
        $uploadDirectory = '../colorlib-regform-18/uploads/';
        $newFileName =  uniqid() . '-' . $fileExtension;
        $uploadPath = $uploadDirectory . $newFileName;

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        if (!is_writable($uploadDirectory)) {
            echo 'Upload directory is not writable.';
        }

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            // Profile picture upload successful, update the database with the new filename
            $updateSql = "UPDATE `signin` SET `user_pic` = '$newFileName' WHERE `user_id` = $userID";

            if ($conn->query($updateSql) === true) {
                // Update successful
                echo 'success';
            } else {
                // Update failed
                http_response_code(500); // Internal Server Error
                echo 'Error updating profile picture: ' . $conn->error;
            }
        } else {
            // File upload failed
            http_response_code(500); // Internal Server Error
            echo 'Error uploading profile picture.';
        }
    } else {
        // Invalid file type
        echo 'Invalid file type. Please upload a JPG or PNG image.';
    }
} else {
    // No profile picture uploaded, handle other updates here

    // Retrieve updates from the POST data
    $updates = [];

    if (isset($_POST['user_name'])) {
        $updates['user_name'] = $_POST['user_name'];
    }

    if (isset($_POST['first_name'])) {
        $updates['first_name'] = $_POST['first_name'];
    }

    if (isset($_POST['last_name'])) {
        $updates['last_name'] = $_POST['last_name'];
    }

    if (isset($_POST['user_email'])) {
        $updates['user_email'] = $_POST['user_email'];
    }

    // Update the `signin` table
    if (!empty($updates)) {
        $updateSql = 'UPDATE `signin` SET ';

        $firstUpdate = true;
        foreach ($updates as $key => $value) {
            if (!$firstUpdate) {
                $updateSql .= ', ';
            }
            $updateSql .= "`$key` = '" . $conn->real_escape_string($value) . "'";
            $firstUpdate = false;
        }

        $updateSql .= " WHERE `user_id` = $userID";

        if ($conn->query($updateSql) === true) {
            // Update successful for signin table

            // Now, select the username and email from the `signin` table
            $selectSql = "SELECT `user_name`, `user_email` FROM `signin` WHERE `user_id` = $userID";
            $result = $conn->query($selectSql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Update the `login` table with the username and email
                $user_name = $row['user_name'];
                $user_email = $row['user_email'];

                $updateLoginSql = "UPDATE `login` SET `user_name` = '$user_name', `user_email` = '$user_email' WHERE `user_id` = $userID";

                if ($conn->query($updateLoginSql) === true) {
                    // Update successful for login table
                    echo 'success';
                } else {
                    // Update failed for login table
                    http_response_code(500); // Internal Server Error
                    echo 'Error updating profile in login table: ' . $conn->error;
                }
            }
        } else {
            // Update failed for signin table
            http_response_code(500); // Internal Server Error
            echo 'Error updating profile: ' . $conn->error;
        }
    } else {
        // No updates provided
        echo 'No changes to save';
    }
}

// Close the database connection
$conn->close();
?>
