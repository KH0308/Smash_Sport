<?php
include 'db_connection.php';

session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the payID from the POST data
    global $connection;
    $payID = $_POST["payID"];
    //$payID = "4XX19SkQ";

    // Update the stsPay field to 'Refund in progress' for the given payID
    $sql = "UPDATE payment SET stsPay = 'Refund in progress' WHERE payID = '$payID'";

    // Execute the SQL query
    if ($connection->query($sql) === TRUE) {
        echo "stsPay updated to 'Refund in progress' for payID: " . $payID;
    } else {
        echo "Error updating stsPay: " . $connection->error;
    }

    // Close the database connection
    $connection->close();
} else {
    // Handle invalid request method (e.g., not POST)
    http_response_code(400);
    echo "Invalid request method.";
}
?>