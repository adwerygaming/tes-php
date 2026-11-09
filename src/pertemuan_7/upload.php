<?php
// Pastikan script hanya memproses jika form dikirimkan via method POST
if (isset($_POST['submit'])) {

    // Ambil data file dari array superglobal $_FILES
    $file        = $_FILES['berkas'];
    $fileName    = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize    = $file['size'];
    $fileError   = $file['error'];

    // 1. Tentukan direktori tujuan penyimpanan di server
    $targetDir = 'uploads/';

    // Buat folder 'uploads/' secara otomatis jika belum ada di server
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // 2. Ambil ekstensi file yang diunggah
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // 3. Konfigurasi Batasan/Validasi
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
    $maxFileSize       = 2 * 1024 * 1024; // 2 MB dalam satuan byte

    // --- PROSES VALIDASI ---

    // Validasi 1: Cek apakah ada error pada sistem upload PHP
    if ($fileError !== UPLOAD_ERR_OK) {
        die("Terjadi kesalahan saat mengunggah file. Kode Error: " . $fileError);
    }

    // Validasi 2: Cek ekstensi file
    if (!in_array($fileExtension, $allowedExtensions)) {
        die("Ekstensi file tidak diizinkan! Hanya diperbolehkan: JPG, JPEG, PNG, dan PDF.");
    }

    // Validasi 3: Cek ukuran file
    if ($fileSize > $maxFileSize) {
        die("Ukuran file terlalu besar! Maksimal 2 MB.");
    }

    // 4. Generate nama file unik untuk mencegah file lama tertimpa jika namanya sama
    $newFileName = uniqid('FILE_', true) . '.' . $fileExtension;
    $destination = $targetDir . $newFileName;

    // 5. Pindahkan file dari folder temporary ke folder tujuan
    if (move_uploaded_file($fileTmpName, $destination)) {
        echo "<h3>Upload Berhasil!</h3>";
        echo "Nama File Asli: " . htmlspecialchars($fileName) . "<br>";
        echo "Nama File di Server: " . $newFileName . "<br>";
        echo "Tipe Ekstensi: ." . $fileExtension . "<br>";
        echo "Ukuran File: " . round($fileSize / 1024, 2) . " KB<br>";
        echo "Lokasi Penyimpanan: " . $destination . "<br><br>";
        echo '<a href="index.php">Kembali ke Form</a>';
    } else {
        echo "Gagal memindahkan file ke direktori tujuan.";
    }
} else {
    // Jika file ini diakses langsung tanpa melalui tombol submit form
    header("Location: index.php");
    exit();
}
