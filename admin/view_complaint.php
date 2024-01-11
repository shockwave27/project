<?php
$conn = new mysqli('localhost', 'root', '', 'nimbus_island');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if complaint_id and user_id are provided in the URL
if (isset($_GET['complaint_id']) && isset($_GET['user_id'])) {
    $complaint_id = $_GET['complaint_id'];
    $user_id = $_GET['user_id'];

    // Fetch complaint details
    $query = "SELECT `title`, `statement` FROM `complaint` WHERE `complaint_id` = $complaint_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $complaint = mysqli_fetch_assoc($result);

        // Fetch user email
        $query = "SELECT `user_email` FROM `login` WHERE `user_id` = $user_id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);

            // Now you have complaint details ($complaint) and user email ($user['user_email'])
            // Use this information as needed, for example, to display in the HTML or send an email

            // Display complaint details and user email
            echo "<h1>Complaint Details</h1>";
            echo "<p><strong>Title:</strong> {$complaint['title']}</p>";
            echo "<p><strong>Statement:</strong> {$complaint['statement']}</p>";
            echo "<p><strong>User Email:</strong> {$user['user_email']}</p>";

            // Reply form
            echo "<form method='post' action='/nimbus_v3/vendor/process_reply.php'>";
            echo "<label for='reply'>Reply:</label>";
            echo "<textarea name='reply' id='reply' rows='4' cols='50'></textarea><br>";
            echo "<input type='hidden' name='complaint_id' value='$complaint_id'>";
            echo "<input type='hidden' name='user_id' value='$user_id'>";
            echo "<input type='submit' value='Send Reply'>";
            echo "</form>";

        } else {
            echo "Error fetching user details: " . mysqli_error($connection);
        }
    } else {
        echo "Error fetching complaint details: " . mysqli_error($connection);
    }
} else {
    echo "Invalid parameters provided";
}
$conn->close();
?>
