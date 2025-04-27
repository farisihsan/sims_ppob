<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('css/transaction-history.css') ?>">
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
        </div>
    </div>
    <div class="transaction-history-container">
        <div class="transaction-history-header">
            <h2>Semua Transaksi</h2>
        </div>
        <div class="transaction-history-card">
            <?php 
            // Set timezone ke Asia/Jakarta
            if(function_exists('date_default_timezone_set')) {
                date_default_timezone_set('Asia/Jakarta');
            }
            usort($transaction, function($a, $b) {
                return strtotime($b['created_on']) - strtotime($a['created_on']); 
            });
            $latestTransactions = array_slice($transaction, 0, 5); 
            foreach ($latestTransactions as $t) : ?>
                <div class="transaction-card">
                    <div class="card-header">
                        <div class="service-name"><?= $t['service_name'] ?></div>
                        <div class="transaction-date">
                            <?= date('d M Y H:i', strtotime($t['created_on'])) ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="amount-container">
                            <span class="transaction-amount <?= $t['transaction_type'] === 'TOPUP' ? 'amount-plus' : 'amount-minus' ?>">
                                <?= $t['transaction_type'] === 'TOPUP' ? '+ ' : '- ' ?>
                                Rp<?= number_format($t['total_amount'], 0, ',', '.') ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
    </div>
</main>



<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('js/script.js') ?>"></script>
<?= $this->endSection() ?>
