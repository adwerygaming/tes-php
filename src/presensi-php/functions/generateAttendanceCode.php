<?php
declare(strict_types=1);

function generateAttendanceCode(int $length = 6): string {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charsLength = strlen($chars);
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $chars[random_int(0, $charsLength - 1)];
    }

    return $code;
}
