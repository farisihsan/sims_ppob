<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMS PPOB - Registrasi</title>
    <link rel="stylesheet" href="<?= base_url('css/auth.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="auth-container">
            <div class="logo-section">
                <img src="/assets/icons/Logo.png" alt="SIMS PPOB" class="logo">
                <h1>SIMS PPOB</h1>
            </div>
            
            <h2>Lengkapi data untuk membuat akun</h2>
            
            <form class="auth-form" action="<?= base_url('api/registration') ?>" method="POST">
                <div class="input-group">
                    <div class="input-icon">
                        <img src="<?= base_url('images/mail.svg') ?>" alt="Email">
                        <input type="email" name="email" placeholder="masukan email anda" required>
                    </div>
                    <?php if(isset($validation) && $validation->hasError('email')): ?>
                        <p class="error-message"><?= $validation->getError('email') ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="input-group">
                    <div class="input-icon">
                        <img src="<?= base_url('images/person.svg') ?>" alt="Nama Depan">
                        <input type="text" name="first_name" placeholder="nama depan" required>
                    </div>
                    <?php if(isset($validation) && $validation->hasError('first_name')): ?>
                        <p class="error-message"><?= $validation->getError('first_name') ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="input-group">
                    <div class="input-icon">
                        <img src="<?= base_url('images/person.svg') ?>" alt="Nama Belakang">
                        <input type="text" name="last_name" placeholder="nama belakang" required>
                    </div>
                    <?php if(isset($validation) && $validation->hasError('last_name')): ?>
                        <p class="error-message"><?= $validation->getError('last_name') ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="input-group">
                    <div class="input-icon">
                        <img src="<?= base_url('images/lock.svg') ?>" alt="Password">
                        <input type="password" name="password" placeholder="buat password" required>
                        <button type="button" class="toggle-password">
                            <img src="<?= base_url('images/eye-off.svg') ?>" alt="Show Password">
                        </button>
                    </div>
                    <?php if(isset($validation) && $validation->hasError('password')): ?>
                        <p class="error-message"><?= $validation->getError('password') ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="input-group">
                    <div class="input-icon">
                        <img src="<?= base_url('images/lock.svg') ?>" alt="Konfirmasi Password">
                        <input type="password" name="confirm_password" placeholder="konfirmasi password" required>
                        <button type="button" class="toggle-password">
                            <img src="<?= base_url('images/eye-off.svg') ?>" alt="Show Password">
                        </button>
                    </div>
                    <?php if(isset($validation) && $validation->hasError('confirm_password')): ?>
                        <p class="error-message"><?= $validation->getError('confirm_password') ?></p>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="auth-button">Registrasi</button>
                
                <p class="auth-link-text">sudah punya akun? login <a href="<?= base_url('login') ?>" class="auth-link">di sini</a></p>
            </form>
        </div>
        
        <div class="illustration">
            <img src="<?= base_url('assets/images/illustrasi-login.png') ?>" alt="Illustration" class="illustration-image">
        </div>
    </div>
</body>
</html> 