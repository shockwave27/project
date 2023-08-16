// usercheck.js

// Define the validateForm function
function validateForm() {
    var userNameTaken = document.getElementById('userNameTaken').value === 'true';
    var emailTaken = document.getElementById('emailTaken').value === 'true';

    if (userNameTaken) {
        alert('Username is already taken.');
        return false; // Prevent form submission
    }

    if (emailTaken) {
        alert('Email is already taken.');
        return false; // Prevent form submission
    }

    // Allow form submission
    return true;
}


