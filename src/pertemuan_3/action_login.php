<?php
$user = $_POST['user'];
$pass = $_POST['pass'];

if ($user == "" || $pass == "") {
    $pesan = "Username atau Password tidak boleh kosong";
} elseif ($user != "zizi") {
    $pesan = "Username tidak valid";
} elseif ($user == "zizi" && $pass != "123") {
    $pesan = "Password tidak valid";
} else {
    $pesan = "LOGIN SUKSES! Selamat datang $user";
}

echo "<b>$pesan</b> <br>";
echo "<a href='login_3654.php'>Back</a>";
?>