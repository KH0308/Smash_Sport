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
    $description = $_POST['description'];
    $training_category = $_POST['training_category'];
    $setExercise = $_POST['setExercise'];
    $duration_minutes = $_POST['duration_minutes'];
    $calories_burned = $_POST['calories_burned'];
    $vid_exr = $_POST['vid_exr'];
    $img_exr = $_POST['img_exr'];

    // Update data in the database (assuming you have a table named 'events')
    $sql = "UPDATE exercise SET name=?, description=?, training_category=?, setExercise=?, duration_minutes=?, calories_burned=?, img_exr=?, vid_exr=? WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssssss", $name, $description, $training_category, $setExercise, $duration_minutes, $calories_burned, $img_exr, $vid_exr, $id);

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
