<?php
session_start();
include '../config/koneksi.php';
include '../functions/checkLogin.php';

$email = $_POST['email'];
$password = $_POST['password'];

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

header("Location: ../dashboard/index.php");
?>