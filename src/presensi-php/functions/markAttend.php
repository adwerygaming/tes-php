<?php
    declare(strict_types=1);

    function markAttend(string $code, int $user_id): string {
        $conn = $GLOBALS['config'];

        $lectureStmt = $conn->prepare("SELECT id FROM lectures WHERE attendance_code = ? LIMIT 1");
        $lectureStmt->bind_param("s", $code);
        $lectureStmt->execute();
        $lecture = $lectureStmt->get_result()->fetch_object();

        if ($lecture === null) {
            return 'invalid_code';
        }

        if (hasAttended($code, $user_id)) {
            return 'already_exists';
        }

        $lecture_id = (int) $lecture->id;
        $insertStmt = $conn->prepare("INSERT INTO attendances (lecture_id, user_id) VALUES (?, ?)");
        $insertStmt->bind_param("ii", $lecture_id, $user_id);

        if ($insertStmt->execute() && $insertStmt->affected_rows > 0) {
            return 'success';
        }

        return 'error';
    }
?>