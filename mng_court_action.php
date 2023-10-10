<?php
// db_actions.php

include 'db_connection.php'; // Include the database configuration
//username based on session


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    $courtId = $_POST['courtId'];
    $newStatus = $_POST['newStatus'];
    $description = $_POST['description'];
    $username = $_SESSION['username'];

    // Call the updateCourtStatus function
    updateCourtStatus($courtId, $newStatus, $description, $username);

    // You can handle any response or validation here if needed
    // For example, you can send a success message back to the JavaScript
    echo "Status updated successfully"; // You can customize this response
    exit;
}

function fetchCourtInformation() {
    global $connection;
    
    $sql = "SELECT court.*, staff.sfName AS 'StaffIncharge' FROM court
     JOIN staff ON court.staffIncharge = staff.staffID";
    $result = $connection->query($sql);

    $courtData = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courtData[] = $row;
        }
    }

    return $courtData;
}

function updateCourtStatus($courtId, $newStatus, $description, $username) {
    global $connection;

    $sql = "UPDATE court SET courtStatus = ?, descStatus = ?, staffIncharge = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssi", $newStatus, $description, $username, $courtId);
    $stmt->execute();
    $stmt->close();
}
?>
