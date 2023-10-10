<?php

require_once 'db_connection.php';

session_start();

//username based on session

$username = $_SESSION['username'];

$sql = "SELECT DISTINCT booking.bookID, booking.userID, booking.dateBook, 
booking.status, payment.payID, payment.payDate, payment.payTime, payment.payOpt, 
payment.totalPay, payment.stsPay  
FROM booking
INNER JOIN payment ON booking.payID = payment.payID
WHERE (booking.status = 'cancel' AND payment.stsPay = 'Valid') 
OR (booking.status = 'cancel' AND payment.stsPay = 'Refund in progress')";

$result = $connection->query($sql);

/*$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}*/

$connection->close();

//echo json_encode($data); // Output the fetched data as JSON
?>