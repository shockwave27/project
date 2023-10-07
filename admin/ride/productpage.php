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
                            <th>Type</th> <!-- Add a new column for "Type" -->
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
                                <td><?php echo $product['ride_type']; ?></td> <!-- Display the "Type" field -->
                                <td>
                                    <button type="button" class="btn btn-primary edit-product" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['ride_id']; ?>">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                            <!-- Edit Product Modal -->
                            <div class="modal fade" id="editProductModal<?php echo $product['ride_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
                                <!-- Modal content here -->
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
<!-- Modal for creating/editing a product -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create/Edit Ride</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add form fields for creating/editing a product here -->
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
        // Replace these with your database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "nimbus_island";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Perform the SQL query to fetch data from the "ridecategory" table
        $sql = "SELECT `category_type` FROM `ridecategory` WHERE 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option>' . $row['category_type'] . '</option>';
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </select>
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
  </body>
</html>