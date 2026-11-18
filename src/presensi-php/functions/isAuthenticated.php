<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function requireAuth(): void {
    if (empty($_SESSION['user_id'])) {
        header('Location: /presensi-php/login.php');
        exit;
    }
}

function requireRole(string $requiredRole): void {
    requireAuth();
    $userRole = $_SESSION['role'] ?? 'student';

    if ($userRole !== $requiredRole) {
        if ($userRole === 'lecturer') {
            header('Location: /presensi-php/dashboard/lecturer/index.php');
        } else {
            header('Location: /presensi-php/dashboard/index.php');
        }
        exit;
    }
}

requireAuth();
