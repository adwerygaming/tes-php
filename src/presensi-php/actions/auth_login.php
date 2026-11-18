<?php
// auth_login.php

session_start();
include '../config/koneksi.php';
include '../functions/checkLogin.php';

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    header("Location: ../login.php?err_code=not_satisfied");
    exit();
}

$user = checkLogin($email, $password);

if ($user === null) {
    header("Location: ../login.php?err_code=invalid_creds");
    exit();
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];

if ($user['role'] === 'lecturer') {
    header("Location: ../dashboard/lecturer/index.php");
} else {
    header("Location: ../dashboard/index.php");
}
exit();
?>