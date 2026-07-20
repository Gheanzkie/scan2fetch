<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BCC Scan2Fetch | Sign In 🌈</title>
    <link rel="icon" href="<?= base_url('image/qr-code-76.png') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Quicksand', 'Source Sans Pro', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);
            padding: 20px;
            position: relative;
        }

        .floating-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }

        .floating-shapes .shape {
            position: absolute;
            font-size: 3rem;
            opacity: 0.06;
            animation: floatShape 15s ease-in-out infinite;
        }

        .floating-shapes .shape:nth-child(1) { top: 10%; left: 5%; animation-delay: 0s; }
        .floating-shapes .shape:nth-child(2) { top: 20%; right: 8%; animation-delay: 2s; }
        .floating-shapes .shape:nth-child(3) { bottom: 25%; left: 8%; animation-delay: 4s; }
        .floating-shapes .shape:nth-child(4) { bottom: 15%; right: 5%; animation-delay: 1s; }

        @keyframes floatShape {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(8deg); }
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 40px 36px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.04);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255,255,255,0.8);
        }

        .login-wrapper::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 180px;
            height: 180px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            border-radius: 50%;
            opacity: 0.05;
        }

        .login-wrapper::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 220px;
            height: 220px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            border-radius: 50%;
            opacity: 0.04;
        }

        .brand-section {
            text-align: center;
            margin-bottom: 32px;
            position: relative;
            z-index: 1;
        }

        .brand-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            font-size: 34px;
            margin: 0 auto 12px;
            box-shadow: 0 8px 25px rgba(245,87,108,0.2);
            animation: floatIcon 3s ease-in-out infinite;
        }

        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .brand-name {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #a8c0ff, #3f2b96);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-subtitle {
            font-size: 15px;
            color: #8a8aaa;
            font-weight: 400;
            margin-top: 4px;
        }

        .alert {
            background: rgba(254, 226, 226, 0.4);
            border: 1px solid rgba(254, 202, 202, 0.3);
            border-radius: 15px;
            color: #991b1b;
            font-size: 14px;
            padding: 12px 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .alert i { margin-right: 10px; font-size: 16px; }
        .alert-success {
            background: rgba(220, 252, 231, 0.4);
            border-color: rgba(187, 247, 208, 0.3);
            color: #166534;
        }

        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #5a5a7a;
            margin-bottom: 6px;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            border: 2px solid rgba(160,160,180,0.15);
            border-radius: 15px;
            background: rgba(255,255,255,0.5);
            transition: all 0.3s ease;
        }

        .input-wrapper:focus-within {
            border-color: #a8c0ff;
            background: rgba(255,255,255,0.8);
            box-shadow: 0 0 0 4px rgba(168,192,255,0.15);
        }

        .input-icon {
            padding: 0 14px;
            color: #9a9aba;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .input-wrapper:focus-within .input-icon { color: #3f2b96; }

        .input-field {
            width: 100%;
            padding: 14px 14px 14px 0;
            border: none;
            background: transparent;
            font-size: 15px;
            color: #3d3d5c;
            outline: none;
            font-family: 'Quicksand', sans-serif;
        }

        .input-field::placeholder { color: #b0b0c8; font-weight: 400; }

        .toggle-password {
            padding: 0 14px;
            cursor: pointer;
            color: #b0b0c8;
            transition: all 0.3s ease;
        }

        .toggle-password:hover { color: #3f2b96; }

        .btn-signin {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #a8c0ff, #3f2b96);
            border: none;
            border-radius: 15px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Quicksand', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 4px;
            box-shadow: 0 4px 20px rgba(63,43,150,0.2);
        }

        .btn-signin:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(63,43,150,0.3);
        }
        .btn-signin:active { transform: translateY(0); }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0 16px;
        }

        .divider-line {
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, #a8c0ff, #f093fb, #f5576c);
            border-radius: 2px;
        }

        .divider-text {
            font-size: 12px;
            color: #b0b0c8;
            font-weight: 600;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .feature-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: #7a7a9a;
            padding: 6px 14px;
            background: rgba(255,255,255,0.5);
            border-radius: 50px;
            border: 1px solid rgba(160,160,180,0.1);
        }

        .feature-badge .fa-shield-alt { color: #4facfe; }
        .feature-badge .fa-qrcode { color: #a8c0ff; }
        .feature-badge .fa-bolt { color: #f093fb; }

        .footer-note {
            text-align: center;
            font-size: 13px;
            color: #b0b0c8;
            margin-top: 16px;
        }

        .footer-note a {
            color: #6b6b8d;
            text-decoration: none;
            font-weight: 600;
        }
        .footer-note a:hover { color: #3f2b96; }

        @media (max-width: 480px) {
            .login-wrapper { padding: 28px 20px; border-radius: 20px; }
            .brand-name { font-size: 24px; }
            .brand-icon { width: 65px; height: 65px; font-size: 28px; }
            .btn-signin { font-size: 15px; padding: 14px; }
            .floating-shapes .shape { display: none; }
        }
    </style>
</head>
<body>

    <div class="floating-shapes">
        <div class="shape">🌈</div>
        <div class="shape">⭐</div>
        <div class="shape">🌸</div>
        <div class="shape">☁️</div>
    </div>

    <div class="login-wrapper">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-child"></i></div>
            <h1 class="brand-name">SCAN2FETCH</h1>
            <p class="brand-subtitle">🌈 Welcome back! Let's keep kids safe 🌟</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert"><i class="fas fa-exclamation-circle"></i><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label class="form-label">📱 Phone Number</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-phone"></i></span>
                    <input type="text" name="phone" class="input-field" placeholder="0917xxxxxxx" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">🔒 Password</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="input-field" id="password" placeholder="Enter your password" required>
                    <span class="toggle-password" onclick="togglePassword()"><i class="fas fa-eye" id="toggleIcon"></i></span>
                </div>
            </div>
            <button type="submit" class="btn-signin"><i class="fas fa-sign-in-alt"></i> Let's Go! 🚀</button>
        </form>

        <div class="divider"><span class="divider-line"></span><span class="divider-text">✦ SAFE & FUN ✦</span><span class="divider-line"></span></div>

        <div class="features">
            <span class="feature-badge"><i class="fas fa-shield-alt"></i> Safe</span>
            <span class="feature-badge"><i class="fas fa-qrcode"></i> QR Tech</span>
            <span class="feature-badge"><i class="fas fa-bolt"></i> Fast</span>
        </div>

        <div class="footer-note">🛡️ &copy; <?= date('Y') ?> BCC Scan2Fetch • <a href="<?= base_url() ?>">🏠 Back to Home</a></div>
    </div>

    <script>
    function togglePassword() {
        var p = document.getElementById('password');
        var i = document.getElementById('toggleIcon');
        if (p.type === 'password') { p.type = 'text'; i.classList.remove('fa-eye'); i.classList.add('fa-eye-slash'); }
        else { p.type = 'password'; i.classList.remove('fa-eye-slash'); i.classList.add('fa-eye'); }
    }
    </script>
</body>
</html>