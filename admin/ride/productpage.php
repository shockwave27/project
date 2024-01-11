<!DOCTYPE html>
<html>

<head>
    <title>Your Page Title</title>
</head>

<body>
    <?php include '../header.php'; ?>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">products</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <h2>Product Table</h2>

                <?php include('productdetails.php'); ?>

                <?php if (isset($products) && is_array($products)) { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td><?php echo $product['ride_id']; ?></td>
                                    <td><?php echo $product['ride_name']; ?></td>
                                    <td><?php echo $product['ride_details']; ?></td>
                                    <td>$<?php echo number_format($product['ride_price'], 2); ?></td>
                                    <td><img src="assets/php/<?php echo $product['ride_photo']; ?>" alt="<?php echo $product['ride_name']; ?> Image" width="100"></td>
                                    <td><?php echo $product['ride_type']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary edit-product" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['ride_id']; ?>">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                <!-- Edit Product Modal -->
                                <div class="modal fade" id="editProductModal<?php echo $product['ride_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="editProductModalLabel">Edit Ride</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <!-- Use a form with a hidden input for ride_id -->
        <form id="editProductForm<?php echo $product['ride_id']; ?>" enctype="multipart/form-data" onsubmit="saveEditedProduct(<?php echo $product['ride_id']; ?>); return false;">
            <div class="mb-3">
                <label for="editProductName<?php echo $product['ride_id']; ?>" class="form-label">Ride Name</label>
                <input type="text" class="form-control" id="editProductName<?php echo $product['ride_id']; ?>" name="ride_name" value="<?php echo $product['ride_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="editProductDescription<?php echo $product['ride_id']; ?>" class="form-label">Ride Description</label>
                <textarea class="form-control" id="editProductDescription<?php echo $product['ride_id']; ?>" name="ride_details"><?php echo $product['ride_details']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="editProductPrice<?php echo $product['ride_id']; ?>" class="form-label">Ride Price</label>
                <input type="text" class="form-control" id="editProductPrice<?php echo $product['ride_id']; ?>" name="ride_price" value="<?php echo $product['ride_price']; ?>">
            </div>
            <div class="mb-3">
                <label for="editProductImage<?php echo $product['ride_id']; ?>" class="form-label">Ride Image</label>
                <input type="file" class="form-control" id="editProductImage<?php echo $product['ride_id']; ?>" name="ride_pic" accept="image/*">
            </div>
            <!-- Hidden input for ride_id -->
            <input type="hidden" name="ride_id" value="<?php echo $product['ride_id']; ?>">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>No products available.</p>
                <?php } ?>

                <!-- Button to trigger the modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">
                    Create New Ride
                </button>
                <!-- Modal for creating/editing a product -->
                <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create/Edit Ride</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="productForm" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="productName" class="form-label">Ride Name</label>
                                        <input type="text" class="form-control" id="productName" name="ride_name" placeholder="Enter product name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="productDescription" class="form-label">Ride Description</label>
                                        <textarea class="form-control" id="productDescription" name="ride_details" placeholder="Enter product description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productPrice" class="form-label">Ride Price</label>
                                        <input type="text" class="form-control" id="productPrice" name="ride_price" placeholder="Enter product price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="productImage" class="form-label">Ride Image</label>
                                        <input type="file" class="form-control" id="productImage" name="ride_pic" accept="image/*">
                                    </div>

                                    <!-- Dropdown for Ride Type -->
                                    <div class="mb-3">
                                        <label for="productType" class="form-label">Ride Type</label>
                                        <select class="form-control" id="productType" name="ride_type">
                                            <?php
                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $dbname = "nimbus_island";

                                            $conn = new mysqli($servername, $username, $password, $dbname);

                                            if ($conn->connect_error) {
                                                die("Connection failed: " . $conn->connect_error);
                                            }

                                            $sql = "SELECT `category_type` FROM `ridecategory` WHERE 1";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option>' . $row['category_type'] . '</option>';
                                                }
                                            }

                                            $conn->close();
                                            ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveProduct">Save Product</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--for ride submission-->
    <script src="assets/js/submission_food.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    function saveEditedProduct(rideId) {
        // Collect form data
        var formData = new FormData(document.getElementById('editProductForm' + rideId));

        // Log all form values to the console
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        // You can add additional data to the formData if needed
        // formData.append('additionalField', 'additionalValue');

        // AJAX request
        $.ajax({
            type: 'POST',
            url: 'assets/php/updateProduct.php', // Change this to your PHP file for updating
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    console.log('Product updated successfully:', response.message);
                    // Close the modal or perform other actions as needed
                    $("#editProductModal" + rideId).modal('hide');
                    // Update the table or perform other actions
                } else {
                    // Handle errors if needed
                    console.error('Failed to update product:', response.message);
                }
            },
            error: function (error) {
                console.error('AJAX request failed:', error);
            }
        });
    }
</script>


</body>

</html>
