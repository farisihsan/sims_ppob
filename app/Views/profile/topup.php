<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<main class="topup-main">
    <div class="profile-saldo-container">
        <div class="profile-section">
            <img src="<?= isset($user['photo']) ? $user['photo'] : '/assets/images/Profile%20Photo.png' ?>" alt="Profile">
            <div>
                <div class="welcome">Selamat datang,</div>
                <div class="name">
                    <?= isset($user) ? esc($user['first_name'] . ' ' . $user['last_name']) : 'Guest' ?>
                </div>
            </div>
        </div>
        <div class="saldo-card">
            <div style="font-size:1.1rem;opacity:0.9;">Saldo anda</div>
            <h3>
                Rp <span id="saldo-value" data-saldo="<?= isset($user) && isset($user['saldo']) ? number_format($user['saldo'], 0, ',', '.') : '0' ?>">••••••••</span>
            </h3>
            <button type="button" class="lihat-saldo" id="toggle-saldo">
                <span id="toggle-saldo-text">Lihat Saldo</span>
                <svg id="toggle-saldo-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M2.05 12a9.94 9.94 0 0 1 19.9 0 9.94 9.94 0 0 1-19.9 0z"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="container">
        <div class="topup-label">
            <span>Silahkan masukan</span><br>
            <span class="topup-label-bold">Nominal Top Up</span>
        </div> 
        <form action="<?= base_url('topup') ?>" method="post" id="topup-form">
            <div class="topup-grid">
                <div class="input-group-topup">
                    <span class="input-icon-topup">
                        <i class="fa-solid fa-money-bill"></i>
                    </span>
                    <input type="number" name="nominal" min="10000" step="1000" placeholder="masukan nominal Top Up" class="topup-input" autocomplete="off">
                </div>
                <div class="topup-button-grid">
                    <button type="button" class="topup-nominal-btn" data-value="10000">Rp10.000</button>
                    <button type="button" class="topup-nominal-btn" data-value="20000">Rp20.000</button>
                    <button type="button" class="topup-nominal-btn" data-value="50000">Rp50.000</button>
                    <button type="button" class="topup-nominal-btn" data-value="100000">Rp100.000</button>
                    <button type="button" class="topup-nominal-btn" data-value="250000">Rp250.000</button>
                    <button type="button" class="topup-nominal-btn" data-value="500000">Rp500.000</button>
                </div>
            </div>
            <button type="button" class="submit-btn topup-submit-btn" data-endpoint="<?= base_url('topup') ?>" data-label="Top Up" id="topup-submit-btn">
                Top Up
            </button>
        </form>
    </div>
</main>

<!-- Modal Konfirmasi Top Up -->
<div class="modal" id="modaltransaction">
    <div class="modal-content">
        <div id="modal-icon" class="modal-topup-icon"></div>
        <div id="modal-message" class="modal-topup-message"></div>
        <div id="modal-nominal" class="modal-topup-nominal"></div>
        <div id="modal-action" class="modal-topup-action">
            <button id="confirm-btn" class="btn-confirm-topup">Ya, lanjutkan Bayar</button>
            <button id="cancel-btn" class="btn-cancel-topup">Batalkan</button>
        </div>
        <div id="modal-back" class="modal-topup-back" style="display:none;">
            <a href="/" class="btn-back-topup">Kembali ke Beranda</a>
        </div>
    </div>
</div>



<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('js/script.js') ?>"></script>
<?= $this->endSection() ?>
