<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BCC Scan2Fetch | Sign In</title>
    <link rel="icon" href="<?= base_url('public/assets/dist/img/favicon.ico') ?>">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/dist/css/adminlte.min.css') ?>">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Source Sans Pro', sans-serif;
            height: 100vh; display: flex; background: #ffffff;
        }
        
        .login-side {
            width: 45%; max-width: 520px;
            display: flex; align-items: center; justify-content: center;
            padding: 40px; background: #ffffff;
        }
        
        .login-container { width: 100%; max-width: 400px; }
        
        .brand-section { margin-bottom: 40px; text-align: center; }
        
        .brand-icon {
            font-size: 50px; margin-bottom: 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        
        .brand-name {
            font-size: 28px; font-weight: 600; color: #1a202c;
            margin-bottom: 6px; letter-spacing: -0.5px;
        }
        
        .brand-name span { color: #667eea; }
        
        .brand-subtitle { font-size: 15px; color: #64748b; font-weight: 400; }
        
        .alert {
            background: #fef2f2; border: 1px solid #fecaca;
            border-radius: 10px; color: #991b1b; font-size: 14px;
            padding: 14px 16px; margin-bottom: 24px;
            display: flex; align-items: center;
        }
        
        .alert i { margin-right: 12px; font-size: 16px; }
        
        .alert-success {
            background: #f0fdf4; border-color: #bbf7d0; color: #166534;
        }
        
        .form-group { margin-bottom: 20px; }
        
        .form-label {
            display: block; font-size: 14px; font-weight: 500;
            color: #334155; margin-bottom: 8px;
        }
        
        .input-wrapper {
            display: flex; align-items: center;
            border: 1.5px solid #e2e8f0; border-radius: 12px;
            background: #ffffff; transition: all 0.2s ease;
        }
        
        .input-wrapper:focus-within {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .input-icon { padding: 0 16px; color: #94a3b8; font-size: 16px; }
        
        .input-field {
            width: 100%; padding: 15px 16px 15px 0;
            border: none; background: transparent;
            font-size: 15px; color: #1e293b; outline: none;
        }
        
        .input-field::placeholder { color: #94a3b8; font-weight: 400; }
        
        .btn-signin {
            width: 100%; padding: 15px 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none; border-radius: 12px; color: white;
            font-size: 15px; font-weight: 600; cursor: pointer;
            transition: all 0.2s ease;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            margin-bottom: 24px;
        }
        
        .btn-signin:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }
        
        .btn-signin:active { transform: translateY(0); box-shadow: none; }
        
        .footer-note { text-align: center; font-size: 13px; color: #94a3b8; }
        
        .footer-note a { color: #64748b; text-decoration: none; font-weight: 500; }
        
        .footer-note a:hover { color: #1e293b; }
        
        .image-side {
            flex: 1;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            position: relative; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
        }
        
        .overlay-content {
            text-align: center; color: white; padding: 60px; z-index: 10;
        }
        
        .overlay-icon {
            font-size: 100px; margin-bottom: 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        .overlay-title {
            font-size: 36px; font-weight: 700; margin-bottom: 16px;
            line-height: 1.2; text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        
        .overlay-title span { color: #667eea; }
        
        .overlay-text {
            font-size: 16px; opacity: 0.9; line-height: 1.6;
            max-width: 450px; text-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
        }
        
        .system-badge {
            position: absolute; top: 40px; right: 40px;
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);
            padding: 12px 20px; border-radius: 40px; color: white;
            font-weight: 500; font-size: 14px;
            border: 1px solid rgba(255, 255, 255, 0.2); z-index: 10;
        }
        
        .system-badge i { margin-right: 8px; color: #667eea; }
        
        @media (max-width: 900px) {
            .image-side { display: none; }
            .login-side { width: 100%; max-width: 100%; padding: 24px; }
        }
        
        @media (max-width: 480px) {
            .login-side { padding: 20px; }
            .brand-name { font-size: 24px; }
            .overlay-title { font-size: 28px; }
        }
    </style>
</head>
<body>

<!-- LEFT SIDE - LOGIN FORM -->
<div class="login-side">
    <div class="login-container">
        
        <!-- Brand -->
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-qrcode"></i></div>
            <h1 class="brand-name">BCC <span>SCAN2FETCH</span></h1>
            <p class="brand-subtitle">Sign in to your account</p>
        </div>

        <!-- Error Alert -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert">
                <i class="fas fa-exclamation-circle"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <!-- Success Alert -->
        <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-mobile-alt"></i></span>
                    <input type="text" name="phone" class="input-field" placeholder="0917xxxxxxx" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="input-field" placeholder="Enter your password" required>
                </div>
            </div>

            <button type="submit" class="btn-signin">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
        </form>

        <!-- Footer -->
        <div class="footer-note">
            &copy; <?= date('Y') ?> BCC Scan2Fetch. <a href="<?= base_url() ?>">Back to Home</a>
        </div>

    </div>
</div>

<!-- RIGHT SIDE -->
<div class="image-side">
    
    <div class="system-badge">
        <i class="fas fa-qrcode"></i> BCC SCAN2FETCH
    </div>
    
    <div class="overlay-content">
        <div class="overlay-icon"><i class="fas fa-child"></i></div>
        <h2 class="overlay-title">Every Child's Safety<br><span>In Your Hands</span></h2>
        <p class="overlay-text">
            A smart student release and pickup system ensuring only authorized guardians can fetch your child from school.
        </p>
    </div>
</div>

<script src="<?= base_url('public/assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>