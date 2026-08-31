<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>SCAN2FETCH | Sign In</title>
 <link rel="icon" href="<?= base_url('image/qr-code-76.png') ?>">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=fallback">
 <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">

 <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #4361ee;
            --primary-2: #7c3aed;
            --primary-dark: #3b4fd8;
            --heading: #0f172a;
            --text: #334155;
            --muted: #64748b;
            --border: #e2e8f0;
        }

        body {
            min-height: 100vh;
            font-family: 'Quicksand', 'Source Sans Pro', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f1f5f9;
            color: var(--text);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 100px 20px 40px;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, .07);
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            border-bottom: 1px solid var(--border);
        }

        .navbar-inner {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--heading);
            text-decoration: none;
        }

        .nav-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: white;
            font-size: 17px;
            box-shadow: 0 4px 12px rgba(67, 97, 238, .25);
        }

        .brand-text {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: .6px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: var(--heading);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: #fff;
            border: 1px solid #cbd5e1;
            color: var(--muted);
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: border-color .2s ease, color .2s ease;
        }

        .btn-outline:hover { border-color: var(--primary); color: var(--primary); }

        /* ===== LOGIN CARD ===== */
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 34px 34px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
        }

        .brand-section {
            text-align: center;
            margin-bottom: 24px;
        }

        .brand-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 12px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #fff;
            font-size: 26px;
            box-shadow: 0 8px 24px rgba(67,97,238,.3);
        }

        .brand-name {
            font-size: 24px;
            font-weight: 800;
            color: var(--heading);
            letter-spacing: .5px;
        }

        .brand-subtitle {
            font-size: 14px;
            color: var(--muted);
            margin-top: 4px;
        }

        /* ===== ALERTS ===== */
        .alert {
            display: flex;
            align-items: center;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            color: #b91c1c;
            font-size: 13px;
            padding: 11px 14px;
            margin-bottom: 16px;
        }

        .alert i { margin-right: 10px; font-size: 15px; }
        .alert-success {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #15803d;
        }

        /* ===== FORM ===== */
        .form-group { margin-bottom: 16px; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--heading);
            margin-bottom: 6px;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            border: 1px solid #cbd5e1;
            border-radius: 50px;
            background: #fff;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .input-wrapper:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, .12);
        }

        .input-icon {
            padding: 0 12px;
            color: var(--muted);
            font-size: 14px;
        }

        .input-field {
            width: 100%;
            padding: 11px 12px 11px 0;
            border: none;
            background: transparent;
            font-size: 14px;
            color: var(--text);
            outline: none;
            font-family: inherit;
        }

        .input-field::placeholder { color: #94a3b8; opacity: 1; }

        .toggle-password {
            padding: 0 12px;
            cursor: pointer;
            color: var(--muted);
        }

        .toggle-password:hover { color: var(--primary); }

        .btn-signin {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            border: none;
            border-radius: 50px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 6px;
            transition: box-shadow .2s ease, transform .2s ease;
        }

        .btn-signin:hover { background: linear-gradient(135deg, var(--primary-dark), #6d28d9); box-shadow: 0 8px 20px rgba(67, 97, 238, .35); }
        .btn-signin:active { background: linear-gradient(135deg, #3651e0, #6d28d9); transform: translateY(1px); }

        /* ===== DIVIDER & FEATURES ===== */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0 14px;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider-text {
            font-size: 11px;
            color: var(--muted);
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .feature-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            padding: 6px 14px;
            background: #f8fafc;
            border-radius: 6px;
            border: 1px solid var(--border);
        }

        .feature-badge .fa-shield-alt { color: #0284c7; }
        .feature-badge .fa-qrcode { color: var(--primary); }
        .feature-badge .fa-bolt { color: #d97706; }

        .footer-note {
            text-align: center;
            font-size: 13px;
            color: var(--muted);
            margin-top: 16px;
        }

        .footer-note a {
            color: var(--muted);
            text-decoration: none;
            font-weight: 600;
        }
        .footer-note a:hover { color: var(--primary); }

        @media (max-width: 480px) {
            .login-card { padding: 26px 22px; }
            .brand-name { font-size: 21px; }
            .brand-icon { width: 56px; height: 56px; font-size: 22px; }
            .btn-signin { font-size: 14px; padding: 11px; }
            .brand-text { font-size: 16px; }
            .nav-icon { width: 36px; height: 36px; font-size: 15px; }
        }
 </style>
</head>
<body>

 <!-- ===== NAVBAR ===== -->
 <nav class="navbar">
 <div class="navbar-inner">
 <a href="<?= base_url() ?>" class="navbar-left">
 <div class="nav-icon"><i class="fas fa-qrcode"></i></div>
 <div class="brand-text">SCAN2FETCH</div>
 </a>
 <a href="<?= base_url() ?>" class="btn-outline">
 <i class="fas fa-arrow-left"></i> Home
 </a>
 </div>
 </nav>

 <!-- ===== LOGIN CARD ===== -->
 <div class="login-card">
 <div class="brand-section">
 <div class="brand-icon"><i class="fas fa-qrcode"></i></div>
 <h1 class="brand-name">SCAN2FETCH</h1>
 <p class="brand-subtitle">School pick-up &amp; drop-off system</p>
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
 <label class="form-label">Phone Number</label>
 <div class="input-wrapper">
 <span class="input-icon"><i class="fas fa-phone"></i></span>
 <input type="text" name="phone" class="input-field" placeholder="0917xxxxxxx" required autofocus>
 </div>
 </div>
 <div class="form-group">
 <label class="form-label">Password</label>
 <div class="input-wrapper">
 <span class="input-icon"><i class="fas fa-lock"></i></span>
 <input type="password" name="password" class="input-field" id="password" placeholder="Enter your password" required>
 <span class="toggle-password" onclick="togglePassword()"><i class="fas fa-eye" id="toggleIcon"></i></span>
 </div>
 </div>
 <button type="submit" class="btn-signin"><i class="fas fa-sign-in-alt"></i> Sign In</button>
 </form>

 <div class="divider"><span class="divider-line"></span><span class="divider-text">Secure Access</span><span class="divider-line"></span></div>

 <div class="features">
 <span class="feature-badge"><i class="fas fa-shield-alt"></i> Safe</span>
 <span class="feature-badge"><i class="fas fa-qrcode"></i> QR Tech</span>
 <span class="feature-badge"><i class="fas fa-bolt"></i> Fast</span>
 </div>

 <div class="footer-note">&copy; <?= date('Y') ?> Scan2Fetch</div>
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