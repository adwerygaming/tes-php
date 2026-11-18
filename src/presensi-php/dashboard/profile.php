<?php
include '../functions/isAuthenticated.php';
include '../functions/resolveUser.php';

$user = resolveUser($GLOBALS['_SESSION']['user_id']);

$pageTitle = 'Edit Profile';
include '../components/header.php';

$status = $_GET['status'] ?? null;
switch ($status) {
    case 'success':
        $alertClass = 'alert-success';
        $alertMessage = 'Profile updated successfully.';
        break;
    case 'name_required':
        $alertClass = 'alert-danger';
        $alertMessage = 'Display name is required.';
        break;
    case 'birthdate_required':
        $alertClass = 'alert-danger';
        $alertMessage = 'Birth date is required.';
        break;
    case 'invalid_image':
        $alertClass = 'alert-danger';
        $alertMessage = 'Invalid image file. Please upload a JPG, PNG, GIF, or WebP image (max 2 MB).';
        break;
    case 'upload_failed':
        $alertClass = 'alert-danger';
        $alertMessage = 'Failed to upload the profile picture. Please try again.';
        break;
    case 'error':
        $alertClass = 'alert-danger';
        $alertMessage = 'An error occurred while updating your profile. Please try again.';
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
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="flex-grow-1 d-flex">
        <div class="card shadow-sm w-100">
            <div class="card-body d-flex flex-column p-4">
                <h3><b>Edit Profile</b></h3>

                <?php if ($alertMessage): ?>
                <div class="alert <?= $alertClass ?> alert-dismissible fade show" role="alert">
                    <i class="bi bi-<?= $status === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill' ?> me-2"></i>
                    <?= htmlspecialchars($alertMessage) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <form action="../actions/process_profile_edit.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="displayNameInput" class="form-label">Full Name</label>
                        <span style="color: red;">*</span>
                        <input type="text" name="displayName" id="displayNameInput" class="form-control" value="<?= htmlspecialchars($user['displayName']) ?>" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <span style="color: red;">*</span>
                        <input type="email" id="emailInput" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" disabled>
                        <small class="form-text text-muted">Email cannot be changed.</small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="birthDateInput" class="form-label">Birth Date</label>
                        <span style="color: red;">*</span>
                        <input type="date" name="birthDate" id="birthDateInput" class="form-control" value="<?= htmlspecialchars($user['birthDate'] ?? '') ?>" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="bioInput" class="form-label">Bio</label>
                        <textarea class="form-control" name="bio" id="bioInput" rows="3" placeholder="Tell us about yourself..."><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group mt-3 d-flex gap-3 align-items-center">
                        <div style="width: 64px; height: 64px; border-radius: 50%; overflow: hidden; flex-shrink: 0; background-color: #dee2e6;">
                            <?php if (!empty($user['profilePicturePath'])): ?>
                                <img id="avatarPreview" src="/presensi-php/<?= htmlspecialchars($user['profilePicturePath']) ?>" alt="Avatar" width="64" height="64" style="object-fit: cover;">
                            <?php else: ?>
                                <img id="avatarPreview" src="https://api.dicebear.com/9.x/avataaars/svg?seed=<?= htmlspecialchars($user['displayName']) ?>" alt="Avatar" width="64" height="64">
                            <?php endif; ?>
                        </div>
                        <div>
                            <label for="profilePictureInput" class="form-label">Profile Picture</label>
                            <input type="file" name="profilePicture" id="profilePictureInput" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Upload a new profile picture (optional). Max 2 MB.</small>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('profilePictureInput');
    const preview = document.getElementById('avatarPreview');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
