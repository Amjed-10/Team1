<?php
$host = 'localhost'; 
$dbUser = 'root'; 
$dbPass = ''; 
$dbName = 'attendance_db'; 

$mysqli = new mysqli($host, $dbUser, $dbPass, $dbName);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

`attendance_db`
$mysqli->select_db($dbName);
?>
