<?php
session_start();
include '../functions/isAuthenticated.php';
requireRole('lecturer');

include '../config/koneksi.php';

$lecture_id = (int) ($_GET['id'] ?? 0);
$lecturer_id = (int) $_SESSION['user_id'];

header('Content-Type: application/json');

if ($lecture_id <= 0) {
    echo json_encode(['error' => 'invalid_lecture_id', 'attendees' => []]);
    exit();
}

$query = "SELECT u.id, u.displayName, u.email, u.profilePicturePath, a.created_at 
          FROM attendances a 
          JOIN users u ON a.user_id = u.id 
          JOIN lectures l ON a.lecture_id = l.id 
          WHERE a.lecture_id = $lecture_id AND l.lecturer_id = $lecturer_id 
          ORDER BY a.created_at DESC";

$result = mysqli_query($config, $query);

$attendees = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $attendees[] = [
            'id' => (int) $row['id'],
            'displayName' => $row['displayName'],
            'email' => $row['email'],
            'profilePicturePath' => $row['profilePicturePath'],
            'time' => date('H:i:s', strtotime($row['created_at']))
        ];
    }
}

echo json_encode(['total' => count($attendees), 'attendees' => $attendees]);
exit();
