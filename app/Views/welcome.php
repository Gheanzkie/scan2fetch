<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCAN2FETCH | Home</title>
    <link rel="icon" href="<?= base_url('image/qr-code-76.png') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --blue: #4361ee;
            --purple: #3b4fd8;
            --pink: #e11d48;
            --rose: #dc2626;
            --teal: #0284c7;
            --green: #16a34a;
            --orange: #d97706;
            --ink: #0f172a;
            --muted: #64748b;
            --faint: #94a3b8;
        }

        body {
            min-height: 100vh;
            font-family: 'Quicksand', 'Source Sans Pro', sans-serif;
            background: #f1f5f9;
            background-attachment: fixed;
            color: var(--ink);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.04);
            padding: 12px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--ink);
            text-decoration: none;
        }

        .nav-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--blue), var(--purple));
            color: white;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(63,43,150,0.2);
        }

        .brand-text {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, var(--blue), var(--purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--blue), var(--purple));
            color: #fff;
            padding: 10px 26px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: box-shadow 0.3s ease;
            box-shadow: 0 4px 15px rgba(63,43,150,0.25);
        }

        .btn-login:hover { box-shadow: 0 8px 25px rgba(63,43,150,0.35); }

        /* ===== HERO ===== */
        .main-content {
            padding: 130px 0 60px;
            position: relative;
            z-index: 1;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 48px;
            align-items: center;
        }

        .tagline-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            color: #3730a3;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .main-heading {
            font-size: 44px;
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 16px;
            color: var(--ink);
        }

        .main-heading .highlight {
            background: linear-gradient(135deg, var(--blue), var(--purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .main-subheading {
            font-size: 16px;
            color: var(--muted);
            max-width: 480px;
            margin-bottom: 28px;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--blue), var(--purple));
            color: #fff;
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: box-shadow 0.3s ease;
            box-shadow: 0 6px 25px rgba(63,43,150,0.25);
        }

        .btn-cta:hover { box-shadow: 0 10px 35px rgba(63,43,150,0.35); }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: rgba(255,255,255,0.6);
            border: 2px solid rgba(160,160,180,0.15);
            color: var(--muted);
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: border-color 0.3s ease, color 0.3s ease;
        }

        .btn-outline:hover { border-color: var(--blue); color: var(--purple); }

        .features-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .feature-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: #5a5a8a;
            background: rgba(255,255,255,0.6);
            border: 1px solid rgba(160,160,180,0.15);
        }

        .feature-pill .fa-shield-alt { color: var(--teal); }
        .feature-pill .fa-qrcode { color: var(--purple); }
        .feature-pill .fa-bolt { color: var(--pink); }
        .feature-pill .fa-smile { color: var(--rose); }

        /* ===== HERO ILLUSTRATION ===== */
        .hero-visual {
            position: relative;
        }

        .visual-card {
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.9);
            border-radius: 28px;
            padding: 34px 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.06);
            text-align: center;
        }

        .visual-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 4px;
        }

        .visual-sub {
            font-size: 12px;
            color: var(--faint);
            margin-bottom: 22px;
        }

        .qr-mock {
            width: 150px;
            height: 150px;
            margin: 0 auto 22px;
            border-radius: 18px;
            border: 2px solid rgba(63,43,150,0.1);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--purple);
            font-size: 4.5rem;
        }

        .visual-status {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--green);
            padding: 10px 18px;
            border-radius: 50px;
            background: rgba(129,199,132,0.12);
        }

        .visual-float {
            position: absolute;
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.95);
            border: 1px solid rgba(255,255,255,0.9);
            border-radius: 16px;
            padding: 10px 16px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.08);
            font-size: 12px;
            font-weight: 600;
            color: var(--ink);
        }

        .visual-float.top {
            top: -16px;
            right: -10px;
        }

        .visual-float.bottom {
            bottom: -16px;
            left: -10px;
        }

        .visual-float .fa-bell { color: var(--orange); }
        .visual-float .fa-sms { color: var(--teal); }

        /* ===== HOW IT WORKS ===== */
        .steps-section {
            padding: 70px 0 40px;
        }

        .section-head {
            text-align: center;
            max-width: 560px;
            margin: 0 auto 40px;
        }

        .section-head h2 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .section-head p {
            font-size: 15px;
            color: var(--muted);
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .step-card {
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.9);
            border-radius: 22px;
            padding: 28px 22px;
            text-align: center;
            box-shadow: 0 10px 35px rgba(0,0,0,0.04);
            transition: box-shadow 0.3s ease;
        }

        .step-card:hover { box-shadow: 0 16px 45px rgba(0,0,0,0.08); }

        .step-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 16px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
        }

        .step-icon.c1 { background: linear-gradient(135deg, var(--blue), var(--purple)); }
        .step-icon.c2 { background: linear-gradient(135deg, var(--teal), var(--green)); }
        .step-icon.c3 { background: linear-gradient(135deg, var(--pink), var(--rose)); }
        .step-icon.c4 { background: linear-gradient(135deg, var(--orange), #f57c00); }

        .step-card h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--ink);
        }

        .step-card p {
            font-size: 13px;
            color: var(--muted);
        }

        /* ===== FOOTER ===== */
        .footer-text {
            margin-top: 60px;
            padding: 24px 0;
            text-align: center;
            color: var(--faint);
            font-size: 13px;
            border-top: 1px solid rgba(160,160,180,0.15);
        }

        .footer-text .heart { color: var(--rose); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .hero {
                grid-template-columns: 1fr;
                gap: 56px;
                text-align: center;
            }
            .main-subheading { margin-left: auto; margin-right: auto; }
            .hero-actions { justify-content: center; }
            .features-row { justify-content: center; }
            .visual-float { display: none; }
            .steps-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 480px) {
            .main-heading { font-size: 30px; }
            .section-head h2 { font-size: 24px; }
            .steps-grid { grid-template-columns: 1fr; }
            .brand-text { font-size: 17px; }
            .nav-icon { width: 36px; height: 36px; font-size: 15px; }
            .btn-login { padding: 8px 18px; font-size: 13px; }
            .main-content { padding: 110px 0 40px; }
        }
    </style>
</head>
<body>

    <!-- ===== NAVIGATION ===== -->
    <nav class="navbar">
        <div class="container navbar-inner">
            <a href="<?= base_url() ?>" class="navbar-left">
                <div class="nav-icon"><i class="fas fa-child"></i></div>
                <div class="brand-text">SCAN2FETCH</div>
            </a>
            <a href="<?= base_url('login') ?>" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <div class="main-content">
        <div class="container">

            <div class="hero">
                <div>
                    <div class="tagline-badge"><i class="fas fa-shield-alt"></i> Safe • Smart • Simple</div>
                    <h1 class="main-heading">
                        Every Child's Safety<br>
                        <span class="highlight">In Your Hands</span>
                    </h1>
                    <p class="main-subheading">
                        A smart student release and pickup system ensuring only authorized
                        guardians can fetch your child from school.
                    </p>

                    <div class="hero-actions">
                        <a href="<?= base_url('login') ?>" class="btn-cta">
                            <i class="fas fa-rocket"></i> Get Started
                        </a>
                        <a href="#how-it-works" class="btn-outline">
                            <i class="fas fa-info-circle"></i> How it works
                        </a>
                    </div>

                    <div class="features-row">
                        <span class="feature-pill"><i class="fas fa-shield-alt"></i> Secure</span>
                        <span class="feature-pill"><i class="fas fa-qrcode"></i> QR Tech</span>
                        <span class="feature-pill"><i class="fas fa-bolt"></i> Real-time</span>
                        <span class="feature-pill"><i class="fas fa-smile"></i> Easy</span>
                    </div>
                </div>

                <div class="hero-visual">
                    <div class="visual-card">
                        <div class="visual-title">Parent QR Pass</div>
                        <div class="visual-sub">Scan to release your child</div>
                        <div class="qr-mock"><i class="fas fa-qrcode"></i></div>
                        <div class="visual-status">
                            <i class="fas fa-check-circle"></i> Verified • Ready to fetch
                        </div>
                    </div>
                    <div class="visual-float top">
                        <i class="fas fa-bell"></i> Pickup Notification
                    </div>
                    <div class="visual-float bottom">
                        <i class="fas fa-sms"></i> SMS Alert Sent
                    </div>
                </div>
            </div>

            <!-- ===== HOW IT WORKS ===== -->
            <div class="steps-section" id="how-it-works">
                <div class="section-head">
                    <h2>How Scan2Fetch Works</h2>
                    <p>A simple and safe process from registration to pickup.</p>
                </div>
                <div class="steps-grid">
                    <div class="step-card">
                        <div class="step-icon c1"><i class="fas fa-user-plus"></i></div>
                        <h3>Register</h3>
                        <p>School registers the student and their parents or guardians.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-icon c2"><i class="fas fa-id-card"></i></div>
                        <h3>Get QR Pass</h3>
                        <p>Each guardian receives a unique QR code and account password.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-icon c3"><i class="fas fa-qrcode"></i></div>
                        <h3>Scan at Pickup</h3>
                        <p>Guardians tap their QR code; the school verifies identity instantly.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-icon c4"><i class="fas fa-child"></i></div>
                        <h3>Safe Release</h3>
                        <p>The child is released and parents are notified via SMS.</p>
                    </div>
                </div>
            </div>

            <p class="footer-text">&copy; <?= date('Y') ?> BCC Scan2Fetch • All rights reserved</p>
        </div>
    </div>

</body>
</html>