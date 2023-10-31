<?php
// Make sure you have an active database connection first
$servername = "localhost";
$username = "root";
$password = ""; // No password

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, "nimbus_island");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ticket_id and user_id from the POST data
    $ticketId = $_POST['ticket_id'];
    $userId = $_POST['user_id'];

    // Create a SQL query to fetch the ticket details
    $sql = "SELECT `ticket_id`, `t_uniq_id`, `user_id`, `user_name`, `full_name`, `email`, `name_on_card`, `card_number`, `price`, `no_of_tickets`, `rides`, `pay_date`, `book_date`, `ticket_cat`
            FROM `ticket`
            WHERE `ticket_id` = $ticketId AND `user_id` = $userId";

    // Execute the query
    $result = $conn->query($sql);

    // Check if there is a result
    if ($result) {
        // Fetch the ticket details and assign them to variables
        if ($row = $result->fetch_assoc()) {
            $ticketId = $row['ticket_id'];
            $tUniqId = $row['t_uniq_id'];
            $userFullName = $row['full_name'];
            $email = $row['email'];
            $nameOnCard = $row['name_on_card'];
            $cardNumber = $row['card_number'];
            $price = $row['price'];
            $numberOfTickets = $row['no_of_tickets'];
            $rides = $row['rides'];
            $payDate = $row['pay_date'];
            $bookDate = $row['book_date'];
            $ticketCat = $row['ticket_cat'];
            
            // You can continue to assign other variables here if needed
        }

        // Display the ticket details
        echo '<h1>Ticket Details</h1>';
        echo 'Ticket ID: ' . $ticketId;
        echo 'Transaction ID: ' . $tUniqId;
        // Display other ticket details as needed

        // Close the database connection
        $conn->close();
    } else {
        echo 'Ticket not found.';
    }
} else {
    // If it's not a POST request, handle it accordingly (e.g., redirect to a different page).
    echo 'Invalid request';
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - CSS Grid: Train Ticket</title>
  <link href="https://fonts.googleapis.com/css?family=Jura:400,700|Questrial|Inconsolata:400,700|Montserrat:900|Old+Standard+TT:700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="main-content">
  <div class="ticket">
    <div class="ticket__main">
      <div class="header">NIMBUS ISLAND</div>
      <div class="info passenger">
        <div class="info__item">Name</div>
        <div class="info__detail"><?php echo $userFullName; ?></div>
      </div>
      <div class="info platform"> <span>Ticket </span><span> </span><span>Type</span>
        <div class="number">
          <div></div>
          <div><?php echo $ticketCat; ?><span></span>-<span></span>ticekt</div>
        </div>
      </div>
      <!-- <div class="info departure">
        <div class="info__item">Depart</div>
        <div class="info__detail">King's Cross</div>
      </div>-->
      <!-- <div class="info arrival">
        <div class="info__item">Ticket Type</div>
        <div class="info__detail">basic</div>
      </div> -->
      <div class="info date">
        <div class="info__item">Date of booking</div>
        <div class="info__detail"><?php echo  $payDate ?></div>
      </div>
      <div class="info time">
        <div class="info__item">booked at</div>
        <div class="info__detail"><?php echo   $payDate ?></div>
      </div>
      <div class="info carriage">
        <div class="info__item">No of admits</div>
        <div class="info__detail"><?php echo $numberOfTickets; ?></div>
      </div>
      <div class="info seat">
        <div class="info__item">date booked for</div>
        <div class="info__detail"><?php echo $bookDate; ?></div>
      </div>
      <div class="fineprint"> 
        <!-- <p>Boarding begins 30 minutes before departure. Snacks available for purchase from The Honeydukes Express.</p> -->
        <p>This ticket is Non-refundable  •Exchange this ticket at the counter</p>
        <p>•NIMBUS ISLAND Authority</p>
      </div>
      <div style="padding: 10px 0 0 0;"><img src="nimbus (1).png" alt="Ticket Logo"></div>
      <div class="snack">
        <svg viewBox="0 -11 414.00053 414">
          <path d="m202.480469 352.128906c0-21.796875-17.671875-39.46875-39.46875-39.46875-21.800781 0-39.472657 17.667969-39.472657 39.46875 0 21.800782 17.671876 39.472656 39.472657 39.472656 21.785156-.023437 39.445312-17.683593 39.46875-39.472656zm0 0"></path>
          <path d="m348.445312 348.242188c2.148438 21.691406-13.695312 41.019531-35.390624 43.167968-21.691407 2.148438-41.015626-13.699218-43.164063-35.390625-2.148437-21.691406 13.695313-41.019531 35.386719-43.167969 21.691406-2.148437 41.019531 13.699219 43.167968 35.390626zm0 0"></path>
          <path d="m412.699219 63.554688c-1.3125-1.84375-3.433594-2.941407-5.699219-2.941407h-311.386719l-3.914062-24.742187c-3.191407-20.703125-21.050781-35.9531252-42-35.871094h-42.699219c-3.867188 0-7 3.132812-7 7s3.132812 7 7 7h42.699219c14.050781-.054688 26.03125 10.175781 28.171875 24.0625l33.800781 213.515625c3.191406 20.703125 21.050781 35.957031 42 35.871094h208.929687c3.863282 0 7-3.132813 7-7 0-3.863281-3.136718-7-7-7h-208.929687c-14.050781.054687-26.03125-10.175781-28.171875-24.0625l-5.746094-36.300781h213.980469c18.117187-.007813 34.242187-11.484376 40.179687-28.597657l39.699219-114.578125c.742188-2.140625.402344-4.511718-.914062-6.355468zm0 0"></path>
        </svg>
      </div>
      <div class="barcode">
    <div class="barcode__scan"></div>
    <div class="barcode__id"><?php echo $tUniqId; ?></div>
     </div>

    <!-- <div class="ticket__side">
      <div class="logo"> 
        <p>NIMBUS ISLAND</p>
      </div>
      <div class="info side-arrive">
      <div class="info__item">Date</div>
        <div class="info__detail"></div>
      </div>
      <div class="info side-depart">
      <div class="info__item">Time</div>
        <div class="info__detail"></div>
      </div>
       <div class="info side-date">
        <div class="info__item">Date</div>
        <div class="info__detail">1 Sep 2018</div>
      </div>
      <div class="info side-time">
        <div class="info__item">Time</div>
        <div class="info__detail">11:00AM</div>
      </div>
      <div class="barcode">
        <div class="barcode__scan"></div>
         <div class="barcode__id"></div> -->
      </div>
    </div> 
  </div>
</div>
<!-- <form action="invoice_page.php" method="POST">
  <input type="hidden" name="uniqueID" value="">
  <input type="hidden" name="username" value="">
  <button type="submit" name="printInvoice">Invoice</button>
</form> -->

<aside class="context">
  <div class="explanation">Part of the <a href="https://codepen.io/collection/DQvYpQ/" target="_blank">CSS Grid collection here</a>.</div>
</aside>
<footer><a href="https://twitter.com/meowlivia_" target="_blank"><i class="icon-social-twitter icons"></i></a><a href="https://github.com/oliviale" target="_blank"><i class="icon-social-github icons"></i></a><a href="https://dribbble.com/oliviale" target="_blank"><i class="icon-social-dribbble icons"></i></a></footer>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
</body>
</html>