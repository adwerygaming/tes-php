<?php
session_start();
include "config.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$user_login = $_SESSION['username'];
