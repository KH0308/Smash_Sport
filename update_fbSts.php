<?php
include 'db_connection.php';

session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the payID from the POST data
    global $connection;
    $id = $_POST["fbID"];
    //$payID = "4XX19SkQ";

    // Update the stsPay field to 'Refund in progress' for the given payID
    $sql = "UPDATE feedback SET fbkStatus = 'Responded' WHERE id = '$id'";

    // Execute the SQL query
    if ($connection->query($sql) === TRUE) {
        echo "status updated to 'Responded' for payID: " . $id;
    } else {
        echo "Error updating status: " . $connection->error;
    }

    // Close the database connection
    $connection->close();
} else {
    // Handle invalid request method (e.g., not POST)
    http_response_code(400);
    echo "Invalid request method.";
}
?>