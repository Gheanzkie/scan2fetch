<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SHARED PROFESSIONAL PASTEL THEME - STAFF ===== */
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

.staff-name {
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

.btn-kid-warning {
    background: linear-gradient(135deg, var(--soft-orange), #f57c00) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(255,183,77,0.25) !important;
}

.btn-kid-warning:hover { box-shadow: 0 8px 25px rgba(255,183,77,0.35) !important; color: #fff !important; }

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
    color: #fff !important;
    border: none !important;
    cursor: pointer;
    transition: box-shadow 0.25s ease !important;
}

.btn-action-edit {
    background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
    box-shadow: 0 3px 10px rgba(76,175,80,0.18) !important;
}

.btn-action-edit:hover { box-shadow: 0 6px 18px rgba(76,175,80,0.30) !important; color: #fff !important; }

.btn-action-delete {
    background: linear-gradient(135deg, var(--soft-rose), #d32f2f) !important;
    box-shadow: 0 3px 10px rgba(245,87,108,0.18) !important;
}

.btn-action-delete:hover { box-shadow: 0 6px 18px rgba(245,87,108,0.30) !important; color: #fff !important; }

.btn-action-view {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    box-shadow: 0 3px 10px rgba(63,43,150,0.15) !important;
}

.btn-action-view:hover { box-shadow: 0 6px 18px rgba(63,43,150,0.28) !important; color: #fff !important; }

.btn-action-more { background: rgba(63,43,150,0.08) !important; color: #5a5280 !important; }
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

label {
    color: var(--ink) !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    margin-bottom: 6px !important;
}

label .text-danger { color: var(--soft-rose) !important; }

/* ===== AVATAR ===== */
.avatar-circle {
    border-radius: 50% !important;
    overflow: hidden !important;
    padding: 0 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: #4361ee !important;
    color: #fff !important;
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
.breadcrumb-item + .breadcrumb-item::before { color: var(--faint) !important; content: "â€º" !important; }

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

/* ===== PHOTO PREVIEW ===== */
.staff-photo-preview {
    width: 96px;
    height: 96px;
    margin: 0 auto;
    border-radius: 50%;
    overflow: hidden;
    border: 2px dashed rgba(63,43,150,0.25);
    background: rgba(168,192,255,0.10);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    position: relative;
}

.staff-photo-preview:hover { border-color: var(--soft-blue); }

.staff-photo-preview i { font-size: 30px; color: rgba(63,43,150,0.35); }

.staff-photo-preview img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
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
 <i class="fas fa-user-tie mr-2"></i>
                        Staff Management
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item active">Staff</li>
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
                                    Staff List
 <span class="badge badge-soft ml-2"><?= count($staffs ?? []) ?></span>
 </h5>
 <div class="d-flex align-items-center flex-wrap" style="gap:8px;">
 <a href="<?= base_url('staffs-send-all') ?>" class="btn btn-kid-primary btn-sm"
                                                title="Send passwords to staff who haven't received one yet"
                                                onclick="return confirm('Send passwords to all staff who have not received one yet?')">
 <i class="fas fa-sms mr-1"></i> Send All Passwords
 </a>
 <?php if (session('role') == 'admin'): ?>
 <a href="<?= base_url('staffs-delete-all') ?>" class="btn btn-danger btn-sm"
                                                title="Delete ALL staff accounts"
                                                onclick="return confirm('DELETE ALL STAFF?\n\nThis will permanently delete ALL staff accounts.\n\nThis cannot be undone!')">
 <i class="fas fa-trash-alt mr-1"></i> Delete All
 </a>
 <?php endif; ?>
 <button type="button" class="btn btn-kid-primary btn-sm" data-toggle="modal" data-target="#addStaffModal">
 <i class="fas fa-plus mr-1"></i> Add Staff
 </button>
 </div>
 </div>
 </div>
 <div class="card-body pt-0">

 <!-- FILTER SECTION -->
 <div class="filter-section">
 <div class="filter-row">
 <div class="filter-item">
 <label class="filter-label">Search Staff</label>
 <div class="input-group input-group-sm">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-search"></i></span>
 </div>
 <input type="text" id="searchStaff" class="form-control form-control-sm" placeholder="Search name or phone...">
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
 <th>Staff ID</th>
 <th>Full Name</th>
 <th>Phone</th>
 <th class="text-center">Password</th>
 <th class="text-center" style="width:150px;">Actions</th>
 </tr>
 </thead>
 <tbody>
 <?php if (!empty($staffs)): ?>
 <?php $i = 1; foreach ($staffs as $staff): ?>
 <tr class="staff-row" data-search="<?= esc(strtolower($staff['fname'].' '.($staff['mname']??'').' '.$staff['lname'].' '.$staff['phone'].' '.($staff['staff_no']??''))) ?>">
 <td class="num"><?= $i++ ?></td>
 <td>
 <?php if (!empty($staff['staff_no'])): ?>
 <span class="badge badge-soft" style="font-family: ui-monospace, monospace; font-size:11.5px;"><?= esc($staff['staff_no']) ?></span>
 <?php else: ?>
 <span class="muted" style="font-size:12px;">No ID</span>
 <?php endif; ?>
 </td>
 <td>
 <div class="d-flex align-items-center">
 <div class="avatar-circle mr-2" style="width:40px;height:40px;min-width:40px;overflow:hidden;padding:0;">
 <?php $__stp = staff_photo_url((string) ($staff['staff_no'] ?? '')); ?>
 <?php if ($__stp): ?>
 <img src="<?= esc($__stp) ?>" alt="" style="width:100%;height:100%;object-fit:cover;">
 <?php else: ?>
 <i class="fas fa-user-tie" style="font-size:17px;"></i>
 <?php endif; ?>
 </div>
 <div>
 <div class="staff-name"><?= esc(full_name($staff)) ?></div>
 <?php if(!empty($staff['mname'])): ?>
 <div class="muted"><?= esc($staff['mname']) ?></div>
 <?php endif; ?>
 </div>
 </div>
 </td>
 <td><code><?= esc($staff['phone']) ?></code></td>
 <td class="text-center">
 <?php if (!empty($staff['password_sent'])): ?>
 <span class="badge badge-soft" title="Password already sent" style="color:#2e7d32;"><i class="fas fa-check"></i></span>
 <?php else: ?>
 <span class="badge badge-soft" title="Password not yet sent" style="color:#c2185b;"><i class="fas fa-times"></i></span>
 <?php endif; ?>
 </td>
 <td class="text-center">
 <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
 <div class="dropdown">
 <button class="btn-action btn-action-more dropdown-toggle" data-toggle="dropdown" title="More actions" style="border:none; cursor:pointer;">
 <i class="fas fa-ellipsis-h"></i>
 </button>
 <div class="dropdown-menu dropdown-menu-right">
 <a class="dropdown-item" href="#"
 data-toggle="modal" data-target="#editStaffModal"
 data-id="<?= $staff['id'] ?>"
 data-fname="<?= esc($staff['fname']) ?>"
 data-mname="<?= esc($staff['mname'] ?? '') ?>"
 data-lname="<?= esc($staff['lname']) ?>"
 data-staff-no="<?= esc($staff['staff_no'] ?? '') ?>"
 data-photo="<?= esc(staff_photo_url((string) ($staff['staff_no'] ?? ''))) ?>"
 data-created="<?= esc($staff['created_at'] ?? '') ?>"
 data-phone="<?= esc($staff['phone']) ?>">
 <i class="fas fa-edit mr-2" style="color:#b8750a;"></i> Edit
 </a>
 <div class="dropdown-divider"></div>
 <?php if (empty($staff['password_sent'])): ?>
 <a class="dropdown-item" href="<?= base_url('staffs-send-password/' . $staff['id']) ?>"
 onclick="return confirm('Generate and send a password to this staff via SMS?\n\n<?= esc(full_name($staff)) ?>')">
 <i class="fas fa-sms mr-2" style="color:#2e7d32;"></i> Send Password
 </a>
 <?php else: ?>
 <a class="dropdown-item" href="<?= base_url('staffs-send-password/' . $staff['id']) ?>"
 onclick="return confirm('Reset and send a new password to this staff via SMS?\n\n<?= esc(full_name($staff)) ?>')">
 <i class="fas fa-key mr-2" style="color:#2e7d32;"></i> Reset Password
 </a>
 <?php endif; ?>
 <div class="dropdown-divider"></div>
 <a class="dropdown-item text-danger" href="<?= base_url('staffs-delete/' . $staff['id']) ?>"
 onclick="return confirm('Delete this staff member?\n\n<?= esc(full_name($staff)) ?>')">
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
 <td colspan="7" class="text-center py-5 empty-state">
 <i class="fas fa-user-tie fa-3x mb-3 d-block"></i>
 <h5>No staff accounts yet</h5>
 <p>Click "Add Staff" to register a new staff member.</p>
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

<!-- ===== ADD STAFF MODAL ===== -->
<div class="modal fade" id="addStaffModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <form action="<?= base_url('staffs-save') ?>" method="post" enctype="multipart/form-data">
 <?= csrf_field() ?>
 <div class="modal-header">
 <h5 class="modal-title">
 <i class="fas fa-user-plus mr-2" style="color: var(--soft-blue);"></i>
                        Register New Staff
 </h5>
 <button type="button" class="close" data-dismiss="modal" style="color: var(--ink);">&times;</button>
 </div>
 <div class="modal-body">
 <div class="text-center mb-3">
 <div id="addStaffPicBox" title="Click to add the picture" style="position:relative;width:96px;height:96px;margin:0 auto;border-radius:50%;overflow:hidden;border:3px solid rgba(108,140,255,0.25);background:#eef2ff;display:flex;align-items:center;justify-content:center;cursor:pointer;">
 <img id="addStaffPicImg" src="" alt="" style="display:none;width:100%;height:100%;object-fit:cover;">
 <i class="fas fa-camera" id="addStaffPicPh" style="font-size:28px;color:#a5b4fc;"></i>
 </div>
 <input type="file" id="addStaffPicFile" accept="image/*" style="display:none;">
 <input type="hidden" name="staff_picture_data" id="addStaffPicData" value="">
 <small class="text-muted d-block mt-2" style="font-size:12px;">Profile picture <span style="color:#b23c4d;">(optional)</span></small>
 <button type="button" id="addStaffPicRemoveBtn" style="display:none;border:none;background:none;color:#b23c4d;font-size:12px;padding:0;margin-top:2px;"><i class="fas fa-trash-alt mr-1"></i>Remove picture</button>
 </div>
 <div class="row">
 <div class="col-4">
 <div class="form-group">
 <label>First Name <span class="text-danger">*</span></label>
 <input type="text" name="fname" class="form-control" placeholder="Juan" required>
 </div>
 </div>
 <div class="col-4">
 <div class="form-group">
 <label>Middle Name</label>
 <input type="text" name="mname" class="form-control" placeholder="Dela">
 </div>
 </div>
 <div class="col-4">
 <div class="form-group">
 <label>Last Name <span class="text-danger">*</span></label>
 <input type="text" name="lname" class="form-control" placeholder="Cruz" required>
 </div>
 </div>
 </div>
 <div class="form-group">
 <label>Staff ID <span class="text-muted" style="font-weight: 400;">(optional â€” auto-generated as S-####)</span></label>
 <div class="input-group">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
 </div>
 <input type="text" name="staff_no" class="form-control" placeholder="S-1002">
 </div>
 </div>
 <div class="form-group">
 <label>Phone Number <span class="text-danger">*</span></label>
 <div class="input-group">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-phone"></i></span>
 </div>
 <input type="text" name="phone" class="form-control" placeholder="09XXXXXXXXX" required>
 </div>
 </div>
 <div class="alert" style="background: rgba(168,192,255,0.12); border: 1.5px dashed rgba(63,43,150,0.18); border-radius: 12px; margin-bottom: 0; padding: 12px 14px; font-size: 13px; color: var(--ink);">
 <i class="fas fa-info-circle mr-1" style="color: var(--soft-blue);"></i>
                        Passwords are not sent automatically â€” use "Send Password" / "Send All Passwords" to deliver them.
 </div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Cancel</button>
 <button type="submit" class="btn btn-kid-primary btn-sm px-4">
 <i class="fas fa-save mr-1"></i> Save Staff
 </button>
 </div>
 </form>
 </div>
 </div>
</div>

<!-- ===== EDIT STAFF MODAL ===== -->
<div class="modal fade" id="editStaffModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <form action="<?= base_url('staffs-update') ?>" method="post" enctype="multipart/form-data">
 <?= csrf_field() ?>
 <input type="hidden" name="id" id="editId">

 <!-- ===== Staff profile picture (add / change / remove) ===== -->
 <div class="text-center mb-3">
 <div id="staffPicBox" title="Click to add or change the picture" style="position:relative;width:96px;height:96px;margin:0 auto;border-radius:50%;overflow:hidden;border:3px solid rgba(108,140,255,0.25);background:#eef2ff;display:flex;align-items:center;justify-content:center;cursor:pointer;">
 <img id="staffPicImg" src="" alt="" style="display:none;width:100%;height:100%;object-fit:cover;">
 <i class="fas fa-camera" id="staffPicPh" style="font-size:28px;color:#a5b4fc;"></i>
 <span style="position:absolute;left:0;right:0;bottom:0;padding:3px 0;background:rgba(63,43,150,0.72);color:#fff;font-size:10px;font-weight:700;text-align:center;">Change</span>
 </div>
 <input type="file" id="staffPicFile" accept="image/*" style="display:none;">
 <input type="hidden" name="staff_picture_data" id="staffPicData" value="">
 <input type="hidden" name="staff_picture_remove" id="staffPicRemove" value="0">
 <div><button type="button" id="staffPicRemoveBtn" style="display:none;border:none;background:none;color:#b23c4d;font-size:12px;padding:0;margin-top:4px;"><i class="fas fa-trash-alt mr-1"></i>Remove picture</button></div>
 </div>
 <div class="modal-header">
 <h5 class="modal-title">
 <i class="fas fa-user-edit mr-2" style="color: var(--soft-orange);"></i>
                        Edit Staff
 </h5>
 <button type="button" class="close" data-dismiss="modal" style="color: var(--ink);">&times;</button>
 </div>
 <div class="modal-body">
 <div class="row">
 <div class="col-4">
 <div class="form-group">
 <label>First Name <span class="text-danger">*</span></label>
 <input type="text" name="fname" id="editFname" class="form-control" required>
 </div>
 </div>
 <div class="col-4">
 <div class="form-group">
 <label>Middle Name</label>
 <input type="text" name="mname" id="editMname" class="form-control">
 </div>
 </div>
 <div class="col-4">
 <div class="form-group">
 <label>Last Name <span class="text-danger">*</span></label>
 <input type="text" name="lname" id="editLname" class="form-control" required>
 </div>
 </div>
 </div>
 <div class="form-group">
 <label>Staff ID</label>
 <div class="input-group">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
 </div>
 <input type="text" name="staff_no" id="editStaffNo" class="form-control">
 </div>
 </div>
 <div class="form-group">
 <label>Phone Number <span class="text-danger">*</span></label>
 <div class="input-group">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-phone"></i></span>
 </div>
 <input type="text" name="phone" id="editPhone" class="form-control" required>
 </div>
 </div>
 <p class="text-muted mb-3" style="font-size:13px;">
 <i class="fas fa-calendar mr-1"></i> Added: <span id="editStaffCreated">&mdash;</span>
 </p>
 <div class="form-group mb-0">
 <label>Password <span class="text-muted" style="font-weight: 400;">(leave blank to keep current)</span></label>
 <div class="input-group">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-lock"></i></span>
 </div>
 <input type="password" name="password" class="form-control" placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢" minlength="6">
  </div>
  </div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Cancel</button>
 <button type="submit" class="btn btn-kid-warning btn-sm px-4">
 <i class="fas fa-check mr-1"></i> Update Staff
 </button>
 </div>
 </form>
 </div>
 </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    $('#searchStaff').on('keyup', function(){
        var val = $(this).val().toLowerCase();
        $('.staff-row').each(function(){
            var search = $(this).data('search');
            $(this).toggle(search.indexOf(val) > -1);
        });
    });

    $('#editStaffModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        $('#editId').val(button.data('id'));
        $('#editFname').val(button.data('fname'));
        $('#editMname').val(button.data('mname'));
        $('#editLname').val(button.data('lname'));
        $('#editStaffNo').val(button.data('staffNo'));

        // Registered date (moved out of the list table)
        var created = button.data('created') || '';
        if (created) {
            var d = new Date(String(created).replace(' ', 'T'));
            $('#editStaffCreated').text(isNaN(d.getTime()) ? created : d.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' }));
        } else {
            $('#editStaffCreated').text('â€”');
        }

        // ===== Staff profile picture widget =====
        var photo = button.data('photo') || '';
        $('#staffPicImg').attr('src', photo).toggle(!!photo);
        $('#staffPicPh').toggle(!photo);
        $('#staffPicData').val('');
        $('#staffPicRemove').val('0');
        $('#staffPicRemoveBtn').toggle(!!photo);

        $('#staffPicBox').off('click').on('click', function () { $('#staffPicFile').trigger('click'); });

        $('#staffPicFile').off('change').on('change', function () {
            if (!this.files || !this.files[0]) return;
            var reader = new FileReader();
            reader.onload = function (ev) {
                var img = new Image();
                img.onload = function () {
                    var max = 400, side = Math.min(img.width, img.height);
                    var cv = document.createElement('canvas'); cv.width = max; cv.height = max;
                    var ctx = cv.getContext('2d');
                    ctx.fillStyle = '#fff'; ctx.fillRect(0, 0, max, max);
                    ctx.drawImage(img, (img.width - side) / 2, (img.height - side) / 2, side, side, 0, 0, max, max);
                    var data = cv.toDataURL('image/jpeg', 0.9);
                    $('#staffPicImg').attr('src', data).show();
                    $('#staffPicPh').hide();
                    $('#staffPicData').val(data);
                    $('#staffPicRemove').val('0');
                    $('#staffPicRemoveBtn').show();
                };
                img.src = ev.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        });

        $('#staffPicRemoveBtn').off('click').on('click', function () {
            $('#staffPicFile').val('');
            $('#staffPicImg').attr('src', '').hide();
            $('#staffPicPh').show();
            $('#staffPicData').val('');
            $('#staffPicRemove').val('1');
            $(this).hide();
        });
        $('#editPhone').val(button.data('phone'));
    });

    $('#addStaffModal').on('shown.bs.modal', function() {
        $(this).find('input[name="fname"]').focus();
    });

    $('#editStaffModal').on('shown.bs.modal', function() {
        $(this).find('input[name="fname"]').focus();
    });

    // ===== ADD STAFF: profile picture (crop to 400x400, store data URL) =====
    var $addSBox = $('#addStaffPicBox'), $addSImg = $('#addStaffPicImg'),
        $addSPh = $('#addStaffPicPh'), $addSFile = $('#addStaffPicFile'),
        $addSData = $('#addStaffPicData'), $addSRemove = $('#addStaffPicRemoveBtn');

    function addSPaint(src) {
        if (src) {
            $addSImg.attr('src', src).show();
            $addSPh.hide();
            $addSRemove.show();
        } else {
            $addSImg.attr('src', '').hide();
            $addSPh.show();
            $addSRemove.hide();
        }
    }
    $addSBox.on('click', function () { $addSFile.trigger('click'); });
    $addSFile.on('change', function () {
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
                $addSData.val(dataUrl);
                addSPaint(dataUrl);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });
    $addSRemove.on('click', function () {
        $addSData.val('');
        $addSFile.val('');
        addSPaint('');
    });
    $('#addStaffModal').on('hidden.bs.modal', function () {
        $addSData.val('');
        $addSFile.val('');
        addSPaint('');
    });
});
</script>
<?= $this->endSection() ?>
