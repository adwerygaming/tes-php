<?php
include '../functions/isAuthenticated.php';
requireRole('student');

include '../functions/resolveUser.php';
include '../config/koneksi.php';

$user = resolveUser($_SESSION['user_id']);

$lecturesQuery = "SELECT l.id, l.name, l.datetime, l.room_code, lec.displayName AS lecturer_name 
                  FROM lectures l 
                  LEFT JOIN lecturers lec ON l.lecturer_id = lec.id 
                  ORDER BY l.datetime DESC";
$lecturesResult = mysqli_query($config, $lecturesQuery);
$lectures = [];
while ($row = mysqli_fetch_assoc($lecturesResult)) {
    $lectures[] = $row;
}

$pageTitle = 'Dashboard Mahasigma';
include '../components/header.php';

$attend_code = $_GET['attend_code'] ?? null;
switch ($attend_code) {
    case '1':
        $alertMessage = 'You have already recorded your attendance for this lecture.';
        break;
    case '2':
        $alertMessage = 'Invalid attendance code. Please check the code and try again.';
        break;
    case '3':
        $alertMessage = 'An error occurred while processing your attendance. Please try again later.';
        break;
    case '4':
        $alertMessage = 'Attendance code is required. Please enter a valid code.';
        break;
    default:
        $alertMessage = null;
}
?>

<div class="container flex-grow-1 d-flex flex-column gap-4" style="max-width: 80rem;">
    <?php include '../components/userSection.php'; ?>

    <section class="flex-grow-1 d-flex">
        <div class="card shadow-sm w-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-4">
                <h4 class="card-title mb-2">Enter Attendance Code</h4>
                <p class="text-body-secondary mb-4">Type the code given by your lecturer to record your attendance.</p>

                <form id="preAttendForm" class="w-100" style="max-width: 24rem;">
                    <div class="input-group input-group-lg">
                        <input type="text" id="sectionCodeInput" class="form-control text-center" placeholder="Attendance code" aria-label="Attendance code" autocomplete="off" required>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

                
                <?php if ($attend_code): ?>
                <div class="alert theme-danger" role="alert" style="margin-bottom: 1em;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?php echo $alertMessage; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section>
        <div class="card shadow-sm w-100">
            <div class="card-body p-4">
                <h4 class="card-title mb-3">Available Lectures</h4>

                <?php if (count($lectures) > 0): ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($lectures as $lecture): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-start px-0">
                        <div>
                            <h6 class="mb-1 fw-semibold"><?= htmlspecialchars($lecture['name']) ?></h6>
                            <small class="text-body-secondary">
                                <i class="bi bi-person-fill me-1"></i><?= htmlspecialchars($lecture['lecturer_name']) ?>
                                <span class="mx-1">·</span>
                                <i class="bi bi-door-open-fill me-1"></i>R <?= htmlspecialchars($lecture['room_code']) ?>
                            </small>
                        </div>
                        <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill">
                            <i class="bi bi-calendar-event me-1"></i><?= date('d M Y, H:i', strtotime($lecture['datetime'])) ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="text-center text-body-secondary py-4">
                    <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                    <p class="mt-2 mb-0">No lectures available at the moment.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="confirmAttend" tabindex="-1" aria-labelledby="confirmAttendLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../actions/process_attendance_code.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmAttendLabel">Attendance Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to submit attendance code: <strong id="displayCode" class="text-primary"></strong>?</p>

                    <input type="hidden" name="the_code" id="modalCodeInput">

                    <div class="form-check">
                        <input type="radio" name="confirm" value="yes" class="form-check-input" id="confirmYes" required>
                        <label for="confirmYes" class="form-check-label">Yes, record my attendance</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../components/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const preForm = document.getElementById('preAttendForm');
    const modalEl = document.getElementById('confirmAttend');
    const confirmModal = new bootstrap.Modal(modalEl);

    preForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const code = document.getElementById('sectionCodeInput').value.trim();
        if (!code) return;

        document.getElementById('modalCodeInput').value = code;
        document.getElementById('displayCode').textContent = code;

        confirmModal.show();
    });
});
</script>