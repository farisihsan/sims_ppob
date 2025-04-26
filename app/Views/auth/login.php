<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMS PPOB - Login</title>
    <link rel="stylesheet" href="<?= base_url('css/auth.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="auth-container">
            <div class="logo-section">
                <img src="<?= base_url('assets/icons/Logo.png') ?>" alt="SIMS PPOB" class="logo">
                <h1>SIMS PPOB</h1>
            </div>
            
            <h2>Masuk atau buat akun untuk memulai</h2>
            
            <form class="auth-form" action="<?= base_url('login') ?>" method="POST">
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
                        <img src="<?= base_url('images/lock.svg') ?>" alt="Password">
                        <input type="password" name="password" placeholder="masukan password anda" required>
                        <button type="button" class="toggle-password">
                            <img src="<?= base_url('images/eye-off.svg') ?>" alt="Show Password">
                        </button>
                    </div>
                    <?php if(isset($validation) && $validation->hasError('password')): ?>
                        <p class="error-message"><?= $validation->getError('password') ?></p>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="auth-button">Masuk</button>
                
                <p class="auth-link-text">belum punya akun? registrasi <a href="<?= base_url('register') ?>" class="auth-link">di sini</a></p>
            </form>
        </div>
        
        <div class="illustration">
            <img src="<?= base_url('assets/images/illustrasi-login.png') ?>" alt="Illustration" class="illustration-image">
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('img');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                icon.src = type === 'password' 
                    ? '<?= base_url('images/eye-off.svg') ?>' 
                    : '<?= base_url('images/eye.svg') ?>';
            });
        });
    </script>
</body>
</html> 