<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SHARED PROFESSIONAL PASTEL THEME - TEACHER ===== */
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

.teacher-name {
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

.badge-grade {
    background: linear-gradient(135deg, rgba(240,147,251,0.15), rgba(168,192,255,0.15)) !important;
    color: #5a5280 !important;
    font-size: 11px !important;
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
}

.btn-kid-primary:hover {
    color: #fff !important;
    box-shadow: 0 8px 20px rgba(63,43,150,0.25) !important;
}

.btn-kid-warning {
    background: linear-gradient(135deg, var(--soft-orange), #ff8f00) !important;
    color: #fff !important;
}

.btn-kid-warning:hover { color: #fff !important; box-shadow: 0 8px 20px rgba(255,183,77,0.3) !important; }

.btn-outline-kid {
    border: 1.5px solid var(--soft-blue) !important;
    color: var(--soft-purple) !important;
    background: transparent !important;
}

.btn-outline-kid:hover {
    background: rgba(168,192,255,0.15) !important;
    color: var(--soft-purple) !important;
}

.btn-action {
    font-size: 12px !important;
    font-weight: 700 !important;
    border-radius: 50px !important;
    padding: 6px 12px !important;
    border: none !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 5px !important;
}

.btn-action-view { background: rgba(79,172,254,0.15) !important; color: #2f6fd0 !important; }
.btn-action-view:hover { background: rgba(79,172,254,0.3) !important; color: #1f55a8 !important; }

.btn-action-edit { background: rgba(255,183,77,0.18) !important; color: #b8750a !important; }
.btn-action-edit:hover { background: rgba(255,183,77,0.35) !important; color: #8f5c07 !important; }

.btn-action-password { background: rgba(129,199,132,0.18) !important; color: #2e7d32 !important; }
.btn-action-password:hover { background: rgba(129,199,132,0.35) !important; color: #1b5e20 !important; }

.btn-action-delete { background: rgba(245,87,108,0.12) !important; color: #c2185b !important; }
.btn-action-delete:hover { background: rgba(245,87,108,0.25) !important; color: #880e4f !important; }

.btn-action-more { background: rgba(63,43,150,0.08) !important; color: #5a5280 !important; }
.btn-action-more:hover { background: rgba(63,43,150,0.16) !important; color: #3f2b96 !important; }

.dropdown-menu {
    border-radius: 14px !important;
    border: 1px solid rgba(255,255,255,0.8) !important;
    box-shadow: 0 12px 32px rgba(63,43,150,0.12) !important;
}

.dropdown-item {
    font-size: 13px !important;
    font-weight: 600 !important;
    color: var(--ink) !important;
    border-radius: 8px !important;
}

.dropdown-item:hover { background: rgba(168,192,255,0.12) !important; color: var(--soft-purple) !important; }
.dropdown-item.text-danger:hover { background: rgba(245,87,108,0.08) !important; color: #c2185b !important; }

/* ===== ALERTS ===== */
.alert-success {
    background: rgba(129,199,132,0.12) !important;
    border-color: rgba(129,199,132,0.2) !important;
    color: #1b5e20 !important;
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
.teacher-photo-preview {
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

.teacher-photo-preview:hover { border-color: var(--soft-blue); }

.teacher-photo-preview i { font-size: 30px; color: rgba(63,43,150,0.35); }

.teacher-photo-preview img {
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
 <i class="fas fa-chalkboard-teacher mr-2"></i>
                        Teacher Management
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item active">Teachers</li>
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
                                    Teacher List
 <span class="badge badge-soft ml-2"><?= count($teachers ?? []) ?></span>
 </h5>
 <button type="button" class="btn btn-kid-primary btn-sm" data-toggle="modal" data-target="#addTeacherModal">
 <i class="fas fa-plus mr-1"></i> Add Teacher
 </button>
 </div>
 </div>
 <div class="card-body pt-0">

 <!-- FILTER SECTION -->
 <div class="filter-section">
 <div class="filter-row">
 <div class="filter-item">
 <label class="filter-label">Search Teacher</label>
 <div class="input-group input-group-sm">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-search"></i></span>
 </div>
 <input type="text" id="searchTeacher" class="form-control form-control-sm" placeholder="Search name, phone or grade...">
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
 <th>Grade / Section</th>
 <th class="text-center">Students</th>
 <th>Created</th>
 <th class="text-center" style="width:140px;">Actions</th>
 </tr>
 </thead>
 <tbody>
 <?php if (!empty($teachers)): ?>
 <?php $i = 1; foreach ($teachers as $teacher): ?>
 <tr class="teacher-row" data-search="<?= esc(strtolower($teacher['fname'].' '.($teacher['mname']??'').' '.$teacher['lname'].' '.$teacher['phone'].' '.$teacher['grade_section'])) ?>">
 <td class="num"><?= $i++ ?></td>
 <td>
 <div class="d-flex align-items-center">
 <?php if (!empty($teacher['picture'])): ?>
 <img src="<?= base_url('uploads/teachers/' . $teacher['picture']) ?>" alt="Teacher"
                    class="avatar-circle mr-2" style="width:40px;height:40px;min-width:40px;object-fit:cover;background:#f1f5f9;">
 <?php else: ?>
 <div class="avatar-circle mr-2" style="width:40px;height:40px;min-width:40px;">
 <i class="fas fa-chalkboard-teacher" style="font-size:17px;"></i>
 </div>
 <?php endif; ?>
 <div>
 <div class="teacher-name"><?= esc($teacher['fname']) ?> <?= esc($teacher['lname']) ?></div>
 <?php if(!empty($teacher['mname'])): ?>
 <div class="muted"><?= esc($teacher['mname']) ?></div>
 <?php endif; ?>
 </div>
 </div>
 </td>
 <td><code><?= esc($teacher['phone']) ?></code></td>
 <td>
 <span class="badge badge-grade"><i class="fas fa-book mr-1"></i><?= esc($teacher['grade_section']) ?></span>
 </td>
 <td class="text-center">
 <span class="badge badge-soft"><?= $studentCounts[$teacher['grade_section']] ?? 0 ?></span>
 </td>
 <td class="muted"><?= date('M d, Y', strtotime($teacher['created_at'])) ?></td>
 <td class="text-center">
 <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
 <a href="<?= base_url('teachers-view/' . $teacher['id']) ?>"
                                                           class="btn-action btn-action-view"
                                                           title="View students under this teacher">
 <i class="fas fa-eye"></i> View
 </a>
 <div class="dropdown">
 <button class="btn-action btn-action-more dropdown-toggle"
                                                                    data-toggle="dropdown"
                                                                    title="More actions"
                                                                    style="border:none; cursor:pointer;">
 <i class="fas fa-ellipsis-h"></i>
 </button>
 <div class="dropdown-menu dropdown-menu-right">
 <a class="dropdown-item" href="#"
                                                                   data-toggle="modal" data-target="#editTeacherModal"
                                                                   data-id="<?= $teacher['id'] ?>"
                                                                   data-fname="<?= esc($teacher['fname']) ?>"
                                                                   data-mname="<?= esc($teacher['mname'] ?? '') ?>"
                                                                   data-lname="<?= esc($teacher['lname']) ?>"
data-phone="<?= esc($teacher['phone']) ?>"
                                                                    data-grade="<?= esc($teacher['grade_section']) ?>"
                                                                    data-picture="<?= esc($teacher['picture'] ?? '') ?>">
 <i class="fas fa-edit mr-2" style="color:#b8750a;"></i> Edit
 </a>
 <div class="dropdown-divider"></div>
 <a class="dropdown-item" href="<?= base_url('teachers-send-password/' . $teacher['id']) ?>"
                                                                   onclick="return confirm('Send a new password to this teacher via SMS?\n\n<?= esc($teacher['fname']) ?> <?= esc($teacher['lname']) ?>')">
 <i class="fas fa-key mr-2" style="color:#2e7d32;"></i> Reset Password
 </a>
 <div class="dropdown-divider"></div>
 <a class="dropdown-item text-danger" href="<?= base_url('teachers-delete/' . $teacher['id']) ?>"
                                                                   onclick="return confirm('Delete this teacher?\n\n<?= esc($teacher['fname']) ?> <?= esc($teacher['lname']) ?>')">
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
 <i class="fas fa-chalkboard-teacher fa-3x mb-3 d-block"></i>
 <h5>No teachers yet</h5>
 <p>Click "Add Teacher" to register a new teacher.</p>
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

<!-- ===== ADD TEACHER MODAL ===== -->
<div class="modal fade" id="addTeacherModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <form action="<?= base_url('teachers-save') ?>" method="post" enctype="multipart/form-data">
 <?= csrf_field() ?>
 <div class="modal-header">
 <h5 class="modal-title">
 <i class="fas fa-user-plus mr-2" style="color: var(--soft-blue);"></i>
                        Register New Teacher
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
 <div class="row">
 <div class="col-6">
 <div class="form-group">
 <label>Phone Number <span class="text-danger">*</span></label>
 <div class="input-group">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-phone"></i></span>
 </div>
 <input type="text" name="phone" class="form-control" placeholder="09XXXXXXXXX" required>
 </div>
 </div>
 </div>
 <div class="col-6">
 <div class="form-group">
 <label>Grade / Section <span class="text-danger">*</span></label>
 <select name="grade_section" class="form-control" required>
 <option value="">— Select Grade & Section —</option>
 <optgroup label="Kindergarten">
 <option>Kindergarten - A</option>
 <option>Kindergarten - B</option>
 </optgroup>
 <optgroup label=" Grade 1">
 <option>Grade 1 - A</option>
 <option>Grade 1 - B</option>
 </optgroup>
 <optgroup label=" Grade 2">
 <option>Grade 2 - A</option>
 <option>Grade 2 - B</option>
 </optgroup>
 <optgroup label=" Grade 3">
 <option>Grade 3 - A</option>
 <option>Grade 3 - B</option>
 </optgroup>
 <optgroup label=" Grade 4">
 <option>Grade 4 - A</option>
 <option>Grade 4 - B</option>
 </optgroup>
 <optgroup label=" Grade 5">
 <option>Grade 5 - A</option>
 <option>Grade 5 - B</option>
 </optgroup>
 <optgroup label=" Grade 6">
 <option>Grade 6 - A</option>
 <option>Grade 6 - B</option>
 </optgroup>
 </select>
 </div>
 </div>
 </div>
 <div class="alert" style="background: rgba(168,192,255,0.12); border: 1.5px dashed rgba(63,43,150,0.18); border-radius: 12px; margin-bottom: 0; padding: 12px 14px; font-size: 13px; color: var(--ink);">
 <i class="fas fa-info-circle mr-1" style="color: var(--soft-blue);"></i>
                        The teacher is linked to the grade/section above, so their students and parents connect automatically.
                        A temporary password will be generated and recorded in the SMS Logs (SMS is not live yet).
 </div>

 <div class="text-center mt-3">
 <div class="teacher-photo-preview" id="addPhotoPreview" onclick="document.getElementById('addPhotoInput').click()">
 <i class="fas fa-user" id="addPhotoIcon"></i>
 <img id="addPhotoImg" src="" alt="">
 </div>
 <input type="file" id="addPhotoInput" class="d-none" accept="image/*" name="picture">
 <small class="form-text text-muted">Optional teacher photo</small>
 </div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Cancel</button>
 <button type="submit" class="btn btn-kid-primary btn-sm px-4">
 <i class="fas fa-save mr-1"></i> Save Teacher
 </button>
 </div>
 </form>
 </div>
 </div>
</div>

<!-- ===== EDIT TEACHER MODAL ===== -->
<div class="modal fade" id="editTeacherModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <form action="<?= base_url('teachers-update') ?>" method="post" enctype="multipart/form-data">
 <?= csrf_field() ?>
 <input type="hidden" name="id" id="editId">
 <div class="modal-header">
 <h5 class="modal-title">
 <i class="fas fa-user-edit mr-2" style="color: var(--soft-orange);"></i>
                        Edit Teacher
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
 <div class="row">
 <div class="col-6">
 <div class="form-group">
 <label>Phone Number <span class="text-danger">*</span></label>
 <div class="input-group">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-phone"></i></span>
 </div>
 <input type="text" name="phone" id="editPhone" class="form-control" required>
 </div>
 </div>
 </div>
 <div class="col-6">
 <div class="form-group mb-0">
 <label>Grade / Section <span class="text-danger">*</span></label>
 <select name="grade_section" id="editGrade" class="form-control" required>
 <option value="">— Select Grade & Section —</option>
 <optgroup label="Kindergarten">
 <option>Kindergarten - A</option>
 <option>Kindergarten - B</option>
 </optgroup>
 <optgroup label=" Grade 1">
 <option>Grade 1 - A</option>
 <option>Grade 1 - B</option>
 </optgroup>
 <optgroup label=" Grade 2">
 <option>Grade 2 - A</option>
 <option>Grade 2 - B</option>
 </optgroup>
 <optgroup label=" Grade 3">
 <option>Grade 3 - A</option>
 <option>Grade 3 - B</option>
 </optgroup>
 <optgroup label=" Grade 4">
 <option>Grade 4 - A</option>
 <option>Grade 4 - B</option>
 </optgroup>
 <optgroup label=" Grade 5">
 <option>Grade 5 - A</option>
 <option>Grade 5 - B</option>
 </optgroup>
 <optgroup label=" Grade 6">
 <option>Grade 6 - A</option>
 <option>Grade 6 - B</option>
 </optgroup>
 </select>
 </div>
 </div>
 </div>

 <div class="text-center mt-3">
 <div class="teacher-photo-preview" id="editPhotoPreview" onclick="document.getElementById('editPhotoInput').click()">
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
 <i class="fas fa-check mr-1"></i> Update Teacher
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
    $('#searchTeacher').on('keyup', function(){
        var val = $(this).val().toLowerCase();
        $('.teacher-row').each(function(){
            var search = $(this).data('search');
            $(this).toggle(search.indexOf(val) > -1);
        });
    });

    $('#editTeacherModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        $('#editId').val(button.data('id'));
        $('#editFname').val(button.data('fname'));
        $('#editMname').val(button.data('mname'));
        $('#editLname').val(button.data('lname'));
        $('#editPhone').val(button.data('phone'));
        $('#editGrade').val(button.data('grade'));

        var pic = button.data('picture');
        if (pic) {
            $('#editPhotoImg').attr('src', '<?= base_url('uploads/teachers/') ?>' + pic).show();
            $('#editPhotoIcon').hide();
        } else {
            $('#editPhotoImg').attr('src', '').hide();
            $('#editPhotoIcon').show();
        }
        document.getElementById('editPhotoInput').value = '';
    });

    function previewTeacherPhoto(input, imgId, iconId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (ev) {
                $('#' + imgId).attr('src', ev.target.result).show();
                $('#' + iconId).hide();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#addPhotoInput').on('change', function () { previewTeacherPhoto(this, 'addPhotoImg', 'addPhotoIcon'); });
    $('#editPhotoInput').on('change', function () { previewTeacherPhoto(this, 'editPhotoImg', 'editPhotoIcon'); });

    $('#addTeacherModal').on('hidden.bs.modal', function () {
        $('#addPhotoImg').attr('src', '').hide();
        $('#addPhotoIcon').show();
        document.getElementById('addPhotoInput').value = '';
    });

    $('#addTeacherModal').on('shown.bs.modal', function() {
        $(this).find('input[name="fname"]').focus();
    });

    $('#editTeacherModal').on('shown.bs.modal', function() {
        $(this).find('input[name="fname"]').focus();
    });
});
</script>
<?= $this->endSection() ?>