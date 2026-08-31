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

 <!-- REGISTRATION RESULT MODAL -->
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
 <?= esc($p['fname']) ?> <?= esc($p['lname']) ?>
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
 <?= esc($f['fname']) ?> <?= esc($f['lname']) ?>
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

 <div class="alert alert-info mb-0 mt-2">
 <i class="fas fa-info-circle mr-1"></i>
 <strong>Important:</strong> QR codes have been generated with text labels. Parents can scan the QR code or manually type the code number for student pickup.
 </div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Close</button>
 <a href="<?= base_url('students-add') ?>" class="btn btn-kid-success btn-sm">Register Another</a>
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
 <span class="input-group-text"><i class="fas fa-search"></i></span>
 </div>
 <input type="text" id="searchStudent" class="form-control form-control-sm" placeholder="Search name or grade...">
 </div>
 </div>
 <div class="filter-item">
 <label class="filter-label">Grade</label>
 <select id="filterGrade" class="form-control form-control-sm">
 <option value="">All Grades</option>
 <option value="kindergarten">Kindergarten</option>
 <option value="grade 1">Grade 1</option>
 <option value="grade 2">Grade 2</option>
 <option value="grade 3">Grade 3</option>
 <option value="grade 4">Grade 4</option>
 <option value="grade 5">Grade 5</option>
 <option value="grade 6">Grade 6</option>
 </select>
 </div>
 <div class="filter-item">
 <label class="filter-label">Section</label>
 <select id="filterSection" class="form-control form-control-sm">
 <option value="">All Sections</option>
 <option value="a">Section A</option>
 <option value="b">Section B</option>
 </select>
 </div>
 </div>
 </div>

 <!-- TABLE -->
 <div class="table-responsive">
 <table class="table table-hover">
 <thead>
 <tr>
 <th style="width:50px;">#</th>
 <th style="width:60px;">Photo</th>
 <th>Name</th>
 <th>Grade</th>
 <th>Created</th>
 <th class="text-center" style="width:120px;">Action</th>
 </tr>
 </thead>
 <tbody>
 <?php if(!empty($students)): $i=1; foreach($students as $s): $pic=!empty($s['picture'])?base_url('uploads/students/'.$s['picture']):''; ?>
 <tr class="student-row" data-name="<?= esc(strtolower($s['fname'].' '.$s['lname'])) ?>" data-grade="<?= esc(strtolower($s['grade_section'])) ?>">
 <td class="num"><?= $i++ ?></td>
 <td class="photo-cell" onclick="openImageViewer('<?= $pic ?>','<?= esc($s['fname'].' '.$s['lname']) ?>')">
 <?php if(!empty($s['picture'])): ?>
 <img src="<?= base_url('uploads/students/'.$s['picture']) ?>" class="img-circle" style="width:42px;height:42px;">
 <?php else: ?>
 <div class="photo-empty d-flex align-items-center justify-content-center" style="width:42px;height:42px;">
 <i class="fas fa-child" style="color: var(--faint); font-size: 18px;"></i>
 </div>
 <?php endif; ?>
 </td>
 <td>
 <a href="<?= base_url('students-view/'.$s['id']) ?>" class="student-name-link">
 <?= esc($s['fname']) ?> <?= esc($s['lname']) ?>
 </a>
 </td>
 <td><span class="badge badge-soft"><?= esc($s['grade_section']) ?></span></td>
 <td class="muted"><?= date('M d, Y', strtotime($s['created_at'])) ?></td>
 <td class="text-center">
 <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
 <a href="<?= base_url('students-view/'.$s['id']) ?>" class="btn-action btn-action-view">
 <i class="fas fa-eye"></i> View
 </a>
 <div class="dropdown">
 <button class="btn-action btn-action-more dropdown-toggle" data-toggle="dropdown" title="More actions" style="border:none; cursor:pointer;">
 <i class="fas fa-ellipsis-h"></i>
 </button>
 <div class="dropdown-menu dropdown-menu-right">
 <a class="dropdown-item" href="<?= base_url('students-edit/'.$s['id']) ?>">
 <i class="fas fa-edit mr-2" style="color:#b8750a;"></i> Edit
 </a>
 <div class="dropdown-divider"></div>
 <a class="dropdown-item text-danger" href="<?= base_url('students-delete/'.$s['id']) ?>"
 onclick="return confirm('Delete this student?\n\n<?= esc($s['fname']) ?> <?= esc($s['lname']) ?>')">
 <i class="fas fa-trash mr-2"></i> Delete
 </a>
 </div>
 </div>
 </div>
 </td>
 </tr>
 <?php endforeach; else: ?>
 <tr>
 <td colspan="6" class="text-center py-5 empty-state">
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

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    function filterTable(){
        var s = $('#searchStudent').val().toLowerCase(),
            g = $('#filterGrade').val().toLowerCase(),
            sec = $('#filterSection').val().toLowerCase();
        $('.student-row').each(function(){
            var n = $(this).data('name'),
                gr = $(this).data('grade');
            $(this).toggle(
                (s=='' || n.indexOf(s)>-1 || gr.indexOf(s)>-1) &&
                (g=='' || gr.indexOf(g)>-1) &&
                (sec=='' || gr.indexOf('- '+sec)>-1 || gr.endsWith(' '+sec))
            );
        });
    }
    $('#searchStudent').on('keyup', filterTable);
    $('#filterGrade,#filterSection').on('change', filterTable);
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

<?php if(session()->getFlashdata('registration_success')): ?>
$(document).ready(function() {
    $('#registrationResultModal').modal('show');
});
<?php endif; ?>
</script>
<?= $this->endSection() ?>