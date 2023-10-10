<?php

include 'db_connection.php';

session_start();

//username based on session

$username = $_SESSION['username'];

$queryTtlPayBook = "SELECT * FROM staff WHERE staffID = '$username';";

$result = mysqli_query($connection, $queryTtlPayBook);

if ($result && mysqli_num_rows($result) > 0) {
    
    $userData = mysqli_fetch_assoc($result);

    $FName = $userData['sfName'];
    $LName = $userData['slName'];
    $sGdr = $userData['staffGender'];
    $sAge = $userData['staffAge'];
    $sBirth = $userData['staffBirth'];
    $sPst = $userData['staffPosition'];
    $sMail = $userData['staffMail'];
    $sPhone = $userData['staffNo'];
    $sPwd = $userData['staffPwd'];
    $sImg = $userData['staffIMG'];
}
else{
    echo ("<script> window.alert('No Data Found! Please contact staff by email to admin@gmail.com'); 
    window.location.href = 'dashboard.html'; </script>");
}

// Close the database connection
mysqli_close($connection);

?>