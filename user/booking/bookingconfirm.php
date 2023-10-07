<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
</head>
<body>
    <h1>Ticket Details</h1>
    
    <div id="ticket-details">
        <p id="selected-rides">Selected Rides: </p>
        <p id="total-price">Total Price: </p>
    </div>

    <script>
        // Function to parse query parameters from the URL
        function getQueryParameters() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            return urlParams;
        }

        // Function to display selected rides and total price
        function displayTicketDetails() {
            const params = getQueryParameters();
            const selectedRides = params.get('selectedRides');
            const totalPrice = params.get('totalPrice');

            const selectedRidesElement = document.getElementById('selected-rides');
            const totalPriceElement = document.getElementById('total-price');

            // Parse the selectedRides JSON
            const selectedRidesArray = JSON.parse(decodeURIComponent(selectedRides));

            selectedRidesElement.textContent += selectedRidesArray.join(', ');
            totalPriceElement.textContent += `$${totalPrice.toFixed(2)}`;
        }

        // Call the function to display ticket details when the page loads
        displayTicketDetails();
    </script>
</body>
</html>
