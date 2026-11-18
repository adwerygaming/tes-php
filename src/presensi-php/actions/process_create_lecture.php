<?php
session_start();
include '../functions/isAuthenticated.php';
requireRole('lecturer');

include '../config/koneksi.php';
include '../functions/generateAttendanceCode.php';
include '../functions/generateLectureId.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../dashboard/lecturer/create_class.php");
    exit();
}

$name = trim($_POST['name'] ?? '');
$room_code = trim($_POST['room_code'] ?? '');
$datetime = trim($_POST['datetime'] ?? '');
$lecturer_id = (int) $_SESSION['user_id'];

if (empty($name) || empty($room_code) || empty($datetime)) {
    header("Location: ../dashboard/lecturer/create_class.php?err=missing_fields");
    exit();
}

$lecture_id = generateLectureId($config);

$attendance_code = '';
do {
    $attendance_code = generateAttendanceCode(6);
    $checkQuery = "SELECT id FROM lectures WHERE attendance_code = '$attendance_code'";
    $checkResult = mysqli_query($config, $checkQuery);
} while (mysqli_num_rows($checkResult) > 0);

$nameEscaped = mysqli_real_escape_string($config, $name);
$roomCodeEscaped = mysqli_real_escape_string($config, $room_code);
$datetimeEscaped = mysqli_real_escape_string($config, $datetime);

$insertQuery = "INSERT INTO lectures (id, name, lecturer_id, datetime, room_code, attendance_code) 
                VALUES ($lecture_id, '$nameEscaped', $lecturer_id, '$datetimeEscaped', '$roomCodeEscaped', '$attendance_code')";

if (mysqli_query($config, $insertQuery)) {
    header("Location: ../dashboard/lecturer/class_screen.php?id=" . $lecture_id);
    exit();
} else {
    header("Location: ../dashboard/lecturer/create_class.php?err=db_error");
    exit();
}
