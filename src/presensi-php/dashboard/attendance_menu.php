<?php
include '../functions/isAuthenticated.php';
requireRole('student');

include '../config/koneksi.php';
include '../functions/resolveLectureByAttendanceCode.php';

$attendance_code = $_GET['code'] ?? null;

if ($attendance_code === null) {
    header("Location: index.php");
    exit();
}

$lecture = resolveLectureByAttendanceCode($attendance_code);

if ($lecture === null) {
    header("Location: index.php");
    exit();
}

$pageTitle = 'Attendance Menu';
include '../components/header.php';
?>

<div class="container flex-grow-1 d-flex flex-column gap-4">
    <section>
        <div class="card shadow-sm">
            <div class="card-body ">
                <div class="d-flex align-items-center gap-3 text-center justify-content-center">
                    <div>
                        <i class="bi bi-check-circle-fill" style="font-size: 4em; color: green;"></i>
                        <h3><b>Attendance Success</b></h3>
                        <p class="text-body-secondary mb-3">
                            <?= htmlspecialchars($lecture['name']) ?>
                            <?php if (!empty($lecture['lecturer_name'])): ?>
                                · <?= htmlspecialchars($lecture['lecturer_name']) ?>
                            <?php endif; ?>
                            · R <?= htmlspecialchars($lecture['room_code']) ?>
                        </p>
                        <a href="index.php" class="btn btn-outline-secondary" title="Back to dashboard" aria-label="Back to dashboard">
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include '../components/footer.php'; ?>
