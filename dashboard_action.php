<?php

include 'db_connection.php';

session_start();

//username based on session

$username = $_SESSION['username'];

$queryTtlPayBook = "SELECT 
staff.*,
payment_sums.total_pay_book,
payment_sums.total_pay_purchase,
user_sums.total_users,
customer_sums.total_customers
FROM staff
CROSS JOIN (
SELECT 
    SUM(CASE WHEN payType = 'Booking' AND stsPay = 'Valid' THEN totalPay ELSE 0 END) AS total_pay_book,
    SUM(CASE WHEN payType = 'Purchase' AND stsPay = 'Valid' THEN totalPay ELSE 0 END) AS total_pay_purchase
FROM payment
) AS payment_sums
CROSS JOIN (
SELECT COUNT(*) AS total_users
FROM user
) AS user_sums
CROSS JOIN (
SELECT COUNT(*) AS total_customers
FROM payment
WHERE stsPay IN ('Valid', 'Pending')
) AS customer_sums
WHERE staff.staffID = '$username';";

$result = mysqli_query($connection, $queryTtlPayBook);

if ($result && mysqli_num_rows($result) > 0) {
    
    $userData = mysqli_fetch_assoc($result);

    $sName = $userData['sfName'];
    $sImg = $userData['staffIMG'];
    $ttlPayBook = $userData['total_pay_book'];
    $ttlPayPch = $userData['total_pay_purchase'];
    $ttlUser = $userData['total_users'];
    $ttlCust = $userData['total_customers'];
}
else{
    echo ("<script> window.alert('No Data Found! Please contact staff by email to admin@gmail.com'); 
    window.location.href = 'index.html'; </script>");
}

// Close the database connection
mysqli_close($connection);

?>