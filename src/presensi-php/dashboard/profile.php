<?php
include '../functions/isAuthenticated.php';
include '../functions/resolveUser.php';

$user = resolveUser($GLOBALS['_SESSION']['user_id']);

$pageTitle = 'Dashboard Mahasigma';
include '../components/header.php';
?>

<div class="container flex-grow-1 d-flex flex-column gap-4" style="max-width: 80rem;">
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
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="flex-grow-1 d-flex">
        <div class="card shadow-sm w-100">
            <div class="card-body d-flex flex-column p-4">
                <h3><b>Edit Profile</b></h3>

                <!-- multipart/form-data -->
                <form action="../actions/process_profile_edit.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="displayNameInput" class="form-label">Full Name</label>
                        <a style="color: red;">*</a>
                        <input type="text" id="displayNameInput" class="form-control" value="<?= htmlspecialchars($user['displayName']) ?>" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <a style="color: red;">*</a>
                        <input type="email" id="emailInput" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" disabled required>
                        <small class="form-text text-muted">Email cannot be changed.</small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="birthDateInput" class="form-label">Birth Date</label>
                        <a style="color: red;">*</a>
                        <input type="date" id="birthDateInput" class="form-control" value="<?= htmlspecialchars($user['birthDate']) ?>" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="bioInput" class="form-label">Bio</label>
                        <textarea class="form-control" id="bioInput" rows="3" placeholder="Bio"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group mt-3 d-flex gap-3 align-items-center">
                        <!-- live previre -->
                        <div style="background-color: brown; width: 64px; height: 64px; border-radius: 50%; overflow: hidden;">
                            <img src="https://api.dicebear.com/9.x/avataaars/svg?seed=<?= htmlspecialchars($user['displayName']) ?>" alt="Avatar" width="64" height="64" class="rounded-circle">
                        </div>
                        <div>
                            <label for="profilePictureInput" class="form-label">Profile Picture</label>
                            <input type="file" id="profilePictureInput" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Upload a new profile picture (optional).</small>
                        </div>
                    </div>

                    <div class="form-group mt-4 text-end">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="/presensi-php/dashboard/index.php" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include '../components/footer.php'; ?>

</script>