document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('checkbox-form');
    const floatingCart = document.getElementById('floating-cart');
    const selectedItems = document.getElementById('selected-items');
    const confirmButton = document.getElementById('confirm-button');

    let selectedRides = new Set();
    let totalPrice = 0;
    let confirmationSent = false;

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
            const selectedRidesArray = Array.from(selectedRides);
            const url = `bookingconfirm.php?selectedRides=${encodeURIComponent(JSON.stringify(selectedRidesArray))}&totalPrice=${totalPrice}`;
            window.location.href = url;
        }
    });

    // Function to create a cart item with a remove button
    function createCartItem(itemName) {
        const listItem = document.createElement('li');
        listItem.textContent = itemName;
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
});
