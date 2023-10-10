<?php
// Include the database connection file
include('db_connection.php');

session_start();

//username based on session

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $product_id = $_POST['product_id'];
    $variant_id = $_POST['variant_id'];
    $color_id = $_POST['color_id'];
    $size_id = $_POST['size_id'];
    $quantity = $_POST['quantity'];

    // Update data in the database 
    $sql = "UPDATE productvariant SET color_id=?, size_id=?, quantity=? WHERE id=? AND product_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssii", $color_id, $size_id, $quantity, $variant_id, $product_id);

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
