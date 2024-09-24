<?php
session_start();
require 'db_connect.php'; // الاتصال بقاعدة البيانات

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // التحقق من أن حقول اسم المستخدم وكلمة المرور ليست فارغة
    if (!empty($username) && !empty($password)) {
        // جلب بيانات المستخدم من قاعدة البيانات
        $stmt = $mysqli->prepare("SELECT username, password, role FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        // التحقق مما إذا كان المستخدم موجودًا
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($dbUsername, $dbPassword, $role);
            $stmt->fetch();

            // التحقق من كلمة المرور باستخدام password_verify
            if (password_verify($password, $dbPassword)) {
                // تسجيل الدخول بنجاح
                $_SESSION['username'] = $dbUsername;
                $_SESSION['role'] = $role;

                // التحقق من دور المستخدم
                if ($role === 'admin') {
                    // إذا كان المستخدم admin، إعادة التوجيه إلى صفحة upload.php
                    header('Location: upload_attendance.php');
                } else {
                    // إذا كان المستخدم ليس admin، إعادة التوجيه إلى الصفحة الرئيسية
                    header('Location: index.php');
                }
                exit(); // إنهاء السكربت بعد التوجيه
            } else {
                echo "<p class='error'>Invalid password.</p>";
            }
        } else {
            echo "<p class='error'>No such user found.</p>";
        }

        $stmt->close();
    } else {
        echo "<p class='error'>Please fill in both fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles1.css">
    <style>
        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <!-- عرض رسالة الخطأ إن وجدت -->
        <?php if (!empty($error_message)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
