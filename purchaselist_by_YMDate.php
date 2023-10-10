<?php
require_once 'db_connection.php';

session_start();

// Username based on session
$username = $_SESSION['username'];

$selectedYear = $_GET['selectedYear']; // Get the selected year
$selectedMonth = $_GET['selectedMonth']; // Get the selected month

$sql = "SELECT * FROM payment WHERE payType = 'Purchase'"; // Assuming you want to filter by 'Booking' status

// Apply additional filters based on the selected year and month
if ($selectedYear !== 'all' && $selectedMonth !== 'all') {
    $sql .= " AND YEAR(payDate) = '$selectedYear'";
    $sql .= " AND MONTH(payDate) = '$selectedMonth'";
} else if ($selectedYear !== 'all') {
    $sql .= " AND YEAR(payDate) = '$selectedYear'";
} else if ($selectedMonth !== 'all') {
    $sql .= " AND MONTH(payDate) = '$selectedMonth'";
}

$sql .= " ORDER BY payDate DESC"; // Order by dateBook in descending order

$result = $connection->query($sql);

$totalSumPurchase = 0;

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$connection->close();

echo json_encode($data); // Output the fetched data as JSON
?>
