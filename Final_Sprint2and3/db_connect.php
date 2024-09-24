
<?php
$host = 'localhost'; // اسم السيرفر
$db = 'school_db'; // اسم قاعدة البيانات
$user = 'root'; // اسم المستخدم
$pass = ''; // كلمة المرور (تكون فارغة عادةً في XAMPP)

$mysqli = new mysqli($host, $user, $pass, $db);

// التحقق من الاتصال
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
?>
