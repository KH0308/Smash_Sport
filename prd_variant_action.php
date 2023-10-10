<?php
require_once 'db_connection.php'; // Include your database connection script

$prdID = $_GET['prdID']; // Get the selected product ID from the dropdown

// SQL query to get product information
$productInfoSQL = "SELECT id, name FROM product WHERE id = ?";
$stmt = $connection->prepare($productInfoSQL);
$stmt->bind_param("i", $prdID);
$stmt->execute();
$resultProductInfo = $stmt->get_result();
$productInfo = $resultProductInfo->fetch_assoc();
$stmt->close();

// SQL query to get product variant data
$productVariantSQL = "SELECT productvariant.*, color.name AS 'Color',
 size.name AS 'Size' FROM productvariant JOIN color ON productvariant.color_id = color.id
  JOIN size ON productvariant.size_id = size.id WHERE product_id = ?";
$stmt = $connection->prepare($productVariantSQL);
$stmt->bind_param("i", $prdID);
$stmt->execute();
$resultProductVariant = $stmt->get_result();

$data = array();

if ($resultProductVariant->num_rows > 0) {
    while ($row = $resultProductVariant->fetch_assoc()) {
        $data[] = $row;
    }
}

$stmt->close();
$connection->close();

// Create an array with product information and variant data
$response = array(
    'productInfo' => $productInfo,
    'productVariants' => $data
);

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
