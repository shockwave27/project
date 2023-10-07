document.addEventListener("DOMContentLoaded", function () {
    // Handle the form submission when the "Save Category" button is clicked
    document.getElementById("saveCategory").addEventListener("click", function () {
        // Get form data
        var formData = new FormData(document.getElementById("categoryForm"));

        // Send an AJAX request to insert data into the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "assets/php/ride_category_insert.php", true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Success, you can do something here like showing a success message or refreshing the table
                console.log(xhr.responseText);

                // Close the modal after a successful submission
                document.getElementById("createCategoryModal").style.display = "none";
                document.body.classList.remove("modal-open");
                document.querySelector(".modal-backdrop").remove();
            } else {
                // Error handling
                console.error(xhr.statusText);
            }
        };
        xhr.send(formData);
    });
});