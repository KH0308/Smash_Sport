<?php
// Include your database connection code here
include 'db_connection.php';

if (isset($_GET['id'])) {
    $feedbackId = $_GET['id'];
    
    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE id = ?");
    $stmt->bind_param("i", $feedbackId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        echo json_encode($row); // Return product data as JSON
    } else {
        echo json_encode(array()); // Return an empty JSON object if product not found
    }
    
    $stmt->close();
}

// Close your database connection here (optional)
$connection->close();
?>
