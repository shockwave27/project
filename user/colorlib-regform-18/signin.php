<?php
// Include the connect.php file to establish the database connection
require_once('../../connect.php');

$alertMessages = array(); // Initialize an array to store alert messages

// Define the upload directory
$uploadDirectory = 'uploads/'; // This folder should exist and have write permissions

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $firstName = $_POST['loginFirstName'];
    $lastName = $_POST['loginLastName'];
    $userName = $_POST['loginUsername'];
    $userEmail = $_POST['loginEmail'];
    $userPassword = $_POST['loginPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if the email or username already exists
    $existingEmailQuery = "SELECT COUNT(*) FROM signin WHERE user_email = '$userEmail'";
    $existingUsernameQuery = "SELECT COUNT(*) FROM signin WHERE user_name = '$userName'";

    $existingEmailResult = mysqli_query($conn, $existingEmailQuery);
    $existingUsernameResult = mysqli_query($conn, $existingUsernameQuery);

    if (!$existingEmailResult || !$existingUsernameResult) {
        // Handle query execution errors here
        die("Database query failed: " . mysqli_error($conn));
    }

    $existingEmailCount = mysqli_fetch_row($existingEmailResult)[0];
    $existingUsernameCount = mysqli_fetch_row($existingUsernameResult)[0];

    if ($existingEmailCount > 0) {
        $alertMessages[] = "Email already exists. Please choose another email.";
    } elseif ($existingUsernameCount > 0) {
        $alertMessages[] = "Username already exists. Please choose another username.";
    } else {
        // Set the user_type to 'user'
        $userType = 'user';

        // Check if a file was uploaded
        if (isset($_FILES['user_pic']) && $_FILES['user_pic']['error'] == UPLOAD_ERR_OK) {
            // Get file data
            $fileData = file_get_contents($_FILES['user_pic']['tmp_name']);

            // Generate a unique filename for the uploaded file (e.g., using a timestamp)
            $uniqueFilename = uniqid() . '-' . $_FILES['user_pic']['name'];
            $filePath = $uploadDirectory . $uniqueFilename;

            // Move the uploaded file to the upload directory
            if (move_uploaded_file($_FILES['user_pic']['tmp_name'], $filePath)) {
                // Insert data into 'signin' table with 'user_type' and profile picture
                $insertSignInQuery = "INSERT INTO signin (user_email, first_name, last_name, user_name, user_password, user_type, user_pic)
                                      VALUES ('$userEmail', '$firstName', '$lastName', '$userName', '$userPassword', '$userType', '$filePath')";

                if (mysqli_query($conn, $insertSignInQuery)) {
                    $user_id = mysqli_insert_id($conn); // Get the auto-incremented 'user_id'

                    // Insert data into 'login' table with the 'user_id'
                    $insertLoginQuery = "INSERT INTO login (user_id, user_name, user_email, user_password, user_type)
                                         VALUES ('$user_id', '$userName', '$userEmail', '$userPassword', '$userType')";

                    if (!mysqli_query($conn, $insertLoginQuery)) {
                        $alertMessages[] = "Error inserting into 'login' table";
                    }
                } else {
                    $alertMessages[] = "Error inserting into 'signin' table";
                }
            } else {
                $alertMessages[] = "Error moving uploaded file to the server.";
            }
        } else {
            $alertMessages[] = "Error uploading profile picture";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Your head content here -->
</head>
<body>
    <!-- Your HTML content here -->

    <!-- Display alert messages using JavaScript and redirect to index.html -->
    <script>
        <?php
        if (!empty($alertMessages)) {
            echo 'alert("' . implode('\n', $alertMessages) . '");';

            echo 'window.location.href = "../../index.html";';
        } else {
            echo 'window.location.href = "../../index.html";';
        }
        ?>
    </script>
</body>
</html>
