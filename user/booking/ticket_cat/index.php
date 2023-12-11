<?php
session_start();
echo($_SESSION['user_id']);

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
$latestTicketQuery = "SELECT `basic`, `fast` FROM `ticket_cat_price` ORDER BY `ticket_cat_price_id` DESC LIMIT 1"; 

$basicquery = "SELECT `ride_id`, `ride_name`, `ride_details`, `ride_availability`, `ride_price`, `ride_photo`, `ride_type`, `basic`, `fastrack` FROM `ride` WHERE basic = 'yes'";
   
$fastquery = "SELECT `ride_id`, `ride_name`, `ride_details`, `ride_availability`, `ride_price`, `ride_photo`, `ride_type`, `basic`, `fastrack` FROM `ride` WHERE fastrack = 'yes'";

$result = mysqli_query($conn, $latestTicketQuery);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $basicValue = $row['basic'];
    $fastValue = $row['fast'];

    // Now you have the basic and fast values in the $basicValue and $fastValue variables
    // You can use them as needed
    // echo "Basic Value: " . $basicValue . "<br>";
    // echo "Fast Value: " . $fastValue . "<br>";
} else {
    echo "Error executing query: " . mysqli_error($conn);
}


// Execute the queries and fetch ride data
$basicresult = mysqli_query($conn, $basicquery);
$basicrides = [];
while ($row = mysqli_fetch_assoc($basicresult)) {
    $basicrides[] = $row;
}

$fastresult = mysqli_query($conn, $fastquery);
$fastrides = []; // Use a different variable for Fastrack rides
while ($row = mysqli_fetch_assoc($fastresult)) {
    $fastrides[] = $row;
}

// Access the first ride in each category
if (!empty($basicrides)) {
    echo "Basic Ride Names:";
                foreach ($basicrides as $ride) {
                    echo "<p>" . $ride['ride_name'] . "</p>";
                }
}

if (!empty($fastrides)) {
	echo "fasttrack rides";
	foreach ($fastrides as $ride) {
		echo "<p>" . $ride['ride_name'] . "</p>";
	}
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Joy AmusementPark a Entertainment Category Flat Bootstrap Responsive Website Template :: w3layouts</title>
	<!--for-mobile-apps-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Joy AmusementPark Responsive Website Template, Web Templates, Flat Web Templates, Android Compatible web template, 
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!--//for-mobile-apps-->
	
	<!-- Custom-Theme-Files -->
    <!-- Bootstrap-CSS --> 			<link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- JQuery --> 				<script src="js/jquery.min.js"></script>
    <!-- Bootstrap-Main --> 		<script src="js/bootstrap.min.js">		</script>
    <!-- Index-Page-Styling --> 	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
	
	<script type="text/javascript" src="js/tabulous.js"></script>
	<script type="text/javascript" src="js/flip.js"></script>
	
	<!-- redirect to special booking-->
		<script type="text/javascript">
    function redirectForSpecialBooking() {
        window.location.href = "/nimbus_v3/user/booking/ridebooking.php"; // Replace with the actual URL of your booking page
    }
</script>
		

	<!-- Gallery effect CSS --> <link rel="stylesheet" href="css/swipebox.css">
	
	<!--JS for animate-->
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/wow.min.js"></script>
		<script>
			new WOW().init();
		</script>
	<!--//end-animate-->
	
	<!--startsmothscrolling-->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
	<!--endsmothscrolling-->

</head>

<body>



<!-- Tickets Starts here -->
<div class="tickets" id="price">
	<div class="container">
		<div class="tickets-padding-w3agile">
		  <h3> Ticket Price </h3>
			<!-- Tickets Tabs Starts -->
				<div id="wrapper">
					<div id="tabs4">
						<ul>
							<li><a href="#tabs-1" title="">Basic</a></li>
							<li><a href="#tabs-2" title="">Fastrack</a></li>
							<li><a href="#tabs-3" title="" onclick="redirectForSpecialBooking()">Special</a></li>
						</ul>
						
						<div id="tabs_container">

							<div id="tabs-1">  <!-- Tabs container Starts -->
									<section class="grid1a">
										<section class="para-a">
											<h4>One Person</h4>
											<h5> <span>$</span><?php echo" $basicValue" ?></h5>
											<p>Fun as You LIke</p>
											<p>Only place in the World</p>
										</section>
									</section>
									
									<section class="grid1b">
										<h3>Basic Ticket</h3>
										<section class="para">
										 <?php
                                          if (!empty($basicrides)) {
											foreach ($basicrides as $ride) {
												echo "<p>" . $ride['ride_name'] . "</p>";
											}
                                            }
                                             ?>
											
										</section><br>
										<button class="book-now-button" data-ticket-data='<?php echo json_encode($basicrides); ?>' data-ticket-type="basic">Book Now</button>


										
									</section>
							</div>

							<div id="tabs-2">
									<section class="grid2a">
										<section class="para-a">
											<h4>One Person</h4>
											<h5> <span>$</span><?php echo" $fastValue" ?></h5>
											<p>Fun as You LIke</p>
											<p>Only place in the World</p>
										</section>
									</section>
									
									<section class="grid2b">
										<h3>fasttrack Ticket</h3>
										<section class="para">
										<?php
                                          if (!empty($fastrides)) {
											foreach ($fastrides as $ride) {
												echo "<p>" . $ride['ride_name'] . "</p>";
											}
                                            }
                                             ?>
										</section>
										<br>
										<button class="book-now-button-fast" data-ticket-data='<?php echo json_encode($fastrides); ?>' data-ticket-type="fast">Book Now</button>


									</section>
							</div>

							<div id="tabs-3" >
									<!-- <section class="grid3a">
										<section class="para-a">
											<h4>Four Persons</h4>
											<h5> <span>$</span>199</h5>
											<p>Fun as You LIke</p>
											<p>Only place in the World</p>
										</section>
									</section>
									
									<section class="grid3b">
										<h3>Special Ticket</h3>
										<section class="para">
											<p> Entry Pass </p>
											<p> All Roller Coasters  </p>
											<p> Ferris Wheel  </p>
											<p> Pendulum Rides Basic </p>
											<p> Carousel - All Rides </p>
											<p> Bumper Cars </p>
											<p> skyRide - One Way </p>
											<p> water slide - only Two time </p>
										</section>
									</section> -->
							</div>

						</div><!--End tabs container-->
					</div><!--End tabs-->
				</div>
			<!-- Ticket Tab Ends -->	
		</div>
	</div>
</div> <!-- Tickets Ends -->
	



<!-- Contact Starts -->
<!-- <div class="contact" id="contact">
	<div class="container">
		<div class="contact-padding">
			<h3> Contact Us</h3>
			<div>
				<div class="col-md-4 address">
					<h4>Address</h4>
					<address>
						Lorem Ipsum<br>
						HTML5 Buildings,<br>
						Doctorville,<br>
						Great Britain<br>
						(123) 456-7890<br>
						<span>Phone : +123 4567 8900</span>
					</address>
				</div>
				
				<div class="col-md-4 contact-grids map map-grid">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d24539.92663142791!2d-86.16046302812671!3d39.75108691096141!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1463029882632" style="border:0" ></iframe>
				</div>
				
				<div class="col-md-4 social-icons">
					<h4>Follow Us</h4>
					<ul class="social">
						<li><a href="#" class="facebook" title="Go to Our Facebook Page"></a></li>
						<li><a href="#" class="twitter" title="Go to Our Twitter Account"></a></li>
						<li><a href="#" class="googleplus" title="Go to Our Google Plus Account"></a></li>
						<li><a href="#" class="instagram" title="Go to Our Instagram Account"></a></li>
						<li><a href="#" class="youtube" title="Go to Our Youtube Channel"></a></li>
					</ul>
				</div>
			  <div class="clearfix"></div>
			</div>
			
			<div class="footer">
				<p>© 2016 Joy AmusementPark. All Rights Reserved | Design by  <a href="https://w3layouts.com/" target="_blank"> w3layouts </a></p>
			</div>

		</div>
	</div>
</div> Contact Ends -->


	<!--gallery-->
	<!-- Include jQuery & Filterizr -->
    
	<!-- //Slide-To-Top JavaScript -->
	<script>
// JavaScript function to handle the button click
document.querySelector('.book-now-button').addEventListener('click', function() {
console.log("button is clicked");
    var ticketData = JSON.parse(this.getAttribute('data-ticket-data'));
    var ticketType = this.getAttribute('data-ticket-type');
    bookTicket(ticketData, ticketType);
});
document.querySelector('.book-now-button-fast').addEventListener('click', function() {
console.log("button is clicked");
    var ticketData = JSON.parse(this.getAttribute('data-ticket-data'));
    var ticketType = this.getAttribute('data-ticket-type');
    bookTicket(ticketData, ticketType);
});

// Your bookTicket function
function bookTicket(ticketData, ticketType) {
    var rideNames = [];
    ticketData.forEach(function (ride) {
        rideNames.push(ride.ride_name);
    });
    console.log('Selected ' + ticketType + ' Ticket Rides:', rideNames);
	if (rideNames) {
		var data = {
            selectedRides: rideNames,
            ticketType: ticketType
        };
                // Assuming you're using jQuery for the AJAX request
                $.ajax({
                    type: 'POST', // Use POST for more secure data transfer
                    url: 'store_selected_rides_in_session.php', // Replace with the actual URL to process the data on the server
					data: data,
                    success: function (response) {
                        // Handle the server's response, if needed
                        // For example, you could display a success message to the user
                        alert(response);
                        console.log(response);
                        // location.reload(); // This line reloads the page
						window.location.href = '../checkout.php'; 
                    },
                    error: function (xhr, status, error) {
                        // Handle errors, if any
                        console.error(error);
                    }
                });
            }

            // window.location.href = url;
        }
    


</script>

</body>
</html>