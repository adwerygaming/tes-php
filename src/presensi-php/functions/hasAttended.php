<?php
    declare(strict_types=1);

    function hasAttended(string $code, int $user_id): bool {
        $conn = $GLOBALS['config'];

        $stmt = $conn->prepare(
            "SELECT 1 
            FROM attendances a
            INNER JOIN lectures l ON a.lecture_id = l.id
            WHERE l.attendance_code = ? AND a.user_id = ?
            LIMIT 1"
        );
        $stmt->bind_param("si", $code, $user_id);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }
?>