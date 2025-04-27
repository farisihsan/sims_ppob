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
        <span>Pembayaran</span><br>
        <div class="transaction-label">
            <img src="<?= base_url('assets/icons/pbb.png') ?>" alt="PBB">
            <span>PBB</span>
        </div> 
        <form action="<?= base_url('pbb') ?>" method="post" class="transaction-form">
            <input type="number" name="nominal" placeholder="Masukan Nominal Pembayaran PBB">
            <button type="submit">Bayar</button>
        </form>
    </div>
</main>

<!-- Modal Konfirmasi Top Up -->
<div class="modal" id="pbb-modal">
    <div class="modal-content">
        <div id="modal-pbb-icon" class="modal-transaction-icon">
        <!-- Icon akan diisi via JS -->
        </div>
        <div id="modal-pbb-message" class="modal-transaction-message">
        <!-- Pesan akan diisi via JS -->
        </div>
        <div id="modal-pbb-nominal" class="modal-transaction-nominal">
        <!-- Nominal akan diisi via JS -->
        </div>
        <div id="modal-pbb-action" class="modal-transaction-action">
            <button id="confirm-pbb" class="btn-confirm-transaction">Ya, lanjutkan Top Up</button>
            <button id="cancel-pbb" class="btn-cancel-transaction">Batalkan</button>
        </div>
        <div id="modal-pbb-back" class="modal-transaction-back" style="display:none;">
            <a href="/" class="btn-back-transaction">Kembali ke Beranda</a>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi PBB -->
<div class="modal" id="pbb-modal">
  <div class="modal-content">
    <div id="modal-pbb-icon" class="modal-topup-icon"></div>
    <div id="modal-pbb-message" class="modal-topup-message"></div>
    <div id="modal-pbb-nominal" class="modal-topup-nominal"></div>
    <div id="modal-pbb-action" class="modal-topup-action">
      <button id="confirm-pbb" class="btn-confirm-topup">Ya, lanjutkan Bayar</button>
      <button id="cancel-pbb" class="btn-cancel-topup">Batalkan</button>
    </div>
    <div id="modal-pbb-back" class="modal-topup-back" style="display:none;">
      <a href="/" class="btn-back-topup">Kembali ke Beranda</a>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Logout -->


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('js/script.js') ?>"></script>
<?= $this->endSection() ?>
