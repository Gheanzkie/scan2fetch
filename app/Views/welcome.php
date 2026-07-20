<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCC Scan2Fetch - Home 🌈</title>
    <link rel="icon" href="<?= base_url('image/qr-code-76.png') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            font-family: 'Quicksand', 'Source Sans Pro', sans-serif;
            background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);
            position: relative;
            overflow-x: hidden;
        }

        /* Soft floating shapes */
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
            font-size: 3.5rem;
            opacity: 0.08;
            animation: floatShape 15s ease-in-out infinite;
        }

        .floating-shapes .shape:nth-child(1) { top: 10%; left: 5%; animation-delay: 0s; }
        .floating-shapes .shape:nth-child(2) { top: 20%; right: 8%; animation-delay: 2s; }
        .floating-shapes .shape:nth-child(3) { bottom: 25%; left: 8%; animation-delay: 4s; }
        .floating-shapes .shape:nth-child(4) { bottom: 15%; right: 5%; animation-delay: 1s; }
        .floating-shapes .shape:nth-child(5) { top: 50%; left: 50%; animation-delay: 3s; font-size: 5rem; opacity: 0.05; }

        @keyframes floatShape {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(8deg); }
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.04);
            padding: 12px 30px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 65px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #4a4a6a;
            text-decoration: none;
        }

        .nav-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #a8c0ff, #3f2b96);
            color: white;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(63,43,150,0.2);
        }

        .brand-text {
            font-size: 20px;
            font-weight: 700;
            background: linear-gradient(135deg, #a8c0ff, #3f2b96);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-link {
            color: #6b6b8d;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 6px 0;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #a8c0ff, #3f2b96);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after { width: 100%; }
        .nav-link:hover { color: #3f2b96; }

        .btn-login {
            background: linear-gradient(135deg, #a8c0ff, #3f2b96);
            color: #fff !important;
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(63,43,150,0.25);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(63,43,150,0.35);
        }

        /* ===== MAIN CONTENT ===== */
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
            max-width: 750px;
            width: 100%;
        }

        .hero-wrapper {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(15px);
            border-radius: 40px;
            padding: 50px 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.04);
            border: 1px solid rgba(255,255,255,0.8);
            position: relative;
        }

        .hero-wrapper::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            border-radius: 50%;
            opacity: 0.06;
        }

        .hero-wrapper::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            border-radius: 50%;
            opacity: 0.05;
        }

        .hero-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            font-size: 44px;
            margin: 0 auto 20px;
            box-shadow: 0 10px 35px rgba(245,87,108,0.25);
            animation: floatHero 4s ease-in-out infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes floatHero {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-12px) scale(1.02); }
        }

        .tagline-badge {
            display: inline-block;
            background: linear-gradient(135deg, rgba(160, 216, 255, 0.3), rgba(240, 147, 251, 0.3));
            border: 1px solid rgba(160, 216, 255, 0.3);
            color: #5a5a8a;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .main-heading {
            font-size: 42px;
            font-weight: 700;
            color: #3d3d5c;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .main-heading .highlight {
            background: linear-gradient(135deg, #a8c0ff, #3f2b96);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .main-subheading {
            font-size: 17px;
            color: #7a7a9a;
            font-weight: 400;
            max-width: 500px;
            margin: 0 auto 16px;
            line-height: 1.7;
        }

        .main-quote {
            font-style: italic;
            color: #9a9aba;
            font-size: 15px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid rgba(160, 160, 180, 0.15);
        }

        .features-row {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .feature-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: #5a5a8a;
            background: rgba(255,255,255,0.6);
            border: 1px solid rgba(160, 160, 180, 0.15);
            transition: all 0.3s ease;
        }

        .feature-pill:hover {
            transform: scale(1.05);
            border-color: #a8c0ff;
            background: rgba(168, 192, 255, 0.1);
        }

        .feature-pill .fa-shield-alt { color: #4facfe; }
        .feature-pill .fa-qrcode { color: #a8c0ff; }
        .feature-pill .fa-bolt { color: #f093fb; }
        .feature-pill .fa-smile { color: #f5576c; }

        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-top: 25px;
            padding: 14px 40px;
            background: linear-gradient(135deg, #a8c0ff, #3f2b96);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 6px 25px rgba(63,43,150,0.25);
        }

        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 35px rgba(63,43,150,0.35);
        }

        .footer-text {
            margin-top: 40px;
            color: #b0b0c8;
            font-size: 13px;
        }

        .footer-text .heart { color: #f5576c; }

        @media (max-width: 768px) {
            .navbar { padding: 10px 20px; }
            .brand-text { font-size: 17px; }
            .main-heading { font-size: 30px; }
            .hero-wrapper { padding: 35px 25px; }
            .hero-icon { width: 80px; height: 80px; font-size: 34px; }
        }

        @media (max-width: 480px) {
            .navbar { padding: 8px 16px; }
            .brand-text { font-size: 15px; }
            .nav-icon { width: 32px; height: 32px; font-size: 14px; }
            .btn-login { padding: 6px 16px; font-size: 12px; }
            .main-heading { font-size: 24px; }
            .hero-wrapper { padding: 25px 18px; border-radius: 25px; }
            .hero-icon { width: 65px; height: 65px; font-size: 28px; }
            .features-row { gap: 8px; }
            .feature-pill { font-size: 11px; padding: 4px 12px; }
            .btn-cta { padding: 10px 24px; font-size: 14px; }
            .floating-shapes .shape { display: none; }
        }
    </style>
</head>
<body>

    <div class="floating-shapes">
        <div class="shape">🌈</div>
        <div class="shape">⭐</div>
        <div class="shape">🎈</div>
        <div class="shape">🌸</div>
        <div class="shape">☁️</div>
    </div>

    <!-- ===== NAVIGATION ===== -->
    <nav class="navbar">
        <a href="<?= base_url() ?>" class="navbar-left">
            <div class="nav-icon"><i class="fas fa-child"></i></div>
            <div class="brand-text">SCAN2FETCH</div>
        </a>
        <div class="navbar-right">
            <a href="<?= base_url() ?>" class="nav-link">🏠 Home</a>
            <a href="<?= base_url('login') ?>" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="main-content">
        <div class="welcome-container">
            <div class="hero-wrapper">
                <div class="hero-icon"><i class="fas fa-child"></i></div>
                <div class="tagline-badge">🛡️ Safe • Smart • Simple</div>
                <h1 class="main-heading">
                    Every Child's Safety<br>
                    <span class="highlight">In Your Hands</span> 🌟
                </h1>
                <p class="main-subheading">
                    A smart student release and pickup system ensuring only authorized guardians can fetch your child from school.
                </p>
                <p class="main-quote">Because peace of mind starts with knowing your child is safe.</p>
                <div class="features-row">
                    <span class="feature-pill"><i class="fas fa-shield-alt"></i> Secure</span>
                    <span class="feature-pill"><i class="fas fa-qrcode"></i> QR Tech</span>
                    <span class="feature-pill"><i class="fas fa-bolt"></i> Real-time</span>
                    <span class="feature-pill"><i class="fas fa-smile"></i> Easy</span>
                </div>
                <a href="<?= base_url('login') ?>" class="btn-cta"><i class="fas fa-rocket"></i> Get Started</a>
            </div>
            <p class="footer-text">🛡️ &copy; <?= date('Y') ?> BCC Scan2Fetch • Made with <span class="heart">❤️</span> for kids</p>
        </div>
    </div>

</body>
</html>