<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id']) || empty($GLOBALS['_SESSION']['user_id']) || $_SESSION['user_id'] !== $GLOBALS['_SESSION']['user_id']) {
    header('Location: /presensi-php/login.php');
    exit;
}