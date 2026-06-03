<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | BCC Scan2Fetch</title>
    
    <!-- AdminLTE & Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/dist/css/adminlte.min.css') ?>">
    
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --dark: #1a1a2e;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        
        /* Animated background circles */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.05;
            animation: floatCircle 20s infinite ease-in-out;
        }
        .bg-circle:nth-child(1) { width: 600px; height: 600px; background: #667eea; top: -200px; left: -200px; animation-delay: 0s; }
        .bg-circle:nth-child(2) { width: 400px; height: 400px; background: #764ba2; bottom: -100px; right: -100px; animation-delay: -5s; }
        .bg-circle:nth-child(3) { width: 300px; height: 300px; background: #667eea; top: 50%; left: 50%; animation-delay: -10s; }
        
        @keyframes floatCircle {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(50px, -30px) scale(1.1); }
            50% { transform: translate(-20px, 40px) scale(0.9); }
            75% { transform: translate(-40px, -20px) scale(1.05); }
        }
        
        .error-container {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 40px;
            max-width: 600px;
        }
        
        .error-icon {
            font-size: 80px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        
        .error-code {
            font-size: 140px;
            font-weight: 900;
            line-height: 1;
            letter-spacing: -5px;
            background: linear-gradient(180deg, #fff 0%, rgba(255,255,255,0.3) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }
        
        .error-title {
            font-size: 24px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        
        .error-message {
            font-size: 15px;
            color: rgba(255,255,255,0.6);
            margin-bottom: 35px;
            line-height: 1.6;
        }
        
        .error-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-home {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            color: #fff;
            text-decoration: none;
        }
        
        .btn-back {
            background: rgba(255,255,255,0.1);
            color: #fff;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s;
            border: 1px solid rgba(255,255,255,0.2);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-back:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
            text-decoration: none;
        }
        
        .dots {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-top: 40px;
        }
        
        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            animation: dotPulse 1.5s infinite ease-in-out;
        }
        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes dotPulse {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.5); }
        }
        
        @media (max-width: 480px) {
            .error-code { font-size: 100px; }
            .error-title { font-size: 18px; }
            .error-icon { font-size: 60px; }
        }
    </style>
</head>
<body>
    
    <!-- Animated Background -->
    <div class="bg-circle"></div>
    <div class="bg-circle"></div>
    <div class="bg-circle"></div>
    
    <!-- Error Content -->
    <div class="error-container">
        
        <!-- Icon -->
        <div class="error-icon">
            <i class="fas fa-map-signs"></i>
        </div>
        
        <!-- Error Code -->
        <div class="error-code">404</div>
        
        <!-- Title -->
        <h2 class="error-title">Page Not Found</h2>
        
        <!-- Message -->
        <p class="error-message">
            Oops! The page you're looking for doesn't exist or has been moved.<br>
            Let's get you back on track.
        </p>
        
        <!-- Action Buttons -->
        <div class="error-actions">
            <a href="javascript:history.back()" class="btn-back">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>
        
        <!-- Animated Dots -->
        <div class="dots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
        
    </div>

</body>
</html>