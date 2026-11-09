<?php 
// include "cek_login.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($judul ?? "Admin Panel") ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="berita.php">Admin Panel</a>
            <div class="navbar-nav ms-auto align-items-center">
                <a class="nav-link" href="halamanuser.php">Kelola User</a>
                <a class="nav-link" href="berita.php">Kelola Berita</a>
                <span class="navbar-text text-white small mx-2">Halo, <?= htmlspecialchars($user_login) ?></span>
                <a class="nav-link" href="../logout.php">Logout</a>
            </div>
        </div>
    </nav>
</body>