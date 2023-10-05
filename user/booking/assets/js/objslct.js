document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('checkbox-form');
    const floatingCart = document.getElementById('floating-cart');
    const selectedItems = document.getElementById('selected-items');

    // Add a change event listener to the form
    form.addEventListener('change', function () {
        // Clear the cart
        selectedItems.innerHTML = '';

        // Get all selected checkboxes
        const checkboxes = form.querySelectorAll('input[type="checkbox"]:checked');

        if (checkboxes.length > 0) {
            // Display the floating cart
            floatingCart.style.display = 'block';

            // Add selected items to the cart
            checkboxes.forEach(function (checkbox) {
                const itemName = checkbox.value;
                const listItem = document.createElement('li');
                listItem.textContent = itemName;
                selectedItems.appendChild(listItem);
            });
        } else {
            // Hide the cart if no items are selected
            floatingCart.style.display = 'none';
        }
    });
});
