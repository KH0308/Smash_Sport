<?php
// Include the database connection file
include('db_connection.php');

session_start();

//username based on session

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $buyID = $_POST['buyID'];
    $stsUpdate = 'Pick-Up';

    // Update data in the database (assuming you have a table named 'events')
    $sql = "UPDATE purchase SET buyStatus=? WHERE buyID=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $stsUpdate, $buyID);

    echo $sql; // Add this line before $stmt->execute()

    if ($stmt->execute()) {
        // Data updated successfully
        echo "Data updated successfully!";
    } else {
        // Error occurred while updating data
        echo "Failed to update data.";
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
} else {
    // Handle other HTTP methods or requests
    echo "Invalid request method.";
}
?>
