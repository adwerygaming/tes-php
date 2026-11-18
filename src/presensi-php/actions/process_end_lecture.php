<?php
session_start();
include '../functions/isAuthenticated.php';
requireRole('lecturer');

include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../dashboard/lecturer/index.php");
    exit();
}

$lecture_id = (int) ($_POST['lecture_id'] ?? 0);
$lecturer_id = (int) $_SESSION['user_id'];

if ($lecture_id <= 0) {
    header("Location: ../dashboard/lecturer/index.php");
    exit();
}

$checkQuery = "SELECT id FROM lectures WHERE id = $lecture_id AND lecturer_id = $lecturer_id";
$checkResult = mysqli_query($config, $checkQuery);

if (mysqli_num_rows($checkResult) === 0) {
    header("Location: ../dashboard/lecturer/index.php?err=not_found");
    exit();
}

$deleteAttendances = "DELETE FROM attendances WHERE lecture_id = $lecture_id";
mysqli_query($config, $deleteAttendances);

$deleteLecture = "DELETE FROM lectures WHERE id = $lecture_id AND lecturer_id = $lecturer_id";
mysqli_query($config, $deleteLecture);

header("Location: ../dashboard/lecturer/index.php?status=class_ended");
exit();
