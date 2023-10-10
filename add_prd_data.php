<?php
// Include the database connection file
include('db_connection.php');

session_start();

//username based on session

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    //$id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $imageUrl = $_POST['imageUrl'];

    // Insert data into the database (assuming you have a table named 'events')
    $sql = "INSERT INTO product (name, category, description, price, rating, imageUrl) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssss", $name, $category, $description, $price, $rating, $imageUrl);

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
