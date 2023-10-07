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
          <li class="breadcrumb-item active">Categories</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
 <section class="section">
      <div class="row">
          <div class="col-lg-12">
            <h2>Category Table</h2>

            <?php include('categorydetails.php'); ?>

            <?php if (isset($categories) && is_array($categories)) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category) { ?>
                            <tr>
                                <td><?php echo $category['category_id']; ?></td>
                                <td><?php echo $category['category_type']; ?></td>
                                <td><?php echo $category['category_description']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary edit-category" data-bs-toggle="modal" data-bs-target="#editCategoryModal<?php echo $category['category_id']; ?>">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                            <!-- Edit Category Modal -->
                            <div class="modal fade" id="editCategoryModal<?php echo $category['category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                                <!-- Modal content here -->
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No categories available.</p>
            <?php } ?>
              <!-- Button to trigger the modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                  Create New Category
              </button>
                                          <!-- Modal for creating/editing a category -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create/Edit Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <!-- Add form fields for creating/editing a category here -->
              <form id="categoryForm">
                  <div class="mb-3">
                      <label for="categoryType" class="form-label">Category Type</label>
                      <input type="text" class="form-control" id="categoryType" name="category_type" placeholder="Enter category type">
                  </div>
                  <div class="mb-3">
                      <label for="categoryDescription" class="form-label">Category Description</label>
                      <textarea class="form-control" id="categoryDescription" name="category_description" placeholder="Enter category description"></textarea>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="saveCategory">Save Category</button>
          </div>
      </div>
  </div>
</div>

     
       
          </div>
      </div>
  </section>

    <!-- JavaScript for category submission -->
    <script src="assets/js/submission_category.js"></script>
  </body>
</html>
