<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content here -->
</head>
<body>
    <?php
    session_start();

    // Check if the user is logged in (user_id exists in the session)
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page if the user is not authenticated
        header('Location: login.php');
        exit;
    }

    // Retrieve user data from the session
    $userID = $_SESSION['user_id'];
    $userName = $_SESSION['user_name'];
    $userEmail = $_SESSION['user_email'];
    ?>

    <h1>Welcome, <?php echo $userName; ?>!</h1>
    <p>Email: <?php echo $userEmail; ?></p>

    <!-- Other content for the user profile page -->
</body>
</html>
