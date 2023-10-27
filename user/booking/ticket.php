<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nameOnCard = $_POST["name"];
    $cardNumber = $_POST["cardnumber"];
    $expirationDate = $_POST["expirationdate"];
    $securityCode = $_POST["securitycode"];
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $numberOfTickets = $_POST["ticket-quantity"];
    $ticketPrice = $_POST['total-price'];

    // Set up your database connection
    $servername = "localhost";
    $dbUsername = "your_db_username";
    $dbPassword = "your_db_password";
    $dbname = "your_db_name";

    // Create a connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the SQL INSERT operation
    $sql = "INSERT INTO ticket (user_id, user_name, email, name_on_card, card_number, price, rides, date)
            VALUES ('$username', '$fullname', '$email', '$nameOnCard', '$cardNumber', '$ticketPrice', '$numberOfTickets', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted into the database successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        body { margin: 0 !important; }
        .TicketLogo { width: 110px; height: 100px; }
        #barcode img { height: 75px; width: 75px; max-width: 75px; max-height: 75px; }
    </style>
</head>

<body>
    <div class="TTicket" style="margin: 0px; height: 192px; width: 530px;">
        <table width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
            <tr>
                <td width="110" valign="top" style="margin-left: 5px">
                    <div style="padding: 10px 0 0 0;"><img src="nimbus.png" alt="Ticket Logo"></div>
                    <div style="padding: 5px 0 0 5px;">OrderID #{ORDERID}</div>
                    <div style="padding: 2px 0 0 5px;">AcctID #{ACCTID}</div>
                    <div style="padding: 2px 0 0 5px;"><b>{TICKETHOLDER}</b></div>
                </td>
                <td valign="top" style="padding-top: 10px; padding-left: 15px">
                    <div style="padding: 15px 0 0 0; font-size: 16px;"><b>{EVENTNAME}</b></div>
                    <div style="padding: 5px 0 0 0; font-size: 14px;"><b>{EVENTDATE}</b></div>
                    <div style="padding: 15px 0 0 0; font-size: 14px;"><b>{VENUENAME}</b></div>
                    <div style="padding: 0 0 0 0; font-size: 12px;">{VENUEADDRESS}</div>
                    <div style="padding: 15px 0 0 0; font-size: 14px; padding-top: 8px;">{TICKETINFO}</div>
                    <div style="padding: 3px 0 0 5px; font-size: 10px;">No Refunds or Exchanges</div>
                </td>
                <td width="100" valign="top">
                    <div id="barcode" style="padding: 5px 0 5px 0; max-width: 100%; text-align: right;">{BARCODE}</div>
                    <div style="text-align: right; width: 100%; padding: 0 7px 0 0; font-size: 16px;"><b>{TICKETPRICEFULL}</b></div>
                    <div style="text-align: right; width: 100%; padding: 0 7px 0 0; font-size: 12px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{TICKETSECTION}</div>
                    <div style="text-align: right; width: 100%; padding: 2px 7px 0 0; font-size: 12px;">{ORDERID}</div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
