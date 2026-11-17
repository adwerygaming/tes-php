<?php
include '../config/koneksi.php';
    function resolveUser(int $user_id): ?array {
        $query = "SELECT * FROM users WHERE id = '$user_id'";
        $result = mysqli_query($GLOBALS['config'], $query) or exit("Error query: $query");

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            return $data;
        } else {
            return null;
        }
    }
?>