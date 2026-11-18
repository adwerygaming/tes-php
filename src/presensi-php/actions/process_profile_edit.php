<?php
session_start();
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../dashboard/profile.php");
    exit();
}

if (empty($_SESSION['user_id'])) {
    header("Location: ../login.php?err_code=not_logged_in");
    exit();
}

$user_id = (int) $_SESSION['user_id'];
$displayName = trim($_POST['displayName'] ?? '');
$birthDate = trim($_POST['birthDate'] ?? '');
$bio = trim($_POST['bio'] ?? '');

if ($displayName === '') {
    header("Location: ../dashboard/profile.php?status=name_required");
    exit();
}

if ($birthDate === '') {
    header("Location: ../dashboard/profile.php?status=birthdate_required");
    exit();
}

$profilePictureFilename = null;
$profilePicturePath = null;

if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 2 * 1024 * 1024; // 2 MB

    $fileType = $_FILES['profilePicture']['type'];
    $fileSize = $_FILES['profilePicture']['size'];

    if (!in_array($fileType, $allowedTypes) || $fileSize > $maxSize) {
        header("Location: ../dashboard/profile.php?status=invalid_image");
        exit();
    }

    $extension = match ($fileType) {
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif',
        'image/webp' => 'webp',
        default      => 'jpg',
    };
    $profilePictureFilename = 'user_' . $user_id . '_' . time() . '.' . $extension;
    $profilePicturePath = 'uploads/profile/' . $profilePictureFilename;

    $uploadDir = __DIR__ . '/../uploads/profile/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $destination = $uploadDir . $profilePictureFilename;
    if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $destination)) {
        header("Location: ../dashboard/profile.php?status=upload_failed");
        exit();
    }

    $oldQuery = "SELECT profilePicturePath FROM users WHERE id = $user_id";
    $oldResult = mysqli_query($config, $oldQuery);
    if ($oldResult && $oldRow = mysqli_fetch_assoc($oldResult)) {
        if (!empty($oldRow['profilePicturePath'])) {
            $oldFile = __DIR__ . '/../' . $oldRow['profilePicturePath'];
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
    }
}

$displayName = mysqli_real_escape_string($config, $displayName);
$birthDate   = mysqli_real_escape_string($config, $birthDate);
$bio         = mysqli_real_escape_string($config, $bio);

$query = "UPDATE users SET displayName = '$displayName', birthDate = '$birthDate', bio = '$bio'";

if ($profilePicturePath !== null) {
    $safePath = mysqli_real_escape_string($config, $profilePicturePath);
    $query .= ", profilePicturePath = '$safePath'";
}

$query .= " WHERE id = $user_id";

$result = mysqli_query($config, $query);

if ($result) {
    header("Location: ../dashboard/profile.php?status=success");
} else {
    header("Location: ../dashboard/profile.php?status=error");
}
exit();
?>
