<?php
// الاتصال بقاعدة البيانات
require 'db_connect.php'; // تأكد من تعديل مسار db_connect.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // الحصول على التاريخ من النموذج
    $attendance_date = $_POST['attendance_date'];
    
    // تحويل التاريخ إلى صيغة ملائمة كاسم جدول
    $formatted_date = str_replace('-', '_', $attendance_date);
    $tableName = "attendance_" . $formatted_date;

    // التحقق من وجود الملف المرفوع
    if (isset($_FILES['file']['tmp_name'])) {
        $file = $_FILES['file']['tmp_name'];
        $fileHandle = fopen($file, 'r');

        if ($fileHandle !== false) {
            // إنشاء جدول للحضور في حالة عدم وجوده
            $createTableQuery = "
                CREATE TABLE IF NOT EXISTS $tableName (
                    id INT(11) AUTO_INCREMENT PRIMARY KEY,
                    student_name VARCHAR(255) NOT NULL,
                    class_id VARCHAR(10) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ";
            $mysqli->query($createTableQuery);

            // قراءة البيانات من ملف CSV
            $rowsInserted = 0;
            while (($data = fgetcsv($fileHandle, 1000, ',')) !== false) {
                $student_name = $data[0];
                $class_id = $data[1];

                // إدخال البيانات إلى جدول الحضور
                $query = "INSERT INTO $tableName (student_name, class_id) VALUES (?, ?)";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('ss', $student_name, $class_id);
                $stmt->execute();
                $rowsInserted++;
            }

            fclose($fileHandle);
            echo "Attendance data uploaded successfully. Rows inserted: $rowsInserted";
        } else {
            echo "Error opening the file.";
        }
    } else {
        echo "No file uploaded.";
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Attendance</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #518aa7;
            margin-bottom: 20px;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="date"],
        .form-group input[type="file"],
        .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        .form-group button {
            background-color: #518aa7;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #417aa3;
        }

        /* Header CSS */
        .header {
            background: #518aa7;
            padding: 6px;
        }

        .header b {
            background: #fff;
            color: red;
            padding: 10px;
            font-size: 20px;
        }

        .header marquee {
            font-size: 20px;
            color: #ffffff;
            width: 80%;
        }

        .logo {
            height: 110px;
        }

        nav {
            float: right;
            padding: 25px 0px;
        }

        nav a {
            color: black;
            text-decoration: none;
            font-size: 18px;
            padding: 2px 10px;
            font-weight: 500;
        }

        nav a:hover {
            color: #5cb85c;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header">
        <div class="container1">
            <b> NEWS : </b>
            <marquee>😂😂 الدفعه الجديده شكلها تعبانه موت  </marquee>
        </div>
    </div>
    
    <!-- Logo and Navigation -->
    <div class="container1">
        <img src="294445316_107952225324580_7070432144729465402_n.jpg" class="logo">
        <nav>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="chatbot.php">Chatbot</a>
            <a href="attendance.php">Attendance Students</a>
            <a href="schedule.php">Weekly School Schedule</a>
        </nav>
    </div>

    <!-- Main Content Container -->
    <div class="container">
        <h2>Upload Attendance Data</h2>

        <form action="upload_attendance.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="attendance-date">Select Date:</label>
                <input type="date" id="attendance-date" name="attendance_date" required>
            </div>

            <div class="form-group">
                <label for="file">Select Attendance File (CSV):</label>
                <input type="file" id="file" name="file" accept=".csv" required>
            </div>

            <div class="form-group">
                <button type="submit">Upload Attendance</button>
            </div>
        </form>
    </div>

</body>
</html>
