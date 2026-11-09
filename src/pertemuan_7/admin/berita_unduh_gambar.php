<?php
include "cek_login.php";

$image = $_GET['image'];

if (!$image) {
    die("Nama file gambar tidak diberikan.");
}

// Folder tempat menyimpan gambar berita (alamat lengkap di komputer)
$folder = __DIR__ . "/../images/berita/";

// Cek apakah file gambar ada
if (!file_exists($folder . $image)) {
    die("File gambar tidak ditemukan.");
}

// Set header untuk mengunduh file gambar
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"" . basename($image) . "\"");

// Baca file gambar dan kirim ke browser
readfile($folder . $image);

?>