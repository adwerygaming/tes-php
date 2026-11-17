<?php
include '../functions/isAuthenticated.php';
include '../functions/resolveUser.php';

$user = resolveUser($GLOBALS['_SESSION']['user_id']);

$pageTitle = 'Dashboard Mahasigma';
include '../components/header.php';
?>

<!-- Wrapper: centered like max-w-7xl mx-auto, stretches to fill remaining height -->
<div class="container flex-grow-1 d-flex flex-column gap-4" style="max-width: 80rem;">

    <!-- Section 1: Student info -->
    <section>
        <div class="card shadow-sm">
            <div class="card-body ">
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <img src="https://api.dicebear.com/9.x/avataaars/svg?seed=<?= htmlspecialchars($user['displayName']) ?>" alt="Avatar" width="64" height="64" class="rounded-circle">
                    </div>
                    <div>
                        <a>#<?= htmlspecialchars($user['id']) ?></a>
                        <h5 class="card-title mb-1"><?= htmlspecialchars($user['displayName']) ?></h5>
                        <p class="card-text text-body-secondary mb-0"><?= htmlspecialchars($user['email']) ?></p>
                        <a href="/dashboard/profile.php" class="btn-sm btn-outline-secondary" title="Edit profile" aria-label="Edit profile">
                           Edit Profile
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section 2: Attendance code (fills till bottom) -->
    <section class="flex-grow-1 d-flex">
        <div class="card shadow-sm w-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-4">
                <h4 class="card-title mb-2">Enter Attendance Code</h4>
                <p class="text-body-secondary mb-4">Type the code given by your lecturer to record your attendance.</p>

                <form action="/presensi-php/actions/process_attendance_code.php" method="post" class="w-100" style="max-width: 24rem;">
                    <div class="input-group input-group-lg">
                        <input type="text" name="code" class="form-control text-center" placeholder="Attendance code" aria-label="Attendance code" autocomplete="off" required>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>

<?php include '../components/footer.php'; ?>