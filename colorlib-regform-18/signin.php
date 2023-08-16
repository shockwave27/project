<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "nimbus_island"; // Change to your database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alertMessages = array(); // Initialize an array to store alert messages

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $firstName = $_POST['loginFirstName'];
    $lastName = $_POST['loginLastName'];
    $userName = $_POST['loginUsername'];
    $userEmail = $_POST['loginEmail'];
    $userPassword = $_POST['loginPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Insert data into 'signin' table
    $insertSignInQuery = "INSERT INTO signin (first_name, last_name, user_name, user_email, user_password)
                          VALUES ('$firstName', '$lastName', '$userName', '$userEmail', '$userPassword')";

    if ($conn->query($insertSignInQuery) === TRUE) {
        $user_id = $conn->insert_id; // Get the auto-incremented 'user_id'
        
        // Insert data into 'login' table with the 'user_id'
        $insertLoginQuery = "INSERT INTO login (user_id, user_name, user_email, user_password)
                             VALUES ('$user_id', '$userName', '$userEmail', '$userPassword')";
        
        if ($conn->query($insertLoginQuery) === TRUE) {
            $alertMessages[] = "Registration successful!";
        } else {
            $alertMessages[] = "Error inserting into 'login' table: " . $conn->error;
        }
    } else {
        $alertMessages[] = "Error inserting into 'signin' table: " . $conn->error;
    }
}

$conn->close();
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
            echo 'window.location.href = "index.html";';
        }
        ?>
    </script>
</body>
</html>
