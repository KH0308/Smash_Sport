<?php
    $host = 'localhost';
    $username = 'Admin';
    $password = 'Khairul@262';
    $database = 'smashsportdb';

    // Establish a connection to the MySQL database
    $connection = mysqli_connect($host, $username, $password, $database);

    // Check if the connection was successful
    if (!$connection) {
        die('Failed to connect to the database: ' . mysqli_connect_error());
    }
?>