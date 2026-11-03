<?php
    include "config.php";

    $user = $_POST['username'];
    $pass = $_POST['password'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, full_name, email) VALUES ('$user', '$pass', '$full_name', '$email')";
?>