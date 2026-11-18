<?php
$pageTitle = $pageTitle ?? 'AmikomTwo';
$brandHref = (isset($_SESSION['role']) && $_SESSION['role'] === 'lecturer') 
    ? '/presensi-php/dashboard/lecturer/index.php' 
    : '/presensi-php/dashboard/index.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <?php include __DIR__ . '/../config/bootstrap-style.php'; ?>
</head>

<body class="bg-body-tertiary d-flex flex-column min-vh-100" data-bs-theme="light">

    <nav class="navbar bg-body border-bottom">
        <div class="container" style="max-width: 80rem;">
            <a class="navbar-brand fw-semibold" href="<?= $brandHref ?>">AmikomTwo</a>
            <a href="/presensi-php/dashboard/logout.php" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
        </div>
    </nav>

    <main class="flex-grow-1 d-flex flex-column py-4">