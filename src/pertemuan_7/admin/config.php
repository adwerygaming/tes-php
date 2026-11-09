<?php
$config = mysqli_connect(
    getenv('DB_HOST'),
    "root",
    getenv('DB_PASSWORD'),
    "dataweb3654"
);

if (!$config) {
    die('Gagal terhubung ke MySQLi: '. mysqli_connect_error());
}
?>