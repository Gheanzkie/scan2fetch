<?php helper('site'); ?>
<!DOCTYPE html>
<html lang="en" style="font-size: 14px;">
<head>
 <link rel="icon" href="<?= base_url('image/qr-code-76.png') ?>">
 <meta name="csrf-name" content="<?= csrf_token() ?>">
 <meta name="csrf-token" content="<?= csrf_hash() ?>">
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?= siteTitle($pageName ?? '') ?></title>

 <!-- ===== THEME PRELOAD (prevents dark-mode flash) ===== -->
 <script>
    try {
        if (localStorage.getItem('scan2fetch-theme') === 'dark') {
            document.documentElement.classList.add('theme-dark');
        }
    } catch (e) {}
 </script>

 <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">
 <link rel="stylesheet" href="<?= base_url('public/assets/dist/css/adminlte.min.css') ?>">
 <link rel="stylesheet" href="<?= base_url('public/assets/plugins/toastr/toastr.min.css') ?>">

 <!-- DataTables -->
 <link rel="stylesheet" href="<?= base_url('public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
 <link rel="stylesheet" href="<?= base_url('public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
 <link rel="stylesheet" href="<?= base_url('public/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">

 <style>
        /* ============================================================
           GLOBAL PROFESSIONAL DESIGN SYSTEM
           Rules are scoped under `html body ...` (or `html.theme-dark
           body ...`) with !important so they consistently win over the
           per-page pastel styles that previously loaded later.
        ============================================================ */
        :root {
            --primary: #4361ee;
            --primary-dark: #3b4fd8;
            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
            --info: #0284c7;
            --bg: #f1f5f9;
            --card: #ffffff;
            --border: #e2e8f0;
            --heading: #0f172a;
            --text: #334155;
            --muted: #64748b;

            /* kept so leftover page styles referencing these vars still look clean */
            --soft-blue: #4361ee;
            --soft-purple: #7c3aed;
            --soft-pink: #e11d48;
            --soft-green: #16a34a;
            --soft-orange: #d97706;
            --soft-teal: #0284c7;
            --soft-yellow: #f59e0b;
            --soft-rose: #dc2626;
        }

        html body {
            font-family: 'Source Sans Pro', 'Segoe UI', system-ui, -apple-system, sans-serif !important;
            background: var(--bg) !important;
            color: var(--text) !important;
            min-height: 100vh;
        }

        .content-wrapper { background: transparent !important; }

        /* ===== SCROLLBAR ===== */
        body ::-webkit-scrollbar { width: 8px; height: 8px; }
        body ::-webkit-scrollbar-track { background: transparent; }
        body ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }
        body ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* ===== CARDS ===== */
        html body .card,
        html body .kid-card,
        html body .fun-box {
            background: var(--card) !important;
            border: 1px solid var(--border) !important;
            border-radius: 10px !important;
            box-shadow: 0 1px 3px rgba(15, 23, 42, .07) !important;
            overflow: hidden !important;
        }

        html body .card-header,
        body .kid-card .card-header {
            background: #f8fafc !important;
            border-bottom: 1px solid var(--border) !important;
            padding: 13px 20px !important;
        }

        html body .card-header h3,
        html body .card-header h5,
        html body .card-header h6 {
            color: var(--heading) !important;
            font-weight: 700 !important;
            font-size: 1rem !important;
            margin-bottom: 0 !important;
        }

        html body .card-body { padding: 18px 20px !important; }

        /* ===== WELCOME BANNER ===== */
        html body .welcome-banner {
            background: var(--card) !important;
            border: 1px solid var(--border) !important;
            border-radius: 10px !important;
            box-shadow: 0 1px 3px rgba(15, 23, 42, .07) !important;
            padding: 1.4rem 2rem !important;
            margin-bottom: 1.5rem !important;
            color: var(--text) !important;
            position: relative !important;
            overflow: hidden !important;
        }
        html body .welcome-banner h2 { color: var(--heading) !important; font-weight: 800 !important; font-size: 1.5rem !important; }
        html body .welcome-banner p { color: var(--muted) !important; font-size: .95rem !important; margin-bottom: 0 !important; }

        /* ===== STAT BOXES ===== */
        html body .fun-box { padding: 1.1rem .5rem !important; cursor: default !important; box-shadow: 0 1px 3px rgba(15,23,42,.05) !important; }
        html body .fun-box .icon-circle {
            width: 46px !important; height: 46px !important;
            border-radius: 10px !important;
            font-size: 1.15rem !important;
            background: #eef2ff !important;
            color: var(--primary) !important;
            margin: 0 auto 10px !important;
        }
        html body .fun-box .number { color: var(--heading) !important; font-size: 1.55rem !important; font-weight: 800 !important; display: block !important; }
        html body .fun-box .label { color: var(--muted) !important; font-size: .72rem !important; font-weight: 700 !important; text-transform: uppercase !important; letter-spacing: .4px !important; }

        /* neutralize kid gradient backgrounds */
        html body .bg-kid-blue,
        html body .bg-kid-green,
        html body .bg-kid-orange,
        html body .bg-kid-pink,
        html body .bg-kid-purple,
        html body .bg-kid-yellow,
        html body .bg-kid-teal {
            background: var(--card) !important;
            color: var(--text) !important;
        }
        html body .bg-kid-blue   { border-top: 3px solid var(--primary) !important; }
        html body .bg-kid-green  { border-top: 3px solid var(--success) !important; }
        html body .bg-kid-orange { border-top: 3px solid var(--warning) !important; }
        html body .bg-kid-pink   { border-top: 3px solid #e11d48 !important; }
        html body .bg-kid-purple { border-top: 3px solid #7c3aed !important; }
        html body .bg-kid-yellow { border-top: 3px solid #f59e0b !important; }
        html body .bg-kid-teal   { border-top: 3px solid var(--info) !important; }

        /* ===== CHILD / LIST ITEMS ===== */
        html body .child-item,
        html body .subfetcher-item {
            background: var(--card) !important;
            border: 1px solid var(--border) !important;
            border-radius: 8px !important;
            transition: border-color .15s ease, box-shadow .15s ease !important;
        }
        html body .child-item:hover,
        html body .subfetcher-item:hover { border-color: var(--primary) !important; box-shadow: 0 2px 8px rgba(15,23,42,.06) !important; }

        /* ===== TABLES ===== */
        html body .table thead.bg-light,
        html body .table-fun thead,
        html body .table thead {
            background: #f1f5f9 !important;
        }
        html body .table thead th {
            color: #475569 !important;
            background: #f1f5f9 !important;
            font-weight: 700 !important;
            font-size: 12px !important;
            letter-spacing: .3px !important;
            text-transform: uppercase !important;
            border-bottom: 1px solid var(--border) !important;
            padding: 10px 12px !important;
        }
        html body .table tbody td {
            color: var(--text) !important;
            vertical-align: middle !important;
            border-top: 1px solid #f1f5f9 !important;
            padding: 10px 12px !important;
            font-size: 14px !important;
        }
        html body .table tbody tr { border-bottom: 1px solid #f1f5f9 !important; }
        html body .table tbody tr:hover { background: #f8fafc !important; }

        /* ===== FORMS ===== */
        html body label { color: var(--heading) !important; font-weight: 600 !important; font-size: 13px !important; margin-bottom: 5px !important; }

        html body .form-control {
            height: 42px !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            font-family: inherit !important;
            line-height: 1.5 !important;
            color: var(--text) !important;
            background: #fff !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 6px !important;
            box-shadow: none !important;
            transition: border-color .15s ease, box-shadow .15s ease !important;
        }
        html body textarea.form-control { height: auto !important; min-height: 90px !important; }
        html body .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, .12) !important;
            background: #fff !important;
            color: var(--text) !important;
        }
        html body .form-control::placeholder { color: #94a3b8 !important; opacity: 1; }
        html body .form-control[readonly],
        html body .form-control[disabled] { background: #f8fafc !important; }

        /* ===== SELECTS — full option visibility ===== */
        html body select.form-control {
            height: 42px !important;
            line-height: 1.5 !important;
            padding: 6px 34px 6px 12px !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 448 512'%3E%3Cpath fill='%2364748b' d='M207 372.9L12.7 178.7c-6.6-6.6-6.6-17.4 0-24l11.3-11.3c6.6-6.6 17.4-6.6 24 0L224 313.6l176-180.1c6.6-6.6 17.4-6.6 24 0l11.3 11.3c6.6 6.6 6.6 17.4 0 24L241 372.9c-4.7 4.7-10.9 7.1-17 7.1s-12.3-2.4-17-7.1z'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 12px center !important;
            background-size: 12px !important;
            cursor: pointer !important;
        }
        html body select.form-control:focus { border-color: var(--primary) !important; box-shadow: 0 0 0 3px rgba(67, 97, 238, .12) !important; }
        html body select.form-control option {
            background: #fff !important;
            color: var(--text) !important;
            padding: 6px 10px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 1.5 !important;
        }

        /* ===== INPUT GROUP ===== */
        html body .input-group-text {
            background: #f8fafc !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 6px !important;
            color: var(--muted) !important;
            font-size: 14px !important;
        }

        /* ===== BUTTONS (uniform) ===== */
        html body .btn,
        html body .btn-kid {
            border-radius: 6px !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            font-family: inherit !important;
            line-height: 1.3 !important;
            padding: 8px 16px !important;
            border: 1px solid transparent !important;
            box-shadow: none !important;
            text-transform: none !important;
            transition: all .15s ease !important;
        }
        html body .btn:hover { box-shadow: 0 2px 6px rgba(15,23,42,.14) !important; }
        html body .btn-primary,
        html body .btn-kid-primary { background: var(--primary) !important; border-color: var(--primary) !important; color: #fff !important; }
        html body .btn-primary:hover, html body .btn-primary:focus { background: var(--primary-dark) !important; border-color: var(--primary-dark) !important; }
        html body .btn-success,
        html body .btn-kid-success { background: var(--success) !important; border-color: var(--success) !important; color: #fff !important; }
        html body .btn-success:hover { background: #128a3d !important; border-color: #128a3d !important; }
        html body .btn-warning,
        html body .btn-kid-warning { background: var(--warning) !important; border-color: var(--warning) !important; color: #fff !important; }
        html body .btn-warning:hover { background: #b85f04 !important; border-color: #b85f04 !important; color: #fff !important; }
        html body .btn-danger { background: var(--danger) !important; border-color: var(--danger) !important; color: #fff !important; }
        html body .btn-danger:hover { background: #b91c1c !important; border-color: #b91c1c !important; }
        html body .btn-info { background: var(--info) !important; border-color: var(--info) !important; color: #fff !important; }
        html body .btn-info:hover { background: #0369a1 !important; border-color: #0369a1 !important; }
        html body .btn-kid-purple { background: #7c3aed !important; border-color: #7c3aed !important; color: #fff !important; }
        html body .btn-kid-purple:hover { background: #6d28d9 !important; border-color: #6d28d9 !important; }
        html body .btn-kid-pink { background: #e11d48 !important; border-color: #e11d48 !important; color: #fff !important; }
        html body .btn-kid-pink:hover { background: #be123c !important; border-color: #be123c !important; }

        html body .btn-outline-secondary,
        html body .btn-outline-primary,
        html body .btn-outline-success,
        html body .btn-outline-danger,
        html body .btn-outline-warning,
        html body .btn-outline-info,
        html body .btn-outline-dark {
            background: #fff !important;
            border: 1px solid #cbd5e1 !important;
            color: #475569 !important;
        }
        html body .btn-outline-secondary:hover,
        html body .btn-outline-primary:hover,
        html body .btn-outline-success:hover,
        html body .btn-outline-danger:hover,
        html body .btn-outline-warning:hover,
        html body .btn-outline-info:hover,
        html body .btn-outline-dark:hover {
            background: #f1f5f9 !important;
            border-color: #94a3b8 !important;
            color: #1e293b !important;
            box-shadow: none !important;
        }
        html body .btn-outline-kid,
        html body .btn-outline-kid.active {
            background: #fff !important;
            border: 1px solid #cbd5e1 !important;
            color: #475569 !important;
        }
        html body .btn-outline-kid:hover {
            background: #eef2ff !important;
            border-color: #4361ee !important;
            color: #4361ee !important;
        }

        html body .btn-sm { padding: 5px 12px !important; font-size: 13px !important; }
        html body .btn-xs { padding: 3px 10px !important; font-size: 12px !important; border-radius: 6px !important; }

        /* ===== BADGES ===== */
        html body .badge {
            font-weight: 600 !important;
            font-size: 12px !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
        }
        html body .badge-primary { background: #eef2ff !important; color: #4338ca !important; }
        html body .badge-success { background: #dcfce7 !important; color: #15803d !important; }
        html body .badge-warning { background: #fef3c7 !important; color: #b45309 !important; }
        html body .badge-danger { background: #fee2e2 !important; color: #b91c1c !important; }
        html body .badge-info { background: #e0f2fe !important; color: #0369a1 !important; }
        html body .badge-light { background: #f1f5f9 !important; color: #475569 !important; }
        html body .badge-dark { background: #1e293b !important; color: #fff !important; }
        html body .badge-soft { background: #f1f5f9 !important; color: #475569 !important; }
        html body .badge-grade { background: #eef2ff !important; color: #4338ca !important; }
        html body .badge-parent { background: #e0f2fe !important; color: #0369a1 !important; }
        html body .badge-count { background: #eef2ff !important; color: #4338ca !important; }
        html body .badge-released { background: #dcfce7 !important; color: #15803d !important; }
        html body .badge-pending { background: #fef3c7 !important; color: #b45309 !important; }

        /* ===== CUSTOM MODULE ACTIONS ===== */
        html body .btn-action, html body .btn-action-view, html body .btn-action-edit,
        html body .btn-action-delete, html body .btn-action-more, html body .btn-action-password {
            border-radius: 5px !important;
            padding: 4px 9px !important;
            font-size: 12px !important;
        }
        html body .student-item { background: #fff !important; border-color: #e2e8f0 !important; }
        html body .student-item:hover { background: #f8fafc !important; border-color: #cbd5e1 !important; }
        html body .qr-card, html body .qr-thumb { background: #fff !important; border-color: #e2e8f0 !important; }
        html body .qr-thumb:hover { border-color: #4361ee !important; }
        html body .photo-cell img, html body .img-circle { border: 2px solid #e2e8f0 !important; }
        html body .live-pulse { color: #dc2626 !important; }
        html body .info-box.active { border-color: #4361ee !important; box-shadow: 0 2px 10px rgba(67, 97, 238, .15) !important; }
        html body .card:hover { border-color: #cbd5e1 !important; box-shadow: 0 2px 12px rgba(15, 23, 42, .08) !important; }

        /* ===== ALERTS ===== */
        html body .alert {
            border-radius: 8px !important;
            padding: 12px 16px !important;
            font-size: 14px !important;
            border: 1px solid transparent !important;
            font-weight: 500 !important;
        }
        html body .alert-success { background: #f0fdf4 !important; border-color: #bbf7d0 !important; color: #15803d !important; }
        html body .alert-danger  { background: #fef2f2 !important; border-color: #fecaca !important; color: #b91c1c !important; }
        html body .alert-warning { background: #fffbeb !important; border-color: #fde68a !important; color: #b45309 !important; }
        html body .alert-info    { background: #f0f9ff !important; border-color: #bae6fd !important; color: #0369a1 !important; }

        /* ===== MODALS ===== */
        html body .modal-content {
            border-radius: 10px !important;
            border: 1px solid var(--border) !important;
            box-shadow: 0 20px 40px rgba(15, 23, 42, .2) !important;
        }
        html body .modal-header { border-bottom: 1px solid var(--border) !important; padding: 15px 20px !important; }
        html body .modal-footer { border-top: 1px solid var(--border) !important; padding: 12px 20px !important; }
        html body .modal-title { color: var(--heading) !important; font-weight: 700 !important; font-size: 1.05rem !important; }

        /* ===== DROPDOWNS ===== */
        html body .dropdown-menu {
            border-radius: 8px !important;
            border: 1px solid var(--border) !important;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .12) !important;
            padding: 4px !important;
        }
        html body .dropdown-item {
            border-radius: 6px !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            color: var(--text) !important;
        }
        html body .dropdown-item:hover { background: #f1f5f9 !important; color: var(--heading) !important; }
        html body .dropdown-header strong { color: var(--heading) !important; }
        html body .dropdown-header small { color: var(--muted) !important; }

        /* ===== BREADCRUMB / CONTENT HEADER ===== */
        html body .breadcrumb { background: transparent !important; padding: 0 !important; margin-bottom: 6px !important; }
        html body .breadcrumb-item a { color: var(--muted) !important; font-weight: 500 !important; font-size: 13px !important; text-decoration: none !important; }
        html body .breadcrumb-item a:hover { color: var(--primary) !important; }
        html body .breadcrumb-item.active { color: var(--text) !important; font-weight: 600 !important; font-size: 13px !important; }
        html body .breadcrumb-item + .breadcrumb-item::before { color: #cbd5e1 !important; content: "/" !important; }
        html body .content-header h1 {
            color: var(--heading) !important;
            font-weight: 800 !important;
            font-size: 1.4rem !important;
            margin: .2rem 0 .4rem !important;
        }
        html body .content-header h1 i { color: var(--heading) !important; -webkit-text-fill-color: currentColor !important; }

        /* ===== INFO BOX (stats on logs/sms pages) ===== */
        html body .info-box {
            background: var(--card) !important;
            border: 1px solid var(--border) !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 3px rgba(15, 23, 42, .05) !important;
            min-height: 90px !important;
        }
        html body .info-box-icon { border-radius: 8px 0 0 8px !important; }
        html body .info-box-number { font-size: 1.35rem !important; font-weight: 800 !important; color: var(--heading) !important; }
        html body .info-box-text { font-size: 12px !important; font-weight: 700 !important; text-transform: uppercase !important; letter-spacing: .3px !important; color: var(--muted) !important; }

        /* ===== FILTER / TOOLBAR AREAS ===== */
        html body .filter-section,
        html body .date-selector,
        html body .tab-filters,
        html body .step-nav,
        html body .action-bar {
            background: var(--card) !important;
            border: 1px solid var(--border) !important;
            border-radius: 8px !important;
        }
        html body .filter-label { color: var(--muted) !important; font-size: 12px !important; font-weight: 700 !important; text-transform: uppercase !important; letter-spacing: .3px !important; }

        /* ===== EMPTY STATE ===== */
        html body .empty-state i { color: #cbd5e1 !important; }
        html body .empty-state h5 { color: var(--heading) !important; }
        html body .empty-state p { color: var(--muted) !important; }
        html body .empty-state .text-muted { color: var(--muted) !important; }

        /* ===== PAGINATION ===== */
        html body .pagination .page-link { border-radius: 6px !important; margin: 0 2px !important; color: var(--primary) !important; font-size: 13px !important; }
        html body .page-item.active .page-link { background: var(--primary) !important; border-color: var(--primary) !important; }

        /* ===== GUARDIAN / QR AREAS (register + profile pages) ===== */
        html body .guardian-box,
        html body .photo-preview,
        html body #studentPhotoPreview,
        html body .qr-row,
        html body .photo-empty {
            background: var(--card) !important;
            border: 1px solid var(--border) !important;
            border-radius: 8px !important;
        }

        /* ============================================================
           DARK MODE (html.theme-dark)
        ============================================================ */
        html.theme-dark {
            --bg: #0f172a;
            --card: #1e293b;
            --border: #334155;
            --heading: #f1f5f9;
            --text: #cbd5e1;
            --muted: #94a3b8;
            color-scheme: dark;
        }

        html.theme-dark body {
            background: #0f172a !important;
            color: var(--text) !important;
        }

        html.theme-dark body .card,
        html.theme-dark body .kid-card,
        html.theme-dark body .fun-box,
        html.theme-dark body .welcome-banner,
        html.theme-dark body .child-item,
        html.theme-dark body .subfetcher-item,
        html.theme-dark body .info-box,
        html.theme-dark body .filter-section,
        html.theme-dark body .date-selector,
        html.theme-dark body .tab-filters,
        html.theme-dark body .step-nav,
        html.theme-dark body .action-bar,
        html.theme-dark body .guardian-box,
        html.theme-dark body .photo-preview,
        html.theme-dark body #studentPhotoPreview,
        html.theme-dark body .qr-row,
        html.theme-dark body .photo-empty {
            background: #1e293b !important;
            border-color: #334155 !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .3) !important;
        }
        html.theme-dark body .card-header,
        html.theme-dark body .kid-card .card-header { background: #243247 !important; border-bottom-color: #334155 !important; }
        html.theme-dark body .card-header h3,
        html.theme-dark body .card-header h5,
        html.theme-dark body .card-header h6,
        html.theme-dark body .welcome-banner h2,
        html.theme-dark body .content-header h1,
        html.theme-dark body .content-header h1 i,
        html.theme-dark body label,
        html.theme-dark body .modal-title,
        html.theme-dark body .breadcrumb-item.active,
        html.theme-dark body .fun-box .number { color: #f1f5f9 !important; }

        html.theme-dark body .welcome-banner p,
        html.theme-dark body .fun-box .label,
        html.theme-dark body .breadcrumb-item a { color: #94a3b8 !important; }

        html.theme-dark body .table thead th { background: #243247 !important; color: #cbd5e1 !important; border-bottom-color: #334155 !important; }
        html.theme-dark body .table tbody td { color: var(--text) !important; border-top-color: #334155 !important; }
        html.theme-dark body .table tbody tr { border-bottom-color: #334155 !important; }
        html.theme-dark body .table tbody tr:hover { background: #243247 !important; }

        html.theme-dark body .form-control {
            background: #0f172a !important;
            border-color: #475569 !important;
            color: var(--text) !important;
        }
        html.theme-dark body .form-control:focus {
            background: #0f172a !important;
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, .25) !important;
            color: var(--text) !important;
        }
        html.theme-dark body .form-control::placeholder { color: #64748b !important; }
        html.theme-dark body select.form-control { background-color: #0f172a !important; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 448 512'%3E%3Cpath fill='%2394a3b8' d='M207 372.9L12.7 178.7c-6.6-6.6-6.6-17.4 0-24l11.3-11.3c6.6-6.6 17.4-6.6 24 0L224 313.6l176-180.1c6.6-6.6 17.4-6.6 24 0l11.3 11.3c6.6 6.6 6.6 17.4 0 24L241 372.9c-4.7 4.7-10.9 7.1-17 7.1s-12.3-2.4-17-7.1z'/%3E%3C/svg%3E") !important; }
        html.theme-dark body select.form-control option { background: #1e293b !important; color: var(--text) !important; }
        html.theme-dark body .input-group-text { background: #243247 !important; border-color: #475569 !important; color: #94a3b8 !important; }

        html.theme-dark body .modal-content { background: #1e293b !important; border-color: #334155 !important; }
        html.theme-dark body .modal-header { background: #243247 !important; border-bottom-color: #334155 !important; }
        html.theme-dark body .modal-footer { background: #243247 !important; border-top-color: #334155 !important; }
        html.theme-dark body .modal-body { background: #1e293b !important; color: var(--text) !important; }

        html.theme-dark body .dropdown-menu { background: #1e293b !important; border-color: #334155 !important; }
        html.theme-dark body .dropdown-item { color: var(--text) !important; }
        html.theme-dark body .dropdown-item:hover { background: #243247 !important; color: #fff !important; }

        html.theme-dark body .badge-success { background: #14532d !important; color: #86efac !important; }
        html.theme-dark body .badge-warning { background: #78350f !important; color: #fcd34d !important; }
        html.theme-dark body .badge-danger  { background: #7f1d1d !important; color: #fca5a5 !important; }
        html.theme-dark body .badge-info    { background: #0c4a6e !important; color: #7dd3fc !important; }
        html.theme-dark body .badge-light   { background: #334155 !important; color: #cbd5e1 !important; }
        html.theme-dark body .badge-primary { background: #3730a3 !important; color: #c7d2fe !important; }
        html.theme-dark body .badge-soft     { background: #334155 !important; color: #cbd5e1 !important; }
        html.theme-dark body .badge-grade    { background: #3730a3 !important; color: #c7d2fe !important; }
        html.theme-dark body .badge-parent   { background: #0c4a6e !important; color: #7dd3fc !important; }
        html.theme-dark body .badge-count    { background: #3730a3 !important; color: #c7d2fe !important; }
        html.theme-dark body .badge-released { background: #14532d !important; color: #86efac !important; }
        html.theme-dark body .badge-pending  { background: #78350f !important; color: #fcd34d !important; }

        html.theme-dark body .student-item { background: #243247 !important; border-color: #334155 !important; }
        html.theme-dark body .student-item:hover { background: #1e293b !important; border-color: #475569 !important; }
        html.theme-dark body .qr-card, html.theme-dark body .qr-thumb { background: #243247 !important; border-color: #334155 !important; }
        html.theme-dark body .info-box.active { border-color: #60a5fa !important; }
        html.theme-dark body .card:hover { border-color: #475569 !important; box-shadow: 0 2px 12px rgba(0, 0, 0, .4) !important; }
        html.theme-dark body .live-pulse { color: #f87171 !important; }

        html.theme-dark body .alert-success { background: #14532d !important; border-color: #166534 !important; color: #86efac !important; }
        html.theme-dark body .alert-danger  { background: #7f1d1d !important; border-color: #991b1b !important; color: #fca5a5 !important; }
        html.theme-dark body .alert-warning { background: #78350f !important; border-color: #92400e !important; color: #fcd34d !important; }
        html.theme-dark body .alert-info    { background: #0c4a6e !important; border-color: #075985 !important; color: #7dd3fc !important; }

        html.theme-dark body .text-muted { color: var(--muted) !important; }
        html.theme-dark body .fun-box .icon-circle { background: rgba(67, 97, 238, .18) !important; color: #a5b4fc !important; }
        html.theme-dark body .info-box-number { color: #f1f5f9 !important; }
        html.theme-dark body .info-box-text { color: #94a3b8 !important; }
        html.theme-dark body .filter-label { color: #94a3b8 !important; }

        html.theme-dark body ::-webkit-scrollbar-track { background: #0f172a; }
        html.theme-dark body ::-webkit-scrollbar-thumb { background: #475569; }
        html.theme-dark body ::-webkit-scrollbar-thumb:hover { background: #64748b; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            html body .content-header h1 { font-size: 1.2rem !important; }
            html body .card-body { padding: 14px !important; }
            html body .table td, html body .table th { padding: 7px 6px !important; font-size: 12px !important; }
            html body .btn { font-size: 13px !important; padding: 7px 12px !important; }
        }
 </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed"
      style="font-family: 'Source Sans Pro', 'Segoe UI', system-ui, -apple-system, sans-serif;">

<div class="wrapper">

 <?= $this->include('theme/navbar') ?>
 <?= $this->include('theme/sidebar') ?>
 <?= $this->renderSection('content') ?>

 <!-- ===== FOOTER ===== -->
 <footer class="main-footer no-print"
            style="background: #111827 !important;
                   border-top: 1px solid #1f2937;
                   color: rgba(226,232,240,0.6) !important;
                   padding: 14px 20px !important;
                   font-family: 'Source Sans Pro', 'Segoe UI', system-ui, sans-serif !important;
                   position: relative;
                   z-index: 1;">
 <div class="container-fluid">
 <div class="row align-items-center">
 <div class="col-md-6 text-center text-md-left">
 <span style="color: rgba(226,232,240,0.75); font-weight: 600;">
                        &copy; <?= date('Y') ?> Scan2Fetch
 </span>
 </div>
 <div class="col-md-6 text-center text-md-right">
 <span style="color: rgba(226,232,240,0.4); font-size: 12px;">
                        All rights reserved &nbsp;|&nbsp; Version 1.0
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

<!-- ===== THEME SWITCHER LOGIC ===== -->
<script>
$(function(){
    function applyTheme(theme) {
        document.documentElement.classList.toggle('theme-dark', theme === 'dark');
        $('.theme-opt').removeClass('active');
        $('.theme-opt[data-theme="' + theme + '"]').addClass('active');
        try { localStorage.setItem('scan2fetch-theme', theme); } catch (e) {}
    }

    var saved = 'light';
    try { saved = localStorage.getItem('scan2fetch-theme') || 'light'; } catch (e) {}
    applyTheme(saved);

    $('.theme-opt').on('click', function(){
        applyTheme($(this).data('theme'));
    });
});

// ===== MESSAGES UNREAD BADGE (updates every 20s on every page) =====
$(function(){
    function refreshMsgBadges() {
        $.getJSON('/messages/unread', function(d) {
            var n = (d && d.count) ? d.count : 0;
            $('.msg-badge').text(n).toggle(n > 0);
        });
    }
    refreshMsgBadges();
    setInterval(refreshMsgBadges, 20000);
});
</script>

<?= $this->renderSection('scripts') ?>

</body>
</html>