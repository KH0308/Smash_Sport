<?php

include 'db_connection.php';

//username based on session

$username = $_SESSION['username'];

$sql = "SELECT * 
FROM feedback 
ORDER BY CASE 
    WHEN fbkStatus = 'Pending' THEN 1
    WHEN fbkStatus = 'Responded' THEN 2
    ELSE 3
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