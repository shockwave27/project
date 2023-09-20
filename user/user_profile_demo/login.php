<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include any CSS styles you need -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" action="login_handler.php" method="post">
            <div class="form-group">
                <label for="loginUsername">Username:</label>
                <input type="text" id="loginUsername" name="loginUsername" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="loginEmail">Email:</label>
                <input type="email" id="loginEmail" name="loginEmail" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="loginPassword" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>
