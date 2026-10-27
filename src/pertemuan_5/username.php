<?php
include "config.php";

$sql = "SELECT * FROM user";
$query = mysqli_query($config, $sql);
$row = mysqli_fetch_assoc($query);

echo "<pre>";
print_r($row);
echo "</pre>";

echo "Username: " . $row['username'] . "<br />";
echo "Nama Lengkap: " . $row['full_name'] . "<br />";
echo "Email: " . $row['email'] . "<br />";
?>