<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<main class="main-container">
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

    <!-- Service Grid -->
    <div class="services-grid">
        <a href="/pbb" class="service-item">
            <img src="/assets/icons/pbb.png" alt="PBB">
            <span>PBB</span>
        </a>
        <a href="/listrik" class="service-item">
            <img src="/assets/icons/listrik.png" alt="Listrik">
            <span>Listrik</span>
        </a>
        <a href="/pulsa" class="service-item">
            <img src="/assets/icons/pulsa.png" alt="Pulsa">
            <span>Pulsa</span>
        </a>
        <a href="/pdam" class="service-item">
            <img src="/assets/icons/pdam.png" alt="PDAM">
            <span>PDAM</span>
        </a>
        <a href="/pgn" class="service-item">
            <img src="/assets/icons/pgn.png" alt="PGN">
            <span>PGN</span>
        </a>
        <a href="/tv-langganan" class="service-item">
            <img src="/assets/icons/Televisi.png" alt="TV Langganan">
            <span>TV Langganan</span>
        </a>
        <a href="/musik" class="service-item">
            <img src="/assets/icons/Musik.png" alt="Musik">
            <span>Musik</span>
        </a>
        <a href="/voucher-game" class="service-item">
            <img src="/assets/icons/Game.png" alt="Voucher Game">
            <span>Voucher Game</span>
        </a>
        <a href="/voucher-makanan" class="service-item">
            <img src="/assets/icons/Voucher%20Makanan.png" alt="Voucher Makanan">
            <span>Voucher Makanan</span>
        </a>
        <a href="/kurban" class="service-item">
            <img src="/assets/icons/Kurban.png" alt="Kurban">
            <span>Kurban</span>
        </a>
        <a href="/zakat" class="service-item">
            <img src="/assets/icons/Zakat.png" alt="Zakat">
            <span>Zakat</span>
        </a>
        <a href="/paket-data" class="service-item">
            <img src="/assets/icons/Paket%20Data.png" alt="Paket Data">
            <span>Paket Data</span>
        </a>
    </div>

    <!-- Promo Section -->
    <div class="promo-section">
        <h3>Temukan promo menarik</h3>
        <div class="promo-slider-container">
            <div class="promo-slider" id="promo-slider">
                <div class="promo-card">
                    <img src="/assets/banner/Banner%201.png" alt="Saldo Gratis">
                </div>
                <div class="promo-card">
                    <img src="/assets/banner/Banner%202.png" alt="Diskon Listrik">
                </div>
                <div class="promo-card">
                    <img src="/assets/banner/Banner%203.png" alt="Promo Makan">
                </div>
                <div class="promo-card">
                    <img src="/assets/banner/Banner%204.png" alt="Cashback 25%">
                </div>
                <div class="promo-card">
                    <img src="/assets/banner/Banner%205.png" alt="Buy 1 Get 2">
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('js/script.js') ?>"></script>
<?= $this->endSection() ?> 