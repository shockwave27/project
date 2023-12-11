<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "nimbus_island";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ticket_cat, book_date, no_of_tickets FROM ticket";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Split rows for each ticket if no_of_tickets is greater than one
        $no_of_tickets = (int)$row['no_of_tickets'];
        if ($no_of_tickets > 1) {
            for ($i = 0; $i < $no_of_tickets; $i++) {
                $data[] = array(
                    'ticket_cat' => $row['ticket_cat'],
                    'book_date' => $row['book_date'],
                    
                );
            }
        } else {
            $data[] = array(
                'ticket_cat' => $row['ticket_cat'],
                'book_date' => $row['book_date'],
                
            );
        }
    }
}

$conn->close();
// Debug: Log JSON data
error_log(json_encode($data));

header('Content-Type: application/json');
echo json_encode($data);


?>
