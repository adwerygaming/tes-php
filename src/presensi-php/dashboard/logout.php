<?php 

session_start();
// Unset all session variables
$_SESSION['user_id'] = null;

// Destroy the session
session_destroy();
header("Location: /presensi-php/login.php");
?>