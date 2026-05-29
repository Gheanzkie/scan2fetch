<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCC Scan2Fetch - Home</title>
    <link rel="icon" href="<?= base_url('public/assets/dist/img/favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/dist/css/adminlte.min.css') ?>">
    
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #5a6fd6;
            --secondary: #764ba2;
            --bg-dark: #1a1a2e;
            --bg-mid: #16213e;
            --bg-light: #0f3460;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-mid) 50%, var(--bg-light) 100%);
            min-height: 100vh;
            font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(102,126,234,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(118,75,162,0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .navbar {
            background: rgba(26, 26, 46, 0.95);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(102, 126, 234, 0.3);
            padding: 12px 30px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            text-decoration: none;
        }

        .navbar-left i {
            font-size: 26px;
            color: var(--primary);
        }

        .navbar-left .brand-text {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.5px;
        }

        .navbar-left .brand-text span {
            color: var(--primary);
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-link {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
            padding: 6px 0;
        }

        .nav-link:hover {
            color: #fff;
        }

        .btn-login {
            background: var(--primary);
            color: #fff !important;
            padding: 8px 22px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }

        .main-content {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 30px 50px;
        }

        .welcome-container {
            text-align: center;
            max-width: 700px;
            width: 100%;
        }

        .hero-logo {
            font-size: 80px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .tagline-badge {
            display: inline-block;
            background: rgba(102,126,234,0.2);
            border: 1px solid rgba(102,126,234,0.3);
            color: #a5b4fc;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        .main-heading {
            font-size: 56px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .main-heading span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .main-subheading {
            font-size: 18px;
            color: rgba(255,255,255,0.7);
            font-weight: 300;
            max-width: 500px;
            margin: 0 auto 12px;
            line-height: 1.6;
        }

        .main-quote {
            font-style: italic;
            color: rgba(255,255,255,0.5);
            font-size: 16px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .footer-text {
            margin-top: 60px;
            color: rgba(255,255,255,0.4);
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .hero-logo { font-size: 60px; }
            .main-heading { font-size: 34px; }
            .navbar { padding: 10px 15px; }
            .navbar-right { gap: 12px; }
            .btn-login { padding: 6px 16px; font-size: 12px; }
            .brand-text { font-size: 16px; }
        }

        @media (max-width: 480px) {
            .hero-logo { font-size: 50px; }
            .main-heading { font-size: 26px; }
            .main-content { padding: 80px 16px 30px; }
            .navbar-right { gap: 8px; }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="<?= base_url() ?>" class="navbar-left">
            <i class="fas fa-qrcode"></i>
            <div class="brand-text">BCC<span> SCAN2FETCH</span></div>
        </a>
        <div class="navbar-right">
            <a href="<?= base_url() ?>" class="nav-link">Home</a>
            <a href="<?= base_url('login') ?>" class="btn-login">Login</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="welcome-container">
            
            <div class="hero-logo">
                <i class="fas fa-qrcode"></i>
            </div>
            
            <div class="tagline-section">
                <div class="tagline-badge">Secure • Reliable • Fast</div>
                <h1 class="main-heading">
                    Every Child's Safety<br>
                    <span>In Your Hands</span>
                </h1>
                <p class="main-subheading">
                    A smart student release and pickup system ensuring only authorized guardians can fetch your child from school.
                </p>
                <p class="main-quote">
                    "Because peace of mind starts with knowing your child is safe."
                </p>
            </div>

            <p class="footer-text">&copy; <?= date('Y') ?> BCC Scan2Fetch. All Rights Reserved.</p>

        </div>
    </div>

    <script src="<?= base_url('public/assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/dist/js/adminlte.min.js') ?>"></script>

</body>
</html>