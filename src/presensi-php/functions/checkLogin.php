<?php
    function checkLogin(string $username, string $password): ?array {
        if ($username === '' || $password === '') {
            return null;
        }

        $query = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";

        $result = mysqli_query($GLOBALS['config'], $query) or exit("Error query: $query");

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            return $data;
        } else {
            return null;
        }
    }
?>