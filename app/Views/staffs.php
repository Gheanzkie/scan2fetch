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
    border-radius: 6px !important;
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
 <button type="button" class="btn btn-kid-primary btn-sm" data-toggle="modal" data-target="#addStaffModal">
 <i class="fas fa-plus mr-1"></i> Add Staff
 </button>
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
 <th>Full Name</th>
 <th>Phone</th>
 <th>Created</th>
 <th class="text-center" style="width:220px;">Actions</th>
 </tr>
 </thead>
 <tbody>
 <?php if (!empty($staffs)): ?>
 <?php $i = 1; foreach ($staffs as $staff): ?>
 <tr class="staff-row" data-search="<?= esc(strtolower($staff['fname'].' '.($staff['mname']??'').' '.$staff['lname'].' '.$staff['phone'])) ?>">
 <td class="num"><?= $i++ ?></td>
 <td>
 <div class="d-flex align-items-center">
 <?php if (!empty($staff['picture'])): ?>
 <img src="<?= base_url('uploads/staffs/' . $staff['picture']) ?>" alt="Staff"
                    class="avatar-circle mr-2" style="width:40px;height:40px;min-width:40px;object-fit:cover;background:#f1f5f9;">
 <?php else: ?>
 <div class="avatar-circle mr-2" style="width:40px;height:40px;min-width:40px;">
 <i class="fas fa-user-tie" style="font-size:17px;"></i>
 </div>
 <?php endif; ?>
 <div>
 <div class="staff-name"><?= esc($staff['fname']) ?> <?= esc($staff['lname']) ?></div>
 <?php if(!empty($staff['mname'])): ?>
 <div class="muted"><?= esc($staff['mname']) ?></div>
 <?php endif; ?>
 </div>
 </div>
 </td>
 <td><code><?= esc($staff['phone']) ?></code></td>
 <td class="muted"><?= date('M d, Y', strtotime($staff['created_at'])) ?></td>
 <td class="text-center">
 <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
 <button class="btn-action btn-action-edit"
                                                                data-toggle="modal" data-target="#editStaffModal"
                                                                data-id="<?= $staff['id'] ?>"
                                                                data-fname="<?= esc($staff['fname']) ?>"
                                                                data-mname="<?= esc($staff['mname'] ?? '') ?>"
                                                                data-lname="<?= esc($staff['lname']) ?>"
                                                                data-phone="<?= esc($staff['phone']) ?>"
                                                                data-picture="<?= esc($staff['picture'] ?? '') ?>"
                                                                title="Edit">
 <i class="fas fa-edit"></i> Edit
 </button>
 <a href="<?= base_url('staffs-delete/' . $staff['id']) ?>"
                                                           class="btn-action btn-action-delete"
                                                           onclick="return confirm('Delete this staff member?\n\n<?= esc($staff['fname']) ?> <?= esc($staff['lname']) ?>')"
                                                           title="Delete">
 <i class="fas fa-trash"></i> Delete
 </a>
 </div>
 </td>
 </tr>
 <?php endforeach; ?>
 <?php else: ?>
 <tr>
 <td colspan="5" class="text-center py-5 empty-state">
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
                        A temporary password will be generated and recorded in the SMS Logs (SMS is not live yet).
 </div>

 <div class="text-center mt-3">
 <div class="staff-photo-preview" id="addPhotoPreview" onclick="document.getElementById('addPhotoInput').click()">
 <i class="fas fa-user" id="addPhotoIcon"></i>
 <img id="addPhotoImg" src="" alt="">
 </div>
 <input type="file" id="addPhotoInput" class="d-none" accept="image/*" name="picture">
 <small class="form-text text-muted">Optional staff photo</small>
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
 <label>Phone Number <span class="text-danger">*</span></label>
 <div class="input-group">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-phone"></i></span>
 </div>
 <input type="text" name="phone" id="editPhone" class="form-control" required>
 </div>
 </div>
 <div class="form-group mb-0">
 <label>Password <span class="text-muted" style="font-weight: 400;">(leave blank to keep current)</span></label>
 <div class="input-group">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-lock"></i></span>
 </div>
 <input type="password" name="password" class="form-control" placeholder="••••••••" minlength="6">
 </div>
 </div>

 <div class="text-center mt-3">
 <div class="staff-photo-preview" id="editPhotoPreview" onclick="document.getElementById('editPhotoInput').click()">
 <i class="fas fa-user" id="editPhotoIcon"></i>
 <img id="editPhotoImg" src="" alt="">
 </div>
 <input type="file" id="editPhotoInput" class="d-none" accept="image/*" name="picture">
 <small class="form-text text-muted">Leave empty to keep current photo</small>
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
        $('#editPhone').val(button.data('phone'));

        var pic = button.data('picture');
        if (pic) {
            $('#editPhotoImg').attr('src', '<?= base_url('uploads/staffs/') ?>' + pic).show();
            $('#editPhotoIcon').hide();
        } else {
            $('#editPhotoImg').attr('src', '').hide();
            $('#editPhotoIcon').show();
        }
        document.getElementById('editPhotoInput').value = '';
    });

    function previewStaffPhoto(input, imgId, iconId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (ev) {
                $('#' + imgId).attr('src', ev.target.result).show();
                $('#' + iconId).hide();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#addPhotoInput').on('change', function () { previewStaffPhoto(this, 'addPhotoImg', 'addPhotoIcon'); });
    $('#editPhotoInput').on('change', function () { previewStaffPhoto(this, 'editPhotoImg', 'editPhotoIcon'); });

    $('#addStaffModal').on('hidden.bs.modal', function () {
        $('#addPhotoImg').attr('src', '').hide();
        $('#addPhotoIcon').show();
        document.getElementById('addPhotoInput').value = '';
    });

    $('#addStaffModal').on('shown.bs.modal', function() {
        $(this).find('input[name="fname"]').focus();
    });

    $('#editStaffModal').on('shown.bs.modal', function() {
        $(this).find('input[name="fname"]').focus();
    });
});
</script>
<?= $this->endSection() ?>