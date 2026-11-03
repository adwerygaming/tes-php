<?php
    include "config.php";

    $user = $_POST['username'];
    $pass = $_POST['password'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO user (username, passwd, full_name, email) VALUES ('$user', '$pass', '$full_name', '$email')";

    $hasil = mysqli_query($config, $sql);

    if ($hasil) {
        echo "Data Berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan data.";
    }
?>

<br>
<p>Kembali ke <a href="halaman_user.php">halaman user</a></p>