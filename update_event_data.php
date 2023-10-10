<?php
// Include the database connection file
include('db_connection.php');

session_start();

//username based on session

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $id = $_POST['id'];
    $eventName = $_POST['eventName'];
    $eventDesc = $_POST['eventDesc'];
    $organizer = $_POST['organizer'];
    $currentParticipant = $_POST['currentParticipant'];
    $limitParticipant = $_POST['limitParticipant'];
    $eventDate = $_POST['eventDate'];
    $eventDay = $_POST['eventDay'];
    $eventTime = $_POST['eventTime'];
    $eventPlace = $_POST['eventPlace'];
    $eventImg = $_POST['eventImg'];

    // Validate the data (add more validation if needed)
    $dateParts = explode('/', $eventDate);
    if (count($dateParts) === 3) {
        // Rearrange the date parts to "yyyy-mm-dd" format
        $eventDate = $dateParts[2] . '-' . $dateParts[0] . '-' . $dateParts[1];
    } else {
        // Handle invalid date format if needed
        echo "Invalid date format.";
    }

    // Update data in the database (assuming you have a table named 'events')
    $sql = "UPDATE news SET eventName=?, eventDesc=?, organizer=?, currentParticipant=?, numOfParticipant=?, eventDate=?, eventDay=?, timeRange=?, eventPlace=?, eventImg=? WHERE id=? AND staffID=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssssssss", $eventName, $eventDesc, $organizer, $currentParticipant, $limitParticipant, $eventDate, $eventDay, $eventTime, $eventPlace, $eventImg, $id, $username);

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
