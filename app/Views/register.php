<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
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
    background: #f1f5f9 !important;
    color: #334155 !important;
}

.content-wrapper { background: transparent !important; }

/* ===== CARDS ===== */
.card {
    border-radius: 24px !important;
    border: 1px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.75) !important;
    box-shadow: 0 8px 30px rgba(63,43,150,0.05) !important;
    overflow: hidden !important;
}

.card-header {
    background: rgba(255,255,255,0.5) !important;
    border-bottom: 2px solid rgba(255,255,255,0.4) !important;
    padding: 1.1rem 1.5rem !important;
}

.card-header h5 {
    color: var(--ink) !important;
    font-weight: 700 !important;
    font-size: 1.05rem !important;
}

.card-body {
    padding: 1.5rem !important;
}

/* ===== STEP NAVIGATION ===== */
.step-nav {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 10px 18px;
    margin-bottom: 22px;
}

.step-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 20px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    color: #64748b;
    background: #fff;
    border: 1px solid #cbd5e1;
}

.step-link:hover, .step-link.step-active {
    border-color: #4361ee;
    color: #4361ee;
    background: #eef2ff;
}

.step-num {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
    color: #fff;
    background: #4361ee;
}

.step-link.step-active .step-num, .step-num.done {
    background: #16a34a;
}

.step-connector {
    width: 26px;
    height: 2px;
    background: #cbd5e1;
    border-radius: 2px;
}

/* ===== CONTENT HEADER ===== */
.breadcrumb {
    background: transparent !important;
    padding: 0 !important;
}

.breadcrumb-item a {
    color: var(--muted) !important;
    transition: color 0.3s ease !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    font-size: 13px !important;
}

.breadcrumb-item a:hover { color: var(--soft-purple) !important; }

.breadcrumb-item.active {
    color: var(--ink) !important;
    font-weight: 700 !important;
    font-size: 13px !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: #c0c0d8 !important;
    content: "º" !important;
}

.content-header h1 {
    color: #0f172a !important;
    font-weight: 700 !important;
    font-size: 1.8rem !important;
}

.content-header h1 i {
    color: #4361ee !important;
}

/* ===== FORM CONTROLS ===== */
.form-control {
    border-radius: 6px !important;
    border: 1px solid #cbd5e1 !important;
    background: #fff !important;
    color: #334155 !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
}

.form-control:focus {
    border-color: #4361ee !important;
    background: #fff !important;
    color: #334155 !important;
    box-shadow: 0 0 0 4px rgba(67, 97, 238, .12) !important;
}

.form-control::placeholder {
    color: #94a3b8 !important;
    font-weight: 500 !important;
    opacity: 1;
}

select.form-control option {
    background: #ffffff !important;
    color: #334155 !important;
    padding: 6px 10px !important;
    font-size: 14px !important;
}

select.form-control optgroup {
    background: #f8fafc !important;
    color: #0f172a !important;
    font-weight: 700 !important;
}

label {
    color: #334155 !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    margin-bottom: 6px !important;
}

label .text-danger { color: #dc2626 !important; }

.small {
    color: #64748b !important;
    font-size: 12px !important;
}

.input-group-text {
    background: #f1f5f9 !important;
    border: 1px solid #cbd5e1 !important;
    border-right: none !important;
    color: #64748b !important;
    border-radius: 6px 0 0 6px !important;
    font-size: 14px !important;
}

.input-group .form-control {
    border-radius: 0 6px 6px 0 !important;
    border-left: none !important;
}

/* ===== SECTION BOXES ===== */
.guardian-box {
    border-radius: 18px !important;
    padding: 1rem 1.1rem;
    border: 1px solid rgba(255,255,255,0.8);
    background: rgba(255,255,255,0.4);
    transition: box-shadow 0.3s ease !important;
}

.guardian-box.box-parent { border-left: 5px solid var(--soft-green) !important; background: rgba(129,199,132,0.07); }
.guardian-box.box-fetcher { border-left: 5px solid var(--soft-teal) !important; background: rgba(79,172,254,0.07); }
.guardian-box.box-fetcher-alt { border-left: 5px solid var(--soft-orange) !important; background: rgba(255,183,77,0.07); }

.guardian-box h6 {
    color: var(--ink) !important;
    font-weight: 700 !important;
    font-size: 14px !important;
}

/* ===== BADGES ===== */
.badge {
    padding: 6px 14px !important;
    border-radius: 50px !important;
    font-weight: 700 !important;
    font-size: 11px !important;
}

.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }

/* ===== ALERTS ===== */
.alert {
    border-radius: 16px !important;
    padding: 13px 18px !important;
    font-size: 13px !important;
    border: 2px solid transparent !important;
}

.alert-info {
    background: rgba(168,192,255,0.15) !important;
    border-color: rgba(168,192,255,0.20) !important;
    color: #5a5a8a !important;
}

.alert-warning {
    background: rgba(255,183,77,0.14) !important;
    border-color: rgba(255,183,77,0.20) !important;
    color: #8a6d3b !important;
}

.alert i {
    font-size: 1.05rem !important;
    margin-right: 8px !important;
}

/* ===== PHOTO PREVIEWS ===== */
.photo-preview {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid rgba(168,192,255,0.35);
    background: rgba(255,255,255,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: border-color 0.3s ease;
    margin: 0 auto;
}

.photo-preview:hover { border-color: var(--soft-pink); }

.photo-preview i {
    color: rgba(63,43,150,0.25);
    font-size: 30px;
}

.photo-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.student-photo-preview {
    width: 150px;
    height: 150px;
    margin: 0 auto 16px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid rgba(168,192,255,0.35);
    background: rgba(255,255,255,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.student-photo-preview:hover { border-color: var(--soft-pink); }

.student-photo-preview i {
    color: rgba(63,43,150,0.25);
    font-size: 60px;
}

.student-photo-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 700 !important;
    transition: box-shadow 0.3s ease !important;
    padding: 10px 24px !important;
    font-size: 14px !important;
}

.btn-lg {
    padding: 13px 32px !important;
    font-size: 15px !important;
}

.btn-kid-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(63,43,150,0.20) !important;
}

.btn-kid-primary:hover { box-shadow: 0 8px 25px rgba(63,43,150,0.30) !important; }

.btn-kid-success {
    background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(76,175,80,0.20) !important;
}

.btn-kid-success:hover { box-shadow: 0 8px 25px rgba(76,175,80,0.30) !important; }

.btn-kid-pink {
    background: linear-gradient(135deg, var(--soft-pink), var(--soft-rose)) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(245,87,108,0.20) !important;
}

.btn-kid-pink:hover { box-shadow: 0 8px 25px rgba(245,87,108,0.30) !important; }

.btn-outline-kid {
    border: 2px solid rgba(63,43,150,0.12) !important;
    color: var(--muted) !important;
    background: rgba(255,255,255,0.4) !important;
}

.btn-outline-kid:hover {
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
    background: rgba(168,192,255,0.10) !important;
}

/* ===== STICKY ACTION BAR ===== */
.action-bar {
    position: sticky;
    bottom: 12px;
    z-index: 50;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.9);
    border-radius: 50px;
    box-shadow: 0 10px 35px rgba(63,43,150,0.10);
    padding: 12px 18px;
}

/* ===== MODALS ===== */
.modal-content {
    border-radius: 24px !important;
    border: 2px solid rgba(255,255,255,0.8) !important;
    background: rgba(255,255,255,0.97) !important;
    box-shadow: 0 20px 60px rgba(63,43,150,0.10) !important;
}

.modal-header {
    border-bottom: 2px solid rgba(63,43,150,0.06) !important;
    border-radius: 24px 24px 0 0 !important;
    background: rgba(255,255,255,0.5) !important;
    padding: 1.1rem 1.5rem !important;
}

.modal-header h5, .modal-header h6 {
    color: var(--ink) !important;
    font-weight: 700 !important;
    font-size: 1.1rem !important;
}

.modal-footer {
    border-top: 2px solid rgba(63,43,150,0.06) !important;
    border-radius: 0 0 24px 24px !important;
    background: rgba(255,255,255,0.5) !important;
    padding: 1rem 1.5rem !important;
}

.modal-body { padding: 1.5rem !important; }

.modal-backdrop { z-index: 1040 !important; }
.modal { z-index: 1050 !important; }
.modal-dialog { z-index: 1060 !important; }
.modal-open { overflow: auto !important; }
.modal-open .modal { overflow-x: hidden; overflow-y: auto !important; }

.qr-row {
    display: flex;
    align-items: center;
    gap: 10px;
    border: 1px solid rgba(63,43,150,0.08);
    border-radius: 12px;
    padding: 8px 10px;
    margin-bottom: 6px;
    background: rgba(255,255,255,0.5);
}

.qr-row img {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    border: 1px solid rgba(63,43,150,0.10);
}

.qr-row strong { color: var(--ink) !important; }
.qr-row small { color: #8888aa !important; }

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .btn-lg { padding: 10px 20px !important; font-size: 14px !important; }
    .content-header h1 { font-size: 1.4rem !important; }
    .photo-preview { width: 64px; height: 64px; }
    .student-photo-preview { width: 130px; height: 130px; }
    .step-nav { border-radius: 24px; }
}

@media (max-width: 480px) {
    .card { border-radius: 18px !important; }
    .form-control { font-size: 13px !important; padding: 10px 12px !important; }
    .btn { font-size: 12px !important; padding: 8px 16px !important; }
    .action-bar { border-radius: 24px; }
}
.reg-step { display:flex; align-items:center; gap:10px; margin-bottom:14px; }\n.reg-step-num { width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:13px; color:#fff; background:linear-gradient(135deg, var(--soft-blue), var(--soft-purple)); box-shadow:0 3px 10px rgba(63,43,150,0.22); }\n.reg-step-txt { font-size:12px; font-weight:800; letter-spacing:.04em; text-transform:uppercase; color:#5a5280; }\n.reg-step-sub { font-size:11.5px; color:#9a9ab8; font-weight:600; }\n\n/* ===== MINIMAL PROFILE PICTURE PICKER ===== */
.reg-avatar {
    position: relative; width: 92px; height: 92px; margin: 0 auto;
    border-radius: 50%; overflow: hidden; cursor: pointer;
    background: #eef2ff; border: 3px solid rgba(108,140,255,0.25);
    display: flex; align-items: center; justify-content: center;
    transition: border-color .2s ease, transform .15s ease;
}
.reg-avatar:hover { border-color: var(--soft-blue); transform: scale(1.03); }
.reg-avatar-img { width: 100%; height: 100%; object-fit: cover; }
.reg-avatar-placeholder { font-size: 30px; color: #a5b4fc; }
.reg-avatar-overlay {
    position: absolute; left: 0; right: 0; bottom: 0; padding: 4px 0;
    background: rgba(63,43,150,0.72); color: #fff; font-size: 10.5px;
    font-weight: 700; text-align: center; opacity: 0; transition: opacity .2s ease;
}
.reg-avatar:hover .reg-avatar-overlay { opacity: 1; }
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-user-plus mr-2"></i>
                        Register Student
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item"><a href="<?= base_url('students') ?>">Students</a></li>
 <li class="breadcrumb-item active">Register</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">

 <!-- FLASH MESSAGES -->
 <?php if(session()->getFlashdata('msg')): ?>
 <div class="alert alert-success alert-dismissible fade show">
 <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('msg') ?>
 <button type="button" class="close" data-dismiss="alert" style="color: var(--ink);">&times;</button>
 </div>
 <?php endif; ?>
 <?php if(session()->getFlashdata('error')): ?>
 <div class="alert alert-danger alert-dismissible fade show">
 <i class="fas fa-exclamation-circle mr-2"></i> <?= session()->getFlashdata('error') ?>
 <button type="button" class="close" data-dismiss="alert" style="color: var(--ink);">&times;</button>
 </div>
 <?php endif; ?>

 <!-- ===== EXCEL IMPORT ===== -->
 <div class="card mb-4">
 <div class="card-header">
 <h5 class="mb-0">
 <i class="fas fa-file-excel mr-2" style="color: #1d9e4b;"></i>
                                 Import from Excel
 </h5>
 </div>
 <div class="card-body">
 <div class="row align-items-center">
 <div class="col-md-7">
 <p class="mb-1" style="color: var(--muted); font-size: 13.5px;">
 <i class="fas fa-info-circle mr-1" style="color: var(--soft-blue);"></i>
                                        Import many students + parents at once using an Excel (.xlsx) file.
 </p>
 <ul class="small mb-1" style="color: var(--muted);">
 <li>Required columns: Student First Name, Student Last Name, Parent First Name, Parent Last Name, Parent Phone</li>
 <li>Optional: Student Middle Name, Grade & Section, Parent Middle Name, Parent Relation</li>
 <li>Also required: <strong>Student ID</strong> (col J) and <strong>Parent/Fetcher ID</strong> (col K, must start with P-)</li>
 </ul>
 </div>
 <div class="col-md-5">
 <form action="<?= base_url('students-import') ?>" method="post" enctype="multipart/form-data" id="importForm">
 <?= csrf_field() ?>
 <div class="input-group">
 <div class="custom-file">
 <input type="file" class="custom-file-input" name="excel_file" id="excelFileInput" accept=".xlsx" required>
 <label class="custom-file-label" for="excelFileInput">Choose .xlsx file</label>
 </div>
 <div class="input-group-append">
  <button type="submit" class="btn btn-kid-primary btn-sm" id="importBtn">
  <i class="fas fa-upload mr-1"></i> Import
  </button>
 </div>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div>

 <!-- ===== ZIP IMPORT (below the Excel import) ===== -->
 <div class="card mb-3">
 <div class="card-header pt-3">
 <h5 class="mb-0">
 <i class="fas fa-file-zipper mr-2" style="color: var(--soft-blue);"></i>
                                    ZIP Import
 </h5>
 </div>
 <div class="card-body">
 <div class="row align-items-center">
 <div class="col-md-7">
 <p class="mb-1" style="color: var(--muted); font-size: 13.5px;">
 <i class="fas fa-info-circle mr-1" style="color: var(--soft-blue);"></i>
                                        Upload a <strong>.zip</strong> archive and the system extracts it automatically.
 </p>
 <ul class="small mb-1" style="color: var(--muted);">
 <li>Files are extracted to <code>public/uploads/&lt;zip-name&gt;/</code></li>
 <li>Example: <code>grade1-photos.zip</code> â†’ <code>uploads/grade1-photos/</code></li>
 <li>Sub-folders inside the ZIP are kept; hidden/system files are skipped.</li>
 <li>Only images and documents — the archive is never executed.</li>
 </ul>
 </div>
 <div class="col-md-5">
 <form action="<?= base_url('students-import-zip') ?>" method="post" enctype="multipart/form-data" id="zipForm">
 <?= csrf_field() ?>
 <div class="input-group">
 <div class="custom-file">
 <input type="file" class="custom-file-input" name="zip_file" id="zipFileInput" accept=".zip,application/zip" required>
 <label class="custom-file-label" for="zipFileInput" id="zipFileLabel">Choose .zip file</label>
 </div>
 <div class="input-group-append">
  <button type="submit" class="btn btn-kid-primary btn-sm" id="zipBtn">
  <i class="fas fa-upload mr-1"></i> Import ZIP
  </button>
  </div>
  </div>
  </form>
  </div>
  </div>
  </div>
  </div>

  <!-- ===== REGISTRATION FORM ===== -->
 <div id="registrationFormContainer">
 <form action="<?= base_url('students-save') ?>" method="post" enctype="multipart/form-data" id="registrationForm">
 <?= csrf_field() ?>

 <div class="row">

 <!-- ===== LEFT COLUMN: STUDENT INFO ===== -->
 <div class="col-md-5" id="section-student">
 <div class="card">
 <div class="card-header pt-3">
 <h5 class="mb-0">
 <i class="fas fa-user-graduate mr-2" style="color: var(--soft-blue);"></i>
                                        Student Information
 </h5>
 </div>
  <div class="card-body">

  <div class="reg-step">
  <span class="reg-step-num">1</span>
  <div>
  <div class="reg-step-txt">Step 1 &mdash; Student</div>
  <div class="reg-step-sub">Who is being enrolled</div>
  </div>
  </div>

  <!-- ===== REPEATER: one .student-block per student, all sharing 1 parent + fetchers ===== -->
  <div id="studentBlocks">

  <div class="student-block" data-index="0" style="position:relative;">

  <!-- ===== Student profile picture (optional, minimal) ===== -->
  <div class="reg-avatar-wrap text-center mb-3">
  <div class="reg-avatar" title="Click to add or change the picture">
  <img class="reg-avatar-img" src="" alt="" style="display:none;">
  <span class="reg-avatar-placeholder"><i class="fas fa-camera"></i></span>
  <span class="reg-avatar-overlay">Add picture</span>
  </div>
  <input type="file" class="reg-avatar-file" accept="image/*" style="display:none;">
  <input type="hidden" name="student_picture_data[]" class="reg-avatar-data" value="">
  <input type="hidden" name="student_picture_remove[]" class="reg-avatar-remove" value="0">
  <div>
  <button type="button" class="btn btn-link btn-sm reg-avatar-remove-btn" style="display:none; color:#b23c4d; padding:0; font-size:12px;">
  <i class="fas fa-trash-alt mr-1"></i>Remove picture
  </button>
  </div>
  </div>

  <!-- Student ID (manual, not auto-generated) -->
  <div class="form-group">
  <label>Student ID <span class="text-danger">*</span></label>
  <input type="text" name="student_no[]" class="form-control student-no" placeholder="1001" inputmode="numeric" maxlength="20" required>
  <small class="text-muted" style="font-size:10px;">Number printed on the student's record — used as the photo filename.</small>
  </div>

  <!-- Student Name -->
  <div class="row">
  <div class="col-4">
  <label>First Name <span class="text-danger">*</span></label>
  <input type="text" name="fname[]" class="form-control student-fname" placeholder="Juan" required>
  </div>
  <div class="col-4">
  <label>Middle Name</label>
  <input type="text" name="mname[]" class="form-control student-mname" placeholder="Dela">
  </div>
  <div class="col-4">
  <label>Last Name <span class="text-danger">*</span></label>
  <input type="text" name="lname[]" class="form-control student-lname" placeholder="Cruz" required>
  </div>
  </div>

  <!-- Grade & Section -->
  <div class="form-group mt-3">
  <label> Grade & Section <span class="text-danger">*</span></label>
  <select name="grade_section[]" class="form-control student-grade" required>
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

  </div><!-- /.student-block -->

  </div><!-- /#studentBlocks -->

  <button type="button" id="addStudentBtn" class="btn btn-outline-primary btn-block mt-2"
          style="border-radius:12px; border-style:dashed; font-weight:600;">
  <i class="fas fa-plus-circle mr-1"></i> Add another student
  </button>
  <small class="text-muted d-block mt-1" style="font-size:11px;">
  Add every child in this family here — they all share the same parent and fetchers on the right.
  </small>

  <div class="alert alert-info mt-3 mb-0">
  <i class="fas fa-info-circle"></i>
  <small>Fill in student details first, then add parents and fetchers on the right!</small>
  </div>
 </div>
 </div>
 </div>

 <!-- ===== RIGHT COLUMN: PARENT / GUARDIAN ===== -->
 <div class="col-md-7" id="section-guardians">
 <div class="card">
 <div class="card-header pt-3">
 <h5 class="mb-0">
 <i class="fas fa-users mr-2" style="color: var(--soft-green);"></i>
                                        Parent / Guardian
 </h5>
 </div>
 <div class="card-body">

 <div class="reg-step">
 <span class="reg-step-num">2</span>
 <div>
 <div class="reg-step-txt">Step 2 &mdash; Parent / Guardian</div>
 <div class="reg-step-sub">Who is allowed to fetch the child</div>
 </div>
 </div>

 <!-- Parent 1 (Required) -->
 <div class="guardian-box box-parent mb-3">
 <h6 class="mb-3">
 <span class="badge badge-success"> Required</span>
 <i class="fas fa-user mr-1"></i> Parent / Guardian
 </h6>

 <!-- ===== Parent profile picture (optional, minimal) ===== -->
 <div class="reg-avatar-wrap text-center mb-2">
 <div class="reg-avatar" title="Click to add or change the picture">
 <img class="reg-avatar-img" src="" alt="" style="display:none;">
 <span class="reg-avatar-placeholder"><i class="fas fa-camera"></i></span>
 <span class="reg-avatar-overlay">Add picture</span>
 </div>
 <input type="file" class="reg-avatar-file" accept="image/*" style="display:none;">
 <input type="hidden" name="parent_picture_data[]" class="reg-avatar-data" value="">
 <input type="hidden" name="parent_picture_remove[]" class="reg-avatar-remove" value="0">
 <div>
 <button type="button" class="btn btn-link btn-sm reg-avatar-remove-btn" style="display:none; color:#b23c4d; padding:0; font-size:12px;">
 <i class="fas fa-trash-alt mr-1"></i>Remove picture
 </button>
 </div>
 </div>

 <div class="form-group mb-2">
 <label class="small">Parent / Fetcher ID <span class="text-danger">*</span></label>
 <input type="text" name="parent_no[]" class="form-control form-control-sm parent-no" placeholder="P-1001" maxlength="20" required>
 <small class="text-muted" style="font-size:10px;">Same number as the student, prefixed with P- (e.g. P-1001).</small>
 </div>

 <div class="row">
 <div class="col-4">
 <label class="small">First Name <span class="text-danger">*</span></label>
 <input type="text" name="parent_fname[]" class="form-control form-control-sm" placeholder="Maria" required>
 </div>
 <div class="col-4">
 <label class="small">Middle Name</label>
 <input type="text" name="parent_mname[]" class="form-control form-control-sm" placeholder="Santos">
 </div>
 <div class="col-4">
 <label class="small">Last Name <span class="text-danger">*</span></label>
 <input type="text" name="parent_lname[]" class="form-control form-control-sm" placeholder="Dela Cruz" required>
 </div>
 </div>
 <div class="row mt-2">
 <div class="col-7">
 <label class="small"> Phone Number <span class="text-danger">*</span></label>
 <div class="input-group input-group-sm">
 <input type="text" name="parent_phone[]" class="form-control" placeholder="09XXXXXXXXX" required>
 </div>
 </div>
 <div class="col-5">
 <label class="small">Relation <span class="text-danger">*</span></label>
 <select name="parent_relation[]" class="form-control form-control-sm" required>
 <option value="Parent" selected>Parent</option>
 <option value="Mother">Mother</option>
 <option value="Father">Father</option>
 <option value="Guardian">Guardian</option>
 <option value="Grandparent">Grandparent</option>
 <option value="Sibling">Sibling</option>
 <option value="Relative">Relative</option>
 <option value="Driver">Driver</option>
 <option value="Nanny">Nanny</option>
 <option value="Others">Others</option>
 </select>
 </div>
 </div>
 </div>

 <div class="alert alert-warning mt-3 mb-0">
 <i class="fas fa-lightbulb"></i>
 <small>QR codes will be automatically generated for all registered parents. Passwords are NOT sent automatically — send them manually later using "Send Password" or "Send All Passwords" on the Parents page.</small>
 </div>
 </div>
 </div>
 </div>
 </div>

 <!-- ===== STICKY ACTION BAR ===== -->
 <div class="action-bar mt-3">
 <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap: 10px;">
 <a href="<?= base_url('students') ?>" class="btn btn-outline-kid btn-sm">
 <i class="fas fa-arrow-left mr-1"></i> Cancel
 </a>
 <button type="submit" class="btn btn-kid-primary btn-sm px-4" id="submitBtn">
 <i class="fas fa-save mr-1"></i> Save & Generate QR
 </button>
 </div>
 </div>
 </form>
 </div>

 <!-- ===== SUCCESS MODAL ===== -->
 <?php if(session()->getFlashdata('showResult') && session()->getFlashdata('registration_success')): ?>
 <div class="modal fade show" id="resultModal" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display:block; background: rgba(0,0,0,0.5);">
 <div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content">
 <div class="modal-header" style="border-bottom: 2px solid rgba(129,199,132,0.20); background: rgba(129,199,132,0.06);">
 <h5>
 <i class="fas fa-check-circle mr-2" style="color: var(--soft-green);"></i>
                                Registration Successful!
 </h5>
 <button type="button" class="close" data-dismiss="modal" style="color: var(--ink);" id="closeResultModal">&times;</button>
 </div>
 <div class="modal-body">
 <div class="text-center mb-4">
 <i class="fas fa-user-graduate fa-4x" style="color: var(--soft-green);"></i>
 <h4 class="mt-2" style="color: var(--ink);">
 <strong><?= session()->getFlashdata('student_name') ?></strong>
 </h4>
 <p style="color: var(--muted);">has been registered successfully!</p>
 </div>

 <!-- Parents with QR Codes -->
 <div class="mb-3">
 <h6 style="color: var(--ink); font-weight: 700;">
 <i class="fas fa-user mr-2" style="color: var(--soft-blue);"></i>
                                    Registered Parents/Guardians:
 </h6>
 <div class="row">
 <?php $parents = session()->getFlashdata('registered_parents'); ?>
 <?php if(!empty($parents)): ?>
 <?php foreach($parents as $p): ?>
 <div class="col-md-6">
 <div class="qr-row">
 <div>
 <?php if(!empty($p['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" alt="QR">
 <?php else: ?>
 <i class="fas fa-qrcode" style="color: var(--soft-blue);"></i>
 <?php endif; ?>
 </div>
 <div>
 <strong><?= esc(full_name($p)) ?></strong>
 <span class="badge badge-info ml-2"><?= esc($p['relation']) ?></span>
 <br>
 <small><?= esc($p['qr_code'] ?? '') ?></small>
 </div>
 </div>
 </div>
 <?php endforeach; ?>
 <?php endif; ?>
 </div>
 </div>

 <!-- Fetchers with QR Codes -->
 <?php $fetchers = session()->getFlashdata('registered_fetchers'); ?>
 <?php if(!empty($fetchers)): ?>
 <div class="mb-3">
 <h6 style="color: var(--ink); font-weight: 700;">
 <i class="fas fa-user-friends mr-2" style="color: var(--soft-teal);"></i>
                                    Registered Fetchers:
 </h6>
 <div class="row">
 <?php foreach($fetchers as $f): ?>
 <div class="col-md-6">
 <div class="qr-row">
 <div>
 <?php if(!empty($f['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" alt="QR">
 <?php else: ?>
 <i class="fas fa-qrcode" style="color: var(--soft-blue);"></i>
 <?php endif; ?>
 </div>
 <div>
 <strong><?= esc(full_name($f)) ?></strong>
 <br>
 <small><?= esc($f['qr_code'] ?? '') ?></small>
 </div>
 </div>
 </div>
 <?php endforeach; ?>
 </div>
 </div>
 <?php endif; ?>

 <div class="alert alert-success mt-2 mb-0" style="background: rgba(129,199,132,0.10); border-color: rgba(129,199,132,0.18);">
 <i class="fas fa-qrcode mr-1"></i>
 <small>QR codes have been generated for all parents and fetchers!</small>
 </div>

 <?php if(session()->getFlashdata('password_sms_failed')): ?>
 <div class="alert alert-warning mt-2 mb-0">
 <i class="fas fa-exclamation-triangle mr-1"></i>
 <small>One or more SMS with the generated password could not be sent. You can resend it from the parent's page.</small>
 </div>
 <?php else: ?>
 <div class="alert alert-info mt-2 mb-0">
 <i class="fas fa-sms mr-1"></i>
 <small>Passwords were not sent automatically. Send them when ready using "Send Password" / "Send All Passwords" on the Parents page.</small>
 </div>
 <?php endif; ?>
 </div>
 <div class="modal-footer" style="border-top: 2px solid rgba(129,199,132,0.12);">
  <a href="<?= base_url('students') ?>" class="btn btn-kid-primary btn-sm px-4" id="closeResultBtn">
  <i class="fas fa-check mr-1"></i> Done
  </a>
 </div>
 </div>
 </div>
 </div>
 <?php endif; ?>

 </div>
</section>
</div>


 <?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    // ===== + ADD STUDENT (repeater) =====
    var studentBlockSeq = 1; // next data-index

    $('#addStudentBtn').on('click', function(){
        var $first = $('.student-block').first();
        var idx = studentBlockSeq++;

        var $clone = $first.clone();
        // Reset values / previews
        $clone.attr('data-index', idx);
        $clone.find('input[type=text]').val('');
        $clone.find('select').prop('selectedIndex', 0);
        $clone.find('input[type=file]').val('');
        $clone.find('.reg-avatar-data').val('');
        $clone.find('.reg-avatar-remove').val('0');
        $clone.find('.reg-avatar-img').attr('src', '').hide();
        $clone.find('.reg-avatar-placeholder').show();
        $clone.find('.reg-avatar-overlay').text('Add picture');
        $clone.find('.reg-avatar-remove-btn').hide();

        // Remove button (never on the first block)
        $clone.find('.remove-student').remove();
        $clone.append(
            '<button type="button" class="btn btn-sm btn-outline-danger remove-student" ' +
            'style="position:absolute;top:6px;right:6px;border-radius:8px;" ' +
            'title="Remove this student"><i class="fas fa-times"></i></button>'
        );

        // Numbering label
        $clone.find('.block-label').remove();
        $clone.prepend('<div class="block-label badge badge-primary mb-2">Student ' + (idx + 1) + '</div>');

        $('#studentBlocks').append($clone);
        $clone.find('.student-fname').first().focus();
        refreshStudentBlockLabels();
    });

    $(document).on('click', '.remove-student', function(){
        if ($('.student-block').length <= 1) return;
        $(this).closest('.student-block').remove();
        refreshStudentBlockLabels();
    });

    // Manual ID helpers: Student ID digits only, Parent ID always P-<number>.
    $(document).on('input', 'input.student-no', function(){
        this.value = this.value.replace(/[^0-9A-Za-z-]/g, '');
    });
    $(document).on('blur', 'input.parent-no', function(){
        var v = (this.value || '').toUpperCase().replace(/\s+/g, '');
        if (v === '') { return; }
        var m = v.match(/(\d+)$/);
        this.value = m ? ('P-' + m[1]) : (v.indexOf('P-') === 0 ? v : 'P-' + v);
    });
    $(document).on('blur', 'input.student-no', function(){
        this.value = (this.value || '').trim();
    });

    function refreshStudentBlockLabels(){
        $('.student-block').each(function(i){
            var $b = $(this);
            if (!$b.find('.block-label').length) {
                $b.prepend('<div class="block-label badge badge-primary mb-2"></div>');
            }
            $b.find('.block-label').text('Student ' + (i + 1));
            // Keep the remove affordance on every block except the first.
            if (i === 0) { $b.find('.remove-student').remove(); }
            else if (!$b.find('.remove-student').length) {
                $b.append('<button type="button" class="btn btn-sm btn-outline-danger remove-student" ' +
                    'style="position:absolute;top:6px;right:6px;border-radius:8px;" ' +
                    'title="Remove this student"><i class="fas fa-times"></i></button>');
            }
        });
    }
    refreshStudentBlockLabels();

    // ===== FORM VALIDATION =====
    $('#registrationForm').on('submit', function(e) {
        var badIndex = -1;
        $('.student-block').each(function(i){
            var $b = $(this);
            var fname = $b.find('.student-fname').val().trim();
            var lname = $b.find('.student-lname').val().trim();
            var grade = $b.find('.student-grade').val();
            if (!fname || !lname) { badIndex = i; e.preventDefault(); alert(' Oops! Please fill in student ' + (i+1) + ' first name and last name. '); return false; }
            if (!grade) { badIndex = i; e.preventDefault(); alert(' Please select grade & section for student ' + (i+1) + '. '); return false; }
        });
        if (badIndex > -1) { $('.student-block').eq(badIndex).find('.student-fname').focus(); return; }

        var parentFname = $('input[name="parent_fname[]"]').first().val().trim();
        var parentLname = $('input[name="parent_lname[]"]').first().val().trim();
        var parentPhone = $('input[name="parent_phone[]"]').first().val().trim();

        if (!parentFname || !parentLname || !parentPhone) {
            alert(' Please fill in all required parent/guardian fields. ');
            e.preventDefault();
            return;
        }

        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving... Please wait ');
    });

    // ===== IMPORT FORM FILE LABEL =====
    $('#excelFileInput').on('change', function(){
        var name = this.files && this.files[0] ? this.files[0].name : 'Choose .xlsx file';
        $('.custom-file-label').text(name);
    });

    $('#importForm').on('submit', function(){
        $('#importBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Importing...');
    });

    // ===== MINIMAL PROFILE PICTURE (student / parent) =====
    $(document).on('click', '.reg-avatar', function () {
        $(this).closest('.reg-avatar-wrap').find('.reg-avatar-file').trigger('click');
    });

    $(document).on('change', '.reg-avatar-file', function () {
        var input = this;
        var $wrap = $(this).closest('.reg-avatar-wrap');
        if (!input.files || !input.files[0]) return;

        var reader = new FileReader();
        reader.onload = function (e) {
            var img = new Image();
            img.onload = function () {
                var max = 512;
                var side = Math.min(img.width, img.height);
                var canvas = document.createElement('canvas');
                canvas.width = max; canvas.height = max;
                var ctx = canvas.getContext('2d');
                ctx.fillStyle = '#fff'; ctx.fillRect(0, 0, max, max);
                ctx.drawImage(img, (img.width - side) / 2, (img.height - side) / 2, side, side, 0, 0, max, max);
                var data = canvas.toDataURL('image/jpeg', 0.9);

                $wrap.find('.reg-avatar-img').attr('src', data).show();
                $wrap.find('.reg-avatar-placeholder').hide();
                $wrap.find('.reg-avatar-overlay').text('Change');
                $wrap.find('.reg-avatar-data').val(data);
                $wrap.find('.reg-avatar-remove').val('0');
                $wrap.find('.reg-avatar-remove-btn').show();
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    });

    $(document).on('click', '.reg-avatar-remove-btn', function () {
        var $wrap = $(this).closest('.reg-avatar-wrap');
        $wrap.find('.reg-avatar-file').val('');
        $wrap.find('.reg-avatar-img').attr('src', '').hide();
        $wrap.find('.reg-avatar-placeholder').show();
        $wrap.find('.reg-avatar-overlay').text('Add picture');
        $wrap.find('.reg-avatar-data').val('');
        $wrap.find('.reg-avatar-remove').val('1');
        $(this).hide();
    });

    // ===== ZIP IMPORT =====
    $('#zipFileInput').on('change', function(){
        var name = this.files && this.files[0] ? this.files[0].name : 'Choose .zip file';
        $('#zipFileLabel').text(name);
    });

    $('#zipForm').on('submit', function(){
        $('#zipBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Extracting...');
    });

    // ===== SHOW SUCCESS MODAL =====
 <?php if(session()->getFlashdata('showResult') && session()->getFlashdata('registration_success')): ?>
    // Modal is already shown with class "show"
    
    // Close modal and redirect to students page
    $('#closeResultModal, #closeResultBtn').on('click', function(e) {
        e.preventDefault();
        $('#resultModal').removeClass('show');
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        window.location.href = '<?= base_url('register') ?>';
    });
 <?php endif; ?>
});
</script>
<?= $this->endSection() ?>
