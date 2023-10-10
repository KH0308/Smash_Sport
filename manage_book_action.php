<?php

include 'db_connection.php';

session_start();

//username based on session

$username = $_SESSION['username'];

$sql = "SELECT booking.*, payment.stsPay
FROM booking
INNER JOIN payment ON booking.payID = payment.payID
ORDER BY CASE 
    WHEN booking.status = 'active' THEN 1
    WHEN booking.status = 'pass' THEN 2
    WHEN booking.status = 'cancel' THEN 3
    ELSE 4
END;";

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