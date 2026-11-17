<?php
$config = mysqli_connect("localhost", "root", "", "absendulu_3654");

if (!$config) {
    die("Tidak dapat terhubung ke database: " . mysqli_connect_error());
}

if ($config->connect_errno) {
    die("Koneksi gagal: " . $config->connect_errno);
}

global $config;
?>