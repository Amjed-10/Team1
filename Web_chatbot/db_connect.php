
<?php
$host = 'localhost'; 
$db = 'school_db'; 
$user = 'root'; 
$pass = ''; 

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
?>
