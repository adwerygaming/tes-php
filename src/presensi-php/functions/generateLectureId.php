<?php
declare(strict_types=1);

function generateLectureId(mysqli $db): int {
    do {
        $id = random_int(1000000, 9999999);
        $query = "SELECT id FROM lectures WHERE id = $id";
        $result = mysqli_query($db, $query);
    } while ($result && mysqli_num_rows($result) > 0);

    return $id;
}
