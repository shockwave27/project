<?php
session_start();

// Check if the user is logged in (user_id exists in the session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not authenticated
    header('Location: ../index.php');
    exit;
}

// Retrieve user data from the session
$userID = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];

$host = "localhost";
$username = "root";
$password = "";
$database = "nimbus_island"; // Change to your database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve user's profile picture
$sql = "SELECT `user_pic` FROM `signin` WHERE `user_id` = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageData = $row["user_pic"];

    if (!empty($imageData)) {
        $imageSrc = "../colorlib-regform-18/$imageData";
    } else {
        // Default image if no image is found
        $imageSrc = "../colorlib-regform-18/uploads/defaultprofile.jpeg"; // Replace with your default image path
    }
} else {
    // User not found or no image found
    // You can handle this case as needed (e.g., display a message)
    $imageSrc = "../colorlib-regform-18/uploads/defaultprofile.jpeg"; // Replace with your default image path
}

// Perform the SQL query to fetch user data from the "signin" table based on user_id
$sql = "SELECT `user_id`, `user_email`, `first_name`, `last_name`, `user_name`, `user_password`, `user_dob`, `user_type`, `user_pic` FROM `signin` WHERE `user_id` = $userID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    $userData = []; // If no data is returned, initialize an empty array
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
body {
    margin-top: 20px;
    background-color: #f2f6fc;
    color: #69707a;
}

.img-account-profile {
    height: 10rem;
}

.rounded-circle {
    border-radius: 50% !important;
}

.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}

.card .card-header {
    font-weight: 500;
}

.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}

.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}

.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}

.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
</style>
</head>
<body>
<h1>Welcome, <?php echo $userName; ?>!</h1>
    <p>Email: <?php echo $userEmail; ?></p>



<div class="container-xl px-4 mt-4">
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="userprofile.php" target="__blank">Profile</a>
        <a class="nav-link" href="profile_billing_page.html" target="__blank">Billing</a>
        <a class="nav-link" href="security/profile_security_page.php" target="__blank">Security</a>
        <a class="nav-link" href="profile_security_page.html" target="__blank">Notifications</a>
    </nav>
    <hr class="mt-0 mb-4">  
      <div class="row">
    <div class="col-xl-4">
    <form enctype="multipart/form-data" method="POST" action="update_profile.php">
    <div class="card mb-4 mb-xl-0">
        <div class="card-header">Profile Picture</div>
        <div class="card-body text-center">
            <!-- Display the selected image or default profile picture -->
            <img id="imagePreview" class="img-account-profile rounded-circle mb-2" src="<?php echo $imageSrc; ?>" alt="Profile Picture">
            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
            <!-- Replace the file input with a button -->
            <label for="user_pic" class="btn btn-primary">
                Upload new image<input type="file" class="form-control" id="user_pic" name="user_pic" accept="image/*" style="display: none;">
            </label>
        </div>
    </div>
    </div>

        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                   
<!-- Username field -->
<div class="mb-3">
    <label class="small mb-1" for="inputUsername">Username</label>
    <input class="form-control" id="inputUsername" type="text" data-key="user_name" placeholder="Enter your username" value="<?php echo isset($userData['user_name']) ? $userData['user_name'] : ''; ?>">
</div>

<!-- First Name field -->
<div class="col-md-6">
    <label class="small mb-1" for="inputFirstName">First name</label>
    <input class="form-control" id="inputFirstName" type="text" data-key="first_name" placeholder="Enter your first name" value="<?php echo isset($userData['first_name']) ? $userData['first_name'] : ''; ?>">
</div>

<!-- Last Name field -->
<div class="col-md-6">
    <label class="small mb-1" for="inputLastName">Last name</label>
    <input class="form-control" id="inputLastName" type="text" data-key="last_name" placeholder="Enter your last name" value="<?php echo isset($userData['last_name']) ? $userData['last_name'] : ''; ?>">
</div>
</div>

<!-- <div class="row gx-3 mb-3">

<div class="col-md-6">
<label class="small mb-1" for="inputOrgName">Organization name</label>
<input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap">
</div>

<div class="col-md-6">
<label class="small mb-1" for="inputLocation">Location</label>
<input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="San Francisco, CA">
</div>
</div>  -->

<div class="mb-3">
<label class="small mb-1" for="inputEmailAddress">Email address</label>
<input class="form-control" id="inputEmailAddress" type="email" data-key="user_email" placeholder="Enter your email address" value="<?php echo isset($userData['user_email']) ? $userData['user_email'] : ''; ?>">
</div>

<div class="row gx-3 mb-3">

<div class="col-md-6">
<!-- <label class="small mb-1" for="inputPhone">Phone number</label>
<input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="555-123-4567"> -->
</div>

<div class="col-md-6">
<!-- <label class="small mb-1" for="inputBirthday">Birthday</label>
<input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="06/10/1988"> -->
</div>
</div>
                       <button class="btn btn-primary" id="saveChangesBtn" type="button">Save changes</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

<!--for updation-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    // Add your JavaScript code here if needed
    $(document).ready(function () {
        // Capture changes and send them to the server
        $('#saveChangesBtn').click(function () {
            var updates = {};

            // Iterate through each input field with a data-key attribute
            $('input[data-key]').each(function () {
                var key = $(this).data('key');
                var value = $(this).val();
                updates[key] = value;
            });

            // Send updates to the server using an AJAX request
            $.ajax({
                url: 'update_profile.php', // Replace with your server-side script to handle updates
                type: 'POST',
                data: updates,
                cache:false,
                contentType:false,
                processData:false,
                success: function (response) {
                    if (response === 'success') {
                        // Update the displayed information with the changes
                        $('input[data-key]').each(function () {
                            var key = $(this).data('key');
                            var value = updates[key];
                            $(this).val(value);
                        });

                        alert('Changes saved successfully!');
                    } else {
                        alert('Failed to save changes. Please try again.');
                    }
                },
                error: function () {
                    alert('An error occurred while saving changes. Please try again later.');
                }
            });
        });
    });
</script>

<!--script for profile pic preview -->
<script type="text/javascript">
// JavaScript function to preview the selected image
function previewImage(input) {
    var imagePreview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        imagePreview.src = '<?php echo $imageSrc; ?>'; // Set to default profile picture if no image selected
    }
}

// JavaScript function to handle when a new file is selected
document.getElementById('user_pic').addEventListener('change', function () {
    previewImage(this); // Preview the selected image
});
</script>
<!-- end of js for updation -->
</body>
</html>
