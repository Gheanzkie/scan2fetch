<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SOFT PASTEL CHILD-FRIENDLY THEME - ACTIVITY LOGS ===== */
:root {
    --soft-blue: #a8c0ff;
    --soft-purple: #3f2b96;
    --soft-pink: #f093fb;
    --soft-rose: #f5576c;
    --soft-teal: #4facfe;
    --soft-green: #81c784;
    --soft-orange: #ffb74d;
    --soft-yellow: #ffd54f;
}

body {
    background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%) !important;
    color: #3d3d5c !important;
}

.content-wrapper {
    background: transparent !important;
}

/* ===== CARDS ===== */
.card {
    border-radius: 25px !important;
    border: 1px solid rgba(255,255,255,0.6) !important;
    background: rgba(255,255,255,0.7) !important;
    backdrop-filter: blur(15px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.04) !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.06) !important;
}

.card-header {
    background: rgba(255,255,255,0.5) !important;
    border-bottom: 1px solid rgba(255,255,255,0.3) !important;
    padding: 1rem 1.5rem !important;
}

.card-header h5 {
    color: #4a4a6a !important;
    font-weight: 700 !important;
    font-size: 1.1rem !important;
}

.card-footer {
    background: rgba(255,255,255,0.3) !important;
    border-top: 1px solid rgba(255,255,255,0.3) !important;
}

.card-footer small {
    color: #7a7a9a !important;
}

/* ===== INFO BOX ===== */
.info-box {
    border-radius: 20px !important;
    border: 1px solid rgba(255,255,255,0.5) !important;
    background: rgba(255,255,255,0.6) !important;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
}

.info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.06) !important;
}

.info-box .info-box-content {
    color: #3d3d5c !important;
}

.info-box .info-box-text {
    color: #7a7a9a !important;
    font-size: 14px !important;
    font-weight: 500 !important;
}

.info-box .info-box-number {
    color: #3d3d5c !important;
    font-size: 24px !important;
    font-weight: 700 !important;
}

.info-box-icon {
    width: 60px !important;
    height: 60px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1.5rem !important;
    border-radius: 15px !important;
    color: #fff !important;
}

/* ===== TABLE ===== */
.table {
    color: #2d2d4a !important;  /* FIXED: Dark text for whole table */
}

/* ===== TABLE HEADER ===== */
.table thead.bg-light {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink)) !important;
}

.table thead th {
    color: #2d2d4a !important;  /* DARK TEXT - HINDI PUTI */
    font-weight: 700 !important;
    border-bottom: none !important;
    padding: 14px 10px !important;
    font-size: 13px !important;
    white-space: nowrap;
}

/* ===== TABLE BODY - ALL DARK TEXT ===== */
.table tbody tr {
    border-bottom: 1px solid rgba(160,160,180,0.06) !important;
    transition: all 0.3s ease !important;
}

.table tbody tr:hover {
    background: rgba(168,192,255,0.06) !important;
    transform: scale(1.01);
}

.table tbody td {
    color: #2d2d4a !important;  /* DARK TEXT */
    vertical-align: middle !important;
    border-top: none !important;
    padding: 12px 10px !important;
    font-size: 13px !important;
}

.table tbody td strong {
    color: #2d2d4a !important;  /* DARK TEXT for strong */
}

.table tbody td .text-muted {
    color: #7a7a9a !important;
}

/* ===== BADGES ===== */
.badge {
    font-weight: 500 !important;
    padding: 5px 14px !important;
    border-radius: 50px !important;
    font-size: 12px !important;
}

.badge-light {
    background: rgba(160,160,180,0.1) !important;
    color: #5a5a7a !important;
}

.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }
.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-danger { background: var(--soft-rose) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-dark { background: rgba(160,160,180,0.15) !important; color: #4a4a6a !important; }
.badge-secondary { background: rgba(160,160,180,0.08) !important; color: #7a7a9a !important; }

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    padding: 8px 20px !important;
    font-size: 13px !important;
}

.btn:hover {
    transform: translateY(-3px) scale(1.03);
}

.btn-group .btn {
    border-radius: 50px !important;
    border: 1px solid rgba(160,160,180,0.15) !important;
    background: rgba(255,255,255,0.5) !important;
    color: #7a7a9a !important;
    transition: all 0.3s ease !important;
    font-weight: 500 !important;
    padding: 8px 18px !important;
    font-size: 13px !important;
}

.btn-group .btn:hover {
    background: rgba(168,192,255,0.1) !important;
    color: var(--soft-purple) !important;
}

.btn-group .btn.active {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    color: #fff !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 4px 15px rgba(63,43,150,0.2) !important;
}

.btn-outline-primary {
    border-color: rgba(168,192,255,0.3) !important;
    color: #5a5a8a !important;
}

.btn-outline-primary.active {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    color: #fff !important;
    border-color: var(--soft-blue) !important;
}

.btn-outline-success {
    border-color: rgba(129,199,132,0.3) !important;
    color: #5a7a5a !important;
}

.btn-outline-success.active {
    background: var(--soft-green) !important;
    color: #fff !important;
    border-color: var(--soft-green) !important;
}

.btn-outline-danger {
    border-color: rgba(245,87,108,0.3) !important;
    color: #8a5a5a !important;
}

.btn-outline-danger.active {
    background: var(--soft-rose) !important;
    color: #fff !important;
    border-color: var(--soft-rose) !important;
}

.btn-outline-warning {
    border-color: rgba(255,183,77,0.3) !important;
    color: #8a7a4a !important;
}

.btn-outline-warning.active {
    background: var(--soft-orange) !important;
    color: #fff !important;
    border-color: var(--soft-orange) !important;
}

.btn-outline-dark {
    border-color: rgba(160,160,180,0.2) !important;
    color: #7a7a9a !important;
}

.btn-outline-dark.active {
    background: rgba(160,160,180,0.15) !important;
    color: #4a4a6a !important;
    border-color: rgba(160,160,180,0.2) !important;
}

.btn-outline-secondary {
    border-color: rgba(160,160,180,0.15) !important;
    color: #7a7a9a !important;
    background: rgba(255,255,255,0.3) !important;
}

.btn-outline-secondary:hover {
    background: rgba(168,192,255,0.08) !important;
    color: var(--soft-purple) !important;
}

/* ===== FILTERS SECTION ===== */
.filter-section {
    background: rgba(255,255,255,0.5);
    border-radius: 18px;
    padding: 18px 20px 12px 20px;
    margin-bottom: 20px;
    border: 1px solid rgba(255,255,255,0.4);
}

.filter-section .filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: flex-end;
}

.filter-section .filter-item {
    flex: 1;
    min-width: 160px;
}

.filter-section .filter-item-sm {
    flex: 0 0 auto;
    min-width: 100px;
}

.filter-section .filter-label {
    font-size: 13px;
    font-weight: 600;
    color: #5a5a7a;
    margin-bottom: 6px;
    display: block;
}

/* ===== FORM CONTROLS ===== */
.form-control {
    background: rgba(255,255,255,0.6) !important;
    border: 2px solid rgba(160,160,180,0.12) !important;
    color: #3d3d5c !important;
    border-radius: 12px !important;
    padding: 10px 16px !important;
    transition: all 0.3s ease !important;
    font-size: 14px !important;
    height: 42px !important;
}

.form-control:focus {
    background: rgba(255,255,255,0.9) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(168,192,255,0.12) !important;
    color: #3d3d5c !important;
}

.form-control::placeholder {
    color: #b0b0c8 !important;
}

.form-control-sm {
    border-radius: 10px !important;
    padding: 8px 14px !important;
    font-size: 13px !important;
    height: 36px !important;
}

select.form-control {
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b6b8d' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 36px !important;
    cursor: pointer;
}

select.form-control option {
    background: #ffffff !important;
    color: #3d3d5c !important;
    padding: 8px !important;
}

.input-group-text {
    background: rgba(255,255,255,0.4) !important;
    border: 2px solid rgba(160,160,180,0.12) !important;
    border-right: none !important;
    color: #7a7a9a !important;
    border-radius: 12px 0 0 12px !important;
    font-size: 14px !important;
}

.input-group .form-control {
    border-radius: 0 12px 12px 0 !important;
    border-left: none !important;
}

.input-group .form-control:focus {
    border-left: none !important;
}

/* ===== BREADCRUMB ===== */
.breadcrumb {
    background: transparent !important;
    padding: 0 !important;
}

.breadcrumb-item a {
    color: #7a7a9a !important;
    transition: color 0.3s ease !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    font-size: 14px !important;
}

.breadcrumb-item a:hover {
    color: var(--soft-purple) !important;
}

.breadcrumb-item.active {
    color: #4a4a6a !important;
    font-weight: 600 !important;
    font-size: 14px !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: #c0c0d8 !important;
    content: "›" !important;
}

/* ===== CONTENT HEADER ===== */
.content-header h1 {
    color: #3d3d5c !important;
    font-weight: 700 !important;
    font-size: 2rem !important;
}

.content-header h1 i {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== EMPTY STATE ===== */
.text-center.py-5 {
    color: #b0b0c8 !important;
}

.text-center.py-5 h5 {
    color: #7a7a9a !important;
}

.text-center.py-5 i {
    color: rgba(160,160,180,0.15) !important;
}

.text-center.py-5 p {
    color: #b0b0c8 !important;
}

/* ===== DESCRIPTION CELL ===== */
.desc-cell {
    max-width: 400px;
    word-wrap: break-word;
    white-space: normal;
    line-height: 1.5;
}

/* ===== SCROLLBAR ===== */
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

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .filter-section .filter-item {
        min-width: 140px;
    }
}

@media (max-width: 768px) {
    .card-body {
        padding: 1rem !important;
    }
    .content-header h1 {
        font-size: 1.5rem !important;
    }
    .table td, .table th {
        padding: 8px 4px !important;
        font-size: 11px !important;
    }
    .info-box .info-box-number {
        font-size: 18px !important;
    }
    .btn-group .btn {
        font-size: 11px !important;
        padding: 4px 10px !important;
    }
    .filter-section {
        padding: 12px 15px 8px 15px !important;
    }
    .filter-section .filter-item {
        min-width: 100% !important;
        flex: 1 1 100% !important;
    }
    .filter-section .filter-item-sm {
        min-width: 100% !important;
        flex: 1 1 100% !important;
    }
    .desc-cell {
        max-width: 150px;
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
    .badge {
        font-size: 9px !important;
        padding: 3px 8px !important;
    }
    .btn {
        font-size: 10px !important;
        padding: 4px 10px !important;
    }
    .desc-cell {
        max-width: 100px;
        font-size: 10px !important;
    }
}
</style>

<div class="content-wrapper" style="background: transparent;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-history mr-2"></i>
                        Activity Logs 📋
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item active">📋 Activity Logs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <?php 
            $f = $_GET['filter'] ?? 'today'; 
            $m = $_GET['module'] ?? ''; 
            $d = $_GET['date'] ?? date('Y-m-d'); 
            ?>

            <!-- ===== QUICK STATS ===== -->
            <div class="row">
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple));">
                            <i class="fas fa-list"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">📊 Total Logs</span>
                            <span class="info-box-number" id="totalCount"><?= count($logs ?? []) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-green), #43a047);">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">✅ Releases</span>
                            <span class="info-box-number" id="releaseCount"><?= count(array_filter($logs ?? [], function($l){ return ($l['action']??'') == 'release'; })) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-rose), #d32f2f);">
                            <i class="fas fa-times-circle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">❌ Declined</span>
                            <span class="info-box-number" id="declineCount"><?= count(array_filter($logs ?? [], function($l){ return ($l['action']??'') == 'decline'; })) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-teal), #00897b);">
                            <i class="fas fa-calendar-day"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">📅 Today</span>
                            <span class="info-box-number"><?= count(array_filter($logs ?? [], function($l){ return date('Y-m-d', strtotime($l['created_at']??'')) == date('Y-m-d'); })) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== FILTERS ===== -->
            <div class="filter-section">
                <form method="get" action="<?= base_url('logs') ?>" id="filterForm">
                    <div class="filter-row">
                        <!-- Date Filters -->
                        <div class="filter-item">
                            <label class="filter-label">📅 Date Filter</label>
                            <div class="btn-group btn-group-sm" style="flex-wrap: wrap; gap: 4px;">
                                <a href="<?= base_url('logs?filter=today') ?>" class="btn <?= ($f == 'today') ? 'active' : 'btn-outline-primary' ?>">Today</a>
                                <a href="<?= base_url('logs?filter=yesterday') ?>" class="btn <?= ($f == 'yesterday') ? 'active' : 'btn-outline-primary' ?>">Yesterday</a>
                                <a href="<?= base_url('logs?filter=week') ?>" class="btn <?= ($f == 'week') ? 'active' : 'btn-outline-primary' ?>">Week</a>
                                <a href="<?= base_url('logs?filter=month') ?>" class="btn <?= ($f == 'month') ? 'active' : 'btn-outline-primary' ?>">Month</a>
                                <a href="<?= base_url('logs') ?>" class="btn <?= ($f == '' || $f == 'all') ? 'active' : 'btn-outline-primary' ?>">All</a>
                            </div>
                        </div>

                        <!-- Action Filters -->
                        <div class="filter-item">
                            <label class="filter-label">⚡ Action</label>
                            <div class="btn-group btn-group-sm" style="flex-wrap: wrap; gap: 4px;">
                                <a href="<?= base_url('logs?filter=release') ?>" class="btn <?= ($f == 'release') ? 'active' : 'btn-outline-success' ?>">✅ Releases</a>
                                <a href="<?= base_url('logs?filter=decline') ?>" class="btn <?= ($f == 'decline') ? 'active' : 'btn-outline-danger' ?>">❌ Declined</a>
                                <a href="<?= base_url('logs?filter=create') ?>" class="btn <?= ($f == 'create') ? 'active' : 'btn-outline-warning' ?>">➕ Created</a>
                                <a href="<?= base_url('logs?filter=delete') ?>" class="btn <?= ($f == 'delete') ? 'active' : 'btn-outline-dark' ?>">🗑️ Deleted</a>
                            </div>
                        </div>
                    </div>

                    <div class="filter-row" style="margin-top: 10px;">
                        <!-- Module -->
                        <div class="filter-item">
                            <label class="filter-label">📦 Module</label>
                            <select name="module" class="form-control form-control-sm" onchange="this.form.submit()">
                                <option value="">All Modules</option>
                                <option value="auth" <?= ($m == 'auth') ? 'selected' : '' ?>>Auth</option>
                                <option value="student" <?= ($m == 'student') ? 'selected' : '' ?>>Students</option>
                                <option value="parent" <?= ($m == 'parent') ? 'selected' : '' ?>>Parents</option>
                                <option value="sub_fetcher" <?= ($m == 'sub_fetcher') ? 'selected' : '' ?>>Sub-Fetchers</option>
                                <option value="staff" <?= ($m == 'staff') ? 'selected' : '' ?>>Staffs</option>
                                <option value="authorization" <?= ($m == 'authorization') ? 'selected' : '' ?>>Authorization</option>
                                <option value="scan" <?= ($m == 'scan') ? 'selected' : '' ?>>QR Scan</option>
                            </select>
                        </div>

                        <!-- Date Picker -->
                        <div class="filter-item">
                            <label class="filter-label">📅 Specific Date</label>
                            <input type="date" name="date" class="form-control form-control-sm" value="<?= $d ?>" onchange="this.form.submit()">
                        </div>

                        <!-- Reset & Refresh -->
                        <div class="filter-item-sm">
                            <label class="filter-label">&nbsp;</label>
                            <div style="display: flex; gap: 6px;">
                                <a href="<?= base_url('logs') ?>" class="btn btn-outline-secondary btn-sm" style="flex:1;">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="location.reload()" title="Refresh">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ===== TABLE ===== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h5 class="mb-0">
                                    <i class="fas fa-list mr-2" style="color: var(--soft-blue);"></i>
                                    System Activity 📋
                                    <span class="badge" style="background: rgba(160,160,180,0.1); color: #7a7a9a; margin-left: 8px; font-weight: 600; font-size: 12px; padding: 6px 14px;">
                                        <?= count($logs ?? 0) ?>
                                    </span>
                                </h5>
                                <small style="color: #b0b0c8; font-size: 12px;">
                                    <?php if ($f == 'today'): ?>📅 Showing today's logs
                                    <?php elseif ($f == 'yesterday'): ?>📆 Showing yesterday's logs
                                    <?php elseif ($f == 'week'): ?>📊 Showing this week's logs
                                    <?php elseif ($f == 'month'): ?>📈 Showing this month's logs
                                    <?php elseif ($f != '' && $f != 'all'): ?>🔍 Filtered by: <?= ucfirst($f) ?>
                                    <?php else: ?>📋 Showing all logs
                                    <?php endif; ?>
                                    <?= $m ? ' | Module: ' . ucfirst(str_replace('_', ' ', $m)) : '' ?>
                                    <?= $d ? ' | Date: ' . date('M d, Y', strtotime($d)) : '' ?>
                                </small>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:45px;">#</th>
                                            <th style="width:150px;">📅 Date/Time</th>
                                            <th style="width:120px;">👤 User</th>
                                            <th style="width:80px;">🎭 Role</th>
                                            <th style="width:100px;">⚡ Action</th>
                                            <th style="width:100px;">📦 Module</th>
                                            <th>📝 Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($logs)): $i = 1; foreach ($logs as $log): ?>
                                        <?php
                                            $role = $log['role'] ?? '';
                                            if ($role == 'admin') $rb = 'danger';
                                            elseif ($role == 'staff') $rb = 'warning';
                                            elseif ($role == 'parent') $rb = 'info';
                                            else $rb = 'secondary';

                                            $action = $log['action'] ?? '';
                                            if ($action == 'login') { $ab = 'success'; $ai = '🔑'; }
                                            elseif ($action == 'logout') { $ab = 'dark'; $ai = '🚪'; }
                                            elseif (in_array($action, ['create', 'register'])) { $ab = 'primary'; $ai = '➕'; }
                                            elseif ($action == 'update') { $ab = 'warning'; $ai = '✏️'; }
                                            elseif ($action == 'delete') { $ab = 'danger'; $ai = '🗑️'; }
                                            elseif ($action == 'release') { $ab = 'success'; $ai = '✅'; }
                                            elseif ($action == 'decline') { $ab = 'danger'; $ai = '❌'; }
                                            elseif ($action == 'approve') { $ab = 'info'; $ai = '👍'; }
                                            else { $ab = 'secondary'; $ai = '•'; }
                                        ?>
                                        <tr>
                                            <td style="color: #b0b0c8; font-size: 12px; font-weight: 700;"><?= $i++ ?></td>
                                            <td style="color: #7a7a9a; font-size: 12px;"><?= date('M d, Y h:i A', strtotime($log['created_at'])) ?></td>
                                            <td style="color: #2d2d4a; font-weight: 600;"><?= esc($log['user_name'] ?? 'System') ?></td>
                                            <td><span class="badge badge-<?= $rb ?>"><?= ucfirst($role ?: '—') ?></span></td>
                                            <td><span class="badge badge-<?= $ab ?>"><?= $ai ?> <?= ucfirst($action) ?></span></td>
                                            <td><span class="badge badge-light"><?= ucfirst(str_replace('_', ' ', $log['module'] ?? '')) ?></span></td>
                                            <td class="desc-cell" style="color: #2d2d4a; font-size: 13px;">
                                                <?= esc($log['description'] ?? '') ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <i class="fas fa-clipboard-list fa-3x mb-3 d-block" style="color: rgba(160,160,180,0.15);"></i>
                                                <h5 style="color: #7a7a9a;">No activity logs found</h5>
                                                <p style="color: #b0b0c8; font-size: 14px;">Perform actions in the system to see logs here. ✨</p>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if (!empty($logs) && count($logs) >= 200): ?>
                        <div class="card-footer text-center py-2">
                            <small style="color: #b0b0c8;">Showing latest 200 records. Use filters for more specific results.</small>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Auto-refresh every 60 seconds for today's logs only
var idleTime = 0;
var refreshInterval = 60000;

setInterval(function() {
    idleTime += 1000;
    if (idleTime >= refreshInterval && !document.querySelector(':focus')) {
        var url = new URL(window.location.href);
        if (url.searchParams.get('filter') === 'today' || !url.searchParams.get('filter')) {
            location.reload();
        }
    }
}, 1000);

$(document).on('mousemove keypress click scroll', function() {
    idleTime = 0;
});
</script>
<?= $this->endSection() ?>