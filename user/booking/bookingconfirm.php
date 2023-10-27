
<?php
session_start();

// if (isset($_SESSION['selectedRides']) && is_array($_SESSION['selectedRides'])) {
//     echo "Rides in Session: ";
//     echo implode(', ', $_SESSION['selectedRides']);
// } else {
//     echo "No rides in session.";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="assets/css/confirmbooking.css" rel="stylesheet">
    <style>
        
        </style>
</head>
<body>
    <br>

    <!-- Continue Shopping Button -->
    <button id="continue-shopping" onclick="redirectToRideBookingPage()">Continue Selecting Rides <i class='fas fa-box'></i></button>
    <button id="confirm-ticket" onclick="confirmTicket()">Confirm Ticket <i class='fas fa-calendar-check'></i></button>
    <br><h1>Ticket Details</h1>
    
    <div id="ticket-details">
        <p id="selected-rides">Selected Rides: </p>
        <div id="ride-details"></div>
        <p id="total-price">Total Price: </p>
    </div>



    <script>
        function redirectToRideBookingPage() {
    window.location.href = "ridebooking.php";
}
      // Function to parse query parameters from the URL
// Define selectedRidesArray in a broader scope
let selectedRidesArray = [];

// Function to parse query parameters from the URL
function getQueryParameters() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    return urlParams;
}

// Initialize the total price
let totalPrice = 0;

// Function to fetch ride prices and display ticket details
function displayTicketDetails() {
    const selectedRidesArray = <?php echo json_encode($_SESSION['selectedRides']); ?>;
    console.log(selectedRidesArray);
    // const params = getQueryParameters();
    // const selectedRides = params.get('selectedRides');

    const selectedRidesElement = document.getElementById('selected-rides');
    const totalPriceElement = document.getElementById('total-price');
    const rideDetailsElement = document.getElementById('ride-details');
        // Clear the rideDetailsElement before adding the new details
         rideDetailsElement.innerHTML = '';
    // Clear the selectedRidesArray
    // selectedRidesArray = [];

    // // Parse the selectedRides JSON
    // selectedRidesArray = JSON.parse(decodeURIComponent(selectedRides)); 

    // Create an array to store ride details
    const rideDetails = [];

    // Make an AJAX request to fetch ride details
    selectedRidesArray.forEach((rideName) => {
        $.ajax({
            type: 'GET',
            url: 'php/get_ride_price.php', // Replace with the actual URL to fetch ride details
            data: { rideName: rideName },
            success: function (data) {
                const rideData = JSON.parse(data);
                rideDetails.push(rideData);

                // Check if all details have been fetched
                if (rideDetails.length === selectedRidesArray.length) {
                    // Display selected rides and total price
                    selectedRidesElement.textContent = 'Selected Rides: ' + selectedRidesArray.join(', ');

                    // Display individual ride details and update total price
                    rideDetails.forEach((ride) => {
                        const rideRow = document.createElement('div');
                        rideRow.className = 'ride-row';
                        rideRow.innerHTML = `
                            <img src="/nimbus_v3/admin/ride/assets/php/${ride.photo}" alt="/nimbus_v3/admin/ride/assets/php/${ride.name}" width="100">
                            <span>${ride.name} - ₹${ride.price.toFixed(2)}</span>
                            <button data-ride-name="${ride.name}" data-ride-price="${ride.price}" onclick="removeRide(this)">Remove <i class='fas fa-broom'></i></button>
                        `;
                        rideDetailsElement.appendChild(rideRow);

                        // Update the total price
                        totalPrice += ride.price;
                        totalPriceElement.textContent = 'Total Price: ₹' + totalPrice.toFixed(2);
                    });
                }
            }
        });
    });
}


function storeSelectedRidesInSession() {
    const params = getQueryParameters();
    const selectedRides = params.get('selectedRides');
        console.log("session fn");
        console.log(selectedRides);
    // Check if there are selected rides
    if (selectedRides) {
        console.log("session store");
        // Assuming you're using jQuery for the AJAX request
        $.ajax({
            type: 'POST', // Use POST for more secure data transfer
            url: 'store_selected_rides_in_session.php', // Replace with the actual URL to process the data on the server
            data: { selectedRides: selectedRides },
            success: function (response) {
                // Handle the server's response, if needed
                // For example, you could display a success message to the user
                alert(response);
            },
            error: function (xhr, status, error) {
                // Handle errors, if any
                console.error(error);
            }
        });
    }
}

// Function to remove a ride from the list
function removeRide(button) {
    console.log("works remove");
    const rideName = button.getAttribute('data-ride-name');
    console.log(rideName);
    const ridePrice = parseFloat(button.getAttribute('data-ride-price'));
     
    const rideRow = button.parentElement;
    rideRow.remove();

    // Update the total price
    totalPrice -= ridePrice;
    const totalPriceElement = document.getElementById('total-price');
    totalPriceElement.textContent = 'Total Price: $' + totalPrice.toFixed(2);
    const selectedRidesArray = <?php echo json_encode($_SESSION['selectedRides']); ?>;
      console.log(selectedRidesArray);
    // Check if the ride is in the session before making an AJAX request
    if (selectedRidesArray.includes(rideName)) {
        // Remove the ride from the selectedRidesArray (already done in displayTicketDetails)
        console.log(rideName);
        // Make an AJAX request to remove the ride from the session
        $.ajax({
            type: 'POST',
            url: 'remove_ride_from_session.php', // Create this PHP script to remove the ride from the session
            data: { rideName: rideName },
            success: function (response) {
                // Handle the server's response
                alert(response);
            },
            error: function (xhr, status, error) {
                // Handle errors, if any
                console.error(error);
            }
        });
    }
}

function confirmTicket() {
    // Assuming you want to confirm the ticket and process it on the server
    // You can make an AJAX request to a PHP script to handle the confirmation and store the total price in the session.

    // Update this URL to the correct path of your PHP script
    const storeTotalPriceURL = 'store_total_price_in_session.php';

    // Make an AJAX request to store the total price
    $.ajax({
        type: 'POST',
        url: storeTotalPriceURL,
        data: { totalPrice: totalPrice },
        success: function (response) {
            alert(response); // Display a success message or handle the response as needed
            window.location.href = "checkout.php"; // Redirect to the checkout page
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}


// Function to go back to the previous page
function goBack() {
    window.history.back();
}

displayTicketDetails();
</script>

    </script>
    
</body>
</html>
