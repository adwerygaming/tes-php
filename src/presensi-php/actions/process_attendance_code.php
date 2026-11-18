<?php
session_start();
include '../config/koneksi.php';
include '../functions/hasAttended.php';
include '../functions/markAttend.php';

$attendance_code = $_POST['the_code'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../dashboard/index.php");
    exit();
}

if (($_POST['confirm'] ?? '') !== 'yes') {
    header("Location: ../dashboard/index.php");
    exit();
}

if (empty($attendance_code)) {
    header("Location: ../dashboard/index.php?attend_code=4");
    exit();
}

$user_id = $_SESSION['user_id'];

if (hasAttended($attendance_code, $user_id)) {
    header("Location: ../dashboard/index.php?attend_code=1");
    exit();
}

$results = markAttend($attendance_code, $user_id);

switch ($results) {
    case 'success':
        header("Location: ../dashboard/attendance_menu.php?code=" . urlencode($attendance_code));
        exit();
    case 'invalid_code':
        header("Location: ../dashboard/index.php?attend_code=2");
        exit();
    default:
        header("Location: ../dashboard/index.php?attend_code=3");
        exit();
}
?>