<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Include any CSS and JavaScript libraries you need, e.g., Bootstrap -->
    <link rel="stylesheet" href="path-to-bootstrap.css">
    <script src="path-to-bootstrap.js"></script>
</head>
<body>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) { ?>
                    <tr>
                        <td><?php echo $product['food_id']; ?></td>
                        <td><?php echo $product['food_name']; ?></td>
                        <td><?php echo $product['food_details']; ?></td>
                        <td>$<?php echo number_format($product['food_price'], 2); ?></td>
                        <td><img src="<?php echo $product['food_photo']; ?>" alt="<?php echo $product['food_name']; ?> Image" width="100"></td>
                        <td>
                            <button type="button" class="btn btn-primary edit-product" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['food_id']; ?>">
                                Edit
                            </button>
                        </td>
                    </tr>
                    <!-- Edit Product Modal -->
                    <div class="modal fade" id="editProductModal<?php echo $product['food_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
                        <!-- Modal content here -->
                    </div>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No products available.</p>
    <?php } ?>
</body>
</html>
