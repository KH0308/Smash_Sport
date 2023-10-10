<?php
require_once 'db_connection.php';

session_start();

// Set the content-type header to indicate JSON response
header('Content-Type: application/json');

// Username based on session
$username = $_SESSION['username'];

// Validate the date (add more validation if needed)
$start_date = date('Y-m-d', strtotime($_GET['start-date']));
$end_date = date('Y-m-d', strtotime($_GET['end-date']));

// Your SQL query with date filtering
$sql = "SELECT * FROM payment WHERE payType = 'Booking'"; // Assuming you want to filter by 'Booking' status

// Apply additional filters based on the selected year and month
if ($start_date !== '' && $end_date !== '') {
    $sql .= " AND payDate >= '$start_date' AND payDate <= '$end_date'";
} else if ($start_date !== '') {
    $sql .= " AND payDate >= '$start_date'";
} else if ($end_date !== '') {
    $sql .= " AND payDate <= '$end_date'";
}

$sql .= " ORDER BY payDate DESC"; // Order by dateBook in descending order

$result = $connection->query($sql);

$totalSumBook = 0;

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$connection->close();

echo json_encode($data); // Output the fetched data as JSON
?>
