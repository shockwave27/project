<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Ticket Details</h1>
    
    <div id="ticket-details">
        <p id="selected-rides">Selected Rides: </p>
        <div id="ride-details"></div>
        <p id="total-price">Total Price: </p>
    </div>

    <script>
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
    const params = getQueryParameters();
    const selectedRides = params.get('selectedRides');

    const selectedRidesElement = document.getElementById('selected-rides');
    const totalPriceElement = document.getElementById('total-price');
    const rideDetailsElement = document.getElementById('ride-details');

    // Parse the selectedRides JSON
    const selectedRidesArray = JSON.parse(decodeURIComponent(selectedRides));

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
                            <img src="/nimbus_v3/admin/ride/assets/php/${ride.photo}" alt="?nimbus_v3/admin/ride/assets/php/${ride.name}" width="100">
                            <span>${ride.name} - $${ride.price.toFixed(2)}</span>
                            <button data-ride-name="${ride.name}" data-ride-price="${ride.price}" onclick="removeRide(this)">Remove</button>
                        `;
                        rideDetailsElement.appendChild(rideRow);

                        // Update the total price
                        totalPrice += ride.price;
                        totalPriceElement.textContent = 'Total Price: $' + totalPrice.toFixed(2);
                    });
                }
            }
        });
    });
}

// Function to remove a ride from the list
function removeRide(button) {
    const rideName = button.getAttribute('data-ride-name');
    const ridePrice = parseFloat(button.getAttribute('data-ride-price'));

    const rideRow = button.parentElement;
    rideRow.remove();

    // Update the total price
    totalPrice -= ridePrice;
    const totalPriceElement = document.getElementById('total-price');
    totalPriceElement.textContent = 'Total Price: $' + totalPrice.toFixed(2);
}
displayTicketDetails();
    </script>
</body>
</html>
