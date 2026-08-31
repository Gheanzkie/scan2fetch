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
    content: "›" !important;
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

#studentPhotoPreview {
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

#studentPhotoPreview:hover { border-color: var(--soft-pink); }

#studentPhotoPreview i {
    color: rgba(63,43,150,0.25);
    font-size: 60px;
}

#studentPhotoPreview img {
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
    #studentPhotoPreview { width: 130px; height: 130px; }
    .step-nav { border-radius: 24px; }
}

@media (max-width: 480px) {
    .card { border-radius: 18px !important; }
    .form-control { font-size: 13px !important; padding: 10px 12px !important; }
    .btn { font-size: 12px !important; padding: 8px 16px !important; }
    .action-bar { border-radius: 24px; }
}
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
                                Bulk Import from Excel
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
 <li>Column order matters. See the bundled sample file below.</li>
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
 <small class="d-block mt-2">
 <a href="<?= base_url('uploads/sample/sample_students.xlsx') ?>" download style="color: var(--soft-purple); font-weight:600;">
 <i class="fas fa-file-download mr-1"></i> Download sample file (50 students)
 </a>
 </small>
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

 <!-- Student Photo -->
 <div class="form-group text-center mb-4">
 <label class="font-weight-bold" style="font-size: 0.95rem;">
                                             Student Picture
 </label>
 <div id="studentPhotoPreview" onclick="$('#pictureInput').click()">
 <i class="fas fa-child"></i>
 </div>
 <div class="btn-group btn-group-sm" role="group" style="gap: 8px;">
 <button type="button" class="btn btn-kid-primary btn-sm open-camera-btn" data-target="student">
 <i class="fas fa-camera mr-1"></i> Take Photo
 </button>
 <label class="btn btn-kid-pink btn-sm mb-0" style="cursor:pointer;">
 <i class="fas fa-upload mr-1"></i> Upload
 <input type="file" name="picture" id="pictureInput" class="d-none" accept="image/*">
 </label>
 </div>
 <input type="hidden" name="picture_capture" id="pictureCapture">
 </div>

 <!-- Student Name -->
 <div class="row">
 <div class="col-4">
 <label>First Name <span class="text-danger">*</span></label>
 <input type="text" name="fname" class="form-control" placeholder="Juan" required>
 </div>
 <div class="col-4">
 <label>Middle Name</label>
 <input type="text" name="mname" class="form-control" placeholder="Dela">
 </div>
 <div class="col-4">
 <label>Last Name <span class="text-danger">*</span></label>
 <input type="text" name="lname" class="form-control" placeholder="Cruz" required>
 </div>
 </div>

 <!-- Grade & Section -->
 <div class="form-group mt-3">
 <label> Grade & Section <span class="text-danger">*</span></label>
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

 <div class="alert alert-info mt-3 mb-0">
 <i class="fas fa-info-circle"></i>
 <small>Fill in student details first, then add parents and fetchers on the right!</small>
 </div>
 </div>
 </div>
 </div>

 <!-- ===== RIGHT COLUMN: PARENTS & FETCHERS ===== -->
 <div class="col-md-7" id="section-guardians">
 <div class="card">
 <div class="card-header pt-3">
 <h5 class="mb-0">
 <i class="fas fa-users mr-2" style="color: var(--soft-green);"></i>
                                        Parents & Fetchers
 </h5>
 </div>
 <div class="card-body">

 <!-- Parent 1 (Required) -->
 <div class="guardian-box box-parent mb-3">
 <h6 class="mb-3">
 <span class="badge badge-success"> Required</span>
 <i class="fas fa-user mr-1"></i> Parent / Guardian
 </h6>

 <div class="text-center mb-2">
 <div class="photo-preview parent-preview" data-index="0" onclick="$('#parentPictureInput0').click()">
 <i class="fas fa-user"></i>
 </div>
 <input type="file" id="parentPictureInput0" class="d-none parent-pic-input" accept="image/*" data-index="0">
 <input type="hidden" name="parent_picture_capture" class="parent-picture-capture" data-index="0">
 <small class="d-block text-muted" style="font-size:11px;">Click photo to upload</small>
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
 <div class="col-12">
 <label class="small"> Phone Number <span class="text-danger">*</span></label>
 <div class="input-group input-group-sm">
 <input type="text" name="parent_phone[]" class="form-control" placeholder="09XXXXXXXXX" required>
 </div>
 </div>
 </div>
 <input type="hidden" name="parent_relation[]" value="Parent">
 <input type="hidden" name="parent_picture[]">
 </div>

 <!-- Fetcher 1 (Optional) -->
 <div class="guardian-box box-fetcher mb-3">
 <h6 class="mb-3">
 <span class="badge badge-info"> Optional</span>
 <i class="fas fa-user-friends mr-1"></i> Fetcher 1
 </h6>

 <div class="text-center mb-2">
 <div class="photo-preview fetcher-preview" data-index="0" onclick="$('#fetcherPictureInput0').click()">
 <i class="fas fa-user"></i>
 </div>
 <input type="file" id="fetcherPictureInput0" class="d-none fetcher-pic-input" accept="image/*" data-index="0">
 <input type="hidden" name="fetcher_picture_capture" class="fetcher-picture-capture" data-index="0">
 <small class="d-block text-muted" style="font-size:11px;">Click photo to upload</small>
 </div>

 <div class="row">
 <div class="col-4">
 <label class="small">First Name</label>
 <input type="text" name="fetcher_fname[]" class="form-control form-control-sm" placeholder="Juan">
 </div>
 <div class="col-4">
 <label class="small">Middle Name</label>
 <input type="text" name="fetcher_mname[]" class="form-control form-control-sm" placeholder="Dela">
 </div>
 <div class="col-4">
 <label class="small">Last Name</label>
 <input type="text" name="fetcher_lname[]" class="form-control form-control-sm" placeholder="Cruz">
 </div>
 </div>
 <div class="row mt-2">
 <div class="col-6">
 <label class="small"> Phone Number</label>
 <div class="input-group input-group-sm">
 <input type="text" name="fetcher_phone[]" class="form-control" placeholder="09XXXXXXXXX">
 </div>
 </div>
 </div>
 <input type="hidden" name="fetcher_picture[]">
 </div>

 <!-- Fetcher 2 (Optional) -->
 <div class="guardian-box box-fetcher-alt mb-2">
 <h6 class="mb-3">
 <span class="badge badge-warning"> Optional</span>
 <i class="fas fa-user-friends mr-1"></i> Fetcher 2
 </h6>

 <div class="text-center mb-2">
 <div class="photo-preview fetcher-preview" data-index="1" onclick="$('#fetcherPictureInput1').click()">
 <i class="fas fa-user"></i>
 </div>
 <input type="file" id="fetcherPictureInput1" class="d-none fetcher-pic-input" accept="image/*" data-index="1">
 <input type="hidden" name="fetcher_picture_capture" class="fetcher-picture-capture" data-index="1">
 <small class="d-block text-muted" style="font-size:11px;">Click photo to upload</small>
 </div>

 <div class="row">
 <div class="col-4">
 <label class="small">First Name</label>
 <input type="text" name="fetcher_fname[]" class="form-control form-control-sm" placeholder="Pedro">
 </div>
 <div class="col-4">
 <label class="small">Middle Name</label>
 <input type="text" name="fetcher_mname[]" class="form-control form-control-sm" placeholder="Santos">
 </div>
 <div class="col-4">
 <label class="small">Last Name</label>
 <input type="text" name="fetcher_lname[]" class="form-control form-control-sm" placeholder="Dela Cruz">
 </div>
 </div>
 <div class="row mt-2">
 <div class="col-6">
 <label class="small"> Phone Number</label>
 <div class="input-group input-group-sm">
 <input type="text" name="fetcher_phone[]" class="form-control" placeholder="09XXXXXXXXX">
 </div>
 </div>
 </div>
 <input type="hidden" name="fetcher_picture[]">
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
 <strong><?= esc($p['fname']) ?> <?= esc($p['lname']) ?></strong>
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
 <strong><?= esc($f['fname']) ?> <?= esc($f['lname']) ?></strong>
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

<!-- ===== CAMERA MODAL ===== -->
<div class="modal fade" id="cameraModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <div class="modal-header">
 <h6><i class="fas fa-camera mr-2" style="color: var(--soft-blue);"></i>Take Photo</h6>
 <button type="button" class="close" data-dismiss="modal" style="color: var(--ink);">&times;</button>
 </div>
 <div class="modal-body text-center p-2">
 <video id="cameraVideo" autoplay playsinline style="width:100%;max-height:400px;border-radius:12px;background:#1a1a2e;"></video>
 <canvas id="cameraCanvas" style="display:none;"></canvas>
 <div class="mt-2">
 <button type="button" class="btn btn-kid-primary" id="captureBtn">
 <i class="fas fa-camera mr-1"></i> Capture
 </button>
 <button type="button" class="btn btn-outline-secondary" id="cancelCameraBtn">
 <i class="fas fa-times mr-1"></i> Cancel
 </button>
 <button type="button" class="btn btn-outline-success" id="cameraFallbackBtn">
 <i class="fas fa-mobile-alt mr-1"></i> Use Phone Camera / Upload
 </button>
 <input type="file" id="cameraFallbackInput" class="d-none" accept="image/*" capture="environment">
 </div>
 </div>
 </div>
 </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    var stream;
    var currentTarget = 'student';
    var currentIndex = 0;

    // ===== STUDENT PHOTO =====
    $('#pictureInput').on('change', function(){
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#studentPhotoPreview').html('<img src="' + e.target.result + '">');
                $('#studentPhotoPreview').css('border-color', '#81c784');
            };
            reader.readAsDataURL(file);
        }
    });

    // ===== PARENT PHOTO =====
    $(document).on('change', '.parent-pic-input', function(){
        var index = $(this).data('index');
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.parent-preview[data-index="' + index + '"]').html('<img src="' + e.target.result + '">');
            };
            reader.readAsDataURL(file);
        }
    });

    // ===== FETCHER PHOTO =====
    $(document).on('change', '.fetcher-pic-input', function(){
        var index = $(this).data('index');
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.fetcher-preview[data-index="' + index + '"]').html('<img src="' + e.target.result + '">');
            };
            reader.readAsDataURL(file);
        }
    });

    // ===== OPEN CAMERA =====
    $(document).on('click', '.open-camera-btn', function(){
        currentTarget = $(this).data('target') || 'student';
        $('#cameraModal').modal('show');
        // Chrome blocks the in-page camera on plain http:// (non-localhost).
        // Open the phone's native camera app directly instead.
        if (!window.isSecureContext && !/^(localhost|127\.0\.0\.1)$/.test(location.hostname)) {
            $('#cameraFallbackInput').click();
            return;
        }
        setTimeout(function(){
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "user", width: 640, height: 480 } })
            .then(function(st) {
                stream = st;
                $('#cameraVideo')[0].srcObject = stream;
            })
            .catch(function() {
                $('#cameraFallbackBtn').show();
            });
        }, 500);
    });

    // ===== USE PHONE CAMERA / UPLOAD FALLBACK =====
    $('#cameraFallbackBtn').click(function(){
        $('#cameraFallbackInput').click();
    });

    $('#cameraFallbackInput').on('change', function(){
        var file = this.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            var dataUrl = e.target.result;
            if (currentTarget === 'student') {
                $('#studentPhotoPreview').html('<img src="' + dataUrl + '">');
                $('#studentPhotoPreview').css('border-color', '#f093fb');
                $('#pictureCapture').val(dataUrl);
            } else if (currentTarget === 'parent') {
                var index = currentIndex;
                $('.parent-preview[data-index="' + index + '"]').html('<img src="' + dataUrl + '">');
                $('.parent-picture-capture[data-index="' + index + '"]').val(dataUrl);
            } else if (currentTarget === 'fetcher') {
                var index = currentIndex;
                $('.fetcher-preview[data-index="' + index + '"]').html('<img src="' + dataUrl + '">');
                $('.fetcher-picture-capture[data-index="' + index + '"]').val(dataUrl);
            }
            $('#cameraModal').modal('hide');
        };
        reader.readAsDataURL(file);
        this.value = '';
    });

    // ===== CAPTURE PHOTO =====
    $('#captureBtn').click(function(){
        var video = $('#cameraVideo')[0];
        var canvas = $('#cameraCanvas')[0];
        canvas.width = video.videoWidth || 640;
        canvas.height = video.videoHeight || 480;
        canvas.getContext('2d').drawImage(video, 0, 0);
        var dataUrl = canvas.toDataURL('image/png');
        
        if (currentTarget === 'student') {
            $('#studentPhotoPreview').html('<img src="' + dataUrl + '">');
            $('#studentPhotoPreview').css('border-color', '#f093fb');
            $('#pictureCapture').val(dataUrl);
        } else if (currentTarget === 'parent') {
            var index = currentIndex;
            $('.parent-preview[data-index="' + index + '"]').html('<img src="' + dataUrl + '">');
            $('.parent-picture-capture[data-index="' + index + '"]').val(dataUrl);
        } else if (currentTarget === 'fetcher') {
            var index = currentIndex;
            $('.fetcher-preview[data-index="' + index + '"]').html('<img src="' + dataUrl + '">');
            $('.fetcher-picture-capture[data-index="' + index + '"]').val(dataUrl);
        }
        
        if (stream) {
            stream.getTracks().forEach(function(track) { track.stop(); });
        }
        $('#cameraModal').modal('hide');
    });

    // ===== CANCEL CAMERA =====
    $('#cancelCameraBtn').click(function(){
        if (stream) {
            stream.getTracks().forEach(function(track) { track.stop(); });
        }
        $('#cameraModal').modal('hide');
    });

    // ===== STOP CAMERA ON MODAL CLOSE =====
    $('#cameraModal').on('hidden.bs.modal', function(){
        if (stream) {
            stream.getTracks().forEach(function(track) { track.stop(); });
        }
    });

    // ===== FORM VALIDATION =====
    $('#registrationForm').on('submit', function(e) {
        var fname = $('input[name="fname"]').val().trim();
        var lname = $('input[name="lname"]').val().trim();
        var grade = $('select[name="grade_section"]').val();
        var parentFname = $('input[name="parent_fname[]"]').first().val().trim();
        var parentLname = $('input[name="parent_lname[]"]').first().val().trim();
        var parentPhone = $('input[name="parent_phone[]"]').first().val().trim();

        if (!fname || !lname) {
            alert(' Oops! Please fill in student first name and last name. ');
            e.preventDefault();
            return;
        }
        if (!grade) {
            alert(' Please select grade & section. ');
            e.preventDefault();
            return;
        }
        if (!parentFname || !parentLname || !parentPhone) {
            alert(' Please fill in all required parent/guardian fields. ‍');
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

    // ===== SHOW SUCCESS MODAL =====
 <?php if(session()->getFlashdata('showResult') && session()->getFlashdata('registration_success')): ?>
    // Modal is already shown with class "show"
    
    // Close modal and redirect to students page
    $('#closeResultModal, #closeResultBtn').on('click', function(e) {
        e.preventDefault();
        $('#resultModal').removeClass('show');
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        window.location.href = '<?= base_url('students') ?>';
    });
 <?php endif; ?>
});
</script>
<?= $this->endSection() ?>