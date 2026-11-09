<?php
// =====================================================
// Proses menghapus data berita
// =====================================================
include "cek_login.php";

// Folder tempat menyimpan gambar berita (alamat lengkap di komputer)
$folder = __DIR__ . "/../images/berita/";

// 1. Ambil id berita dari alamat URL
$id = $_GET["id"] ?? "";

// 2. Kalau id kosong, kembali ke daftar berita
if ($id == "") {
    header("Location: berita.php");
    exit;
}

// 3. Cari data berita untuk mendapatkan nama gambarnya
$sql = "SELECT * FROM news WHERE id = ?";
$stmt = mysqli_prepare($config, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$hasil = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($hasil);

if (!$data) {
    header("Location: berita.php?pesan=tidakada");
    exit;
}

// 4. Hapus data dari tabel berita
try {
    $sql = "DELETE FROM news WHERE id = ?";

    $stmt = mysqli_prepare($config, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    // Jumlah baris yang benar-benar terhapus
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Hapus juga file gambar dari folder
        if ($data["berita_gambar"] != "" && file_exists($folder . $data["berita_gambar"])) {
            unlink($folder . $data["berita_gambar"]);
        }

        header("Location: berita.php?pesan=hapus");
    } else {
        header("Location: berita.php?pesan=tidakada");
    }
} catch (mysqli_sql_exception $e) {
    header("Location: berita.php?pesan=gagal");
}

exit;
