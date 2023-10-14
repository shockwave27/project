document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('checkbox-form');
    const floatingCart = document.getElementById('floating-cart');
    const selectedItems = document.getElementById('selected-items');
    const confirmButton = document.getElementById('confirm-button'); // Define confirmButton here

    let selectedRides = new Set();
    let totalPrice = 0;
    let confirmationSent = false; // Initialize confirmationSent variable

    form.addEventListener('change', function () {
        selectedItems.innerHTML = '';
        const checkboxes = form.querySelectorAll('input[type="checkbox"]:checked');

        if (checkboxes.length > 0) {
            floatingCart.style.display = 'block';

            checkboxes.forEach(function (checkbox) {
                const itemName = checkbox.value;

                if (!selectedRides.has(itemName)) {
                    selectedRides.add(itemName);
                    const ridePrice = parseFloat(checkbox.getAttribute('data-price'));
                    totalPrice += ridePrice;
                }
            });

            const selectedRidesArray = Array.from(selectedRides);
            selectedRidesArray.forEach(function (itemName) {
                const listItem = createCartItem(itemName);
                selectedItems.appendChild(listItem);
            });

            confirmButton.style.display = 'block';
        } else {
            floatingCart.style.display = 'none';
            confirmButton.style.display = 'none';
        }
    });
    confirmButton.addEventListener('click', function () {

        if (!confirmationSent) {
            confirmationSent = true;
            // const selectedRidesArray = Array.from(selectedRides);

            const ulElement = document.getElementById("selected-items");
            // Get all the list items within the ul element
            const listItems = ulElement.getElementsByTagName("li");

            // Create an array to store the values of the list items
            const values = [];

            // Loop through the list items and retrieve their text content
            for (let i = 0; i < listItems.length; i++) {
                const id = listItems[i].id;
                if (id === "ride_id") {
                    
                    const value = listItems[i].textContent;
                    const modifiedValue = value.replace(/Remove$/, ''); // Removes "Remove" from the end
                    console.log(modifiedValue);
                    values.push(modifiedValue);
                }
               
            }

            // Log the values to the console
            console.log(values);

            if (values) {
                // Assuming you're using jQuery for the AJAX request
                $.ajax({
                    type: 'POST', // Use POST for more secure data transfer
                    url: 'store_selected_rides_in_session.php', // Replace with the actual URL to process the data on the server
                    data: { selectedRides: values },
                    success: function (response) {
                        // Handle the server's response, if needed
                        // For example, you could display a success message to the user
                        alert(response);
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        // Handle errors, if any
                        console.error(error);
                    }
                });
            }

            // window.location.href = url;
        }
    });

    // Function to create a cart item with a remove button
    function createCartItem(itemName) {
        const listItem = document.createElement('li');
        listItem.textContent = itemName;
        listItem.id = "ride_id";
        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', function () {
            // Remove the ride when the Remove button is clicked
            selectedRides.delete(itemName);
            listItem.remove();

            // Uncheck the corresponding checkbox
            const checkboxes = form.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function (checkbox) {
                if (checkbox.value === itemName) {
                    checkbox.checked = false;
                }
            });
        });
        listItem.appendChild(removeButton);
        return listItem;
    }

    // Merge this part here...
});

// Merge your second script...
var confirmationSent = false;

$(document).ready(function () {
    console.log("Clicked on category tab"); // Add this line for debugging
    // Rest of your code...
       // Attach a click event handler to category tabs
    $('.nav-link').click(function () {
        // Get the selected category type or set a default value
        var categoryType = $(this).data('category-type');

        // Make an AJAX request to fetch rides for the selected category type
        console.log("Sending data:", { categoryType: categoryType });
        $.ajax({
            type: 'POST',
            url: 'php/ridefetch.php',
            data: { categoryType: categoryType },
            success: function (data) {
                // Replace the existing content of the specific container
                // In this case, replace the content of <div class="row gy-5">
                $('.row.gy-5').html(data);
            }
        });
    });
});
    
    // Function to parse query parameters from the URL
    function getQueryParameters() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        return urlParams;
    }

    // Function to display selected rides in the cart
    function displaySelectedRidesInCart() {
        console.log("Displaying selected rides in cart.");
        const params = getQueryParameters();
        const selectedRidesJSON = params.get('selectedRides');

        if (selectedRidesJSON) {
            const selectedRides = JSON.parse(decodeURIComponent(selectedRidesJSON));
            const cartElement = document.getElementById('selected-items');

            // Clear the cart first
            cartElement.innerHTML = '';

            // Add selected rides to the cart
            selectedRides.forEach((rideName) => {
                const cartItem = document.createElement('li');
                cartItem.textContent = rideName;
                cartElement.appendChild(cartItem);
            });
        }
    }

    // Define a function to store selected rides in the session
    function storeSelectedRidesInSession() {
        const params = getQueryParameters();
        const selectedRides = params.get('selectedRides');

        // Check if there are selected rides
        if (selectedRides) {
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

    // Call the function to display selected rides in the cart
    displaySelectedRidesInCart();

