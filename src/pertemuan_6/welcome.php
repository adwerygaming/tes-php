<?php 
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "<h2>Control Panel</h2>";
    echo "<p>Selamat datang $username.</p>";
    echo "Klik untuk <a href='logout.php'>logout</a>";
} else {
    echo "Maaf, akses ditolak ya.";
    echo "<a href='login.php'>Klik</a> untuk login dulu";
}