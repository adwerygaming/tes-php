<?php

include "config.php";

$user = $_POST['username'];
$pass = $_POST['password'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];

$sql = "UPDATE user SET passwd = '$pass', full_name = '$full_name', email = '$email' WHERE username = '$user'";

$hasil = mysqli_query($config, $sql);

if ($hasil) {
    echo "Data Berhasil diubah.";
} else {
    echo "Terjadi kesalahan saat mengubah data.";
}

?>

<br>
<p>Kembali ke <a href="halaman_user.php">halaman user</a></p>