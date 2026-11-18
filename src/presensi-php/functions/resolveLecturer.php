<?php
declare(strict_types=1);

include __DIR__ . '/../config/koneksi.php';

function resolveLecturer(int $lecturer_id): ?array {
    $query = "SELECT * FROM lecturers WHERE id = '$lecturer_id'";
    $result = mysqli_query($GLOBALS['config'], $query) or exit("Error query: $query");

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}
