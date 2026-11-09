<?php
include "cek_login.php";

$id       = trim($_GET["id"] ?? "");
$status   = trim($_GET["status"] ?? "");


// 4. Simpan data ke tabel berita
try {
    $get_status_sql = "UPDATE news SET status = ? WHERE id = ?"; // enum('draft', 'terbit')

    $stmt = mysqli_prepare($config, $get_status_sql);

    // Penulis diambil dari user yang sedang login
    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);

    echo $data;

    // Berhasil, kembali ke daftar berita
    header("Location: berita.php?pesan=" . ($status == "draft" ? "draft" : "terbit"));
} catch (mysqli_sql_exception $e) {
    die("Gagal menyimpan data berita: " . $e->getMessage());

    // Kalau gagal simpan, gambar yang sudah dipindahkan dihapus lagi
    if (file_exists($folder . $gambarbaru)) {
        unlink($folder . $gambarbaru);
    }

    header("Location: berita_tambah.php?pesan=gagal");
}

exit;
