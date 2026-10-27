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
    header("Location: welcome.php");
    exit();
} else {
    echo "<p>wrong credentials bro</p>";
}
?>