
<?php
// Get the selected category type from the AJAX request
$categoryType = isset($_POST['categoryType']) ? $_POST['categoryType'] : '';

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

// If $_POST['categoryType'] is not set or empty, fetch the primary category type
if (empty($categoryType)) {
    $sql = "SELECT `category_type` FROM `ridecategory` WHERE `category_priority` = 'primary'";
    $result = $conn->query($sql);

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Fetch the primary category type
        $row = $result->fetch_assoc();
        $categoryType = $row['category_type'];
    }
}

echo $categoryType;
echo 'this is';
echo "<br>";

// Perform the SQL query to fetch rides based on the selected category type
$sql = "SELECT `ride_id`, `ride_name`, `ride_details`, `ride_availability`, `ride_price`, `ride_photo`, `ride_type` FROM `ride` WHERE `ride_type` = '$categoryType'";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the rides as desired
        // Example: Create HTML elements to display ride information
        echo '<div class="col-lg-4 menu-item">';
        echo '<label>';
        echo '<input type="checkbox" class="product-checkbox" name="selected_products[]" value="' . $row['ride_name'] . '">';
        echo '<a href="/nimbus_v3/admin/ride/assets/php/' . $row['ride_photo'] . '" class="glightbox">';
        echo '<img src="/nimbus_v3/admin/ride/assets/php/' . $row['ride_photo'] . '" class="menu-img img-fluid" alt="">';
        echo '</a>';
        echo '</label>';
        echo '<h4>' . $row['ride_name'] . '</h4>';
        echo '<p class="ingredients">' . $row['ride_details'] . '</p>';
        echo '<p class="price">$' . number_format($row['ride_price'], 2) . '</p>';
        echo '</div>';
    }
} else {
    echo "No rides found for the selected category type.";
}

// Close the database connection
$conn->close();
?>