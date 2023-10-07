<html>
<head>
<script type="text/javascript" src="/swal/jquery.min.js"></script>
<script type="text/javascript" src="/swal/bootstrap.min.js"></script>
<script type="text/javascript" src="/swal/sweetalert2@11.js"></script>
</head>
<body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nimbus_island"; // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $ride_name = $_POST['ride_name'];
    $ride_details = $_POST['ride_details'];
    $ride_price = $_POST['ride_price'];
    $ride_type = $_POST['ride_type']; // Add this line to get ride_type

    // Handle image upload (similar to your previous code)
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["ride_pic"]["name"]);

    if (move_uploaded_file($_FILES["ride_pic"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["ride_pic"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO ride (ride_name, ride_details, ride_price, ride_photo, ride_type)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $ride_name, $ride_details, $ride_price, $target_file, $ride_type);

    if ($stmt->execute()) {
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Record inserted successfully',
                didClose: () => {
                    window.location.href = "../../productpage.php";
                }
            });
        </script>
        <?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}

$conn->close();
?>
