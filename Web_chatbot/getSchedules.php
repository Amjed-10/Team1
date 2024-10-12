<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $day = $_POST['day'] ?? '';
    $role = $_POST['role'] ?? '';
    $classId = $_POST['class_id'] ?? '';
    $subject = $_POST['subject'] ?? '';

    $response = [];

    if ($role === 'student' && $day && $classId) {
        $stmt = $mysqli->prepare("SELECT period, time, subject FROM student_schedules WHERE day = ? AND class_id = ?");
        $stmt->bind_param('ss', $day, $classId);
        $stmt->execute();
        $result = $stmt->get_result();
        $response = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } elseif ($role === 'teacher' && $day && $subject) {
        $stmt = $mysqli->prepare("SELECT period, time, class_id FROM teacher_schedules WHERE day = ? AND subject = ?");
        $stmt->bind_param('ss', $day, $subject);
        $stmt->execute();
        $result = $stmt->get_result();
        $response = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    echo json_encode($response);
}
?>
