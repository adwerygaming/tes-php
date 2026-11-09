<?php
// Tentukan direktori penyimpanan file di luar akses publik atau terproteksi
$download_dir = __DIR__ . '/files/';

if (isset($_GET['file'])) {
    // Sanitasi input nama file untuk mencegah Path Traversal (keamanan dasar)
    $filename = basename($_GET['file']);
    $filepath = $download_dir . $filename;

    // 1. Cek apakah file ada dan dapat dibaca
    if (file_exists($filepath) && is_file($filepath)) {

        // Clear output buffer jika ada data sebelumnya
        if (ob_get_level()) {
            ob_end_clean();
        }

        // 2. Set Header HTTP untuk Pengunduhan Aman
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream'); // Memaksa unduh
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));

        // 3. Baca dan kirimkan file ke browser
        readfile($filepath);
        exit;
    } else {
        // Jika file tidak ditemukan
        http_response_code(404);
        die("Error: File tidak ditemukan!");
    }
} else {
    http_response_code(400);
    die("Error: Permintaan tidak valid!");
}
