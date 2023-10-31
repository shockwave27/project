<?php
session_start();

if (isset($_SESSION['selectedRides']) && is_array($_SESSION['selectedRides'])) {
 echo($_SESSION['user_id']);
 echo("<br>");
  echo "Rides in Session: ";
  echo implode(', ', $_SESSION['selectedRides']);
  echo("<br>");
  echo($_SESSION['totalPrice']); 
  echo("<br>");
  echo( $_SESSION['ticketType']); 
} else {
  echo "No rides in session.";
}
// Retrieve user data from the session
$userID = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];

$host = "localhost";
$username = "root";
$password = "";
$database = "nimbus_island"; // Change to your database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform the SQL query to fetch user data from the "signin" table based on user_id
$sql = "SELECT `user_id`, `user_email`, `first_name`, `last_name`, `user_name` FROM `signin` WHERE `user_id` = $userID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    $userData = []; // If no data is returned, initialize an empty array
}
echo "User Data:<br>";
echo "User ID: " . $userData['user_id'] . "<br>";
echo "User Name: " . $userData['user_name'] . "<br>";
echo "First Name: " . $userData['first_name'] . "<br>";
echo "Last Name: " . $userData['last_name'] . "<br>";
echo "User Email: " . $userData['user_email'] . "<br>";

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>



<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
   
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 400px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 40px;
  }
}
</style>
</head>
<body>
<h2>Checkout Form</h2>
<p>.</p>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form form id="checkout-form" action="creditcard.php" method="POST">
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <input type="hidden" id="userid" name="userid" value="<?php echo isset($userData['user_id']) ? $userData['user_id'] : ''; ?>">

            <label for="username"><i class="fa fa-user"></i> User Name</label>
            <input type="text" id="username" name="username" placeholder="Username" value="<?php echo isset($userData['user_name']) ? $userData['user_name'] : ''; ?>">
            <label for="fname"><i class="fa fa-user"></i> Name</label>
            <input type="text" id="fname" name="fullname" placeholder="Full Name" value="<?php echo isset($userData['first_name']) ? $userData['first_name'] : ''; ?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo isset($userData['user_email']) ? $userData['user_email'] : ''; ?>">
            <label for="bookdate"><i class="fa fa-calendar"></i> booked for</label>
             <input type="date" id="bookdate" name="bookdate" >
          </div>

          <div class="col-50">
            <!-- Number of Tickets -->
            <h3>Number of Tickets</h3>
            <div style="display: inline-block;">
            <button type="button" id="decrement-btn" class="btn" style="background-color: #f00; padding: 5px 10px;">-</button>
<input type="text" id="ticket-quantity" name="ticket-quantity" value="1" readonly style="width: 30px; text-align: center;">
<button type="button" id="increment-btn" class="btn" style="background-color: #0f0; padding: 5px 10px;">+</button>

            </div>
          </div>
        </div>

        <!-- Hidden input for total price -->
        <input type="hidden" id="hidden-total-price" name="total-price" value="<?php echo $_SESSION['totalPrice']; ?>">

        <input type="submit" value="Continue to payment" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <div class="col-75">
        <a href="bookingconfirm.php">
          <button id="select-package-btn" class="btn" style="background-color: #2196F3;">Selected Package <i class='fas fa-clipboard'></i></button>
        </a>
      </div>
      <hr>
      <p id="total-price">Total <span class="price" style="color:black"><b>$<?php echo $_SESSION['totalPrice']; ?></b></span></p>
    </div>
  </div>
</div>

<script>
document.getElementById('increment-btn').addEventListener('click', function () {
  var ticketQuantity = parseInt(document.getElementById('ticket-quantity').value);
  ticketQuantity++;
  document.getElementById('ticket-quantity').value = ticketQuantity;
  updateTotalPrice(); // Update the total price
});

// Event listener for the decrement button
document.getElementById('decrement-btn').addEventListener('click', function () {
  var ticketQuantity = parseInt(document.getElementById('ticket-quantity').value);
  if (ticketQuantity > 1) {
    ticketQuantity--;
    document.getElementById('ticket-quantity').value = ticketQuantity;
    updateTotalPrice(); // Update the total price
  }
});

// Function to update the total price based on the number of tickets and the original price per ticket
function updateTotalPrice() {
  var ticketQuantity = parseInt(document.getElementById('ticket-quantity').value);
  var originalPricePerTicket = parseFloat(document.getElementById('hidden-total-price').value); // Get the original price per ticket
  var totalPrice = ticketQuantity * originalPricePerTicket;

  // Display the updated total price in the <p> element
  document.getElementById('total-price').innerHTML = 'Total <span class="price" style="color:black"><b>$' + totalPrice.toFixed(2) + '</b></span>';

  // Update the value of the hidden input field with the new total price
  document.getElementById('hidden-total-price').value = totalPrice;
}

// Initial call to update total price
updateTotalPrice();

</script>


</body>
</html>