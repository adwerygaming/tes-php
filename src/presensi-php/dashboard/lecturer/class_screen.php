<?php
include '../../functions/isAuthenticated.php';
requireRole('lecturer');

include '../../config/koneksi.php';

$lecture_id = (int) ($_GET['id'] ?? 0);
$lecturer_id = (int) $_SESSION['user_id'];

if ($lecture_id <= 0) {
    header("Location: /presensi-php/dashboard/lecturer/index.php");
    exit();
}

$query = "SELECT * FROM lectures WHERE id = $lecture_id AND lecturer_id = $lecturer_id";
$result = mysqli_query($config, $query);

if (mysqli_num_rows($result) === 0) {
    header("Location: /presensi-php/dashboard/lecturer/index.php");
    exit();
}

$lecture = mysqli_fetch_assoc($result);

$pageTitle = 'Class in Session - ' . htmlspecialchars($lecture['name']);
include '../../components/header.php';
?>

<div class="container flex-grow-1 d-flex flex-column gap-4" style="max-width: 85rem;">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1"><?= htmlspecialchars($lecture['name']) ?></h3>
            <p class="text-body-secondary mb-0">
                <i class="bi bi-door-open-fill me-1"></i>Room <?= htmlspecialchars($lecture['room_code']) ?>
                <span class="mx-2">·</span>
                <i class="bi bi-clock-fill me-1"></i>Started at <?= date('d M Y, H:i', strtotime($lecture['datetime'])) ?>
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="/presensi-php/dashboard/lecturer/index.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Dashboard
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#endClassModal">
                <i class="bi bi-stop-circle-fill me-1"></i> End Class
            </button>
        </div>
    </div>

    <div class="row g-4 align-items-stretch">
        <div class="col-lg-5">
            <div class="card shadow-sm h-100 text-center border-primary">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold"></i>Attendance Code</h5>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center p-4 p-md-5">
                    <div class="bg-primary-subtle border border-primary rounded-4 py-4 px-3 w-100 my-3">
                        <span class="display-2 fw-bold text-primary text-monospace user-select-all letter-spacing-2" style="letter-spacing: 0.25rem;">
                            <?= htmlspecialchars($lecture['attendance_code']) ?>
                        </span>
                    </div>
                    <span class="text-body-secondary small text-uppercase">Enter this code to submit attendance</span>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-body d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-semibold">
                       Attendees
                    </h5>
                    <span class="badge bg-primary text-white rounded-pill px-3 py-2" id="attendeesBadge">
                        0 Students
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 28rem;">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th scope="col" class="ps-4">#</th>
                                    <th scope="col">Student</th>
                                    <th scope="col" class="pe-4 text-end">Time</th>
                                </tr>
                            </thead>
                            <tbody id="attendeesTableBody">
                                <tr id="emptyRow">
                                    <td colspan="4" class="text-center text-body-secondary py-5">
                                        <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                                        Waiting for students to submit attendance...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="endClassModal" tabindex="-1" aria-labelledby="endClassLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../../actions/process_end_lecture.php" method="post">
                <input type="hidden" name="lecture_id" value="<?= $lecture['id'] ?>">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="endClassLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>End Class Session
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to end <strong><?= htmlspecialchars($lecture['name']) ?></strong>?</p>
                    <div class="alert alert-warning mb-0" role="alert">
                        <i class="bi bi-info-circle-fill me-1"></i>
                        Ending this class will permanently close and remove the lecture and its attendance records from active sessions.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-stop-circle-fill me-1"></i> Yes, End Class
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../../components/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const lectureId = <?= $lecture['id'] ?>;
    const tableBody = document.getElementById('attendeesTableBody');
    const badge = document.getElementById('attendeesBadge');

    function escapeHtml(str) {
        if (!str) return '';
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function pollAttendees() {
        fetch('/presensi-php/actions/get_attendees_poll.php?id=' + lectureId)
            .then(res => res.json())
            .then(data => {
                const attendees = data.attendees || [];
                const total = data.total || attendees.length;

                badge.textContent = total + (total === 1 ? ' Student' : ' Students');

                if (attendees.length === 0) {
                    tableBody.innerHTML = `
                        <tr id="emptyRow">
                            <td colspan="4" class="text-center text-body-secondary py-5">
                                <i class="bi bi-hourglass-split me-1"></i> Waiting for students to submit attendance...
                            </td>
                        </tr>
                    `;
                    return;
                }

                let html = '';
                attendees.forEach(student => {
                    const avatarUrl = student.profilePicturePath 
                        ? ('/presensi-php/' + escapeHtml(student.profilePicturePath))
                        : ('https://api.dicebear.com/9.x/avataaars/svg?seed=' + encodeURIComponent(student.displayName));

                    html += `
                        <tr>
                            <td class="ps-4 fw-bold text-body-secondary">#${escapeHtml(String(student.id))}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="${avatarUrl}" alt="avatar" width="32" height="32" class="rounded-circle" style="object-fit: cover;">
                                    <span class="fw-semibold">${escapeHtml(student.displayName)}</span>
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <span class="badge bg-light text-dark border">${escapeHtml(student.time)}</span>
                            </td>
                        </tr>
                    `;
                });

                tableBody.innerHTML = html;
            })
            .catch(err => {
                console.error('Polling error:', err);
            });
    }

    pollAttendees();
    setInterval(pollAttendees, 1000);
});
</script>
