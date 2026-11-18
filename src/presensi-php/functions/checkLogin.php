<?php
declare(strict_types=1);

function checkStudentLogin(string $email, string $password): ?array {
    $emailEscaped = mysqli_real_escape_string($GLOBALS['config'], $email);
    $passwordEscaped = mysqli_real_escape_string($GLOBALS['config'], $password);

    $query = "SELECT * FROM users WHERE email = '$emailEscaped' AND password = '$passwordEscaped'";
    $result = mysqli_query($GLOBALS['config'], $query) or exit("Error query: $query");

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $data['role'] = 'student';
        return $data;
    }

    return null;
}

function checkLecturerLogin(string $email, string $password): ?array {
    $emailEscaped = mysqli_real_escape_string($GLOBALS['config'], $email);
    $passwordEscaped = mysqli_real_escape_string($GLOBALS['config'], $password);

    $query = "SELECT * FROM lecturers WHERE email = '$emailEscaped' AND password = '$passwordEscaped'";
    $result = mysqli_query($GLOBALS['config'], $query) or exit("Error query: $query");

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $data['role'] = 'lecturer';
        return $data;
    }

    return null;
}

function checkLogin(string $email, string $password): ?array {
    if ($email === '' || $password === '') {
        return null;
    }

    $lecturer = checkLecturerLogin($email, $password);
    if ($lecturer !== null) {
        return $lecturer;
    }

    return checkStudentLogin($email, $password);
}
