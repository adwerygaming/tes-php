<?php 
declare(strict_types=1);

function resolveLectureByAttendanceCode(string $attendanceCode): ?array {
    $conn = $GLOBALS['config'];
    $codeEscaped = mysqli_real_escape_string($conn, $attendanceCode);

    $query = "SELECT l.*, lec.displayName AS lecturer_name 
              FROM lectures l 
              LEFT JOIN lecturers lec ON l.lecturer_id = lec.id 
              WHERE l.attendance_code = '$codeEscaped'";
    $result = mysqli_query($conn, $query) or exit("Error query: $query");

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}
