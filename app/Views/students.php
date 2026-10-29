<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SHARED PROFESSIONAL PASTEL THEME - STUDENTS ===== */
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

/* ===== CARDS ===== */
.card {
    border-radius: 22px !important;
    border: 1px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.78) !important;
    box-shadow: 0 8px 30px rgba(63,43,150,0.05) !important;
    overflow: hidden !important;
}

.card-header {
    background: rgba(255,255,255,0.6) !important;
    border-bottom: 1px solid rgba(63,43,150,0.06) !important;
    padding: 1rem 1.5rem !important;
}

.card-header h5 {
    color: var(--ink) !important;
    font-weight: 700 !important;
    font-size: 1.05rem !important;
}

.card-body { padding: 1.4rem !important; }

/* ===== TABLE ===== */
.table { margin-bottom: 0; }

.table thead th {
    color: #5a5280 !important;
    font-weight: 700 !important;
    font-size: 12.5px !important;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    background: rgba(168,192,255,0.12) !important;
    border-bottom: 1px solid rgba(63,43,150,0.10) !important;
    padding: 12px 14px !important;
    white-space: nowrap;
}

.table tbody td {
    color: var(--ink) !important;
    vertical-align: middle !important;
    border-top: 1px solid rgba(63,43,150,0.05) !important;
    padding: 13px 14px !important;
    font-size: 14px !important;
}

.table tbody tr { transition: background 0.25s ease !important; }
.table tbody tr:hover { background: rgba(168,192,255,0.06) !important; }

.table .num { color: var(--faint) !important; font-weight: 700 !important; font-size: 13px !important; }
.table .muted { color: var(--muted) !important; font-size: 13px !important; }

.student-name-link {
    color: var(--ink) !important;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    transition: color 0.25s ease;
}

.student-name-link:hover { color: var(--soft-purple) !important; }

/* ===== BADGES ===== */
.badge {
    font-weight: 700 !important;
    padding: 6px 14px !important;
    border-radius: 50px !important;
    font-size: 11.5px !important;
}

.badge-soft {
    background: rgba(168,192,255,0.15) !important;
    color: #5a5280 !important;
}

.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }

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

.btn-kid-success {
    background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(76,175,80,0.20) !important;
}

.btn-kid-success:hover { box-shadow: 0 8px 25px rgba(76,175,80,0.30) !important; color: #fff !important; }

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

/* table row action button (consistent across modules) */
.btn-action {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;
    padding: 6px 14px !important;
    font-size: 12.5px !important;
    border-radius: 50px !important;
    font-weight: 700 !important;
    text-decoration: none !important;
    white-space: nowrap;
}

.btn-action-view {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 3px 10px rgba(63,43,150,0.15) !important;
    transition: box-shadow 0.25s ease !important;
}

.btn-action-view:hover {
    box-shadow: 0 6px 18px rgba(63,43,150,0.28) !important;
    color: #fff !important;
}

.btn-sm { padding: 7px 16px !important; font-size: 12.5px !important; }

/* ===== FILTER SECTION ===== */
.filter-section {
    background: rgba(255,255,255,0.55);
    border: 1px solid rgba(255,255,255,0.7);
    border-radius: 16px;
    padding: 18px 20px 16px 20px;
    margin-bottom: 18px;
}

.filter-section .filter-label {
    display: block;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    color: var(--muted);
    margin-bottom: 8px;
}

.filter-section .filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    align-items: flex-end;
}

.filter-section .filter-item { flex: 1; min-width: 200px; }

/* ===== FORM CONTROLS ===== */
.form-control {
    background: rgba(255,255,255,0.8) !important;
    border: 1.5px solid rgba(63,43,150,0.10) !important;
    color: var(--ink) !important;
    border-radius: 12px !important;
    padding: 10px 14px !important;
    transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease !important;
    font-size: 13.5px !important;
    height: 44px !important;
}

.form-control:focus {
    background: rgba(255,255,255,0.95) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(168,192,255,0.15) !important;
    color: var(--ink) !important;
}

.form-control::placeholder { color: #8f8fae !important; opacity: 1; }

.form-control-sm {
    border-radius: 10px !important;
    padding: 8px 12px !important;
    font-size: 13px !important;
    height: 40px !important;
}

.input-group-text {
    background: rgba(168,192,255,0.12) !important;
    border: 1.5px solid rgba(63,43,150,0.10) !important;
    border-right: none !important;
    color: var(--soft-purple) !important;
    border-radius: 12px 0 0 12px !important;
    font-size: 13px !important;
}

.input-group .form-control {
    border-radius: 0 6px 6px 0 !important;
    border-left: none !important;
}

select.form-control option {
    background: #ffffff !important;
    color: var(--ink) !important;
    padding: 10px !important;
    font-size: 13px !important;
}

/* ===== PHOTO THUMB ===== */
.img-circle {
    border-radius: 50% !important;
    border: 2px solid rgba(168,192,255,0.35) !important;
    object-fit: cover !important;
    transition: border-color 0.25s ease !important;
}

.photo-cell { cursor: pointer; }
.img-circle:hover { border-color: var(--soft-pink) !important; }

.photo-empty {
    border-radius: 50% !important;
    border: 2px solid rgba(168,192,255,0.25) !important;
    background: rgba(168,192,255,0.08) !important;
}

/* ===== ALERTS ===== */
.alert {
    border-radius: 16px !important;
    padding: 14px 20px !important;
    font-size: 13.5px !important;
    border: 1.5px solid transparent !important;
    font-weight: 600 !important;
}

.alert-success {
    background: rgba(129,199,132,0.12) !important;
    border-color: rgba(129,199,132,0.22) !important;
    color: #2e6b4f !important;
}

.alert-danger {
    background: rgba(245,87,108,0.10) !important;
    border-color: rgba(245,87,108,0.20) !important;
    color: #a83748 !important;
}

.alert-info {
    background: rgba(168,192,255,0.12) !important;
    border-color: rgba(168,192,255,0.22) !important;
    color: #4a4a72 !important;
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

/* ===== EMPTY STATE ===== */
.empty-state { color: var(--faint) !important; }
.empty-state h5 { color: var(--muted) !important; font-size: 1.1rem !important; }
.empty-state p { color: var(--faint) !important; font-size: 13.5px !important; }
.empty-state i { color: rgba(168,192,255,0.35) !important; }

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

.modal-content .modal-body img { max-width: 100%; }

.qr-card {
    border: 1px solid rgba(63,43,150,0.08);
    border-radius: 16px;
    padding: 14px;
    margin-bottom: 14px;
    background: rgba(255,255,255,0.6);
}

.qr-card .form-control.code-live {
    font-weight: 700;
    letter-spacing: 0.06em;
    text-align: center;
    background: rgba(129,199,132,0.08) !important;
    border-color: rgba(129,199,132,0.25) !important;
    color: #2e6b4f !important;
}

.qr-card .form-control.code-live.orange {
    background: rgba(255,183,77,0.10) !important;
    border-color: rgba(255,183,77,0.30) !important;
    color: #8a6420 !important;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .content-header h1 { font-size: 1.35rem !important; }
    .filter-section { padding: 14px 14px 12px 14px !important; }
    .filter-section .filter-item { flex: 1 1 100% !important; min-width: 100% !important; }
    .btn { font-size: 12px !important; padding: 6px 14px !important; }
    .table thead th { font-size: 11px !important; padding: 10px 8px !important; }
    .table tbody td { font-size: 12.5px !important; padding: 10px 8px !important; }
    .btn-action { font-size: 11px !important; padding: 5px 10px !important; }
}

@media (max-width: 480px) {
    .card { border-radius: 16px !important; }
}

/* ===== EDIT MODAL (register look) ===== */

.reg-avatar {
    position: relative; width: 92px; height: 92px; margin: 0 auto;
    border-radius: 50%; overflow: hidden; cursor: pointer;
    background: #eef2ff; border: 3px solid rgba(108,140,255,.25);
    display: flex; align-items: center; justify-content: center;
    transition: border-color .2s ease, transform .15s ease;
}
.reg-avatar:hover { border-color: var(--soft-blue); transform: scale(1.03); }
.reg-avatar-img { width: 100%; height: 100%; object-fit: cover; }
.reg-avatar-placeholder { font-size: 30px; color: #a5b4fc; }
.reg-avatar-overlay {
    position: absolute; left: 0; right: 0; bottom: 0; padding: 4px 0;
    background: rgba(63,43,150,.72); color: #fff; font-size: 10.5px;
    font-weight: 700; text-align: center; opacity: 0; transition: opacity .2s ease;
}
.reg-avatar:hover .reg-avatar-overlay { opacity: 1; }

/* modal form fields match the register page */
#editStudentModal .modal-body { padding: 1.35rem 1.5rem 0.5rem !important; }
#editStudentModal .row { margin-left: -7px; margin-right: -7px; }
#editStudentModal .row > [class*="col-"] { padding-left: 7px; padding-right: 7px; }
#editStudentModal .form-group { margin-bottom: 14px; }
#editStudentModal label {
    display: block; font-size: 12.5px; font-weight: 700;
    color: #4a4a68 !important; margin-bottom: 6px !important;
}
#editStudentModal label i { color: var(--soft-blue); margin-right: 5px; font-size: 11.5px; }
#editStudentModal .form-control {
    border: 1px solid rgba(108,140,255,.28) !important;
    border-radius: 11px !important;
    padding: 9px 13px !important;
    font-size: 13.5px !important;
    color: #2d2d4a !important;
    background: #fff !important;
    transition: border-color .16s ease, box-shadow .16s ease;
}
#editStudentModal .form-control:focus {
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 3px rgba(108,140,255,.16) !important;
}
#editStudentModal small.text-muted {
    display: block; margin-top: 5px; font-size: 10.5px !important; color: #9a9ab8 !important;
}
#editStudentModal .modal-footer { border-top: 1px solid rgba(108,140,255,.14); padding: 14px 1.5rem; }
#editStudentModal .modal-footer .btn { border-radius: 11px !important; font-weight: 700; }
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-user-graduate mr-2"></i>
                        Students
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item active">Students</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">

 <!-- SUCCESS MESSAGE -->
 <?php if(session()->getFlashdata('msg')): ?>
 <div class="alert alert-success alert-dismissible fade show">
 <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('msg') ?>
 <button type="button" class="close" data-dismiss="alert" style="color: var(--ink);">&times;</button>
 </div>
 <?php endif; ?>


<?php if(session()->getFlashdata('registration_success')): ?>
 <div class="modal fade" id="registrationResultModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-xl">
 <div class="modal-content">
 <div class="modal-header" style="background: var(--success);">
 <h5 class="mb-0 text-white">
 <i class="fas fa-check-circle mr-2"></i>Registration Successful
 </h5>
 <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
 </div>
 <div class="modal-body">
 <div class="text-center mb-4 p-3" style="background: rgba(129,199,132,0.08); border-radius: 14px;">
 <i class="fas fa-user-graduate fa-2x" style="color: var(--soft-green);"></i>
 <h4 style="color: var(--soft-green);" class="mb-1 mt-2"><?= session()->getFlashdata('student_name') ?></h4>
 <p style="color: var(--muted); margin-bottom: 0;">has been registered successfully!</p>
 </div>

 <?php $parents = session()->getFlashdata('registered_parents'); ?>
 <?php if(!empty($parents)): ?>
 <h6 class="mb-3" style="color: var(--ink); font-weight: 700;">
 <i class="fas fa-users mr-2" style="color: var(--soft-blue);"></i>
                                Registered Parents / Fetchers
 </h6>

 <?php foreach($parents as $index => $p): ?>
 <div class="row align-items-center">
 <div class="col-md-5">
 <h6 class="mb-1" style="color: var(--ink);">
 <span class="badge badge-success mr-2">#<?= $index + 1 ?></span>
 <?= esc(full_name($p)) ?>
 </h6>
 <div class="muted" style="font-size: 13px;">
 <i class="fas fa-tag mr-1"></i> Relation: <strong style="color: var(--ink);"><?= esc($p['relation']) ?></strong>
 </div>
 <div class="muted" style="font-size: 13px;">
 <i class="fas fa-qrcode mr-1"></i> QR Code: <code style="color: var(--soft-green);"><?= esc($p['qr_code']) ?></code>
 </div>
 </div>
 <div class="col-md-7 text-center">
 <div style="display:inline-block;border:2px solid var(--soft-green);border-radius:12px;padding:8px;background:#fff;">
 <img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>"
                                             style="width:160px;height:auto;display:block;"
                                             alt="QR Code">
 <div style="background: var(--soft-green); color: #fff; padding: 4px 10px; border-radius: 0 0 8px 8px; margin-top: 4px; font-weight: bold; font-size: 13px;">
 <?= esc($p['qr_code']) ?>
 </div>
 </div>
 <div class="mt-2">
 <a href="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>"
                                           download="<?= esc($p['qr_code']) ?>.png"
                                           class="btn btn-kid-success btn-sm">
 <i class="fas fa-download mr-1"></i> Download
 </a>
 </div>
 </div>
 </div>
 <hr style="border-color: rgba(63,43,150,0.06); margin: 14px 0;">
 <?php endforeach; ?>
 <?php endif; ?>

 <?php $fetchers = session()->getFlashdata('registered_fetchers'); ?>
 <?php if(!empty($fetchers)): ?>
 <h6 class="mb-3 mt-3" style="color: var(--ink); font-weight: 700;">
 <i class="fas fa-user-friends mr-2" style="color: var(--soft-orange);"></i>
                                Sub-Fetchers
 </h6>

 <?php foreach($fetchers as $index => $f): ?>
 <div class="row align-items-center">
 <div class="col-md-5">
 <h6 class="mb-1" style="color: var(--ink);">
 <span class="badge badge-warning mr-2">#<?= $index + 1 ?></span>
 <?= esc(full_name($f)) ?>
 </h6>
 <div class="muted" style="font-size: 13px;">
 <i class="fas fa-qrcode mr-1"></i> QR Code: <code style="color: var(--soft-orange);"><?= esc($f['qr_code']) ?></code>
 </div>
 </div>
 <div class="col-md-7 text-center">
 <div style="display:inline-block;border:2px solid var(--soft-orange);border-radius:12px;padding:8px;background:#fff;">
 <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>"
                                             style="width:160px;height:auto;display:block;"
                                             alt="QR Code">
 <div style="background: var(--soft-orange); color: #fff; padding: 4px 10px; border-radius: 0 0 8px 8px; margin-top: 4px; font-weight: bold; font-size: 13px;">
 <?= esc($f['qr_code']) ?>
 </div>
 </div>
 <div class="mt-2">
 <a href="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>"
                                           download="<?= esc($f['qr_code']) ?>.png"
                                           class="btn btn-kid-success btn-sm">
 <i class="fas fa-download mr-1"></i> Download
 </a>
 </div>
 </div>
 </div>
 <hr style="border-color: rgba(63,43,150,0.06); margin: 14px 0;">
 <?php endforeach; ?>
 <?php endif; ?>

 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Close</button>
 <a href="<?= base_url('students') ?>" class="btn btn-kid-primary btn-sm">View All</a>
 </div>
 </div>
 </div>
 </div>
 <?php endif; ?>

 <!-- MAIN CARD -->
 <div class="row">
 <div class="col-12">
 <div class="card">
 <div class="card-header">
 <div class="d-flex justify-content-between align-items-center flex-wrap">
 <h5 class="mb-0">
 <i class="fas fa-list-ul mr-2" style="color: var(--soft-blue);"></i>
                                    All Students
 <span class="badge badge-soft ml-2"><?= count($students ?? []) ?></span>
                                </h5>

 </div>
 </div>
 <div class="card-body pt-0">

 <!-- FILTER SECTION -->
 <div class="filter-section">
 <div class="filter-row">
<div class="filter-item">
  <label class="filter-label">Search Student</label>
  <div class="input-group input-group-sm">
  <div class="input-group-prepend">
  </div>
  <input type="text" id="searchStudent" class="form-control form-control-sm" placeholder="Search name or grade...">
  </div>
  </div>
  </div>
  </div>

 <!-- TABLE -->
 <div class="table-responsive">
 <table class="table table-hover">
 <thead>
 <tr>
 <th style="width:50px;">#</th>
 <th>Student ID</th>
 <th>Name</th>
 <th>Grade</th>
 <th class="text-center" style="width:120px;">Action</th>
 </tr>
 </thead>
 <tbody>
 <?php if(!empty($students)): $i=1; foreach($students as $s): ?>
 <tr class="student-row" data-name="<?= esc(strtolower(full_name($s))) ?>" data-grade="<?= esc(strtolower($s['grade_section'])) ?>">
 <td class="num"><?= $i++ ?></td>
 <td>
 <?php if (!empty($s['student_no'])): ?>
 <span class="badge badge-soft" style="font-family: ui-monospace, monospace; font-size:11.5px; letter-spacing:0.02em;"><?= esc($s['student_no']) ?></span>
 <?php else: ?>
 <span class="muted" style="font-size:12px;">No ID</span>
 <?php endif; ?>
 </td>
 <td>
 <?php $__sp = student_photo_url((string) ($s['student_no'] ?? '')); ?>
 <?php if ($__sp): ?>
 <img src="<?= esc($__sp) ?>" alt="" class="avatar-round" style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid rgba(108,140,255,0.25);margin-right:8px;vertical-align:middle;">
 <?php else: ?>
 <span style="display:inline-flex;width:34px;height:34px;border-radius:50%;background:rgba(168,192,255,0.2);color:#5a5280;align-items:center;justify-content:center;font-size:12px;font-weight:700;margin-right:8px;vertical-align:middle;"><?= esc(strtoupper(mb_substr($s['fname'] ?? '', 0, 1) . mb_substr($s['lname'] ?? '', 0, 1))) ?></span>
 <?php endif; ?>
 <a href="<?= base_url('students-view/'.$s['id']) ?>" class="student-name-link">
 <?= esc(full_name($s)) ?>
 </a>
 </td>
 <td><span class="badge badge-soft"><?= esc($s['grade_section']) ?></span></td>
 <td class="text-center">
 <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
 <a href="<?= base_url('students-view/'.$s['id']) ?>" class="btn-action btn-action-view" title="View Student">
 <i class="fas fa-eye"></i> View
 </a>
 <div class="dropdown">
 <button class="btn-action btn-action-more dropdown-toggle" data-toggle="dropdown" title="More actions" style="border:none; cursor:pointer;">
 <i class="fas fa-ellipsis-h"></i>
 </button>
 <div class="dropdown-menu dropdown-menu-right">
 <button type="button" class="dropdown-item edit-student-btn"
 data-id="<?= $s['id'] ?>"
 data-no="<?= esc($s['student_no'] ?? '') ?>"
 data-fname="<?= esc($s['fname']) ?>"
 data-mname="<?= esc($s['mname'] ?? '') ?>"
 data-lname="<?= esc($s['lname']) ?>"
 data-grade="<?= esc($s['grade_section'] ?? '') ?>"
 data-photo="<?= esc(student_photo_url((string) ($s['student_no'] ?? ''))) ?>"
 data-toggle="modal" data-target="#editStudentModal">
 <i class="fas fa-edit mr-2" style="color:#b8750a;"></i> Edit
 </button>
 <div class="dropdown-divider"></div>
 <a class="dropdown-item text-danger" href="<?= base_url('students-delete/'.$s['id']) ?>"
 onclick="return confirm('Delete this student?\n\n<?= esc(full_name($s)) ?>')">
 <i class="fas fa-trash mr-2"></i> Delete
 </a>
 </div>
 </div>
 </div>
 </td>
 </tr>
 <?php endforeach; else: ?>
 <tr>
   <td colspan="5" class="text-center py-5 empty-state">
 <i class="fas fa-user-graduate fa-3x mb-3 d-block"></i>
 <h5>No students yet</h5>
 <p>Register a student to get started!</p>
 </td>
 </tr>
 <?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </section>
</div>

<!-- ===== QR LARGE VIEW MODAL ===== -->
<div class="modal fade" id="qrModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content">
 <div class="modal-header">
 <h5><i class="fas fa-qrcode mr-2" style="color: var(--soft-blue);"></i><span id="qrModalTitle">QR Code</span></h5>
 <button type="button" class="close" data-dismiss="modal" style="color: var(--ink);">&times;</button>
 </div>
 <div class="modal-body text-center" style="background: #fff;">
 <img id="qrFullImage" src="" style="max-width:100%;max-height:65vh;border-radius:12px;">
 </div>
 <div class="modal-footer">
 <a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-kid-primary btn-sm">
 <i class="fas fa-download mr-1"></i> Download
 </a>
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Close</button>
 </div>
 </div>
 </div>
</div>

<!-- ===== IMAGE VIEWER MODAL ===== -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content">
 <div class="modal-header">
 <h5><i class="fas fa-image mr-2" style="color: var(--soft-blue);"></i><span id="imageViewerTitle">Photo</span></h5>
 <button type="button" class="close" data-dismiss="modal" style="color: var(--ink);">&times;</button>
 </div>
 <div class="modal-body text-center" style="background: #fff;">
 <img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;border-radius:12px;">
 </div>
 <div class="modal-footer">
 <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-kid-primary btn-sm">
 <i class="fas fa-download mr-1"></i> Download
 </a>
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Close</button>
 </div>
 </div>
 </div>
</div>

<!-- ===== EDIT STUDENT MODAL (same look as the Register page) ===== -->
<div class="modal fade" id="editStudentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('students-update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editStudentId">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-graduate mr-2" style="color: var(--soft-blue);"></i>Edit Student
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">


                    <!-- Profile picture (same picker as the register page) -->
                    <div class="reg-avatar-wrap text-center mb-3">
                        <div class="reg-avatar" id="editStudentPicBox" title="Click to add or change the picture">
                            <img class="reg-avatar-img" id="editStudentPicImg" src="" alt="" style="display:none;">
                            <span class="reg-avatar-overlay">Add picture</span>
                        </div>
                        <input type="file" class="reg-avatar-file" id="editStudentPicFile" accept="image/*" style="display:none;">
                        <input type="hidden" name="student_picture_data" id="editStudentPicData" value="">
                        <input type="hidden" name="student_picture_remove" id="editStudentPicRemove" value="0">
                        <div>
                            <button type="button" class="btn btn-link btn-sm reg-avatar-remove-btn" id="editStudentPicRemoveBtn"
                                    style="display:none; color:#b23c4d; padding:0; font-size:12px;">
                                <i class="fas fa-trash-alt mr-1"></i>Remove picture
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="editStudentNo"><i class="fas fa-hashtag"></i>Student ID <span class="text-danger">*</span></label>
                        <input type="text" name="student_no" id="editStudentNo" class="form-control" placeholder="1001" inputmode="numeric" maxlength="20" required>
                        <small class="text-muted">Number printed on the student's record - used as the photo filename.</small>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="editStudentFname"><i class="fas fa-user"></i>First Name <span class="text-danger">*</span></label>
                                <input type="text" name="fname" id="editStudentFname" class="form-control" placeholder="Juan" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="editStudentMname"><i class="fas fa-user"></i>Middle Name</label>
                                <input type="text" name="mname" id="editStudentMname" class="form-control" placeholder="Dela">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="editStudentLname"><i class="fas fa-user"></i>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="lname" id="editStudentLname" class="form-control" placeholder="Cruz" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="editStudentGrade"><i class="fas fa-graduation-cap"></i>Grade &amp; Section <span class="text-danger">*</span></label>
                        <select name="grade_section" id="editStudentGrade" class="form-control" required>
                            <option value=""> Select Grade &amp; Section </option>
                            <optgroup label="Kindergarten">
                                <option>Kindergarten - A</option>
                                <option>Kindergarten - B</option>
                            </optgroup>
                            <optgroup label="Grade 1">
                                <option>Grade 1 - A</option>
                                <option>Grade 1 - B</option>
                            </optgroup>
                            <optgroup label="Grade 2">
                                <option>Grade 2 - A</option>
                                <option>Grade 2 - B</option>
                            </optgroup>
                            <optgroup label="Grade 3">
                                <option>Grade 3 - A</option>
                                <option>Grade 3 - B</option>
                            </optgroup>
                            <optgroup label="Grade 4">
                                <option>Grade 4 - A</option>
                                <option>Grade 4 - B</option>
                            </optgroup>
                            <optgroup label="Grade 5">
                                <option>Grade 5 - A</option>
                                <option>Grade 5 - B</option>
                            </optgroup>
                            <optgroup label="Grade 6">
                                <option>Grade 6 - A</option>
                                <option>Grade 6 - B</option>
                            </optgroup>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-kid-primary btn-sm px-4">
                        <i class="fas fa-check mr-1"></i>Update Student
                    </button>
                </div>
            </form>
        </div>
    </div>
 <i class="fas fa-camera" id="editStudentPicPh" style="font-size:28px;color:#a5b4fc;"></i>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    function filterTable(){
        var s = $('#searchStudent').val().toLowerCase();
        $('.student-row').each(function(){
            var n = $(this).data('name'),
                gr = $(this).data('grade');
            $(this).toggle(
                (s=='' || n.indexOf(s)>-1 || gr.indexOf(s)>-1)
            );
        });
    }
    $('#searchStudent').on('keyup', filterTable);
});

function openImageViewer(u,t){
    if(!u) {
        alert('No photo available for this student.');
        return;
    }
    $('#imageViewerFull').attr('src',u);
    $('#imageDownloadBtn').attr('href',u);
    $('#imageDownloadBtn').attr('download',t.replace(/\s+/g,'_')+'.png');
    $('#imageViewerTitle').text(t||'Photo');
    $('#imageViewerModal').modal('show');
}

function openQrModal(u,t){
    if(!u) {
        alert('No QR code available.');
        return;
    }
    $('#qrFullImage').attr('src',u);
    $('#qrDownloadBtn').attr('href',u);
    $('#qrDownloadBtn').attr('download',(t||'qr').replace(/\s+/g,'_')+'.png');
    $('#qrModalTitle').text(t||'QR Code');
    $('#qrModal').modal('show');
}

    // ===== EDIT STUDENT MODAL (floating) =====
    var $sBox = $('#editStudentPicBox'), $sImg = $('#editStudentPicImg'), $sPh = $('#editStudentPicPh'),
        $sFile = $('#editStudentPicFile'), $sData = $('#editStudentPicData'),
        $sRemove = $('#editStudentPicRemove'), $sRemoveBtn = $('#editStudentPicRemoveBtn');

    function sPaint(src) {
        if (src) {
            $sImg.attr('src', src).show();
            $sPh.hide();
            $sRemoveBtn.show();
        } else {
            $sImg.attr('src', '').hide();
            $sPh.show();
            $sRemoveBtn.hide();
        }
    }

    $(document).on('click', '.edit-student-btn', function () {
        var b = $(this);
        $('#editStudentId').val(b.data('id'));
        $('#editStudentNo').val(b.data('no'));
        $('#editStudentNo').val(b.data('no'));
        $('#editStudentFname').val(b.data('fname'));
        $('#editStudentMname').val(b.data('mname'));
        $('#editStudentLname').val(b.data('lname'));
        $('#editStudentGrade').val(b.data('grade'));
        $sData.val('');
        $sRemove.val('0');
        $sFile.val('');
        sPaint(b.data('photo') || '');
    });

    $sBox.on('click', function () { $sFile.trigger('click'); });

    $sFile.on('change', function () {
        if (!this.files || !this.files[0]) { return; }
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = new Image();
            img.onload = function () {
                var side = Math.min(img.width, img.height),
                    sx = (img.width - side) / 2, sy = (img.height - side) / 2,
                    canvas = document.createElement('canvas');
                canvas.width = 400; canvas.height = 400;
                canvas.getContext('2d').drawImage(img, sx, sy, side, side, 0, 0, 400, 400);
                var dataUrl = canvas.toDataURL('image/jpeg', 0.9);
                $sData.val(dataUrl);
                $sRemove.val('0');
                sPaint(dataUrl);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });

    $sRemoveBtn.on('click', function () {
        $sData.val('');
        $sFile.val('');
        $sRemove.val('1');
        sPaint('');
    });

<?php if(session()->getFlashdata('registration_success')): ?>
$(document).ready(function() {
    $('#registrationResultModal').modal('show');
});
<?php endif; ?>
</script>
<?= $this->endSection() ?>