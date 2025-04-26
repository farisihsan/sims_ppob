<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<main class="main-container profile-page">
    <div class="profile-header">
        <div class="profile-photo-wrapper">
            <img src="/assets/images/Profile%20Photo.png" alt="Profile" class="profile-photo">
            <button type="button" class="profile-photo-edit">
                <svg width="18" height="18" fill="none" stroke="#222" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06A1.65 1.65 0 0 0 15 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 8.6 15a1.65 1.65 0 0 0-1.82-.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 5 8.6a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 15 8.6a1.65 1.65 0 0 0 1.82.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 15z"/>
                </svg>
            </button>
        </div>
        <h2 class="profile-name">
            <?= esc($user['first_name'] . ' ' . $user['last_name']) ?>
        </h2>
    </div>
    <form method="post" action="<?= base_url('profile/update') ?>" class="profile-form">
        <div class="form-group">
            <label class="form-label">Email</label>
            <div class="input-group">
                <span class="input-icon">
                    <svg width="18" height="18" fill="none" stroke="#aaa" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg>
                </span>
                <input type="email" name="email" value="<?= esc($user['email']) ?>" readonly class="form-input disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Depan</label>
            <div class="input-group">
                <span class="input-icon">
                    <svg width="18" height="18" fill="none" stroke="#aaa" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a8.38 8.38 0 0 1 13 0"/></svg>
                </span>
                <input type="text" name="first_name" value="<?= esc($user['first_name']) ?>" class="form-input">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Belakang</label>
            <div class="input-group">
                <span class="input-icon">
                    <svg width="18" height="18" fill="none" stroke="#aaa" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a8.38 8.38 0 0 1 13 0"/></svg>
                </span>
                <input type="text" name="last_name" value="<?= esc($user['last_name']) ?>" class="form-input">
            </div>
        </div>
        <button type="submit" class="profile-save-btn">
            Simpan
        </button>
    </form>
</main>
<?= $this->endSection() ?>
