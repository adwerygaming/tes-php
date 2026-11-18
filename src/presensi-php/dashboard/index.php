<?php
include '../functions/isAuthenticated.php';
include '../functions/resolveUser.php';

$user = resolveUser($GLOBALS['_SESSION']['user_id']);

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
    <section>
        <div class="card shadow-sm">
            <div class="card-body ">
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <?php if (!empty($user['profilePicturePath'])): ?>
                            <img src="/presensi-php/<?= htmlspecialchars($user['profilePicturePath']) ?>" alt="Avatar" width="64" height="64" class="rounded-circle" style="object-fit: cover;">
                        <?php else: ?>
                            <img src="https://api.dicebear.com/9.x/avataaars/svg?seed=<?= htmlspecialchars($user['displayName']) ?>" alt="Avatar" width="64" height="64" class="rounded-circle">
                        <?php endif; ?>
                    </div>
                    <div>
                        <a>#<?= htmlspecialchars($user['id']) ?></a>
                        <h5 class="card-title mb-1"><?= htmlspecialchars($user['displayName']) ?></h5>
                        <p class="card-text text-body-secondary mb-0"><?= htmlspecialchars($user['email']) ?></p>
                        <a href="/presensi-php/dashboard/profile.php" class="btn-sm btn-outline-secondary" title="Edit profile" aria-label="Edit profile">
                            Edit Profile
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

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