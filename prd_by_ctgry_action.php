<?php
require_once 'db_connection.php';

session_start();

//username based on session

$username = $_SESSION['username'];

$selectedOption = $_GET['selectedOption']; // Get the selected option value

$sql = "SELECT * FROM product ";

// Apply additional filters based on the selected option
if ($selectedOption !== 'all') {
    $sql .= " WHERE category = '$selectedOption'";
}

$sql .= " ORDER BY name ASC";

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
