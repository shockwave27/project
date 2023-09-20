<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RegistrationForm_v2 by Colorlib</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    <style>
        img {
            border-radius: 50%; /* Make the image rounded */
            max-width: 200px; /* Limit the image width */
            max-height: 200px; /* Limit the image height */
        }
    </style>
</head>

<body>

<div class="wrapper" style="background-image: url('images/bg-registration-form-2.jpg');">
    <div class="inner">
        <form action="signin.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
            <!-- Specify the action and method -->
            <h3>Sign Up</h3>
            <div class="form-group">
                <div class="form-wrapper">
                    <input type="text" class="form-control" id="loginFirstName" name="loginFirstName" placeholder="Enter your first name" required>
                </div>
                <div class="form-wrapper">
                    <input type="text" class="form-control" id="loginLastName" name="loginLastName" placeholder="Enter your last name" required>
                </div>
            </div>
            <div class="form-wrapper">
                <input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Enter your username" required>
            </div>
            <div class="form-wrapper">
                <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Enter your email" required>
            </div>
            <div class="form-wrapper">
                <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Enter your password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility('loginPassword')">
                <label for="showPassword" style="color: black;">Show Password</label>
            </div>
            <div class="form-wrapper">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
            </div>
            <!-- File Upload Fields -->
            <div class="form-wrapper">
                <label for="user_pic" style="color: black;">Profile Picture</label>
                <!-- Replace the file input with an image representing the default profile picture -->
                <img id="defaultProfilePicture" src="blank-profile-picture-973460_640.png" alt="Avatar" style="cursor: pointer;">
                <!-- Add an invisible file input element -->
                <input type="file" class="form-control" id="user_pic" name="user_pic" accept="image/*" style="display: none;">
            </div>
            <div class="form-wrapper">
                <!-- Display the selected image here or default profile picture -->
                <img id="imagePreview" src="" alt="Selected Image" style="max-width: 200px; max-height: 200px;">
            </div>
            <!-- End of File Upload Fields -->
            <div class="form-wrapper">
                <input type="hidden" id="userNameTaken" value="<?php echo $userNameTaken ? 'true' : 'false'; ?>">
                <input type="hidden" id="emailTaken" value="<?php echo $emailTaken ? 'true' : 'false'; ?>">
            </div>
            <div class="checkbox">
                <label style="color: black;">
                    <input type="checkbox" name="acceptTerms"> I accept the Terms of Use & Privacy Policy.
                    <span class="checkmark"></span>
                </label>
            </div>
            <button type="submit" class="btn btn-primary" name="register">Sign Up</button><br>
            <span style="color: black;">Already have an account?</span> <a href="../index.html">Sign in</a>

        </form>
    </div>
</div>

<!-- Password visibility JavaScript -->
<script src="js/password.js"></script>
<script src="js/usercheck.js"></script>

<script>
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
        imagePreview.src = '';
    }
}

// JavaScript function to handle when the default picture is clicked
document.getElementById('defaultProfilePicture').addEventListener('click', function () {
    // Trigger the file input when the default picture is clicked
    document.getElementById('user_pic').click();
});

// JavaScript function to handle when a new file is selected
document.getElementById('user_pic').addEventListener('change', function () {
    // Check if a file has been selected
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            // Change the source of the default image to the selected image
            document.getElementById('defaultProfilePicture').src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>

</body>
</html>
