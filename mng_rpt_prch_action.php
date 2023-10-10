<?php

include 'db_connection.php';
//username based on session

$username = $_SESSION['username'];

$sql = "SELECT * FROM payment WHERE payType = 'Purchase' ORDER BY payDate DESC";

$resultPurchase = $connection->query($sql);

$totalSumPurchase = 0;
$totalPdgSumPurchase = 0;
$totalExpSumPurchase = 0;
$totalRfdSumPurchase = 0;

/*$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}*/

$connection->close();

//echo json_encode($data); // Output the fetched data as JSON
?>