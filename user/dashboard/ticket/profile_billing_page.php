
<?php
session_start();
echo $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>bs5 profile billing page - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
.fa-2x {
    font-size: 2em;
}

.table-billing-history th, .table-billing-history td {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    padding-left: 1.375rem;
    padding-right: 1.375rem;
}
.table > :not(caption) > * > *, .dataTable-table > :not(caption) > * > * {
    padding: 0.75rem 0.75rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}

.border-start-primary {
    border-left-color: #0061f2 !important;
}
.border-start-secondary {
    border-left-color: #6900c7 !important;
}
.border-start-success {
    border-left-color: #00ac69 !important;
}
.border-start-lg {
    border-left-width: 0.25rem !important;
}
.h-100 {
    height: 100% !important;
}
    </style>
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<div class="container-xl px-4 mt-4">

    <nav class="nav nav-borders">
        <a class="nav-link" href="../userdetails.php" target="__blank">Profile</a>
        <a class="nav-link active ms-0" href="profile_billing_page.html" target="__blank">Billing</a>
        <a class="nav-link" href="profile_security_page.html" target="__blank">secrity</a>
        <a class="nav-link" href="profile_security_page.html" target="__blank">Notifications</a>
      </nav>
<hr class="mt-0 mb-4">
<!-- <div class="row">
<div class="col-lg-4 mb-4">

<div class="card h-100 border-start-lg border-start-primary">
<div class="card-body">
<div class="small text-muted">Current monthly bill</div>
<div class="h3">$20.00</div>
<a class="text-arrow-icon small" href="#!">
Switch to yearly billing
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
</a>
</div>
</div>
</div>
<div class="col-lg-4 mb-4">

<div class="card h-100 border-start-lg border-start-secondary">
<div class="card-body">
<div class="small text-muted">Next payment due</div>
<div class="h3">July 15</div>
<a class="text-arrow-icon small text-secondary" href="#!">
View payment history
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
</a>
</div>
</div>
</div>
<div class="col-lg-4 mb-4">

<div class="card h-100 border-start-lg border-start-success">
<div class="card-body">
<div class="small text-muted">Current plan</div>
<div class="h3 d-flex align-items-center">Freelancer</div>
<a class="text-arrow-icon small text-success" href="#!">
Upgrade plan
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
</a>
</div>
</div>
</div>
</div> -->

<!-- <div class="card card-header-actions mb-4">
<div class="card-header">
Payment Methods
<button class="btn btn-sm btn-primary" type="button">Add Payment Method</button>
</div>
<div class="card-body px-0">

<div class="d-flex align-items-center justify-content-between px-4">
<div class="d-flex align-items-center">
<i class="fab fa-cc-visa fa-2x cc-color-visa"></i>
<div class="ms-4">
<div class="small">Visa ending in 1234</div>
<div class="text-xs text-muted">Expires 04/2024</div>
</div>
</div>
<div class="ms-4 small">
<div class="badge bg-light text-dark me-3">Default</div>
<a href="#!">Edit</a>
</div>
</div>
<hr>

<div class="d-flex align-items-center justify-content-between px-4">
<div class="d-flex align-items-center">
<i class="fab fa-cc-mastercard fa-2x cc-color-mastercard"></i>
<div class="ms-4">
<div class="small">Mastercard ending in 5678</div>
<div class="text-xs text-muted">Expires 05/2022</div>
</div>
</div>
<div class="ms-4 small">
<a class="text-muted me-3" href="#!">Make Default</a>
<a href="#!">Edit</a>
</div>
</div>
<hr>

<div class="d-flex align-items-center justify-content-between px-4">
<div class="d-flex align-items-center">
<i class="fab fa-cc-amex fa-2x cc-color-amex"></i>
<div class="ms-4">
<div class="small">American Express ending in 9012</div>
<div class="text-xs text-muted">Expires 01/2026</div>
</div>
</div>
<div class="ms-4 small">
<a class="text-muted me-3" href="#!">Make Default</a>
<a href="#!">Edit</a>
</div>
</div>
</div>
</div> -->

<div class="card mb-4">
<div class="card-header">booked ticket</div>
<div class="card-body p-0">

<div class="table-responsive table-billing-history">
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



    // Check if the user is logged in and the user ID is available
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
         
        // Create a SQL query to fetch data for the specific user
        $sql = "SELECT `ticket_id`, `t_uniq_id`, `user_id`, `user_name`, `full_name`, `email`, `name_on_card`, `card_number`, `price`, `no_of_tickets`, `rides`, `pay_date`, `book_date`, `ticket_cat`
                FROM `ticket`
                WHERE `user_id` = $userId";
    
        $result = $conn->query($sql);
    
        // Check if there are rows returned
        if ($result->num_rows > 0) {
            echo '<table class="table mb-0">';
            echo '<thead>';
            echo '<tr>';
            echo '<th class="border-gray-200" scope="col">Transaction ID</th>';
            echo '<th class="border-gray-200" scope="col">Date</th>';
            echo '<th class="border-gray-200" scope="col">Amount</th>';
            echo '<th class="border-gray-200" scope="col">Status</th>';
            echo '<th class="border-gray-200" scope="col"></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
    
            while ($row = $result->fetch_assoc()) {
                echo '<form method="post" action="ticket/dist/">';
                echo '<tr>';
                echo '<td>#' . $row['t_uniq_id'] . '</td>';
                echo '<td>' . date('m/d/Y', strtotime($row['pay_date'])) . '</td>';
                echo '<td>$' . number_format($row['price'], 2) . '</td>';
                
                $statusClass = ($row['ticket_cat'] == 'Pending') ? 'badge bg-light text-dark' : 'badge bg-success';
                $statusText = ($row['ticket_cat'] == 'Pending') ? 'Pending' : 'Paid';
                echo '<td><span class="' . $statusClass . '">' . $statusText ;

                echo '</span></td>';
                echo '<td>';
                echo '<input type="hidden" name="ticket_id" value="' . $row['ticket_id'] . '">';
                echo '<input type="hidden" name="user_id" value="' . $row['user_id'] . '">';
        
                echo '<button type="submit" class="btn btn-primary" name="view_ticket">View Ticket</button>';
                echo '</td>';
                echo '</tr>';
                echo '</form>';

            }
    
            echo '</tbody>';
            echo '</table>';
        } else {
            echo 'No transactions found.';
        }
    } else {
        echo 'User ID not found in session. Please log in.';
    }
    ?>
    
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>