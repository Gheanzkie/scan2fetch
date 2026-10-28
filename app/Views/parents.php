<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SHARED PROFESSIONAL PASTEL THEME - PARENTS ===== */
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

.parent-name {
    color: var(--ink);
    font-weight: 700;
    font-size: 14px;
}

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

.btn-action-send {
    background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 3px 10px rgba(76,175,80,0.18) !important;
    transition: box-shadow 0.25s ease !important;
}

.btn-action-send:hover {
    box-shadow: 0 6px 18px rgba(76,175,80,0.30) !important;
    color: #fff !important;
}

.btn-action-more {
    background: rgba(63,43,150,0.08) !important;
    border: none !important;
    color: #5a5280 !important;
}

.btn-action-more:hover { background: rgba(63,43,150,0.16) !important; color: #3f2b96 !important; }

.dropdown-menu {
    border-radius: 14px !important;
    border: 1px solid rgba(255,255,255,0.8) !important;
    box-shadow: 0 12px 32px rgba(63,43,150,0.12) !important;
}

.dropdown-item { font-size: 13px !important; font-weight: 600 !important; color: var(--ink) !important; border-radius: 8px !important; }
.dropdown-item:hover { background: rgba(168,192,255,0.12) !important; color: var(--soft-purple) !important; }
.dropdown-item.text-danger:hover { background: rgba(245,87,108,0.08) !important; color: #c2185b !important; }

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

.img-circle:hover { border-color: var(--soft-pink) !important; }

.photo-empty {
    border-radius: 50% !important;
    border: 2px solid rgba(168,192,255,0.25) !important;
    background: rgba(168,192,255,0.08) !important;
}

/* ===== QR THUMB ===== */
.qr-thumb {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    border: 1.5px solid rgba(63,43,150,0.10);
    cursor: pointer;
    object-fit: cover;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
}

.qr-thumb:hover { border-color: var(--soft-blue); box-shadow: 0 4px 12px rgba(63,43,150,0.12); }

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
 <i class="fas fa-user-friends mr-2"></i>
                        Parents Management
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item active">Parents</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">

 <!-- ALERTS -->
 <?php if (session()->getFlashdata('msg')): ?>
 <div class="alert alert-success alert-dismissible fade show">
 <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('msg') ?>
 <button type="button" class="close" data-dismiss="alert" style="color: var(--ink);">&times;</button>
 </div>
 <?php endif; ?>

 <?php if (session()->getFlashdata('error')): ?>
 <div class="alert alert-danger alert-dismissible fade show">
 <i class="fas fa-exclamation-circle mr-2"></i> <?= session()->getFlashdata('error') ?>
 <button type="button" class="close" data-dismiss="alert" style="color: var(--ink);">&times;</button>
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
                                    Parent List
 <span class="badge badge-soft ml-2"><?= count($parents ?? []) ?></span>
 </h5>
 <span style="color: var(--faint); font-size: 12.5px;">
 <i class="fas fa-info-circle mr-1"></i>Passwords are sent manually via "Send Password" or "Send All Passwords" below
 </span>
 <a href="<?= base_url('parents-send-all') ?>" class="btn btn-kid-primary btn-sm mr-2"
                                                title="Send passwords to parents who haven't received one yet"
                                                onclick="return confirm('Send passwords to all parents who have not received one yet?')">
 <i class="fas fa-sms mr-1"></i> Send All Passwords
 </a>
 <?php if (session('role') == 'admin'): ?>
 <a href="<?= base_url('parents-delete-all') ?>" class="btn btn-danger btn-sm mr-2"
                                                title="Delete ALL parents (and orphaned students)"
                                                onclick="return confirm('DELETE ALL PARENTS?\n\nThis will permanently delete ALL parent accounts, their sub-fetchers, and any students left without parents.\n\nThis cannot be undone!')">
 <i class="fas fa-trash-alt mr-1"></i> Delete All
 </a>
 <?php endif; ?>
 </div>
 </div>
 <div class="card-body pt-0">

 <!-- FILTER SECTION -->
 <div class="filter-section">
 <div class="filter-row">
 <div class="filter-item">
 <label class="filter-label">Search Parent</label>
 <div class="input-group input-group-sm">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-search"></i></span>
 </div>
 <input type="text" id="searchParent" class="form-control form-control-sm" placeholder="Search name or phone...">
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
 <th>Parent ID</th>
 <th>Name</th>
 <th>Phone</th>
 <th class="text-center">Password</th>
 <th class="text-center" style="width:210px;">Actions</th>
 </tr>
 </thead>
 <tbody>
 <?php if (!empty($parents)): ?>
 <?php $i = 1; foreach ($parents as $p): ?>
 <tr class="parent-row" data-search="<?= esc(strtolower($p['fname'].' '.($p['mname']??'').' '.$p['lname'].' '.$p['phone'].' '.($p['parent_no']??''))) ?>">
 <td class="num"><?= $i++ ?></td>
 <td>
 <?php if (!empty($p['parent_no'])): ?>
 <span class="badge badge-soft" style="font-family: ui-monospace, monospace; font-size:11.5px; letter-spacing:0.02em;"><?= esc($p['parent_no']) ?></span>
 <?php else: ?>
 <span class="muted" style="font-size:12px;">No ID</span>
 <?php endif; ?>
 </td>
 <td>
 <?php $__pp = parent_photo_url((string) ($p['parent_no'] ?? '')); ?>
 <?php if ($__pp): ?>
 <img src="<?= esc($__pp) ?>" alt="" class="avatar-round" style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid rgba(108,140,255,0.25);margin-right:8px;vertical-align:middle;">
 <?php else: ?>
 <span style="display:inline-flex;width:34px;height:34px;border-radius:50%;background:rgba(168,192,255,0.2);color:#5a5280;align-items:center;justify-content:center;font-size:12px;font-weight:700;margin-right:8px;vertical-align:middle;"><?= esc(strtoupper(mb_substr($p['fname'] ?? '', 0, 1) . mb_substr($p['lname'] ?? '', 0, 1))) ?></span>
 <?php endif; ?>
 <div class="parent-name" style="display:inline-block;vertical-align:middle;"><?= esc(full_name($p)) ?></div>
 </td>
 <td><code><?= esc($p['phone']) ?></code></td>
 <td class="text-center">
 <?php if (!empty($p['password_sent'])): ?>
 <span class="badge badge-soft" title="Password already sent" style="color:#2e7d32;"><i class="fas fa-check"></i></span>
 <?php else: ?>
 <span class="badge badge-soft" title="Password not yet sent" style="color:#c2185b;"><i class="fas fa-times"></i></span>
 <?php endif; ?>
 </td>
 <td class="text-center">
 <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
 <a href="<?= base_url('parents-view/'.$p['id']) ?>" class="btn-action btn-action-view" title="View Parent Details">
 <i class="fas fa-eye"></i> View
 </a>
 <div class="dropdown">
 <button class="btn-action btn-action-more dropdown-toggle" data-toggle="dropdown" title="More actions" style="border:none; cursor:pointer;">
 <i class="fas fa-ellipsis-h"></i>
 </button>
 <div class="dropdown-menu dropdown-menu-right">
 <button type="button" class="dropdown-item edit-parent-btn"
 data-id="<?= $p['id'] ?>"
 data-no="<?= esc($p['parent_no'] ?? '') ?>"
 data-fname="<?= esc($p['fname']) ?>"
 data-mname="<?= esc($p['mname'] ?? '') ?>"
 data-lname="<?= esc($p['lname']) ?>"
 data-phone="<?= esc($p['phone']) ?>"
 data-photo="<?= esc(parent_photo_url((string) ($p['parent_no'] ?? ''))) ?>"
 data-toggle="modal" data-target="#editParentModal">
 <i class="fas fa-edit mr-2" style="color:#b8750a;"></i> Edit
 </button>
 <div class="dropdown-divider"></div>
 <?php if (empty($p['password_sent'])): ?>
 <a class="dropdown-item" href="<?= base_url('parents-send-password/'.$p['id']) ?>"
 onclick="return confirm('Generate and send a password to this parent via SMS?\n\n<?= esc(full_name($p)) ?>')">
 <i class="fas fa-sms mr-2" style="color:#2e7d32;"></i> Send Password
 </a>
 <?php else: ?>
 <a class="dropdown-item" href="<?= base_url('parents-send-password/'.$p['id']) ?>"
 onclick="return confirm('Reset and send a new password to this parent via SMS?\n\n<?= esc(full_name($p)) ?>')">
 <i class="fas fa-key mr-2" style="color:#2e7d32;"></i> Reset Password
 </a>
 <?php endif; ?>
 <div class="dropdown-divider"></div>
 <a class="dropdown-item text-danger" href="<?= base_url('parents-delete/'.$p['id']) ?>"
 onclick="return confirm('Delete this parent?\n\n<?= esc(full_name($p)) ?>')">
 <i class="fas fa-trash mr-2"></i> Delete
 </a>
 </div>
 </div>
 </div>
 </td>
 </tr>
 <?php endforeach; ?>
 <?php else: ?>
 <tr>
 <td colspan="6" class="text-center py-5 empty-state">
 <i class="fas fa-user-friends fa-3x mb-3 d-block"></i>
 <h5>No parents registered yet</h5>
 <p>Parents are automatically registered when adding a student. Their password is sent manually via "Send Password" / "Send All Passwords".</p>
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

<!-- ===== QR MODAL ===== -->
<div class="modal fade" id="qrModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content">
 <div class="modal-header">
 <h5><i class="fas fa-qrcode mr-2" style="color: var(--soft-blue);"></i>QR Code</h5>
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

<!-- ===== EDIT PARENT MODAL (floating, same pattern as teachers/staffs) ===== -->
<div class="modal fade" id="editParentModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <form action="<?= base_url('parents-update') ?>" method="post" enctype="multipart/form-data">
 <?= csrf_field() ?>
 <input type="hidden" name="id" id="editParentId">
 <div class="modal-header">
 <h5 class="modal-title"><i class="fas fa-user-edit mr-2" style="color:#4361ee;"></i>Edit Parent</h5>
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>
 <div class="modal-body">
 <div class="text-center mb-3">
 <div id="editParentPicBox" title="Click to add or change the picture" style="position:relative;width:96px;height:96px;margin:0 auto;border-radius:50%;overflow:hidden;border:3px solid rgba(108,140,255,0.25);background:#eef2ff;display:flex;align-items:center;justify-content:center;cursor:pointer;">
 <img id="editParentPicImg" src="" alt="" style="display:none;width:100%;height:100%;object-fit:cover;">
 <i class="fas fa-camera" id="editParentPicPh" style="font-size:28px;color:#a5b4fc;"></i>
 </div>
 <input type="file" id="editParentPicFile" accept="image/*" style="display:none;">
 <input type="hidden" name="parent_picture_data" id="editParentPicData" value="">
 <input type="hidden" name="parent_picture_remove" id="editParentPicRemove" value="0">
 <button type="button" id="editParentPicRemoveBtn" style="display:none;border:none;background:none;color:#b23c4d;font-size:12px;padding:0;margin-top:4px;"><i class="fas fa-trash-alt mr-1"></i>Delete profile picture</button>
 </div>
 <div class="form-group">
 <label>Parent ID <span class="text-muted" style="font-weight:400;">(editable)</span></label>
 <input type="text" name="parent_no" id="editParentNo" class="form-control" placeholder="e.g. P-1001">
 </div>
<div class="row">
 <div class="col-4">
 <div class="form-group">
 <label>First Name <span class="text-danger">*</span></label>
 <input type="text" name="fname" id="editParentFname" class="form-control" required>
 </div>
 </div>
 <div class="col-4">
 <div class="form-group">
 <label>Middle Name</label>
 <input type="text" name="mname" id="editParentMname" class="form-control">
 </div>
 </div>
 <div class="col-4">
 <div class="form-group">
 <label>Last Name <span class="text-danger">*</span></label>
 <input type="text" name="lname" id="editParentLname" class="form-control" required>
 </div>
 </div>
 </div>
 <div class="form-group mb-0">
 <label>Phone Number <span class="text-danger">*</span></label>
 <input type="text" name="phone" id="editParentPhone" class="form-control" required>
 </div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Cancel</button>
 <button type="submit" class="btn btn-primary btn-sm px-4"><i class="fas fa-check mr-1"></i> Update Parent</button>
 </div>
 </form>
 </div>
 </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    // Search filter
    $('#searchParent').on('keyup', function(){
        var val = $(this).val().toLowerCase();
        $('.parent-row').each(function(){
            var search = $(this).data('search');
            $(this).toggle(search.indexOf(val) > -1);
        });
    });

    // ===== EDIT PARENT MODAL (floating) =====
    var $pBox = $('#editParentPicBox'), $pImg = $('#editParentPicImg'), $pPh = $('#editParentPicPh'),
        $pFile = $('#editParentPicFile'), $pData = $('#editParentPicData'),
        $pRemove = $('#editParentPicRemove'), $pRemoveBtn = $('#editParentPicRemoveBtn');

    function pPaint(src) {
        if (src) {
            $pImg.attr('src', src).show();
            $pPh.hide();
            $pRemoveBtn.show();
        } else {
            $pImg.attr('src', '').hide();
            $pPh.show();
            $pRemoveBtn.hide();
        }
    }

    $(document).on('click', '.edit-parent-btn', function () {
        var b = $(this);
        $('#editParentId').val(b.data('id'));
        $('#editParentNo').val(b.data('no'));
        $('#editParentFname').val(b.data('fname'));
        $('#editParentMname').val(b.data('mname'));
        $('#editParentLname').val(b.data('lname'));
        $('#editParentPhone').val(b.data('phone'));
        $pData.val('');
        $pRemove.val('0');
        $pFile.val('');
        pPaint(b.data('photo') || '');
    });

    $pBox.on('click', function () { $pFile.trigger('click'); });

    $pFile.on('change', function () {
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
                $pData.val(dataUrl);
                $pRemove.val('0');
                pPaint(dataUrl);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });

    $pRemoveBtn.on('click', function () {
        $pData.val('');
        $pFile.val('');
        $pRemove.val('1');
        pPaint('');
    });
});

// ===== OPEN QR MODAL =====
function openQrModal(u) {
    if (!u) { 
        alert('No QR code available.'); 
        return; 
    }
    $('#qrFullImage').attr('src', u);
    $('#qrDownloadBtn').attr('href', u);
    $('#qrModal').modal('show');
}
</script>
<?= $this->endSection() ?>