<?php
// Include your database connection code here
include 'db_connection.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM product WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $productID = $row['id'];
        $productName = $row['name'];
        echo json_encode($row); // Return product data as JSON
    } else {
        echo json_encode(array()); // Return an empty JSON object if product not found
    }
    
    $stmt->close();
}

// Close your database connection here (optional)
$connection->close();
?>
