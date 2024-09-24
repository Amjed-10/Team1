<?php
// تضمين الاتصال بقاعدة البيانات
require 'db_connect.php';

// بدء الجلسة
session_start();

// التحقق مما إذا كان المستخدم مسجلاً دخول
if (!isset($_SESSION['username'])) {
    echo "User not logged in.";
    exit();
}

// الحصول من الجلسة دور المستخدم
$role = $_SESSION['role'] ?? null;  // التحقق من وجود الدور في الجلسة

// إنشاء متغير لتخزين الجدول
$schedules = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'] ?? null;
    $teacher = $_POST['teacher'] ?? null;  // الحصول على المدرس إذا كان موجودًا

    // إذا كان الدور طالب
    if ($role === 'student') {
        $classId = $_POST['class_id'] ?? null;
        if ($day && $classId) {
            // جلب الجدول للطالب بناءً على اليوم والفصل
            $query = "SELECT period, time, subject FROM student_schedules WHERE day = ? AND class_id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("ss", $day, $classId);
            $stmt->execute();
            $result = $stmt->get_result();
            $schedules = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        }
    }
    // إذا كان الدور مدرس
    elseif ($role === 'teacher') {
        $subject = $_POST['subject'] ?? null;
        if ($day && $subject && $teacher) {
            // جلب الجدول للمدرس بناءً على اليوم والمادة والمدرس المختار
            $query = "SELECT period, time, class_id FROM teacher_schedules WHERE day = ? AND subject = ? AND teacher = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("sss", $day, $subject, $teacher);
            $stmt->execute();
            $result = $stmt->get_result();
            $schedules = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        select, button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #518aa7;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #407f9a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #518aa7;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        p {
            text-align: center;
            color: #888;
        }
        /********* Header HTML CSS Starts **********/
.header {
	background: #407f9a;
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
/********* Header HTML CSS End **********/
/********* Design Logo and Menu section CSS Starts **********/
.logo {
	height:110px;
}
/*Menu Section Menu Section*/
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
/********* Design Logo and Menu section CSS End **********/
    </style>
</head>
<body>
    <!------ Header HTML Starts  ------->
<div class="header">
  <div class="container1">
    <b> NEWS : </b>
    <marquee>😂😂 الدفعه الجديده شكلها تعبانه موت  </marquee>
  </div>
</div>
<!------ Header HTML Ends ------->
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
        <h1>View Schedule</h1>

        <!-- Form for selecting day, class/subject, and teacher -->
        <form method="POST" action="schedule.php">
            <div>
                <label for="day">Select Day:</label>
                <select id="day" name="day" required>
                    <option value="">--Select Day--</option>
                    <option value="Sunday">Sunday</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                </select>
            </div>

            <?php if ($role === 'student'): ?>
                <div>
                    <label for="class_id">Select Class:</label>
                    <select id="class_id" name="class_id" required>
                        <option value="">--Select Class--</option>
                        <?php
                        // جلب بيانات الفصول من جدول الطلاب
                        $result = $mysqli->query("SELECT DISTINCT class_id FROM student_schedules");
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['class_id']) . '">' . htmlspecialchars($row['class_id']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            <?php elseif ($role === 'teacher'): ?>
                <div>
                    <label for="subject">Select Subject:</label>
                    <select id="subject" name="subject" required>
                        <option value="">--Select Subject--</option>
                        <?php
                        // جلب بيانات المواد من جدول المدرسين
                        $result = $mysqli->query("SELECT DISTINCT subject FROM teacher_schedules");
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['subject']) . '">' . htmlspecialchars($row['subject']) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- إضافة حقل لاختيار المدرس -->
                <div>
                    <label for="teacher">Select Teacher:</label>
                    <select id="teacher" name="teacher" required>
                        <option value="">--Select Teacher--</option>
                        <?php
                        // جلب أسماء المدرسين من جدول المدرسين
                        $result = $mysqli->query("SELECT DISTINCT teacher FROM teacher_schedules");
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['teacher']) . '">' . htmlspecialchars($row['teacher']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            <?php endif; ?>

            <button type="submit">Show Schedule</button>
        </form>

        <!-- Display Schedule Table -->
        <?php if (!empty($schedules)): ?>
            <table>
                <tr>
                    <th>Period</th>
                    <th>Time</th>
                    <?php if ($role === 'student'): ?>
                        <th>Subject</th>
                    <?php elseif ($role === 'teacher'): ?>
                        <th>Class ID</th>
                    <?php endif; ?>
                </tr>
                <?php foreach ($schedules as $schedule): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($schedule['period']); ?></td>
                        <td><?php echo htmlspecialchars($schedule['time']); ?></td>
                        <?php if ($role === 'student'): ?>
                            <td><?php echo htmlspecialchars($schedule['subject']); ?></td>
                        <?php elseif ($role === 'teacher'): ?>
                            <td><?php echo htmlspecialchars($schedule['class_id']); ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <p>No schedules available for the selected options.</p>
        <?php endif; ?>
    </div>
</body>
</html>
