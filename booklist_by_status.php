<?php
require_once 'db_connection.php';

session_start();

//username based on session

$username = $_SESSION['username'];

$selectedOption = $_GET['selectedOption']; // Get the selected option value

$sql = "SELECT booking.*, payment.stsPay
        FROM booking INNER JOIN payment ON booking.payID = payment.payID";

// Apply additional filters based on the selected option
if ($selectedOption !== 'all') {
    $sql .= " WHERE status = '$selectedOption'";
}

$sql .= " ORDER BY CASE 
            WHEN status = 'active' THEN 1
            WHEN status = 'pass' THEN 2
            WHEN status = 'cancel' THEN 3
            ELSE 4
        END";

$result = $connection->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$connection->close();

echo json_encode($data); // Output the fetched data as JSON

?>
