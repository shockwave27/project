// custom.js

document.addEventListener('DOMContentLoaded', function () {
    // Find the profile button by its class name
    var profileButton = document.querySelector('.profile-button a');

    // Add a click event listener to the profile button
    profileButton.addEventListener('click', function (event) {
        // Prevent the default link behavior (navigation)
        event.preventDefault();

        // Redirect to another page
        window.location.href = 'dashboard/userdetails.php'; // Replace 'your-page-url.html' with the actual URL
    });
});
