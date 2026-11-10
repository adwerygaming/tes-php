<?php
include "cek_login.php";

$id       = trim($_GET["id"] ?? "");
$status   = trim($_GET["status"] ?? "");

try {
    $get_status_sql = "UPDATE news SET status = ? WHERE id = ?"; // enum('draft', 'publish')

    $stmt = mysqli_prepare($config, $get_status_sql);

    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);

    echo $data;

    header("Location: berita.php?pesan=" . ($status == "draft" ? "draft" : "terbit"));
} catch (mysqli_sql_exception $e) {
    header("Location: berita_tambah.php?pesan=gagal");
}

exit;
