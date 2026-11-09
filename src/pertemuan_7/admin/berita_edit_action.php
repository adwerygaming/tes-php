<?php
// =====================================================
// Proses mengubah data berita
// =====================================================
include "cek_login.php";

// Folder tempat menyimpan gambar berita (alamat lengkap di komputer)
$folder = __DIR__ . "/../images/berita/";

// 1. Ambil data yang dikirim dari form
$id      = $_POST["id"] ?? "";
$judul   = trim($_POST["judul"] ?? "");
$isi     = trim($_POST["isi"] ?? "");
$tanggal = $_POST["tanggal"] ?? "";

// 2. Cek data wajib
if ($judul == "" || $isi == "" || $tanggal == "") {
    header("Location: berita_edit.php?id=" . urlencode($id) . "&pesan=kosong");
    exit;
}

// 3. Cari data lama untuk mendapatkan nama gambar sebelumnya
$sql = "SELECT * FROM news WHERE id = ?";
$stmt = mysqli_prepare($config, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$hasil = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($hasil);

// Kalau data tidak ada, kembali ke daftar berita
if (!$data) {
    header("Location: berita.php?pesan=tidakada");
    exit;
}

// Gambar lama tetap dipakai kalau tidak ada gambar baru
$gambarbaru = $data["image"];

// Kode 4 artinya tidak ada file yang dipilih
if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] != 4) {

    if ($_FILES["gambar"]["error"] != 0) {
        header("Location: berita_edit.php?id=" . urlencode($id) . "&pesan=gagal");
        exit;
    }

    $namafile  = $_FILES["gambar"]["name"];
    $ukuran    = $_FILES["gambar"]["size"];
    $sementara = $_FILES["gambar"]["tmp_name"];

    // Ekstensi file dibuat huruf kecil semua: jpg, jpeg, png, gif, webp
    $ekstensi = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));

    if (
        $ekstensi != "jpg" && $ekstensi != "jpeg" && $ekstensi != "png"
        && $ekstensi != "gif" && $ekstensi != "webp"
    ) {
        header("Location: berita_edit.php?id=" . urlencode($id) . "&pesan=format");
        exit;
    }

    // Ukuran gambar maksimal 2 MB
    if ($ukuran > 2 * 1024 * 1024) {
        header("Location: berita_edit.php?id=" . urlencode($id) . "&pesan=ukuran");
        exit;
    }

    // Nama file baru dibuat pendek karena kolom berita_gambar hanya 25 karakter
    $gambarbaru = "b" . time() . rand(10, 99) . "." . $ekstensi;

    // Buat folder gambar kalau belum ada, lalu pastikan bisa ditulis server
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
        chmod($folder, 0777);
    }

    // Pindahkan file baru ke folder gambar. Kalau gagal, perubahan dibatalkan.
    if (!move_uploaded_file($sementara, $folder . $gambarbaru)) {
        header("Location: berita_edit.php?id=" . urlencode($id) . "&pesan=gagalunggah");
        exit;
    }
}

// 4. Simpan perubahan ke database
try {
    $sql = "UPDATE news
            SET title = ?, isi = ?, created_at = ?, image = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($config, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $judul, $isi, $tanggal, $gambarbaru, $id);
    mysqli_stmt_execute($stmt);

    // Kalau gambar diganti, gambar lama dihapus dari folder
    if ($gambarbaru != $data["image"] && $data["image"] != "") {
        if (file_exists($folder . $data["image"])) {
            unlink($folder . $data["image"]);
        }
    }

    header("Location: berita.php?pesan=edit");
} catch (mysqli_sql_exception $e) {
    // Kalau gagal simpan, gambar baru yang sudah dipindahkan dihapus lagi
    if ($gambarbaru != $data["image"] && file_exists($folder . $gambarbaru)) {
        unlink($folder . $gambarbaru);
    }

    header("Location: berita_edit.php?id=" . urlencode($id) . "&pesan=gagal");
}

exit;
