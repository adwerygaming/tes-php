<?php
    declare(strict_types=1);

    function checkAttendanceCode(string $code): ?array {
        if ($code === '') {
            return null;
        }

        $query = "SELECT * FROM lectures WHERE attendance_code = '$code'";

        $result = mysqli_query($GLOBALS['config'], $query) or exit("Error query: $query");

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            return $data;
        } else {
            return null;
        }
    }
?>