<?php
    include 'db_connection.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM staff WHERE BINARY staffID = '".$username."' AND BINARY staffPwd = '".$password."'";
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Login successful
        session_start();
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    }
    else{
        echo ("<script> window.alert('Invalid username or password.');
        window.location.href = 'index.html'; </script>");
    }

    // Close the database connection
    mysqli_close($connection);
?>