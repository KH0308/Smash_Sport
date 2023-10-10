<?php
// Include the database connection file
include('db_connection.php');

session_start();

//username based on session

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $id = $_POST['id'];

    // Update data in the database 
    $sql = "DELETE FROM productvariant WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    echo $sql; // Add this line before $stmt->execute()

    if ($stmt->execute()) {
        // Data updated successfully
        echo "Data delete successfully!";
    } else {
        // Error occurred while updating data
        echo "Failed to delete data.";
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
} else {
    // Handle other HTTP methods or requests
    echo "Invalid request method.";
}
?>