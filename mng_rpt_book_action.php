<?php

include 'db_connection.php';

session_start();

//username based on session

$username = $_SESSION['username'];

$sql = "SELECT * FROM payment WHERE payType = 'Booking' ORDER BY payDate DESC";

$resultBooking = $connection->query($sql);

$totalSumBook = 0;
$totalPdgSumBook = 0;
$totalExpSumBook = 0;
$totalRfdSumBook = 0;

/*$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}*/

$connection->close();

//echo json_encode($data); // Output the fetched data as JSON
?>