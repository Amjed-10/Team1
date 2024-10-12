<?php
require 'db_connect.php';

$admin_password = 'Ziad@1123'; 

$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
$stmt->bind_param('s', $hashed_password);

if ($stmt->execute()) {
    echo "Admin password has been updated successfully.";
} else {
    echo "Error updating admin password: " . $stmt->error;
}

$stmt->close();
?>
