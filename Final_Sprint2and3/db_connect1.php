<?php
// إعداد تفاصيل الاتصال بقاعدة البيانات
$host = 'localhost'; // اسم المضيف
$dbUser = 'root'; // اسم مستخدم قاعدة البيانات
$dbPass = ''; // كلمة المرور (اتركه فارغًا إذا لم يكن هناك كلمة مرور)
$dbName = 'attendance_db'; // اسم قاعدة البيانات

// إنشاء الاتصال بقاعدة البيانات
$mysqli = new mysqli($host, $dbUser, $dbPass, $dbName);

// التحقق من نجاح الاتصال
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// تحديد قاعدة البيانات `attendance_db`
$mysqli->select_db($dbName);
?>
