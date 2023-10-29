<?php
session_start();
if (isset($_SESSION['storeotp'])) {
    echo $_SESSION['storeotp'];
    
} else {
    echo "OTP not found in the session.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $enteredOTP = $_POST["otp"]; // The OTP entered by the user

    // Compare the entered OTP with the stored OTP (retrieve the stored OTP from the session or database)
    $storedOTP = $_SESSION["storeotp"]; // Replace with your storage mechanism
    echo"<br>";
    echo $enteredOTP;
    echo $storedOTP;
    if ($enteredOTP == $storedOTP) {
        // OTP is valid; you can proceed with allowing the user to reset their password or perform other actions

        // Clear the stored OTP from the session
        unset($_SESSION["storeotp"]);
        echo"succesfull";
        // Redirect the user to a password reset form or another page
        header("Location: /nimbus_v3/user/passwordreset/");
        exit();
    } else {
        // Invalid OTP; show an error message
        $error = "Invalid OTP. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
    <h1>OTP Verification</h1>
    <p>Enter the OTP sent to your email to verify your identity.</p>

    <form id="otpVerificationForm" method="post">
        <div class="mb-3">
            <label class="small mb-1" for="otp">Enter OTP</label>
            <input class="form-control" id="otp" type="text" name="otp" placeholder="Enter OTP" required>
        </div>

        <?php if (isset($error)) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>

        <button class="btn btn-primary" type="submit">Verify OTP</button>
    </form>
</body>
</html>
