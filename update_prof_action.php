<?php
// Include the database connection file
include('db_connection.php');

session_start();

//username based on session

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request

    $FName = $_POST['FName'];
    $LName = $_POST['LName'];
    $Gender = $_POST['Gender'];
    $Age = $_POST['Age'];
    $Birthdate = $_POST['Birthdate'];
    $Position = $_POST['Position'];
    $Contact = $_POST['Contact'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $profImg = $_POST['profImg'];

    // Validate the data (add more validation if needed)
    $dateParts = explode('/', $Birthdate);
    if (count($dateParts) === 3) {
        // Rearrange the date parts to "yyyy-mm-dd" format
        $Birthdate = $dateParts[2] . '-' . $dateParts[0] . '-' . $dateParts[1];
    } else {
        // Handle invalid date format if needed
        echo "Invalid date format.";
    }

    // Update data in the database (assuming you have a table named 'events')
    $sql = "UPDATE staff SET sfName=?, slName=?, staffGender=?, staffAge=?, staffBirth=?, staffPosition=?, staffMail=?, staffNo=?, staffPwd=?, staffIMG=? WHERE staffID=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssssssss", $FName, $LName, $Gender, $Age, $Birthdate, $Position, $Email, $Contact, $Password, $profImg, $username);

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
