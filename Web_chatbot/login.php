<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $stmt = $mysqli->prepare("SELECT username, password, role FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($dbUsername, $dbPassword, $role);
            $stmt->fetch();

            if (password_verify($password, $dbPassword)) {
                $_SESSION['username'] = $dbUsername;
                $_SESSION['role'] = $role;

                if ($role === 'admin') {
                    header('Location: upload_attendance.php');
                } else {
                    header('Location: index.php');
                }
                exit(); 
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
