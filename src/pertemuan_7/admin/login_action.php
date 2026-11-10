<?php 
session_start();
include("config.php");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT username FROM user WHERE username='$username' AND passwd='$password'";

$hasil = mysqli_query($config, $sql) or exit("Erroe query: $sql");

if (mysqli_num_rows($hasil) > 0) {
    $data = mysqli_fetch_assoc($hasil);
    $_SESSION['username'] = $data['username'];
    header("Location: berita.php");
    exit();
} else {
    echo "<h1>Username atau Password salah!</h1>";
    echo "<p><a href='login.php'>Kembali ke halaman login</a></p>";
}
?>