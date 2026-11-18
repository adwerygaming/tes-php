<?php 
    declare(strict_types=1);

    function resolveLectureByAttendanceCode(string $attendanceCode): ?array {
        $query = "SELECT * FROM lectures WHERE attendance_code = '$attendanceCode'";
        $result = mysqli_query($GLOBALS['config'], $query) or exit("Error query: $query");

        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }
?>