<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'SIMS PPOB' ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="logo-section">
                <img src="/assets/icons/Logo.png" alt="SIMS PPOB">
                <a href="/">
                    <span style="font-weight:600;font-size:18px;">SIMS PPOB</span>
                </a>
            </div>
            <?php
                $currentPath = service('uri')->getPath();
            ?>
            <nav>
                <a href="/topup" class="<?= $currentPath == 'topup' ? 'active-nav' : '' ?>">Top Up</a>
                <a href="/transaction" class="<?= $currentPath == 'transaction' ? 'active-nav' : '' ?>">Transaction</a>
                <a href="/profile" class="<?= $currentPath == 'profile' ? 'active-nav' : '' ?>">Akun</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <?= $this->renderSection('content') ?>

    <?= $this->renderSection('script') ?>
</body>
</html>
