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
$confirm_id = (int) ($_POST['confirm_id'] ?? 0);

if ($confirm_id !== $user_id) {
    header("Location: ../dashboard/profile.php?status=id_mismatch");
    exit();
}

$query = "SELECT profilePicturePath FROM users WHERE id = $user_id";
$result = mysqli_query($config, $query);
if ($result && $row = mysqli_fetch_assoc($result)) {
    if (!empty($row['profilePicturePath'])) {
        $filePath = __DIR__ . '/../' . $row['profilePicturePath'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}

$deleteAttendances = "DELETE FROM attendances WHERE user_id = $user_id";
mysqli_query($config, $deleteAttendances);

$deleteUser = "DELETE FROM users WHERE id = $user_id";
$deleted = mysqli_query($config, $deleteUser);

if (!$deleted) {
    header("Location: ../dashboard/profile.php?status=error");
    exit();
}

$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

header("Location: ../login.php?err_code=account_deleted");
exit();
?>
