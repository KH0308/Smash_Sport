<?php

include 'db_connection.php';

session_start();

//username based on session

$username = $_SESSION['username'];

$sql = "SELECT * FROM exercise ORDER BY name ASC";

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
