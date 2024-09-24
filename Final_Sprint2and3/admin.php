<?php
require 'db_connect.php'; // الاتصال بقاعدة البيانات

// كلمة المرور الأصلية التي ستستخدمها لتحديث كلمة مرور admin
$admin_password = 'Ziad@1123'; // كلمة المرور الأصلية

// تشفير كلمة المرور باستخدام password_hash
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// تحديث كلمة مرور admin في قاعدة البيانات
$stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
$stmt->bind_param('s', $hashed_password);

if ($stmt->execute()) {
    echo "Admin password has been updated successfully.";
} else {
    echo "Error updating admin password: " . $stmt->error;
}

$stmt->close();
?>
