<?php
require_once 'db_connection.php';

session_start();

//username based on session

$username = $_SESSION['username'];

$selectedOption = $_GET['selectedOption']; // Get the selected option value

$sql = "SELECT * FROM news WHERE staffID = '".$username."'";

// Apply additional filters based on the selected option
if ($selectedOption === 'upcoming') {
    $sql .= " AND eventDate >= CURDATE()";
}
if($selectedOption === 'pass'){
    $sql .= " AND eventDate < CURDATE()";
}

$sql .= " ORDER BY eventDate DESC";

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
