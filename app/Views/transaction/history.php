<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('css/transaction-history.css') ?>">
<main class="transaction-main">
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
    <div class="transaction-history-container">
        <div class="transaction-history-header">
            <h2>Semua Transaksi</h2>
        </div>
        <div class="bulan-filter">
            <?php
            $bulanList = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
            foreach ($bulanList as $num => $nama) {
                $active = ($bulan == $num) ? 'active' : '';
                echo "<a href=\"?bulan=$num&tahun=$tahun\" class=\"$active\">$nama</a> ";
            }
            ?>
        </div>
        <div class="transaction-history-card" id="transaction-list">
            <?php 
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
                        <div class="amount-container">
                            <span class="transaction-amount <?= $t['transaction_type'] === 'TOPUP' ? 'amount-plus' : 'amount-minus' ?>">
                                <?= $t['transaction_type'] === 'TOPUP' ? '+ ' : '- ' ?>
                                Rp<?= number_format($t['total_amount'], 0, ',', '.') ?>
                            </span>
                        </div>
                        <div class="service-name"><?= $t['service_name'] ?></div>
                    </div>
                    <div class="card-body">
                        <div class="transaction-date">
                            <?= date('d M Y H:i', strtotime($t['created_on'])) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (count($transaction) > 5) : ?> 
            <button type="button" class="show-more-btn" id="show-more-btn" data-offset="5" data-limit="5">
                <span>Show More</span>
            </button>
        <?php endif; ?>
        <?php if (count($transaction) <= 5) : ?>
            
        <?php endif; ?>
        <?php if (count($transaction) == 0) : ?>
            <div class="history-card">
                <div class="history-header">
                    <h2>Tidak ada transaksi</h2>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>



<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('js/script.js') ?>"></script>
<?= $this->endSection() ?>
