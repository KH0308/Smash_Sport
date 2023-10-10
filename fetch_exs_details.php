<?php
// Include your database connection code here
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM exercise WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Close your database connection here (optional)
        $connection->close();

        header('Content-Type: application/json'); // Set the response content type to JSON
        echo json_encode($row); // Return exercise data as JSON
    } else {
        // Close your database connection here (optional)
        $connection->close();
        
        header('Content-Type: application/json'); // Set the response content type to JSON
        echo json_encode(['error' => 'Exercise not found']); // Return an error response as JSON
    }
    
    $stmt->close();
}
?>
