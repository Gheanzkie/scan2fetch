<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SHARED PROFESSIONAL PASTEL THEME - SCAN MONITOR ===== */
:root {
    --soft-blue: #a8c0ff;
    --soft-purple: #3f2b96;
    --soft-pink: #f093fb;
    --soft-rose: #f5576c;
    --soft-teal: #4facfe;
    --soft-green: #81c784;
    --soft-orange: #ffb74d;
    --soft-yellow: #ffd54f;
    --ink: #3d3d5c;
    --muted: #7a7a9a;
    --faint: #b0b0c8;
}

body {
    background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%) !important;
    color: var(--ink) !important;
}

.content-wrapper { background: transparent !important; position: relative; z-index: 1; }

/* ===== CONTENT HEADER ===== */
.content-header h1 {
    color: var(--ink) !important;
    font-weight: 700 !important;
    font-size: 1.7rem !important;
}

.content-header h1 i {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.live-pulse {
    display: inline-block;
    color: var(--soft-rose);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
}

/* ===== BREADCRUMB ===== */
.breadcrumb { background: transparent !important; padding: 0 !important; }

.breadcrumb-item a {
    color: var(--muted) !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    text-decoration: none !important;
    transition: color 0.25s ease !important;
}

.breadcrumb-item a:hover { color: var(--soft-purple) !important; }
.breadcrumb-item.active { color: var(--ink) !important; font-weight: 700 !important; font-size: 13px !important; }
.breadcrumb-item + .breadcrumb-item::before { color: var(--faint) !important; content: "›" !important; }

/* ===== CARDS ===== */
.card {
    border-radius: 22px !important;
    border: 1px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.78) !important;
    box-shadow: 0 8px 30px rgba(63,43,150,0.05) !important;
    overflow: hidden !important;
    margin-bottom: 16px;
}

.card-header {
    background: rgba(255,255,255,0.6) !important;
    border-bottom: 1px solid rgba(63,43,150,0.06) !important;
    padding: 1rem 1.5rem !important;
}

.card-header h5 { color: var(--ink) !important; font-weight: 700 !important; font-size: 1.05rem !important; margin: 0; }
.card-body { padding: 1.4rem !important; }

/* ===== STAT INFO BOXES ===== */
.info-box {
    border-radius: 18px !important;
    border: 1px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.7) !important;
    transition: border-color 0.25s ease, box-shadow 0.25s ease !important;
    box-shadow: 0 4px 18px rgba(63,43,150,0.04) !important;
    padding: 16px 18px !important;
    cursor: pointer;
    height: 100%;
}

.info-box:hover { box-shadow: 0 8px 25px rgba(63,43,150,0.12) !important; }

.info-box .info-box-number {
    font-size: 28px !important;
    font-weight: 700 !important;
    color: var(--ink) !important;
    line-height: 1.1;
}

.info-box .info-box-text {
    color: var(--muted) !important;
    font-size: 13px !important;
    font-weight: 600 !important;
}

.info-box-icon {
    width: 48px !important;
    height: 48px !important;
    flex-shrink: 0;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1.2rem !important;
    border-radius: 14px !important;
    color: #fff !important;
}

.info-box.active {
    border: 2px solid var(--soft-blue) !important;
    box-shadow: 0 4px 20px rgba(168,192,255,0.30) !important;
}

/* ===== FILTER PANELS ===== */
.date-selector {
    background: rgba(255,255,255,0.7);
    border-radius: 16px;
    padding: 14px 18px;
    margin-bottom: 16px;
    border: 1px solid rgba(168,192,255,0.20);
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
}

.date-selector .form-control {
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    color: #334155;
    background: #fff;
    width: auto;
    min-width: 160px;
    height: 40px;
}

.date-selector .form-control:focus {
    border-color: #4361ee;
    box-shadow: 0 0 0 3px rgba(67,97,238,0.12);
}

.tab-filters {
    background: rgba(255,255,255,0.5);
    border-radius: 14px;
    padding: 12px 16px;
    margin: 12px 16px;
    border: 1px solid rgba(63,43,150,0.06);
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
}

.tab-filters .form-control {
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    padding: 8px 14px;
    font-size: 12.5px;
    color: #334155;
    background: #fff;
    min-width: 150px;
    height: 40px;
}

.tab-filters .form-control:focus {
    border-color: #4361ee;
    box-shadow: 0 0 0 3px rgba(67,97,238,0.12);
}

.tab-content { display: none; }
.tab-content.active { display: block; }

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 700 !important;
    transition: box-shadow 0.25s ease, color 0.25s ease, background 0.25s ease, border-color 0.25s ease !important;
}

.btn-kid-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(63,43,150,0.20) !important;
}

.btn-kid-primary:hover { box-shadow: 0 8px 25px rgba(63,43,150,0.30) !important; color: #fff !important; }

.btn-kid-warning {
    background: linear-gradient(135deg, var(--soft-orange), #f57c00) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(255,183,77,0.30) !important;
}

.btn-kid-warning:hover { box-shadow: 0 8px 25px rgba(255,183,77,0.45) !important; color: #fff !important; }

.btn-outline-kid {
    border: 1.5px solid rgba(63,43,150,0.15) !important;
    color: var(--muted) !important;
    background: rgba(255,255,255,0.4) !important;
}

.btn-outline-kid:hover {
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
    background: rgba(168,192,255,0.10) !important;
}

.btn-outline-kid.active {
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
    background: rgba(168,192,255,0.15) !important;
}

.btn-sm { padding: 7px 16px !important; font-size: 12.5px !important; }

/* ===== TABLE ===== */
.table {
    color: var(--ink) !important;
    font-size: 13px !important;
    margin-bottom: 0;
}

.table thead {
    background: rgba(168,192,255,0.12) !important;
}

.table thead th {
    color: var(--muted) !important;
    font-weight: 700 !important;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    font-size: 11.5px !important;
    border-bottom: none !important;
    padding: 12px 16px !important;
    white-space: nowrap;
}

.table tbody tr {
    border-bottom: 1px solid rgba(63,43,150,0.06) !important;
    transition: background 0.25s ease !important;
}

.table tbody tr:hover { background: rgba(168,192,255,0.05) !important; }

.table tbody td {
    color: var(--ink) !important;
    vertical-align: middle !important;
    padding: 10px 16px !important;
    font-size: 12.5px !important;
}

.table td strong { color: var(--ink) !important; }
.table td small { color: var(--muted) !important; }

/* ===== BADGES ===== */
.badge {
    font-weight: 700 !important;
    padding: 6px 14px !important;
    border-radius: 50px !important;
    font-size: 11.5px !important;
}

.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-danger { background: var(--soft-rose) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }
.badge-light { background: rgba(168,192,255,0.15) !important; color: #5a5280 !important; }

/* ===== SMS PANEL ===== */
.sms-btn-container {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    background: rgba(255,183,77,0.10);
    border-radius: 14px;
    margin: 12px 16px 0 16px;
    border: 1px solid rgba(255,183,77,0.25);
}

.sms-mode-label {
    font-size: 12px;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.sms-settings {
    min-width: 210px;
}

#smsModeBtn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    border-radius: 6px !important;
    padding: 7px 18px !important;
    font-size: 12.5px !important;
    font-weight: 700 !important;
    color: #475569 !important;
    border: 1px solid #cbd5e1 !important;
    background: #fff !important;
    cursor: pointer;
    white-space: nowrap;
}

#smsModeBtn strong { color: #0f172a; }

.sms-mode-panel {
    width: 100%;
    max-width: 440px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px;
    margin: 0 16px 12px 16px;
    box-shadow: 0 2px 10px rgba(15, 23, 42, .08);
}

html.theme-dark .sms-mode-panel { background: #1e293b; border-color: #334155; }

.sms-panel-title {
    font-size: 13px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e2e8f0;
}

.sms-radio-row {
    display: flex;
    gap: 8px;
    margin-bottom: 12px;
}

.sms-radio {
    flex: 1;
    text-align: center;
    cursor: pointer;
}

.sms-radio input { display: none; }

.sms-radio span {
    display: block;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 12.5px;
    font-weight: 700;
    color: #64748b;
    border: 1px solid #cbd5e1;
    background: #fff;
    transition: all .15s ease;
}

.sms-radio input:checked + span {
    background: #4361ee;
    color: #fff;
    border-color: #4361ee;
}

.sms-interval-row {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 4px;
}

.sms-interval-row > label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 8px;
}

.sms-interval-row .form-control {
    max-width: 90px;
    text-align: center;
    font-weight: 700;
}

.sms-interval-row span {
    font-size: 12.5px;
    font-weight: 600;
    color: var(--muted);
}

.sms-sched-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
}

.sms-sched-row .form-control {
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    font-size: 13px;
    font-weight: 600;
    color: #334155;
    background: #fff;
    height: 40px;
    padding: 4px 10px;
    width: auto;
}

#smsSchedDate { flex: 1; min-width: 150px; }
#smsSchedHour, #smsSchedMinute, #smsSchedAmpm { min-width: 74px; }

.sms-next-send {
    margin-top: 10px;
    padding: 8px 12px;
    border-radius: 50px;
    background: rgba(168,192,255,0.15);
    font-size: 12px;
    font-weight: 600;
    color: var(--soft-purple);
}

.sms-done-send {
    margin-top: 10px;
    padding: 8px 12px;
    border-radius: 50px;
    background: rgba(126,217,87,0.15);
    font-size: 12px;
    font-weight: 600;
    color: var(--soft-green);
}

.sms-hint {
    display: block;
    margin-top: 8px;
    font-size: 11px;
    color: var(--faint);
    line-height: 1.4;
}

.sms-help {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: var(--muted);
    padding: 8px 18px 12px 18px;
    margin: 0 16px 6px 16px;
    border-left: 3px solid var(--soft-blue);
    border-radius: 0 10px 10px 0;
    background: rgba(168,192,255,0.08);
}

.sms-help .auto-ok {
    color: var(--soft-green);
    font-weight: 700;
}

/* ===== EMPTY STATE ===== */
.empty-state { color: var(--faint) !important; }
.empty-state i { color: rgba(168,192,255,0.35) !important; }
.empty-state p, .empty-table { color: var(--faint) !important; }

/* ===== ALERTS ===== */
.alert {
    border-radius: 16px !important;
    padding: 14px 20px !important;
    font-size: 13.5px !important;
    border: 1.5px solid transparent !important;
    font-weight: 600 !important;
}

.alert-warning {
    background: rgba(255,183,77,0.12) !important;
    border-color: rgba(255,183,77,0.22) !important;
    color: #7a5a1e !important;
}

/* ===== MODAL ===== */
.modal-content {
    border-radius: 20px !important;
    border: 1px solid rgba(255,255,255,0.8) !important;
    background: rgba(255,255,255,0.97) !important;
    box-shadow: 0 20px 60px rgba(63,43,150,0.12) !important;
}

.modal-header {
    border-bottom: 1px solid rgba(63,43,150,0.06) !important;
    border-radius: 20px 20px 0 0 !important;
    background: rgba(255,255,255,0.6) !important;
    padding: 1rem 1.5rem !important;
}

.modal-header h5 { color: var(--ink) !important; font-weight: 700 !important; font-size: 1.05rem !important; }

.modal-footer {
    border-top: 1px solid rgba(63,43,150,0.06) !important;
    border-radius: 0 0 20px 20px !important;
    background: rgba(255,255,255,0.5) !important;
    padding: 0.9rem 1.5rem !important;
}

.modal-body { padding: 1.5rem !important; }

.modal-body h4 { color: var(--ink) !important; }
.modal-body p { color: var(--muted) !important; }

.modal textarea.form-control {
    background: rgba(255,255,255,0.8) !important;
    border: 1.5px solid rgba(63,43,150,0.10) !important;
    color: var(--ink) !important;
    border-radius: 12px !important;
    padding: 10px 14px !important;
    transition: border-color 0.25s ease, box-shadow 0.25s ease !important;
    font-size: 13.5px !important;
}

.modal textarea.form-control:focus {
    background: rgba(255,255,255,0.95) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(168,192,255,0.15) !important;
    color: var(--ink) !important;
}

.list-group-item {
    background: rgba(255,255,255,0.5) !important;
    border-color: rgba(63,43,150,0.08) !important;
    color: var(--ink) !important;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .content-header h1 { font-size: 1.35rem !important; }
    .card-body { padding: 1rem !important; }
    .table td, .table th { padding: 8px 10px !important; font-size: 11px !important; }
    .info-box { padding: 12px 14px !important; }
    .info-box .info-box-number { font-size: 22px !important; }
    .date-selector { flex-direction: column; align-items: stretch; }
    .date-selector .form-control { width: 100% !important; }
    .tab-filters { flex-direction: column; align-items: stretch; }
    .tab-filters .form-control { width: 100% !important; }
    .sms-btn-container { flex-direction: column; align-items: stretch; text-align: center; }
}

@media (max-width: 480px) {
    .card { border-radius: 16px !important; }
    .table td, .table th { font-size: 10px !important; padding: 6px 8px !important; }
    .badge { font-size: 10px !important; padding: 4px 10px !important; }
}
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-qrcode mr-2"></i>
                        Scan Monitor
 <?php if($isToday ?? false): ?>
 <span class="live-pulse">● LIVE</span>
 <?php endif; ?>
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item active">Scan Monitor</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">

 <div id="alertArea" style="display:none;"></div>

 <!-- ===== DATE SELECTOR ===== -->
 <div class="date-selector">
 <div class="d-flex align-items-center" style="gap:10px;flex-wrap:wrap;">
 <i class="far fa-calendar-alt" style="color:var(--soft-blue);font-size:18px;"></i>
 <span style="font-weight:600;color:var(--ink);font-size:14px;">Select Date:</span>
 <form method="GET" action="<?= base_url('scan-monitor') ?>" style="display:inline-block;">
 <input type="date" 
                               name="date" 
                               class="form-control" 
                               value="<?= $selectedDate ?? date('Y-m-d') ?>"
                               onchange="this.form.submit()"
                               style="min-width:180px;display:inline-block;">
 </form>
 <span style="color:var(--muted);font-size:13px;font-weight:600;">
 <?= date('F d, Y', strtotime($selectedDate ?? date('Y-m-d'))) ?>
 </span>
 <?php if($isToday ?? false): ?>
 <span class="badge badge-success">Today</span>
 <?php endif; ?>
 </div>
 </div>

 <!-- ===== STATS WITH CLICKABLE TABS ===== -->
 <div class="row mt-3">
 <div class="col-lg-4 col-6 mb-2">
 <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=released') ?>" style="text-decoration:none;color:inherit;">
 <div class="info-box d-flex align-items-center <?= ($activeTab ?? 'released') == 'released' ? 'active' : '' ?>">
 <span class="info-box-icon mr-3" style="background:#16a34a;">
 <i class="fas fa-check-circle"></i>
 </span>
 <div>
 <div class="info-box-text">Released</div>
 <div class="info-box-number"><?= $releasedToday ?? 0 ?></div>
 </div>
 </div>
 </a>
 </div>

 <div class="col-lg-4 col-6 mb-2">
 <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=declined') ?>" style="text-decoration:none;color:inherit;">
 <div class="info-box d-flex align-items-center <?= ($activeTab ?? 'released') == 'declined' ? 'active' : '' ?>">
 <span class="info-box-icon mr-3" style="background:#dc2626;">
 <i class="fas fa-times-circle"></i>
 </span>
 <div>
 <div class="info-box-text">Declined</div>
 <div class="info-box-number"><?= $declinedToday ?? 0 ?></div>
 </div>
 </div>
 </a>
 </div>

 <div class="col-lg-4 col-6 mb-2">
 <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=pending') ?>" style="text-decoration:none;color:inherit;">
 <div class="info-box d-flex align-items-center <?= ($activeTab ?? 'released') == 'pending' ? 'active' : '' ?>">
 <span class="info-box-icon mr-3" style="background:#d97706;">
 <i class="fas fa-clock"></i>
 </span>
 <div>
 <div class="info-box-text">Pending</div>
 <div class="info-box-number"><?= $pendingCount ?? 0 ?></div>
 </div>
 </div>
 </a>
 </div>
 </div>

 <!-- ===== TAB CONTENT ===== -->
 <div class="row">
 <div class="col-12">

 <!-- ===== RELEASED TAB ===== -->
 <div class="tab-content <?= ($activeTab ?? 'released') == 'released' ? 'active' : '' ?>" id="tab-released">
 <div class="card">
 <div class="card-header" style="border-bottom: 3px solid var(--soft-green);">
 <h5>
 <i class="fas fa-check-circle mr-2" style="color:var(--soft-green);"></i>
                                    Released Students
 <span class="badge badge-success ml-2"><?= count($releasedStudents ?? []) ?></span>
 </h5>
 </div>
 <div class="card-body p-0">
 <div class="tab-filters">
 <form method="GET" action="<?= base_url('scan-monitor') ?>" class="d-flex flex-wrap align-items-center" style="gap:8px;width:100%;">
 <input type="hidden" name="date" value="<?= $selectedDate ?? date('Y-m-d') ?>">
 <input type="hidden" name="tab" value="released">
                                        
 <div style="flex:1;min-width:150px;">
 <input type="text" 
                                                   name="search" 
                                                   class="form-control" 
                                                   placeholder="Search student or fetcher..." 
                                                   value="<?= $search ?? '' ?>">
 </div>
                                        
 <div style="min-width:130px;">
 <select name="grade" class="form-control" onchange="this.form.submit()">
 <option value="">All Grades</option>
 <?php foreach($grades ?? [] as $g): ?>
 <option value="<?= esc($g['grade_section']) ?>" <?= ($selectedGrade ?? '') == $g['grade_section'] ? 'selected' : '' ?>>
 <?= esc($g['grade_section']) ?>
 </option>
 <?php endforeach; ?>
 </select>
 </div>
                                        
 <button type="submit" class="btn btn-kid-primary btn-sm">
 <i class="fas fa-search mr-1"></i> Search
 </button>
                                        
 <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=released') ?>" 
                                           class="btn btn-outline-kid btn-sm">
 <i class="fas fa-times mr-1"></i> Clear
 </a>
 </form>
 </div>
                                
 <div style="max-height:500px;overflow-y:auto;">
 <?php if(!empty($releasedStudents)): ?>
 <table class="table table-hover">
 <thead>
 <tr>
 <th>#</th>
 <th>Student</th>
 <th>Grade</th>
 <th>Fetcher</th>
 <th>Time</th>
 </tr>
 </thead>
 <tbody>
 <?php $i = 1; foreach($releasedStudents as $r): ?>
 <tr>
 <td style="color:var(--faint);"><?= $i++ ?></td>
 <td>
 <strong>
 <?= esc($r['student_fname']) ?> <?= esc($r['student_lname']) ?>
 </strong>
 </td>
 <td><span class="badge badge-light"><?= esc($r['grade_section']) ?></span></td>
 <td style="font-size:12px;">
 <?= esc($r['fetcher_fname']) ?> <?= esc($r['fetcher_lname']) ?>
 <br><small style="color:var(--muted);"><?= esc($r['fetcher_relation'] ?? 'Parent') ?></small>
 </td>
 <td style="font-size:11.5px;color:var(--muted);">
 <?= date('h:i A', strtotime($r['time_released'])) ?>
 </td>
 </tr>
 <?php endforeach; ?>
 </tbody>
 </table>
 <?php else: ?>
 <div class="text-center py-4 empty-table">
 <i class="fas fa-inbox fa-2x mb-2 d-block empty-state"></i>
                                        No releases found
 </div>
 <?php endif; ?>
 </div>
 </div>
 </div>
 </div>

 <!-- ===== DECLINED TAB ===== -->
 <div class="tab-content <?= ($activeTab ?? 'released') == 'declined' ? 'active' : '' ?>" id="tab-declined">
 <div class="card">
 <div class="card-header" style="border-bottom: 3px solid var(--soft-rose);">
 <h5>
 <i class="fas fa-times-circle mr-2" style="color:var(--soft-rose);"></i>
                                    Declined Students
 <span class="badge badge-danger ml-2"><?= count($declinedStudents ?? []) ?></span>
 </h5>
 </div>
 <div class="card-body p-0">
 <div class="tab-filters">
 <form method="GET" action="<?= base_url('scan-monitor') ?>" class="d-flex flex-wrap align-items-center" style="gap:8px;width:100%;">
 <input type="hidden" name="date" value="<?= $selectedDate ?? date('Y-m-d') ?>">
 <input type="hidden" name="tab" value="declined">
                                        
 <div style="flex:1;min-width:150px;">
 <input type="text" 
                                                   name="search" 
                                                   class="form-control" 
                                                   placeholder="Search declined records..." 
                                                   value="<?= $search ?? '' ?>">
 </div>
                                        
 <button type="submit" class="btn btn-kid-primary btn-sm">
 <i class="fas fa-search mr-1"></i> Search
 </button>
                                        
 <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=declined') ?>" 
                                           class="btn btn-outline-kid btn-sm">
 <i class="fas fa-times mr-1"></i> Clear
 </a>
 </form>
 </div>
                                
 <div style="max-height:500px;overflow-y:auto;">
 <?php if(!empty($declinedStudents)): ?>
 <table class="table table-hover">
 <thead>
 <tr>
 <th>#</th>
 <th>Time</th>
 <th>Student</th>
 <th>Grade</th>
 <th>Fetcher</th>
 <th>Description</th>
 </tr>
 </thead>
 <tbody>
 <?php $i = 1; foreach($declinedStudents as $d): ?>
 <tr>
 <td style="color:var(--faint);"><?= $i++ ?></td>
 <td style="font-size:11.5px;color:var(--muted);">
 <?= date('h:i A', strtotime($d['created_at'])) ?>
 </td>
 <td>
 <strong>
 <?= esc($d['student_name'] ?? 'Unknown') ?>
 </strong>
 </td>
 <td><span class="badge badge-light"><?= esc($d['grade_section'] ?? '—') ?></span></td>
 <td style="font-size:12px;">
 <?= esc($d['fetcher_display'] ?? $d['user_name'] ?? '—') ?>
 <br><small style="color:var(--muted);"><?= esc($d['role'] ?? '') ?></small>
 </td>
 <td style="font-size:11.5px;color:var(--muted);"><?= esc($d['description'] ?? '—') ?></td>
 </tr>
 <?php endforeach; ?>
 </tbody>
 </table>
 <?php else: ?>
 <div class="text-center py-4 empty-table">
 <i class="fas fa-check-circle fa-2x mb-2 d-block empty-state"></i>
                                        No declined attempts for this date
 </div>
 <?php endif; ?>
 </div>
 </div>
 </div>
 </div>

 <!-- ===== PENDING TAB with SMS Button ===== -->
 <div class="tab-content <?= ($activeTab ?? 'released') == 'pending' ? 'active' : '' ?>" id="tab-pending">
 <div class="card">
 <div class="card-header d-flex justify-content-between align-items-center" style="border-bottom: 3px solid var(--soft-orange);">
 <h5>
 <i class="fas fa-clock mr-2" style="color:var(--soft-orange);"></i>
                                    Pending Students
 <span class="badge badge-warning ml-2"><?= count($pendingStudents ?? []) ?></span>
 </h5>
 <?php if($isToday ?? false): ?>
 <small style="color:var(--muted);font-size:11.5px;font-weight:600;">Waiting for pickup</small>
 <?php endif; ?>
 </div>
 <div class="card-body p-0">
 <?php if($isToday ?? false && ($pendingCount ?? 0) > 0): ?>
 <div class="sms-btn-container">
 <div style="flex:1;min-width:180px;font-size:13px;color:var(--muted);font-weight:600;">
 <i class="fas fa-info-circle mr-1" style="color:var(--soft-orange);"></i>
 <strong style="color:var(--ink);"><?= $pendingCount ?? 0 ?></strong> student(s) still waiting for pickup
 </div>
 <div class="sms-settings" id="smsSettings">
 <button class="btn btn-sm btn-outline-kid" id="smsModeBtn" type="button">
 <i class="fas fa-sliders-h mr-1"></i>
                                            SMS Mode:
 <strong id="smsModeLabel"><?= ($smsMode ?? 'manual') == 'auto' ? 'Automatic' : 'Manual' ?></strong>
 <i class="fas fa-chevron-down ml-1" id="smsModeCaret"></i>
 </button>
 </div>
 <button class="btn btn-kid-warning btn-sm" id="sendSmsBtn" <?= ($smsMode ?? 'manual') == 'auto' ? 'style="display:none;"' : '' ?>>
 <i class="fas fa-sms mr-1"></i> Notify Pending Parents
 </button>
 </div>
 <div class="sms-mode-panel" id="smsModePanel" style="display:none;">
 <div class="sms-panel-title">Auto SMS Settings</div>
 <div class="sms-radio-row">
 <label class="sms-radio <?= ($smsMode ?? 'manual') == 'manual' ? 'active' : '' ?>">
 <input type="radio" name="smsMode" value="manual" <?= ($smsMode ?? 'manual') == 'manual' ? 'checked' : '' ?>>
 <span>Manual</span>
 </label>
 <label class="sms-radio <?= ($smsMode ?? 'manual') == 'auto' ? 'active' : '' ?>">
 <input type="radio" name="smsMode" value="auto" <?= ($smsMode ?? 'manual') == 'auto' ? 'checked' : '' ?>>
 <span>Automatic</span>
 </label>
 </div>
 <div class="sms-interval-row" id="smsIntervalRow" <?= ($smsMode ?? 'manual') == 'auto' ? '' : 'style="display:none;"' ?>>
 <?php
                                            $schedDate = date('Y-m-d');
                                            $schedHour = '02';
                                            $schedMin  = '00';
                                            $schedAmpm = 'PM';
                                            if (!empty($autoSmsDatetime ?? '')) {
                                                $st = strtotime($autoSmsDatetime);
                                                if ($st) {
                                                    $schedDate = date('Y-m-d', $st);
                                                    $schedHour = date('g', $st);
                                                    $schedMin  = date('i', $st);
                                                    $schedAmpm = date('A', $st);
                                                }
                                            }
                                        ?>
 <label>Schedule auto send</label>
 <div class="sms-sched-row">
 <input type="date" class="form-control" id="smsSchedDate" min="<?= date('Y-m-d') ?>" value="<?= $schedDate ?>">
 <select class="form-control" id="smsSchedHour">
 <?php for($h = 1; $h <= 12; $h++): ?>
 <option value="<?= $h ?>" <?= (int)$schedHour == $h ? 'selected' : '' ?>> <?= sprintf('%02d', $h) ?> </option>
 <?php endfor; ?>
 </select>
 <select class="form-control" id="smsSchedMinute">
 <?php for($m = 0; $m <= 59; $m++): ?>
 <option value="<?= sprintf('%02d', $m) ?>" <?= $schedMin == sprintf('%02d', $m) ? 'selected' : '' ?>> <?= sprintf('%02d', $m) ?> </option>
 <?php endfor; ?>
 </select>
 <select class="form-control" id="smsSchedAmpm">
 <option value="AM" <?= $schedAmpm == 'AM' ? 'selected' : '' ?>>AM</option>
 <option value="PM" <?= $schedAmpm == 'PM' ? 'selected' : '' ?>>PM</option>
 </select>
 </div>
 <small class="sms-hint">Parents of not-yet-picked-up students will be notified automatically once this date and time is reached.</small>
 <div class="sms-next-send" id="smsNextSend">
 <?php if(!empty($autoSmsDatetime ?? '')): ?>
 <i class="fas fa-clock mr-1"></i> Next auto send: <strong><?= date('M d, Y h:i A', strtotime($autoSmsDatetime)) ?></strong>
 <?php endif; ?>
 </div>
 </div>
 <div class="d-flex justify-content-end" style="gap:8px;margin-top:10px;">
 <button class="btn btn-sm btn-outline-kid" id="smsModeCloseBtn" type="button">Cancel</button>
 <button class="btn btn-sm btn-kid-primary" id="saveSmsModeBtn" type="button">
 <i class="fas fa-check mr-1"></i> Save
 </button>
 </div>
 </div>
 <div class="sms-help" id="smsHelp">
 <?php if(($smsMode ?? 'manual') == 'auto'): ?>
 <i class="fas fa-magic mr-1"></i> Automatic mode is ON - parents are notified automatically at <strong><?= !empty($autoSmsDatetime ?? '') ? date('M d, Y h:i A', strtotime($autoSmsDatetime)) : 'your scheduled time' ?></strong>.
 <?php else: ?>
 <i class="fas fa-hand-pointer mr-1"></i> Manual mode - press "Notify Pending Parents" to send reminders.
 <?php endif; ?>
 <?php if(!empty($autoSmsNote ?? '')): ?>
 <span class="ml-2 auto-ok"><?= esc($autoSmsNote) ?></span>
 <?php endif; ?>
 </div>
 <?php endif; ?>
                                
 <div class="tab-filters">
 <form method="GET" action="<?= base_url('scan-monitor') ?>" class="d-flex flex-wrap align-items-center" style="gap:8px;width:100%;">
 <input type="hidden" name="date" value="<?= $selectedDate ?? date('Y-m-d') ?>">
 <input type="hidden" name="tab" value="pending">
                                        
 <div style="flex:1;min-width:150px;">
 <input type="text" 
                                                   name="search" 
                                                   class="form-control" 
                                                   placeholder="Search student or grade..." 
                                                   value="<?= $search ?? '' ?>">
 </div>
                                        
 <div style="min-width:130px;">
 <select name="grade" class="form-control" onchange="this.form.submit()">
 <option value="">All Grades</option>
 <?php foreach($grades ?? [] as $g): ?>
 <option value="<?= esc($g['grade_section']) ?>" <?= ($selectedGrade ?? '') == $g['grade_section'] ? 'selected' : '' ?>>
 <?= esc($g['grade_section']) ?>
 </option>
 <?php endforeach; ?>
 </select>
 </div>
                                        
 <button type="submit" class="btn btn-kid-primary btn-sm">
 <i class="fas fa-search mr-1"></i> Search
 </button>
                                        
 <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=pending') ?>" 
                                           class="btn btn-outline-kid btn-sm">
 <i class="fas fa-times mr-1"></i> Clear
 </a>
 </form>
 </div>
                                
 <div style="max-height:500px;overflow-y:auto;">
 <?php if(!empty($pendingStudents)): ?>
 <table class="table table-hover">
 <thead>
 <tr>
 <th>#</th>
 <th>Student</th>
 <th>Grade</th>
 <th>Parent/Guardian</th>
 <th>Contact</th>
 <?php if($isToday ?? false): ?>
 <th>Last Notified</th>
 <?php endif; ?>
 </tr>
 </thead>
 <tbody>
 <?php $i = 1; foreach($pendingStudents as $s): ?>
 <tr>
 <td style="color:var(--faint);"><?= $i++ ?></td>
 <td>
 <strong>
 <?= esc($s['fname']) ?> <?= esc($s['lname']) ?>
 </strong>
 </td>
 <td><span class="badge badge-light"><?= esc($s['grade_section']) ?></span></td>
 <td style="font-size:12px;">
 <?php if(!empty($s['parent_names']) && $s['parent_names'] !== null): ?>
 <?= esc($s['parent_names']) ?>
 <?php else: ?>
 <span style="color:var(--faint);">No parent assigned</span>
 <?php endif; ?>
 </td>
 <td style="font-size:12px;color:var(--muted);">
 <?php if(!empty($s['parent_phones']) && $s['parent_phones'] !== null): ?>
 <i class="fas fa-phone mr-1" style="color:var(--faint);font-size:10px;"></i> <?= esc($s['parent_phones']) ?>
 <?php else: ?>
 <span style="color:var(--faint);">—</span>
 <?php endif; ?>
 </td>
 <?php if($isToday ?? false): ?>
 <td style="font-size:11.5px;color:var(--muted);">
 <?php if(!empty($s['last_sms_notification'])): ?>
 <?= date('h:i A', strtotime($s['last_sms_notification'])) ?>
 <?php else: ?>
 <span style="color:var(--faint);">Not yet</span>
 <?php endif; ?>
 </td>
 <?php endif; ?>
 </tr>
 <?php endforeach; ?>
 </tbody>
 </table>
 <?php else: ?>
 <div class="text-center py-4 empty-table">
 <i class="fas fa-check-circle fa-2x mb-2 d-block empty-state"></i>
                                        All students have been released!
 </div>
 <?php endif; ?>
 </div>
 </div>
 </div>
 </div>

 </div>
 </div>

 </div>
 </section>
</div>

<!-- ===== SMS CONFIRMATION MODAL ===== -->
<div class="modal fade" id="smsConfirmModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content">
 <div class="modal-header" style="border-bottom: 3px solid var(--soft-orange);">
 <h5><i class="fas fa-sms mr-2" style="color: var(--soft-orange);"></i>Send SMS Notifications</h5>
 <button type="button" class="close" data-dismiss="modal" style="color: var(--ink);">&times;</button>
 </div>
 <div class="modal-body">
 <div class="alert alert-warning">
 <i class="fas fa-info-circle mr-1"></i>
                    You are about to send SMS reminders to <strong id="smsTotalCount" style="color:var(--ink);">0</strong> parent(s) of students who have not been picked up yet.
 </div>
                
 <div id="smsStudentList" style="max-height: 300px; overflow-y: auto;">
 <!-- List will be populated by JS -->
 </div>
                
 <div class="mt-3">
 <div class="form-group">
 <label style="color:var(--ink);font-weight:600;font-size:13px;"><i class="fas fa-pen mr-1"></i> Custom Message (Optional)</label>
 <textarea id="smsCustomMessage" class="form-control" rows="2" 
                            placeholder="Add additional message or leave blank for default..."></textarea>
 <small style="color:var(--muted);">The default message will be sent along with your custom message.</small>
 </div>
 </div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Cancel</button>
 <button type="button" class="btn btn-kid-warning btn-sm px-4" id="sendSmsConfirm">
 <i class="fas fa-paper-plane mr-1"></i> Send SMS Now
 </button>
 </div>
 </div>
 </div>
</div>

<!-- ===== SMS RESULT MODAL ===== -->
<div class="modal fade" id="smsResultModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <div class="modal-header" style="border-bottom: 3px solid var(--soft-green);">
 <h5><i class="fas fa-check-circle mr-2" style="color: var(--soft-green);"></i>SMS Sent</h5>
 <button type="button" class="close" data-dismiss="modal" style="color: var(--ink);">&times;</button>
 </div>
 <div class="modal-body text-center py-4">
 <i class="fas fa-check-circle fa-4x mb-3" style="color: var(--soft-green);"></i>
 <h4>SMS Notifications Sent!</h4>
 <p id="smsResultMessage"></p>
 <div id="smsResultDetails" style="max-height: 200px; overflow-y: auto; text-align: left; font-size: 13px;"></div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Close</button>
 </div>
 </div>
 </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
<?php if($isToday ?? false): ?>
var refreshTimer = setInterval(function() {
    if (!document.querySelector(':focus')) {
        location.reload();
    }
}, 30000);

$(document).on('focus', 'input, select', function() {
    clearInterval(refreshTimer);
}).on('blur', 'input, select', function() {
    refreshTimer = setInterval(function() {
        if (!document.querySelector(':focus')) {
            location.reload();
        }
    }, 30000);
});
<?php endif; ?>

function showAlert(message, type) {
    var alertClass = type === 'success' ? 'success' : (type === 'danger' ? 'danger' : 'warning');
    var icon = type === 'success' ? 'check-circle' : (type === 'danger' ? 'times-circle' : 'exclamation-triangle');
    var alertHtml = '<div class="alert alert-' + alertClass + ' alert-dismissible fade show">' +
        '<i class="fas fa-' + icon + ' mr-1"></i> ' + message +
        '<button type="button" class="close" data-dismiss="alert" style="color: var(--ink);">&times;</button>' +
        '</div>';
    $('#alertArea').html(alertHtml).show();
    setTimeout(function() {
        $('#alertArea').fadeOut();
    }, 5000);
}

// ===== SMS BUTTON =====
$(document).ready(function() {
    $('#sendSmsBtn').off('click').on('click', function() {
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Loading...');
        
        $.ajax({
            url: '<?= base_url('scan-monitor/get-pending-list') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success && response.students.length > 0) {
                    var html = '<ul class="list-group">';
                    response.students.forEach(function(s) {
                        html += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                        html += '<div><strong>' + s.fname + ' ' + s.lname + '</strong><br><small style="color: var(--muted);">' + s.grade_section + '</small></div>';
                        html += '<div style="text-align:right;"><span class="badge badge-info">' + s.parent_fname + ' ' + s.parent_lname + '</span><br><small style="color: var(--muted);"><i class="fas fa-phone mr-1"></i>' + s.parent_phone + '</small></div>';
                        html += '</li>';
                    });
                    html += '</ul>';
                    $('#smsStudentList').html(html);
                    $('#smsTotalCount').text(response.students.length);
                    $('#smsConfirmModal').modal('show');
                } else {
                    showAlert('No pending students to notify.', 'warning');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                showAlert('Error fetching pending students. Please refresh.', 'danger');
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fas fa-sms mr-1"></i> Notify Pending Parents');
            }
        });
    });

    // ===== SMS MODE SETTINGS (single button -> options panel) =====
    $('#smsModeBtn').off('click').on('click', function() {
        $('#smsModePanel').slideToggle(140);
        $('#smsModeCaret').toggleClass('fa-chevron-down fa-chevron-up');
    });

    $('#smsModeCloseBtn').off('click').on('click', function() {
        $('#smsModePanel').slideUp(140);
        $('#smsModeCaret').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    });

    $('input[name="smsMode"]').off('change').on('change', function() {
        if ($(this).val() === 'auto') {
            $('#smsIntervalRow').slideDown(140);
            $('#sendSmsBtn').hide();
        } else {
            $('#smsIntervalRow').slideUp(140);
            $('#sendSmsBtn').show();
        }
    });

    $('#saveSmsModeBtn').off('click').on('click', function() {
        var btn = $(this);
        var mode = $('input[name="smsMode"]:checked').val();

        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');

        var data = { '<?= csrf_token() ?>': '<?= csrf_hash() ?>', mode: mode };
        if (mode === 'auto') {
            data.sched_date   = $('#smsSchedDate').val();
            data.sched_hour   = $('#smsSchedHour').val();
            data.sched_minute = $('#smsSchedMinute').val();
            data.sched_ampm   = $('#smsSchedAmpm').val();
        }

        $.ajax({
            url: '<?= base_url('scan-monitor/save-sms-mode') ?>',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {
                btn.prop('disabled', false).html('<i class="fas fa-check mr-1"></i> Save');
                $('#smsModePanel').slideUp(140);
                $('#smsModeCaret').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                if (response.success) {
                    autoSmsMode = response.mode;
                    var label = response.mode === 'auto' ? 'Automatic' : 'Manual';
                    $('#smsModeLabel').text(label);
                    if (response.mode === 'auto') {
                        $('#sendSmsBtn').hide();
                    } else {
                        $('#sendSmsBtn').show();
                    }
                    var help;
                    if (response.mode === 'auto') {
                        var schedTxt = new Date(response.schedule.replace(' ', 'T')).toLocaleString('en-US', { month: 'short', day: 'numeric', year: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true });
                        help = '<i class="fas fa-magic mr-1"></i> Automatic mode is ON - parents are notified automatically at <strong>' + schedTxt + '</strong>.';
                        $('#smsNextSend').html('<i class="fas fa-clock mr-1"></i> Next auto send: <strong>' + schedTxt + '</strong>');
                    } else {
                        help = '<i class="fas fa-hand-pointer mr-1"></i> Manual mode - press "Notify Pending Parents" to send reminders.';
                    }
                    $('#smsHelp').html(help);
                    showAlert('SMS mode set to ' + label + (response.mode === 'auto' ? ' (scheduled)' : '') + '.', 'success');
                } else {
                    showAlert(response.message || 'Could not save SMS mode.', 'danger');
                }
            },
            error: function() {
                btn.prop('disabled', false).html('<i class="fas fa-check mr-1"></i> Save');
                showAlert('Error saving SMS mode. Please refresh.', 'danger');
            }
        });
    });
});

// ===== AUTO-SMS SCHEDULE POLLER (fires + shows result without refresh) =====
var autoSmsMode = '<?= ($smsMode ?? 'manual') ?>';
var autoSmsFired = false;

function checkAutoSms() {
    if (autoSmsMode !== 'auto' || autoSmsFired) {
        return;
    }
    $.ajax({
        url: '<?= base_url('scan-monitor/check-and-fire') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (!response.success || response.mode !== 'auto') {
                return;
            }
            if (response.fired) {
                autoSmsFired = true;
                if ($('#smsNextSend').length) {
                    $('#smsNextSend')
                        .removeClass('sms-next-send')
                        .addClass('sms-done-send')
                        .html('<i class="fas fa-check-circle mr-1"></i> Auto send completed - <strong>' + response.sent + '</strong> parent(s) notified.');
                }
                if (response.sent > 0) {
                    showAlert('Scheduled SMS sent to ' + response.sent + ' parent(s).', 'success');
                } else if (response.total === 0) {
                    showAlert('Scheduled SMS fired - no parents to notify.', 'warning');
                }
            } else if (response.next) {
                var t = new Date(response.next.replace(' ', 'T'));
                if (!isNaN(t.getTime()) && t > new Date()) {
                    var txt = t.toLocaleString('en-US', { month: 'short', day: 'numeric', year: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true });
                    $('#smsNextSend').html('<i class="fas fa-clock mr-1"></i> Next auto send: <strong>' + txt + '</strong>');
                }
            }
        }
    });
}

<?php if(($smsMode ?? 'manual') == 'auto'): ?>
setInterval(checkAutoSms, 10000);
checkAutoSms();
<?php endif; ?>

$('#sendSmsConfirm').click(function() {
    var customMessage = $('#smsCustomMessage').val();
    var btn = $(this);
    
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Sending...');
    
    var formData = new FormData();
    formData.append('custom_message', customMessage);
    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
    
    $.ajax({
        url: '<?= base_url('scan-monitor/send-notifications') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            $('#smsConfirmModal').modal('hide');
            
            if (response.success) {
                var resultHtml = '<p><strong style="color:var(--ink);">Sent:</strong> ' + response.sent + ' SMS</p>';
                if (response.failed > 0) {
                    resultHtml += '<p style="color:var(--soft-rose);font-weight:700;"><strong>Failed:</strong> ' + response.failed + ' SMS</p>';
                }
                resultHtml += '<hr><div style="max-height:150px;overflow-y:auto;">';
                response.messages.forEach(function(msg) {
                    resultHtml += '<div class="small border-bottom py-1" style="color:var(--muted);">';
                    resultHtml += '<i class="fas fa-sms mr-1"></i> ' + msg.parent + '  ' + msg.student;
                    resultHtml += '<br><small style="color: var(--muted);">' + msg.phone + '</small>';
                    resultHtml += '</div>';
                });
                resultHtml += '</div>';
                
                $('#smsResultMessage').text('Successfully sent ' + response.sent + ' SMS notification(s).');
                $('#smsResultDetails').html(resultHtml);
                $('#smsResultModal').modal('show');
                
                setTimeout(function() {
                    location.reload();
                }, 3000);
            } else {
                showAlert(response.message || 'Error sending SMS.', 'danger');
                btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i> Send SMS Now');
            }
        },
        error: function() {
            showAlert('Error sending SMS notifications.', 'danger');
            btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i> Send SMS Now');
        }
    });
});

$('#smsConfirmModal').on('hidden.bs.modal', function() {
    $('#smsCustomMessage').val('');
});
</script>
<?= $this->endSection() ?>