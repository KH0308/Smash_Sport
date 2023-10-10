<?php
require_once 'db_connection.php';

session_start();

//username based on session

$username = $_SESSION['username'];

$selectedOption = $_GET['selectedOption']; // Get the selected option value

$sql = "SELECT purchase.*, user.name AS 'CustomerName', product.name AS 'ProductName',
 payment.stsPay AS 'PaymentStatus', payment.totalPay AS 'TotalPay' FROM purchase 
 JOIN user ON purchase.userID = user.userID JOIN product ON purchase.prdID = product.id 
 JOIN payment ON purchase.payID = payment.payID";

// Apply additional filters based on the selected option
if ($selectedOption !== 'all') {
    $sql .= " WHERE buyStatus = '$selectedOption'";
}

$sql .= " ORDER BY CASE 
            WHEN buyStatus = 'Pending Pick-Up' THEN 1
            WHEN buyStatus = 'Not Valid' THEN 2
            WHEN buyStatus = 'Pick-Up' THEN 3
            WHEN buyStatus = 'Expired' THEN 4
            ELSE 5
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
