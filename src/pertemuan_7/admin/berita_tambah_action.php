<?php
include "cek_login.php";

$folder = __DIR__ . "/../images/berita/";

// 1. Ambil data yang dikirim dari form
$judul   = trim($_POST["judul"] ?? "");
$isi     = trim($_POST["isi"] ?? "");
$tanggal = $_POST["tanggal"] ?? "";

// 2. Cek dulu: semua kolom tidak boleh kosong
if ($judul == "" || $isi == "" || $tanggal == "") {
    header("Location: berita_tambah.php?pesan=kosong");
    exit;
}

// Gambar juga wajib diunggah (kode 4 = tidak ada file yang dipilih)
if (!isset($_FILES["gambar"]) || $_FILES["gambar"]["error"] == 4) {
    header("Location: berita_tambah.php?pesan=kosong");
    exit;
}

// 3. Cek gambar yang diunggah
$namafile  = $_FILES["gambar"]["name"];
$ukuran    = $_FILES["gambar"]["size"];
$sementara = $_FILES["gambar"]["tmp_name"];

// Ekstensi file dibuat huruf kecil semua: jpg, jpeg, png, gif, webp
$ekstensi = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));

if (
    $ekstensi != "jpg" && $ekstensi != "jpeg" && $ekstensi != "png"
    && $ekstensi != "gif" && $ekstensi != "webp"
) {
    header("Location: berita_tambah.php?pesan=format");
    exit;
}

// Ukuran gambar maksimal 2 MB (2 x 1024 x 1024 byte)
if ($ukuran > 2 * 1024 * 1024) {
    header("Location: berita_tambah.php?pesan=ukuran");
    exit;
}

// Nama file baru dibuat pendek karena kolom berita_gambar hanya 25 karakter
$gambarbaru = "b" . time() . rand(10, 99) . "." . $ekstensi;

// Buat folder gambar kalau belum ada, lalu pastikan bisa ditulis server
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
    chmod($folder, 0777);
}

// Pindahkan file dari folder sementara ke folder gambar.
// Kalau gagal, berita tidak disimpan supaya tidak ada data gambar yang hilang.
if (!move_uploaded_file($sementara, $folder . $gambarbaru)) {
    header("Location: berita_tambah.php?pesan=gagalunggah");
    exit;
}

// 4. Simpan data ke tabel berita
try {
    $sql = "INSERT INTO news (title, isi, image, created_at, username, status)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($config, $sql);

    // Penulis diambil dari user yang sedang login
    mysqli_stmt_bind_param($stmt, "ssssss", $judul, $isi, $gambarbaru, $tanggal, $user_login, 'draft');
    mysqli_stmt_execute($stmt);

    // Berhasil, kembali ke daftar berita
    header("Location: berita.php?pesan=tambah");
} catch (mysqli_sql_exception $e) {
    die("Gagal menyimpan data berita: " . $e->getMessage());


    // Kalau gagal simpan, gambar yang sudah dipindahkan dihapus lagi
    if (file_exists($folder . $gambarbaru)) {
        unlink($folder . $gambarbaru);
    }

    header("Location: berita_tambah.php?pesan=gagal");
}

exit;
