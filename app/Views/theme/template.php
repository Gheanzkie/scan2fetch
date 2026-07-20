<?php helper('site'); ?>
<!DOCTYPE html>
<html lang="en" style="font-size: 14px;">
<head>
    <link rel="icon" href="<?= base_url('image/BCC_LOGO.png') ?>">
    <meta name="csrf-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= siteTitle($pageName ?? '') ?></title>
    
    <!-- ===== CHILD-FRIENDLY FONTS ===== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=fallback">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Comic+Neue:300,400,700&display=fallback">
    
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('public/assets/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/toastr/toastr.min.css') ?>">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
    
    <style>
        /* ===== CHILD-FRIENDLY GLOBAL STYLES ===== */
        :root {
            --soft-blue: #6C8CFF;
            --soft-purple: #7C6CFF;
            --soft-pink: #FF8A9B;
            --soft-green: #66BB6A;
            --soft-orange: #FFB74D;
            --soft-teal: #4FC3F7;
            --soft-yellow: #FFD54F;
            --soft-rose: #FF6B7A;
        }
        
        body {
            font-family: 'Quicksand', 'Source Sans Pro', sans-serif !important;
            background: linear-gradient(135deg, #f5f0ff 0%, #ffe8f0 100%) !important;
            color: #2d2d4a !important;
            min-height: 100vh;
        }
        
        /* ===== FUN SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f5f0ff;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple));
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--soft-pink);
        }
        
        /* ===== KID EMOJI ANIMATION ===== */
        .kid-emoji {
            display: inline-block;
            animation: sparkle 2s ease-in-out infinite;
        }
        
        @keyframes sparkle {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.15) rotate(8deg); }
        }
        
        /* ===== FLOATING SHAPES GLOBAL ===== */
        .floating-shapes-global {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        
        .floating-shapes-global .shape {
            position: absolute;
            font-size: 3rem;
            opacity: 0.05;
            animation: floatShapeGlobal 20s ease-in-out infinite;
        }
        
        .floating-shapes-global .shape:nth-child(1) { top: 5%; left: 3%; animation-delay: 0s; }
        .floating-shapes-global .shape:nth-child(2) { top: 15%; right: 5%; animation-delay: 2.5s; }
        .floating-shapes-global .shape:nth-child(3) { bottom: 20%; left: 4%; animation-delay: 5s; }
        .floating-shapes-global .shape:nth-child(4) { bottom: 10%; right: 3%; animation-delay: 1.5s; }
        .floating-shapes-global .shape:nth-child(5) { top: 45%; left: 45%; animation-delay: 3.5s; font-size: 4.5rem; opacity: 0.04; }
        .floating-shapes-global .shape:nth-child(6) { top: 70%; left: 20%; animation-delay: 4s; }
        .floating-shapes-global .shape:nth-child(7) { top: 30%; left: 75%; animation-delay: 6s; }
        
        @keyframes floatShapeGlobal {
            0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
            25% { transform: translateY(-25px) rotate(8deg) scale(1.05); }
            75% { transform: translateY(20px) rotate(-5deg) scale(0.95); }
        }
        
        /* ===== CONTENT WRAPPER ===== */
        .content-wrapper {
            position: relative;
            z-index: 1;
            background: transparent !important;
        }
        
        /* ===== CARDS GLOBAL ===== */
        .card {
            border-radius: 25px !important;
            border: 2px solid rgba(255,255,255,0.6) !important;
            background: rgba(255,255,255,0.75) !important;
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 32px rgba(108,140,255,0.06) !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(108,140,255,0.1) !important;
        }
        
        .card-header {
            background: rgba(255,255,255,0.4) !important;
            border-bottom: 2px solid rgba(255,255,255,0.3) !important;
        }
        
        .card-header h3, .card-header h5, .card-header h6 {
            color: #2d2d4a !important;
            font-weight: 700 !important;
        }
        
        /* ===== TABLE GLOBAL ===== */
        .table thead.bg-light {
            background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
        }
        
        .table thead th {
            color: #ffffff !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            border-bottom: none !important;
            padding: 14px 12px !important;
        }
        
        .table tbody td {
            color: #2d2d4a !important;
            vertical-align: middle !important;
            border-top: none !important;
            padding: 12px 12px !important;
            font-size: 14px !important;
        }
        
        .table tbody tr {
            border-bottom: 1px solid rgba(108,140,255,0.06) !important;
            transition: all 0.3s ease !important;
        }
        
        .table tbody tr:hover {
            background: rgba(108,140,255,0.04) !important;
            transform: scale(1.01);
        }
        
        /* ===== FORM CONTROLS GLOBAL ===== */
        .form-control {
            background: rgba(255,255,255,0.7) !important;
            border: 2px solid rgba(108,140,255,0.1) !important;
            color: #2d2d4a !important;
            border-radius: 14px !important;
            padding: 12px 18px !important;
            transition: all 0.3s ease !important;
            font-size: 15px !important;
            font-family: 'Quicksand', sans-serif !important;
        }
        
        .form-control:focus {
            background: rgba(255,255,255,0.9) !important;
            border-color: var(--soft-blue) !important;
            box-shadow: 0 0 0 4px rgba(108,140,255,0.1) !important;
            color: #2d2d4a !important;
        }
        
        .form-control::placeholder {
            color: #b0b0c8 !important;
        }
        
        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 12 12'%3E%3Cpath fill='%236a6a8a' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 44px !important;
            cursor: pointer;
        }
        
        select.form-control option {
            background: #ffffff !important;
            color: #2d2d4a !important;
            padding: 10px !important;
            font-size: 14px !important;
        }
        
        /* ===== BUTTONS GLOBAL ===== */
        .btn {
            border-radius: 50px !important;
            font-weight: 700 !important;
            transition: all 0.3s ease !important;
            font-family: 'Quicksand', sans-serif !important;
        }
        
        .btn:hover {
            transform: translateY(-3px) scale(1.03);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
            border: none !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(108,140,255,0.25) !important;
        }
        
        .btn-primary:hover {
            box-shadow: 0 8px 25px rgba(108,140,255,0.35) !important;
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
            border: none !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(102,187,106,0.25) !important;
        }
        
        .btn-success:hover {
            box-shadow: 0 8px 25px rgba(102,187,106,0.35) !important;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, var(--soft-orange), #f57c00) !important;
            border: none !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(255,183,77,0.25) !important;
        }
        
        .btn-warning:hover {
            box-shadow: 0 8px 25px rgba(255,183,77,0.35) !important;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, var(--soft-rose), #d32f2f) !important;
            border: none !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(255,107,122,0.25) !important;
        }
        
        .btn-danger:hover {
            box-shadow: 0 8px 25px rgba(255,107,122,0.35) !important;
        }
        
        .btn-outline-secondary {
            border: 2px solid rgba(108,140,255,0.15) !important;
            color: #6a6a8a !important;
            background: rgba(255,255,255,0.3) !important;
        }
        
        .btn-outline-secondary:hover {
            background: rgba(108,140,255,0.08) !important;
            border-color: var(--soft-blue) !important;
            color: var(--soft-purple) !important;
        }
        
        .btn-sm {
            padding: 8px 20px !important;
            font-size: 13px !important;
        }
        
        .btn-xs {
            padding: 4px 14px !important;
            font-size: 11px !important;
            border-radius: 50px !important;
        }
        
        /* ===== BADGES GLOBAL ===== */
        .badge {
            font-weight: 700 !important;
            padding: 6px 16px !important;
            border-radius: 50px !important;
            font-size: 12px !important;
        }
        
        .badge-light {
            background: rgba(108,140,255,0.06) !important;
            color: #5a5a7a !important;
        }
        
        .badge-primary { background: var(--soft-blue) !important; color: #fff !important; }
        .badge-success { background: var(--soft-green) !important; color: #fff !important; }
        .badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
        .badge-danger { background: var(--soft-rose) !important; color: #fff !important; }
        .badge-info { background: var(--soft-teal) !important; color: #fff !important; }
        
        /* ===== ALERTS GLOBAL ===== */
        .alert {
            border-radius: 20px !important;
            padding: 16px 24px !important;
            font-size: 15px !important;
            border: 2px solid transparent !important;
            font-weight: 600 !important;
        }
        
        .alert-success {
            background: rgba(102,187,106,0.1) !important;
            border-color: rgba(102,187,106,0.15) !important;
            color: #3a7a3a !important;
        }
        
        .alert-danger {
            background: rgba(255,107,122,0.1) !important;
            border-color: rgba(255,107,122,0.15) !important;
            color: #aa4a5a !important;
        }
        
        .alert-warning {
            background: rgba(255,183,77,0.1) !important;
            border-color: rgba(255,183,77,0.15) !important;
            color: #8a7a4a !important;
        }
        
        .alert-info {
            background: rgba(79,195,247,0.1) !important;
            border-color: rgba(79,195,247,0.15) !important;
            color: #4a7a8a !important;
        }
        
        /* ===== BREADCRUMB GLOBAL ===== */
        .breadcrumb {
            background: transparent !important;
            padding: 0 !important;
        }
        
        .breadcrumb-item a {
            color: #8888aa !important;
            transition: color 0.3s ease !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            font-size: 14px !important;
        }
        
        .breadcrumb-item a:hover {
            color: var(--soft-purple) !important;
        }
        
        .breadcrumb-item.active {
            color: #2d2d4a !important;
            font-weight: 700 !important;
            font-size: 14px !important;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            color: #c0c0d8 !important;
            content: "›" !important;
        }
        
        /* ===== CONTENT HEADER GLOBAL ===== */
        .content-header h1 {
            color: #2d2d4a !important;
            font-weight: 800 !important;
            font-size: 2rem !important;
        }
        
        .content-header h1 i {
            background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .content-header h1 {
                font-size: 1.5rem !important;
            }
            .card-body {
                padding: 1rem !important;
            }
            .table td, .table th {
                padding: 8px 4px !important;
                font-size: 11px !important;
            }
            .floating-shapes-global .shape {
                font-size: 2rem !important;
            }
            .btn {
                font-size: 12px !important;
                padding: 6px 14px !important;
            }
        }
        
        @media (max-width: 480px) {
            .card {
                border-radius: 18px !important;
            }
            .table td, .table th {
                font-size: 9px !important;
                padding: 4px 2px !important;
            }
            .floating-shapes-global .shape {
                display: none !important;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="font-family: 'Quicksand', 'Source Sans Pro', sans-serif;">

<!-- ===== FLOATING SHAPES GLOBAL ===== -->
<div class="floating-shapes-global">
    <div class="shape">🌈</div>
    <div class="shape">⭐</div>
    <div class="shape">🎈</div>
    <div class="shape">🌸</div>
    <div class="shape">☁️</div>
    <div class="shape">🌟</div>
    <div class="shape">🎉</div>
</div>

<div class="wrapper">

    <?= $this->include('theme/navbar') ?>
    <?= $this->include('theme/sidebar') ?>
    <?= $this->renderSection('content') ?>

    <!-- ===== CHILD-FRIENDLY FOOTER ===== -->
    <footer class="main-footer no-print" 
            style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%) !important;
                   border-top: 2px solid rgba(102,126,234,0.1);
                   color: rgba(255,255,255,0.5) !important;
                   padding: 15px 20px !important;
                   font-family: 'Quicksand', sans-serif !important;
                   position: relative;
                   z-index: 1;">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left">
                    <strong style="color: rgba(255,255,255,0.6);">
                        &copy; <?= date('Y') ?> 
                        <span style="background:linear-gradient(135deg, #a8c0ff, #f093fb);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                            BCC Scan2Fetch
                        </span>
                    </strong>
                    <span style="color: rgba(255,255,255,0.3); margin-left: 8px;">
                        🌟 All rights reserved
                    </span>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <span style="color: rgba(255,255,255,0.3); font-size: 13px;">
                        Made with <span style="color: #FF6B9D; animation: sparkle 2s ease-in-out infinite; display: inline-block;">❤️</span> for kids 🎒
                    </span>
                    <span class="d-none d-sm-inline-block" style="color: rgba(255,255,255,0.15); margin-left: 15px; font-size: 12px;">
                        <b>Version</b> 1.0
                    </span>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="<?= base_url('public/assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('public/assets/dist/js/adminlte.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('public/assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('public/assets/plugins/toastr/toastr.min.js') ?>"></script>

<?= $this->renderSection('scripts') ?>

<style>
    /* ===== FOOTER SPARKLE ANIMATION ===== */
    @keyframes sparkle {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
    
    .main-footer {
        transition: all 0.3s ease;
    }
    
    .main-footer:hover {
        border-top-color: rgba(102,126,234,0.3) !important;
    }
</style>

</body>
</html>