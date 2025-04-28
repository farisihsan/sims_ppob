<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<main class="main-container profile-page">
    <div class="profile-header">
        <div class="profile-photo-wrapper">
            <img src="<?= isset($user['photo']) ? $user['photo'] : '/assets/images/Profile%20Photo.png' ?>" alt="Profile" class="profile-photo">
            <form id="photo-upload-form" action="<?= base_url('profile/image') ?>" method="post" enctype="multipart/form-data">
                <input type="file" id="photo-input" name="photo" accept="image/*" style="display:none;" onchange="document.getElementById('photo-upload-form').submit()">
                <button type="button" class="profile-photo-edit" onclick="document.getElementById('photo-input').click()">
                    <i class="fa-solid fa-upload"></i>
                </button>
            </form>
        </div>
        <h2 class="profile-name" id="profile-name">
            <?= esc($user['first_name'] . ' ' . $user['last_name']) ?>
        </h2>
    </div>
    <form class="auth-form" id="profile-form" action="<?= base_url('profile/update') ?>" method="POST">
        <div id="profile-alert" style="display:none;"></div>
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
        
        <div class="logout-section">
            <button type="button" id="logout-btn" class="logout-btn">
                Logout
            </button>
        </div>
    </form>
</main>

<!-- Modal Logout -->
<div class="modal" id="logout-modal">
    <div class="modal-content">
        <div class="modal-topup-icon">
            <span class="icon-cross"><i class="fa fa-sign-out"></i></span>
        </div>
        <div class="modal-topup-message">
            Anda yakin ingin logout?
        </div>
        <div class="modal-topup-action">
            <button id="confirm-logout" class="btn-confirm-topup">Ya, Logout</button>
            <button id="cancel-logout" class="btn-cancel-topup">Batalkan</button>
        </div>
    </div>
</div>

<?= $this->section('script') ?>
<script src="<?= base_url('js/script.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
