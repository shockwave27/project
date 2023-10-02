<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
session_start();

// Check if the user is logged in (user_id exists in the session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not authenticated
    header('Location: ../login.php'); // Adjust the URL as needed
    exit;
}

$host = "localhost";
$username = "root";
$password = "";
$database = "nimbus_island"; // Change to your database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userID = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];

// SQL query to retrieve user's profile picture
$sql = "SELECT `user_pic` FROM `signin` WHERE `user_id` = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageData = $row["user_pic"];
    
    if (!empty($imageData)) {
   
         $imageSrc = "colorlib-regform-18/$imageData";
    } else {
        // Default image if no image is found
        $imageSrc = "colorlib-regform-18/uploads/defaultprofile.jpeg"; // Replace with your default image path
    }
} else {
    // User not found or no image found
    // You can handle this case as needed (e.g., display a message)
    $imageSrc = "colorlib-regform-18/uploads/defaultprofile.jpeg"; // Replace with your default image path
}

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
	<!--profile image button-->    <link rel="stylesheet" href="css/profile_image_button.css" type="text/css" media="all">
	<script type="text/javascript" src="js/tabulous.js"></script>
	<script type="text/javascript" src="js/flip.js"></script>
	 <!-- Include the custom.js JavaScript file -->
	 <script src="js/profilebutton.js"></script>
	
	<!-- Gallery effect CSS --> <link rel="stylesheet" href="css/swipebox.css">
	<!--modal css-->
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/modal1.css">

    
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
<!--profile photo button-->

<div class="container">
    <div class="profile-button">
        <a href="dashboard/userdetails.php" class="scroll" id="profile-link">
            <img src="<?php echo $imageSrc; ?>" alt="Avatar" class="avatar">
        </a>
    </div>
</div>

<!--profile photo button ends-->
<!-- Header Starts -->

<script src="js/jquery.vide.min.js"></script>
<div class="head-menu">
	<div class="header" data-vide-bg="video/park" id="home">
		<div class="menu-w3l">
			<nav class="navbar navbar-inverse">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span> 
						</button>
						<a class="navbar-brand logo" href="#"><img src="./images/nimbus.png" alt="logo image"></a>	
					</div>
						
					<div class="collapse navbar-collapse " id="myNavbar">
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="#home" class="scroll wow fadeInRight" data-wow-delay=".3s">Home</a></li>
							<li><a href="#about" class="scroll wow fadeInRight" data-wow-delay="0.7s">About Us</a></li>
							<li><a href="#timing" class="scroll wow fadeInRight" data-wow-delay="1.1s">Timings</a></li>
							<li><a href="#facilities" class="scroll wow fadeInRight" data-wow-delay="1.4s">Facilities</a></li>
							<li><a href="#price" class="scroll wow fadeInRight" data-wow-delay="1.7s">Ticket Price</a></li>
							<li><a href="#gallery" class="scroll wow fadeInRight" data-wow-delay="2.1s">Gallery</a></li>
							<li><a href="#booking" class="scroll wow fadeInRight" data-wow-delay="2.4s">Online Booking</a></li>
							<li><a href="#contact" class="scroll wow fadeInRight" data-wow-delay="2.8s">Contact</a></li>
							<li>
								<a href="#login" class="scroll wow fadeInRight" data-wow-delay="3.2s" >Log Out</a></li>
							
						</ul>
						</ul>
					</div>
				</div>
			</nav>
		  <div class="clearfix"> </div>
		</div> <!-- Menu Ends -->
	</div>
</div> <!-- Header Ends -->

<!--  About Starts -->
<div class="about" id="about">
	<div class="container">
		<div class="about-padding-w3ls">
			<h1> About Island </h1>
			<div class="col-md-6 about-img">
				<div class="w3l-img1">
					<img src="./images/about-img2.jpg" alt="logo">
						<div class="w3l-img2">
							<img src="./images/2.jpg" alt="logo">
						</div>
						<div class="w3l-img3">
							<img src="./images/1.jpg" alt="logo">
						</div>
				</div>
			</div>
			
			<div class="col-md-6 about-text">
				<div class="about-text-padding-agile">
				
					<h4> Enjoy Here </h4>
					<p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
						standard dummy text ever since the 1500s, when an unknown printer took and scrambled it to make a type specimen book.
						It has survived not only five centuries, but also the leap into electronic typesetting, remaining standard dummy text.
					</p>
				
				</div>		
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
</div><!--  About Ends -->

<!--  Visiting-time Starts -->
<div class="visiting-time" id="timing">
	<div class="container">
		<div class="visiting-padding">
			
			<div class="timings">
				<h2> Opening Timings</h2>
				<h5> <span> Monday - Friday   </span>  : 11.00 am - 08.00 pm </h5> 
				<h5> <span> Saturday - Sunday </span>  : 10.00 am - 09.00 pm </h5>
				<h5> <span>Holidays           </span>  : 10.00 am - 10.00 pm </h5>
			</div>
		</div>
	</div>
</div><!--  Visiting-time Ends -->

<!--  info Starts -->
<div class="info" id="facilities">
	<div class="container">
		<div class="info-padding-agileits">
			<h2> Facilities </h2>
			
			<div class="up-info">
				<div class="col-xs-3 col-sm-3 col-md-6 col-lg-6 w3-info info1">
					<div class="icon hovereffect">
						<i class="icon1"> </i>
					</div>
					<h5>Food Court</h5>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever 
					   simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text eversince </p>
				</div>
				
				<div class="col-xs-3 col-sm-3 col-md-6 col-lg-6 w3-info info2">
					<div class="icon hovereffect">
						<i class="icon2"> </i>
					</div>
					<h5>Spa Area</h5>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever 
					   simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text eversince </p>
				</div>
			  <div class="clearfix"> </div>
			</div>
			
			<div class="down-info">
				<div class="col-xs-3 col-sm-3 col-md-6 col-lg-6 w3-info info3">
					<div class="icon hovereffect">
						<i class="icon3"> </i>
					</div>
					<h5>Dormitory</h5>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever 
					   simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text eversince </p>
				</div>
				
				<div class="col-xs-3 col-sm-3 col-md-6 col-lg-6 w3-info info4">
					<div class="icon hovereffect">
						<i class="icon4"> </i>
					</div>
					<h5>Lockers</h5>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever 
					   simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text eversince </p>
				</div>
			  <div class="clearfix"> </div>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
</div><!--  info Ends -->


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
							<li><a href="#tabs-2" title="">Children</a></li>
							<li><a href="#tabs-3" title="">Special</a></li>
						
						</ul>
						
						<div id="tabs_container">
						
							<div id="tabs-1">  <!-- Tabs container Starts -->
									<section class="grid1a">
										<section class="para-a">
											<h4>One Person</h4>
											<h5> <span>$</span>65</h5>
											<p>Fun as You LIke</p>
											<p>Only place in the World</p>
										</section>
									</section>
									
									<section class="grid1b">
										<h3>Basic Ticket</h3>
										<section class="para">
											<p> Entry Pass </p>
											<p> All Roller Coasters  </p>
											<p> Ferris Wheel  </p>
											<p> Pendulum Rides Basic </p>
											<p> Carousel - All Rides </p>
											<p> Bumper Cars </p>
											<p> skyRide </p>
											<p> water slide  </p>
										</section>
									</section>
							</div>

							<div id="tabs-2">
									<section class="grid2a">
										<section class="para-a">
											<h4>One Child</h4>
											<h5> <span>$</span>40</h5>
											<p>Fun as You LIke</p>
											<p>Only place in the World</p>
										</section>
									</section>
									
									<section class="grid2b">
										<h3>Children Ticket</h3>
										<section class="para">
											<p> Entry Pass </p>
											<p> All Roller Coasters  </p>
											<p> Ferris Wheel  </p>
											<p> Pendulum Rides Basic </p>
											<p> Carousel  </p>
											<p> Bumper Cars </p>
											<p> skyRide </p>
											<p> water slide </p>
										</section>
									</section>
							</div>

							<div id="tabs-3" >
									<section class="grid3a">
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
									</section>
							</div>

						</div><!--End tabs container-->
					</div><!--End tabs-->
				</div>
			<!-- Ticket Tab Ends -->	
		</div>
	</div>
</div> <!-- Tickets Ends -->
	
<!-- Gallery start -->
<div id="gallery" class="gallery">
	<div class="container">
		<div class="gallery-padding">
			<div class="gallery-w3l-title">
				<h3>Photo Gallery</h3>
				<p>Duis euismod massa ut sem fringilla blandit. Proin vel enim nec ipsum finibus. </p>
			</div>
			
			<div class="gallery_gds">
				<ul class="simplefilter">
					<li class="active" data-filter="all">All</li>
					<li data-filter="1">Water-land</li>
					<li data-filter="2">Rides</li>
					<li data-filter="3">Games</li>
				</ul>
				
				<div class="filtr-container">
					<div class="col-md-4 filtr-item g-width" data-category="1, 4" data-sort="01">
						<div class="hover ehover14">
							<a href="images/g10.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
								<img src="images/g10.jpg" alt="" class="img-responsive" />
								<div class="overlay">
									<h4>Portfolio</h4>
									<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
								</div>
							</a>	
						</div>
					</div>
					<div class="col-md-4 filtr-item g-width" data-category="2, 3" data-sort="02">
						<div class="hover ehover14">
							<a href="images/g11.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
								<img src="images/g11.jpg" alt="" class="img-responsive" />
								<div class="overlay">
									<h4>Portfolio</h4>
									<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
								</div>
							</a>	
						</div>
					</div>
					<div class="col-md-4 filtr-item g-width" data-category="1, 4" data-sort="03">
						<div class="hover ehover14">
							<a href="images/g12.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
								<img src="images/g12.jpg" alt="" class="img-responsive" />
								<div class="overlay">
									<h4>Portfolio</h4>
									<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
								</div>
							</a>	
						</div>
					</div>
					<div class="col-md-4 filtr-item g-width" data-category="3, 4" data-sort="04">
						<div class="hover ehover14">
							<a href="images/g16.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
								<img src="images/g16.jpg" alt="" class="img-responsive" />
								<div class="overlay">
									<h4>Portfolio</h4>
									<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
								</div>
							</a>	
						</div>
					</div>
					<div class="col-md-4 filtr-item g-width" data-category="3" data-sort="05">
						<div class="hover ehover14">
							<a href="images/g14.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
								<img src="images/g14.jpg" alt="" class="img-responsive" />
								<div class="overlay">
									<h4>Portfolio</h4>
									<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
								</div>
							</a>	
						</div>
					</div>
					<div class="col-md-4 filtr-item g-width" data-category="2, 4" data-sort="06">
						<div class="hover ehover14">
							<a href="images/g15.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
								<img src="images/g15.jpg" alt="" class="img-responsive" />
								<div class="overlay">
									<h4>Portfolio</h4>
									<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
								</div>
							</a>	
						</div>
					</div>
				   <div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
</div>  <!-- Gallery Ends -->
	

<!-- Ticket Booking -->
<div class="booking" id="booking">
	<div class="container">
		<div class="booking-padding">
		  <h3>Online Ticket Booking </h3>
			<div class="main">
				<div class="facts">
				
					<form action="#" method="post">
						<div>
							<div class="reservation-name">
							  <h5>Visitor Name </h5>
								<input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
							</div>
									
							<div class="date-pike">
							  <h5>Date of Visit </h5>
								<input class="date" id="datepicker" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'dd/mm/yyyy';}" required="">
							</div>
							
						  <div class="clearfix"> </div>
						</div>
					
						<div class="reservation">
							<div class="groups">
								<div class="grid_4 columns">
								  <h5>Total Tickets</h5>
									<select class="custom-select" id="select-4">
										<option selected="selected">0</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
									</select>
								</div>		
								<div class="grid_5 columns">
								  <h5>Adults</h5>
									<select class="custom-select" id="select-5">
										<option selected="selected">0</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
									</select>
								</div>	
								<div class="grid_6 columns">
								  <h5>Child</h5>
									<select class="custom-select" id="select-6">
										<option selected="selected">0</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
									</select>
								</div>	
							  <div class="clearfix"></div>
							</div>
						</div>
											
						<div class="date_btn">
							<input type="submit" value="Book">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>  <!-- Ticket Booking Ends -->


<!-- Contact Starts -->
<div class="contact" id="contact">
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
</div> <!-- Contact Ends -->

<!--modal start-->



	<!--gallery-->
	<!-- Include jQuery & Filterizr -->
    <script src="js/jquery.filterizr.js"></script>
    <script src="js/controls.js"></script>
    <!-- Kick off Filterizr -->
    <script type="text/javascript">
        $(function() {
            //Initialize filterizr with default options
            $('.filtr-container').filterizr();
        });
    </script> 
	
	<!-- swipe box js -->
	<script src="js/jquery.swipebox.min.js"></script> 
	<script type="text/javascript">
			jQuery(function($) {
				$(".swipebox").swipebox();
			});
	</script>
	<!-- //swipe box js -->
	<!--//gallery-->
	
	<!--strat-date-piker-->
	<link rel="stylesheet" href="css/jquery-ui.css" />
		<script src="js/jquery-ui.js"></script>
		<script>
		  $(function() {
	      $( "#datepicker,#datepicker1" ).datepicker();
			});
		</script>
	<!--/End-date-piker-->
	
	<!-- Slide-To-Top JavaScript (No-Need-To-Change) -->
		<script type="text/javascript">
			$(document).ready(function() {
			$().UItoTop({ easingType: 'easeOutQuart' });
				});
		</script>
		<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- //Slide-To-Top JavaScript -->
	<!--js for modal-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <script src="js/modal1.js"></script>

</body>
</html>