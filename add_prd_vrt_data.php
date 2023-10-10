<?php
// Include the database connection file
include('db_connection.php');

session_start();

//username based on session

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    //$id = $_POST['id'];
    $product_id = $_POST['product_id'];
    $color_id = $_POST['color_id'];
    $size_id = $_POST['size_id'];
    $quantity = $_POST['quantity'];

    // Insert data into the database (assuming you have a table named 'events')
    $sql = "INSERT INTO productvariant (product_id, color_id, size_id, quantity) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $product_id, $color_id, $size_id, $quantity);

    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Data added successfully!";
    } else {
        // Error occurred while inserting data
        echo "Failed to add data.";
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
} else {
    // Handle other HTTP methods or requests
    echo "Invalid request method.";
}
?>
