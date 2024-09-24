<?php
// تضمين الاتصال بقاعدة البيانات
require 'db_connect1.php';

// التحقق مما إذا تم إرسال طلب مع التاريخ والفصل
if (isset($_POST['date']) && isset($_POST['class_id'])) {
    $date = $_POST['date'];
    $class_id = $_POST['class_id'];

    // تحويل التاريخ إلى صيغة ملائمة كاسم جدول
    $formatted_date = str_replace('-', '_', $date);
    $tableName = "attendance_" . $formatted_date;

    // التحقق مما إذا كان الجدول موجودًا
    $checkTableQuery = "SHOW TABLES LIKE '$tableName'";
    $tableExists = $mysqli->query($checkTableQuery);

    if ($tableExists && $tableExists->num_rows > 0) {
        // استعلام لجلب بيانات الحضور بناءً على التاريخ والفصل
        $query = "SELECT student_name FROM $tableName WHERE class_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // جلب النتائج
        $attendance_data = [];
        while ($row = $result->fetch_assoc()) {
            $attendance_data[] = $row;
        }

        $stmt->close();
    } else {
        // إذا كان الجدول غير موجود
        $attendance_data = [];
        echo "No attendance records found for the selected date.";
    }
} else {
    $attendance_data = []; // إذا لم يتم اختيار تاريخ أو فصل بعد
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
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
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #518aa7;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .header {
            background: #518aa7;
            padding: 6px;
        }
        .header b {
            background: #fff;
            color: red;
            padding:10px;
            font-size: 20px;
        }
        .header marquee {
            font-size:20px;
            color: #ffffff;
            width: 80%;
        }

        .logo {
            height:110px;
        }
        nav {
            float: right;
            padding:25px 0px;
        }
        nav a {
            color: black;
            text-decoration: none;
            font-size:18px;
            padding:2px 10px;
            font-weight:500;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container1">
            <b> NEWS : </b>
            <marquee>😂😂 الدفعه الجديده شكلها تعبانه موت  </marquee>
        </div>
    </div>
    
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

    <div class="container">
        <h2>Attendance</h2>
        <form method="POST" action="attendance.php">
            <label for="attendance-date">Select Date:</label>
            <input type="date" id="attendance-date" class="form-control" name="date" required>

            <label for="class-id">Select Class:</label>
            <select id="class-id" class="form-control" name="class_id" required>
                <option value="">--Select Class--</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
                <option value="S4">S4</option>
                <option value="W1">W1</option>
                <option value="W2">W2</option>
                <option value="W3">W3</option>
                <option value="W4">W4</option>
                <option value="J1">J1</option>
                <option value="J2">J2</option>
                <option value="J3">J3</option>
                <option value="J4">J4</option>
            </select>

            <button type="submit" class="form-control">Load Attendance</button>
        </form>
        
        <table id="attendance-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($attendance_data) && !empty($attendance_data)): ?>
                    <?php foreach ($attendance_data as $attendance): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($attendance['student_name']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="1">No attendance records found for the selected date and class.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
