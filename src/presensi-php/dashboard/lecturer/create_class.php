<?php
include '../../functions/isAuthenticated.php';
requireRole('lecturer');

$pageTitle = 'Create Class';
include '../../components/header.php';

$err = $_GET['err'] ?? null;
?>

<div class="container flex-grow-1 d-flex flex-column gap-4" style="max-width: 48rem;">
    <div class="card shadow-sm">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0 fw-bold">Create New Class</h3>
                <a href="/presensi-php/dashboard/lecturer/index.php" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>

            <?php if ($err === 'missing_fields'): ?>
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>Please fill in all required fields.
            </div>
            <?php elseif ($err === 'db_error'): ?>
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>An error occurred while creating the class. Please try again.
            </div>
            <?php endif; ?>

            <form action="../../actions/process_create_lecture.php" method="post">
                <div class="mb-3">
                    <label for="nameInput" class="form-label fw-semibold">Class / Course Name</label>
                    <input type="text" name="name" id="nameInput" class="form-control form-control-lg" placeholder="e.g. Pemrograman Web Lanjut" required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="roomInput" class="form-label fw-semibold">Room Code</label>
                        <input type="text" name="room_code" id="roomInput" class="form-control" placeholder="e.g. 05.04.07 or L 2.4.1" required>
                    </div>

                    <div class="col-md-6">
                        <label for="datetimeInput" class="form-label fw-semibold">Date & Time</label>
                        <input type="datetime-local" name="datetime" id="datetimeInput" class="form-control" value="<?= date('Y-m-d\TH:i') ?>" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="/presensi-php/dashboard/lecturer/index.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary fw-semibold px-4">
                        <i class="bi bi-play-circle-fill me-1"></i> Start & Open Attendance
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../../components/footer.php'; ?>
