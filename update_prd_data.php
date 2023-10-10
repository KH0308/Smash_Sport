<?php
// Include the database connection file
include('db_connection.php');

session_start();

//username based on session

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $imageUrl = $_POST['imageUrl'];

    // Update data in the database 
    $sql = "UPDATE product SET name=?, category=?, description=?, price=?, rating=?, imageUrl=? WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $category, $description, $price, $rating, $imageUrl, $id);

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
