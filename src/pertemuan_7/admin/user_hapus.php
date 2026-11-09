<?php
include "config.php";

$user = $_GET['username'];

$sql = "DELETE FROM user WHERE username='$user'";

$hasil = mysqli_query($config, $sql);

if ($hasil) {
    echo "Data Berhasil dihapus.";
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}
?>

<br>
<p>Kembali ke <a href="halaman_user.php">halaman user</a></p>