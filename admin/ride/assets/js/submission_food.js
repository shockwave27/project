document.addEventListener("DOMContentLoaded", function () {
    // Handle the form submission when the "Save Product" button is clicked
    document.getElementById("saveProduct").addEventListener("click", function () {
        // Get form data
        var formData = new FormData(document.getElementById("productForm"));

        // Send an AJAX request to insert data into the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "assets/php/ride_insert.php", true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Success, you can do something here like showing a success message or refreshing the table
                console.log(xhr.responseText);
                <html>
                <head>
                <script type="text/javascript" src="swal/jquery.min.js"></script>
                <script type="text/javascript" src="swal/bootstrap.min.js"></script>
                <script type="text/javascript" src="swal/sweetalert2@11.js"></script>
                </head>
                <body>
                    </body>
                </html>
                // Trigger SweetAlert for success
                Swal.fire({
                    icon: 'success',
                    text: 'Record inserted successfully',
                    didClose: () => {
                        // Close the modal after a successful submission
                        document.getElementById("createProductModal").style.display = "none";
                        document.body.classList.remove("modal-open");
                        document.querySelector(".modal-backdrop").remove();

                        // Redirect to the product page
                        window.location.href = "productpage.php";
                    }
                });
            } else {
                // Error handling
                console.error(xhr.statusText);
            }
        };
        xhr.send(formData);
    });
});
