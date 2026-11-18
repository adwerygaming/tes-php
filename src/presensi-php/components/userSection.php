<section>
    <div class="card shadow-sm position-relative overflow-hidden">
        <div class="card-body position-relative z-1">
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

        <div class="position-absolute end-0 bottom-0 pe-3 text-body-secondary fw-bold user-select-none" style="opacity: 0.12; rotate: 3deg; font-size: 8.5rem; line-height: 0.75; transform: translate(8%, 15%); pointer-events: none; z-index: 0;">
            #<?= htmlspecialchars($user['id']) ?>
        </div>
    </div>
</section>