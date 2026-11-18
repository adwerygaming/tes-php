<?php
include '../../functions/isAuthenticated.php';
requireRole('lecturer');

include '../../functions/resolveLecturer.php';
include '../../config/koneksi.php';

$lecturer_id = (int) $_SESSION['user_id'];
$lecturer = resolveLecturer($lecturer_id);

if (!$lecturer) {
    header("Location: /presensi-php/login.php?err_code=not_logged_in");
    exit();
}

$pageTitle = 'Dashboard Dosen';
include '../../components/header.php';

$query = "SELECT l.*, COUNT(a.user_id) AS total_attended 
          FROM lectures l 
          LEFT JOIN attendances a ON l.id = a.lecture_id 
          WHERE l.lecturer_id = $lecturer_id 
          GROUP BY l.id 
          ORDER BY l.datetime DESC";
$result = mysqli_query($config, $query);

$lectures = [];
while ($row = mysqli_fetch_assoc($result)) {
    $lectures[] = $row;
}

$status = $_GET['status'] ?? null;
?>

<div class="container flex-grow-1 d-flex flex-column gap-4" style="max-width: 80rem;">
    <?php if ($status === 'class_ended'): ?>
    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>Class session has ended and the lecture has been removed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <section>
        <div class="card shadow-sm position-relative overflow-hidden">
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div>
                            <?php if (!empty($lecturer['profilePhotoPath'])): ?>
                                <img src="/presensi-php/<?= htmlspecialchars($lecturer['profilePhotoPath']) ?>" alt="Avatar" width="64" height="64" class="rounded-circle" style="object-fit: cover;">
                            <?php else: ?>
                                <img src="https://api.dicebear.com/9.x/avataaars/svg?seed=<?= htmlspecialchars($lecturer['displayName']) ?>" alt="Avatar" width="64" height="64" class="rounded-circle">
                            <?php endif; ?>
                        </div>
                        <div>
                            <a>#<?= htmlspecialchars($lecturer['id']) ?></a>
                            <span class="badge bg-secondary-subtle text-secondary-emphasis ms-1">Lecturer</span>
                            <h5 class="card-title mb-1"><?= htmlspecialchars($lecturer['displayName']) ?></h5>
                            <p class="card-text text-body-secondary mb-0"><?= htmlspecialchars($lecturer['email']) ?></p>
                        </div>
                    </div>

                    <div>
                        <a href="/presensi-php/dashboard/lecturer/create_class.php" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Create Class
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="card shadow-sm w-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><i class="bi bi-journal-bookmark-fill me-2"></i>My Classes</h4>
                    <span class="badge text-bg-light border"><?= count($lectures) ?> Classes</span>
                </div>

                <?php if (count($lectures) > 0): ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($lectures as $lec): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center flex-wrap gap-2 px-0 py-3">
                        <div>
                            <h6 class="mb-1 fw-bold"><?= htmlspecialchars($lec['name']) ?></h6>
                            <div class="text-body-secondary small d-flex flex-wrap gap-2 align-items-center">
                                <span><i class="bi bi-door-open-fill me-1"></i>R <?= htmlspecialchars($lec['room_code']) ?></span>
                                <span>·</span>
                                <span><i class="bi bi-calendar-event me-1"></i><?= date('d M Y, H:i', strtotime($lec['datetime'])) ?></span>
                                <span>·</span>
                                <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle">
                                    Code: <strong class="user-select-all"><?= htmlspecialchars($lec['attendance_code']) ?></strong>
                                </span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill px-3 py-2">
                                <i class="bi bi-people-fill me-1"></i><?= $lec['total_attended'] ?> Attended
                            </span>
                            <a href="/presensi-php/dashboard/lecturer/class_screen.php?id=<?= $lec['id'] ?>" class="btn btn-primary btn-sm">
                                <i class="bi bi-broadcast me-1"></i> Open Session
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="text-center text-body-secondary py-5">
                    <i class="bi bi-journal-x" style="font-size: 2.5rem;"></i>
                    <p class="mt-2 mb-3">No classes created yet.</p>
                    <a href="/presensi-php/dashboard/lecturer/create_class.php" class="btn btn-outline-primary btn-sm">
                        Create Your First Class
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<?php include '../../components/footer.php'; ?>
