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
}

body {
    background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%) !important;
    color: #3d3d5c !important;
}

.content-wrapper { background: transparent !important; }

.card {
    border-radius: 25px !important;
    border: 1px solid rgba(255,255,255,0.6) !important;
    background: rgba(255,255,255,0.7) !important;
    backdrop-filter: blur(15px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.04) !important;
    transition: all 0.3s ease !important;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.06) !important;
}

.card-header {
    background: rgba(255,255,255,0.5) !important;
    border-bottom: 1px solid rgba(255,255,255,0.3) !important;
    border-radius: 25px 25px 0 0 !important;
    padding: 1rem 1.5rem !important;
}

.card-header h5 {
    color: #4a4a6a !important;
    font-weight: 700 !important;
    font-size: 1.15rem !important;
}

.card-body {
    padding: 1.5rem !important;
}

.form-control {
    border-radius: 15px !important;
    border: 2px solid rgba(160,160,180,0.12) !important;
    background: rgba(255,255,255,0.5) !important;
    color: #3d3d5c !important;
    padding: 12px 16px !important;
    transition: all 0.3s ease !important;
    font-size: 14px !important;
}

.form-control:focus {
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(168,192,255,0.15) !important;
    background: rgba(255,255,255,0.8) !important;
    color: #3d3d5c !important;
}

.form-control::placeholder {
    color: #b0b0c8 !important;
    font-weight: 400 !important;
}

.form-control-sm {
    padding: 8px 14px !important;
    font-size: 13px !important;
    border-radius: 12px !important;
}

select.form-control option {
    background: #ffffff !important;
    color: #3d3d5c !important;
    padding: 8px !important;
}

select.form-control optgroup {
    background: #f5f0ff !important;
    color: #3f2b96 !important;
    font-weight: 700 !important;
}

label {
    color: #5a5a7a !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    margin-bottom: 5px !important;
}

label .text-danger {
    color: var(--soft-rose) !important;
}

.small {
    color: #7a7a9a !important;
    font-size: 12px !important;
}

.alert {
    border-radius: 18px !important;
    padding: 14px 20px !important;
    font-size: 14px !important;
}

.alert-info {
    background: rgba(168,192,255,0.15) !important;
    border: 2px solid rgba(168,192,255,0.15) !important;
    color: #5a5a8a !important;
}

.alert-warning {
    background: rgba(255,183,77,0.15) !important;
    border: 2px solid rgba(255,183,77,0.15) !important;
    color: #8a7a4a !important;
}

.alert i {
    font-size: 1.1rem !important;
    margin-right: 8px !important;
}

.border.rounded {
    border-color: rgba(160,160,180,0.08) !important;
    border-radius: 18px !important;
    background: rgba(255,255,255,0.3) !important;
    transition: all 0.3s ease !important;
}

.border.rounded:hover {
    transform: scale(1.01);
    background: rgba(255,255,255,0.5) !important;
}

.border.rounded h6 {
    color: #4a4a6a !important;
    font-weight: 700 !important;
    font-size: 14px !important;
}

.badge {
    padding: 6px 16px !important;
    border-radius: 50px !important;
    font-weight: 600 !important;
    font-size: 12px !important;
}

.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }

.input-group-text {
    background: rgba(255,255,255,0.3) !important;
    border: 2px solid rgba(160,160,180,0.08) !important;
    border-right: none !important;
    color: #9a9aba !important;
    border-radius: 15px 0 0 15px !important;
    font-size: 14px !important;
}

.input-group .form-control {
    border-radius: 0 15px 15px 0 !important;
    border-left: none !important;
}

.input-group .form-control:focus {
    border-left: none !important;
}

.btn {
    border-radius: 50px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    padding: 10px 25px !important;
    font-size: 14px !important;
}

.btn:hover {
    transform: translateY(-3px) scale(1.02);
}

.btn-lg {
    padding: 14px 35px !important;
    font-size: 16px !important;
}

.btn-kid-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(63,43,150,0.2) !important;
}

.btn-kid-primary:hover {
    box-shadow: 0 8px 25px rgba(63,43,150,0.3) !important;
}

.btn-kid-success {
    background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(76,175,80,0.2) !important;
}

.btn-kid-success:hover {
    box-shadow: 0 8px 25px rgba(76,175,80,0.3) !important;
}

.btn-kid-pink {
    background: linear-gradient(135deg, var(--soft-pink), var(--soft-rose)) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(245,87,108,0.2) !important;
}

.btn-kid-pink:hover {
    box-shadow: 0 8px 25px rgba(245,87,108,0.3) !important;
}

.btn-outline-kid {
    border: 2px solid rgba(160,160,180,0.15) !important;
    color: #7a7a9a !important;
    background: transparent !important;
}

.btn-outline-kid:hover {
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
    background: rgba(168,192,255,0.08) !important;
}

.photo-preview {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid rgba(168,192,255,0.25);
    background: rgba(255,255,255,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: 0 auto;
}

.photo-preview:hover {
    border-color: var(--soft-pink);
    transform: scale(1.05);
}

.photo-preview i {
    color: rgba(160,160,180,0.2);
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
    margin: 0 auto 15px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid rgba(168,192,255,0.25);
    background: rgba(255,255,255,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

#studentPhotoPreview:hover {
    border-color: var(--soft-pink);
    transform: scale(1.05);
}

#studentPhotoPreview i {
    color: rgba(160,160,180,0.2);
    font-size: 60px;
}

#studentPhotoPreview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.breadcrumb {
    background: transparent !important;
    padding: 0 !important;
}

.breadcrumb-item a {
    color: #7a7a9a !important;
    transition: color 0.3s ease !important;
    font-weight: 500 !important;
    text-decoration: none !important;
}

.breadcrumb-item a:hover {
    color: var(--soft-purple) !important;
}

.breadcrumb-item.active {
    color: #4a4a6a !important;
    font-weight: 600 !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: #c0c0d8 !important;
    content: "›" !important;
}

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

.kid-emoji {
    display: inline-block;
    animation: sparkle 2s ease-in-out infinite;
}

@keyframes sparkle {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.15) rotate(8deg); }
}

/* ===== SUCCESS MODAL ===== */
.modal-content {
    border-radius: 28px !important;
    border: 2px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.95) !important;
    backdrop-filter: blur(15px);
    box-shadow: 0 20px 60px rgba(108,140,255,0.08) !important;
}

.modal-header {
    border-bottom: 2px solid rgba(108,140,255,0.08) !important;
    border-radius: 28px 28px 0 0 !important;
    background: rgba(255,255,255,0.5) !important;
    padding: 1.2rem 1.8rem !important;
}

.modal-header h5 {
    color: #2d2d4a !important;
    font-weight: 700 !important;
    font-size: 1.3rem !important;
}

.modal-footer {
    border-top: 2px solid rgba(108,140,255,0.08) !important;
    border-radius: 0 0 28px 28px !important;
    background: rgba(255,255,255,0.3) !important;
    padding: 1rem 1.8rem !important;
}

.modal-body {
    padding: 1.8rem !important;
}

.btn-kid-success {
    background: linear-gradient(135deg, #81c784, #43a047) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(76,175,80,0.2) !important;
    border-radius: 50px !important;
    padding: 10px 28px !important;
    font-weight: 700 !important;
    transition: all 0.3s ease !important;
}

.btn-kid-success:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(76,175,80,0.3) !important;
}

.modal-backdrop {
    z-index: 1040 !important;
}

.modal {
    z-index: 1050 !important;
}

.modal-dialog {
    z-index: 1060 !important;
}

.modal-open {
    overflow: auto !important;
}

.modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto !important;
}

@media (max-width: 768px) {
    .card-body {
        padding: 1rem !important;
    }
    .btn-lg {
        padding: 10px 20px !important;
        font-size: 14px !important;
    }
    .content-header h1 {
        font-size: 1.5rem !important;
    }
    .card-header h5 {
        font-size: 1rem !important;
    }
    .photo-preview {
        width: 60px;
        height: 60px;
    }
    #studentPhotoPreview {
        width: 120px;
        height: 120px;
    }
}

@media (max-width: 480px) {
    .card {
        border-radius: 18px !important;
    }
    .form-control {
        font-size: 13px !important;
        padding: 10px 12px !important;
    }
    .btn {
        font-size: 12px !important;
        padding: 8px 16px !important;
    }
}
</style>

<div class="content-wrapper" style="background: transparent;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-user-plus mr-2"></i>
                        Register Student <span class="kid-emoji">🌟</span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('students') ?>">🎓 Students</a></li>
                        <li class="breadcrumb-item active">✨ Register</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <!-- ===== REGISTRATION FORM ===== -->
            <div id="registrationFormContainer">
                <form action="<?= base_url('students-save') ?>" method="post" enctype="multipart/form-data" id="registrationForm">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        
                        <!-- ===== LEFT COLUMN: Student Info ===== -->
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header pt-3">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user-graduate mr-2" style="color: var(--soft-blue);"></i>
                                        Student Information 🎒
                                    </h5>
                                </div>
                                <div class="card-body">
                                    
                                    <!-- Student Photo -->
                                    <div class="form-group text-center mb-4">
                                        <label class="font-weight-bold" style="font-size: 1rem;">
                                            📸 Student Picture <span class="kid-emoji">😊</span>
                                        </label>
                                        <div id="studentPhotoPreview" onclick="$('#pictureInput').click()">
                                            <i class="fas fa-child"></i>
                                        </div>
                                        <div class="btn-group btn-group-sm" role="group" style="gap: 8px;">
                                            <button type="button" class="btn btn-kid-primary open-camera-btn" data-target="student">
                                                <i class="fas fa-camera mr-1"></i> Take Photo 📷
                                            </button>
                                            <label class="btn btn-kid-pink mb-0" style="cursor:pointer;">
                                                <i class="fas fa-upload mr-1"></i> Upload ⬆️
                                                <input type="file" name="picture" id="pictureInput" class="d-none" accept="image/*">
                                            </label>
                                        </div>
                                        <input type="hidden" name="picture_capture" id="pictureCapture">
                                    </div>

                                    <!-- Student Name -->
                                    <div class="row">
                                        <div class="col-4">
                                            <label>First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="fname" class="form-control" placeholder="👦 Juan" required>
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
                                        <label>📚 Grade & Section <span class="text-danger">*</span></label>
                                        <select name="grade_section" class="form-control" required>
                                            <option value="">— Select Grade & Section —</option>
                                            <optgroup label="🌈 Kindergarten">
                                                <option>Kindergarten - A</option>
                                                <option>Kindergarten - B</option>
                                            </optgroup>
                                            <optgroup label="📖 Grade 1">
                                                <option>Grade 1 - A</option>
                                                <option>Grade 1 - B</option>
                                            </optgroup>
                                            <optgroup label="📖 Grade 2">
                                                <option>Grade 2 - A</option>
                                                <option>Grade 2 - B</option>
                                            </optgroup>
                                            <optgroup label="📖 Grade 3">
                                                <option>Grade 3 - A</option>
                                                <option>Grade 3 - B</option>
                                            </optgroup>
                                            <optgroup label="📖 Grade 4">
                                                <option>Grade 4 - A</option>
                                                <option>Grade 4 - B</option>
                                            </optgroup>
                                            <optgroup label="📖 Grade 5">
                                                <option>Grade 5 - A</option>
                                                <option>Grade 5 - B</option>
                                            </optgroup>
                                            <optgroup label="📖 Grade 6">
                                                <option>Grade 6 - A</option>
                                                <option>Grade 6 - B</option>
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div class="alert alert-info mt-3 mb-0">
                                        <i class="fas fa-info-circle"></i>
                                        <small>Fill in student details first, then add parents and fetchers on the right! ✨</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===== RIGHT COLUMN: Parents & Fetchers ===== -->
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header pt-3">
                                    <h5 class="mb-0">
                                        <i class="fas fa-users mr-2" style="color: var(--soft-green);"></i>
                                        Parents & Fetchers 👨‍👩‍👧‍👦
                                    </h5>
                                </div>
                                <div class="card-body">
                                    
                                    <!-- Parent 1 (Required) -->
                                    <div class="border rounded p-3 mb-3" style="border-left: 5px solid var(--soft-green); background: rgba(129,199,132,0.06);">
                                        <h6 class="mb-3">
                                            <span class="badge badge-success">⭐ Required</span>
                                            <i class="fas fa-user mr-1"></i> Parent / Guardian 👨‍👩
                                        </h6>
                                        
                                        <!-- Parent Photo -->
                                        <div class="text-center mb-2">
                                            <div class="photo-preview parent-preview" data-index="0" onclick="$('#parentPictureInput0').click()">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <input type="file" id="parentPictureInput0" class="d-none parent-pic-input" accept="image/*" data-index="0">
                                            <input type="hidden" name="parent_picture_capture" class="parent-picture-capture" data-index="0">
                                            <small class="d-block text-muted" style="font-size:11px;">Click photo to upload 📸</small>
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
                                            <div class="col-6">
                                                <label class="small">📱 Phone Number <span class="text-danger">*</span></label>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">📱</span>
                                                    </div>
                                                    <input type="text" name="parent_phone[]" class="form-control" placeholder="09XXXXXXXXX" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label class="small">🔒 Password <span class="text-danger">*</span></label>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">🔒</span>
                                                    </div>
                                                    <input type="password" name="parent_password[]" class="form-control" placeholder="Min. 6 characters" required>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="parent_relation[]" value="Parent">
                                        <input type="hidden" name="parent_picture[]">
                                    </div>

                                    <!-- Fetcher 1 (Optional) -->
                                    <div class="border rounded p-3 mb-3" style="border-left: 5px solid var(--soft-teal); background: rgba(79,172,254,0.06);">
                                        <h6 class="mb-3">
                                            <span class="badge badge-info">✨ Optional</span>
                                            <i class="fas fa-user-friends mr-1"></i> Fetcher 1 👤
                                        </h6>
                                        
                                        <!-- Fetcher Photo -->
                                        <div class="text-center mb-2">
                                            <div class="photo-preview fetcher-preview" data-index="0" onclick="$('#fetcherPictureInput0').click()">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <input type="file" id="fetcherPictureInput0" class="d-none fetcher-pic-input" accept="image/*" data-index="0">
                                            <input type="hidden" name="fetcher_picture_capture" class="fetcher-picture-capture" data-index="0">
                                            <small class="d-block text-muted" style="font-size:11px;">Click photo to upload 📸</small>
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
                                                <label class="small">📱 Phone Number</label>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">📱</span>
                                                    </div>
                                                    <input type="text" name="fetcher_phone[]" class="form-control" placeholder="09XXXXXXXXX">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="fetcher_picture[]">
                                    </div>

                                    <!-- Fetcher 2 (Optional) -->
                                    <div class="border rounded p-3 mb-2" style="border-left: 5px solid var(--soft-orange); background: rgba(255,183,77,0.06);">
                                        <h6 class="mb-3">
                                            <span class="badge badge-warning">🌟 Optional</span>
                                            <i class="fas fa-user-friends mr-1"></i> Fetcher 2 👤
                                        </h6>
                                        
                                        <!-- Fetcher Photo -->
                                        <div class="text-center mb-2">
                                            <div class="photo-preview fetcher-preview" data-index="1" onclick="$('#fetcherPictureInput1').click()">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <input type="file" id="fetcherPictureInput1" class="d-none fetcher-pic-input" accept="image/*" data-index="1">
                                            <input type="hidden" name="fetcher_picture_capture" class="fetcher-picture-capture" data-index="1">
                                            <small class="d-block text-muted" style="font-size:11px;">Click photo to upload 📸</small>
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
                                                <label class="small">📱 Phone Number</label>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">📱</span>
                                                    </div>
                                                    <input type="text" name="fetcher_phone[]" class="form-control" placeholder="09XXXXXXXXX">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="fetcher_picture[]">
                                    </div>

                                    <div class="alert alert-warning mt-3 mb-0">
                                        <i class="fas fa-lightbulb"></i>
                                        <small>QR codes will be automatically generated for all registered parents and fetchers! ✨📱</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ===== ACTION BUTTONS ===== -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between flex-wrap" style="gap: 10px;">
                                <a href="<?= base_url('students') ?>" class="btn btn-outline-kid btn-lg">
                                    <i class="fas fa-arrow-left mr-1"></i> Cancel ❌
                                </a>
                                <button type="submit" class="btn btn-kid-success btn-lg px-5" id="submitBtn">
                                    <i class="fas fa-save mr-1"></i> Save & Generate QR ✨🚀
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ===== SUCCESS MODAL ===== -->
            <?php if(session()->getFlashdata('showResult') && session()->getFlashdata('registration_success')): ?>
            <div class="modal fade show" id="resultModal" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display:block; background: rgba(0,0,0,0.5);">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" style="border-radius: 28px; border: 3px solid rgba(129,199,132,0.3);">
                        <div class="modal-header" style="border-bottom: 2px solid rgba(129,199,132,0.2); background: rgba(129,199,132,0.05); border-radius: 28px 28px 0 0;">
                            <h5 style="color: #2d2d4a; font-weight: 700;">
                                <i class="fas fa-check-circle mr-2" style="color: var(--soft-green);"></i>
                                Registration Successful! 🎉
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" style="color: #4a4a6a;" id="closeResultModal">&times;</button>
                        </div>
                        <div class="modal-body" style="padding: 2rem;">
                            <div class="text-center mb-4">
                                <i class="fas fa-user-graduate fa-4x" style="color: var(--soft-green);"></i>
                                <h4 class="mt-2" style="color: #2d2d4a;">
                                    <strong><?= session()->getFlashdata('student_name') ?></strong>
                                </h4>
                                <p style="color: #7a7a9a;">has been registered successfully! 🌟</p>
                            </div>
                            
                            <!-- Parents with QR Codes -->
                            <div class="mb-3">
                                <h6 style="color: #2d2d4a; font-weight: 700;">
                                    <i class="fas fa-user mr-2" style="color: var(--soft-blue);"></i>
                                    Registered Parents/Guardians:
                                </h6>
                                <div class="row">
                                    <?php $parents = session()->getFlashdata('registered_parents'); ?>
                                    <?php if(!empty($parents)): ?>
                                        <?php foreach($parents as $p): ?>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center border rounded p-2 mb-1" style="border-color: rgba(108,140,255,0.08);">
                                                <div class="mr-2">
                                                    <?php if(!empty($p['qr_code'])): ?>
                                                        <img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" 
                                                             style="width:40px;height:40px;border-radius:8px;border:1px solid rgba(108,140,255,0.1);">
                                                    <?php else: ?>
                                                        <i class="fas fa-qrcode" style="color: var(--soft-blue);"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <div>
                                                    <strong style="color: #2d2d4a;"><?= esc($p['fname']) ?> <?= esc($p['lname']) ?></strong>
                                                    <span class="badge badge-info ml-2"><?= esc($p['relation']) ?></span>
                                                    <br>
                                                    <small style="color: #8888aa; font-size: 10px;"><?= esc($p['qr_code'] ?? '') ?></small>
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
                                <h6 style="color: #2d2d4a; font-weight: 700;">
                                    <i class="fas fa-user-friends mr-2" style="color: var(--soft-teal);"></i>
                                    Registered Fetchers:
                                </h6>
                                <div class="row">
                                    <?php foreach($fetchers as $f): ?>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center border rounded p-2 mb-1" style="border-color: rgba(79,172,254,0.08);">
                                            <div class="mr-2">
                                                <?php if(!empty($f['qr_code'])): ?>
                                                    <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" 
                                                         style="width:40px;height:40px;border-radius:8px;border:1px solid rgba(108,140,255,0.1);">
                                                <?php else: ?>
                                                    <i class="fas fa-qrcode" style="color: var(--soft-blue);"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <strong style="color: #2d2d4a;"><?= esc($f['fname']) ?> <?= esc($f['lname']) ?></strong>
                                                <br>
                                                <small style="color: #8888aa; font-size: 10px;"><?= esc($f['qr_code'] ?? '') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="alert alert-success mt-2 mb-0" style="background: rgba(129,199,132,0.08); border-color: rgba(129,199,132,0.15);">
                                <i class="fas fa-qrcode mr-1"></i>
                                <small>QR codes have been generated for all parents and fetchers! 📱✨</small>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: 2px solid rgba(129,199,132,0.1); border-radius: 0 0 28px 28px;">
                            <a href="<?= base_url('students') ?>" class="btn btn-kid-success px-4" id="closeResultBtn">
                                <i class="fas fa-check mr-1"></i> Done ✅
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
                <h6><i class="fas fa-camera mr-2" style="color: var(--soft-blue);"></i>Take Photo 📸</h6>
                <button type="button" class="close" data-dismiss="modal" style="color: #4a4a6a;">&times;</button>
            </div>
            <div class="modal-body text-center p-2">
                <video id="cameraVideo" autoplay playsinline style="width:100%;max-height:400px;border-radius:12px;background:#1a1a2e;"></video>
                <canvas id="cameraCanvas" style="display:none;"></canvas>
                <div class="mt-2">
                    <button type="button" class="btn btn-kid-primary" id="captureBtn">
                        <i class="fas fa-camera mr-1"></i> Capture 📷
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="cancelCameraBtn">
                        <i class="fas fa-times mr-1"></i> Cancel ❌
                    </button>
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
        setTimeout(function(){
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "user", width: 640, height: 480 } })
            .then(function(st) {
                stream = st;
                $('#cameraVideo')[0].srcObject = stream;
            })
            .catch(function(e) {
                alert('⚠️ Camera error: ' + e.message + '\n📸 Please use the upload option instead.');
            });
        }, 500);
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
        var parentPass = $('input[name="parent_password[]"]').first().val().trim();

        if (!fname || !lname) {
            alert('⚠️ Oops! Please fill in student first name and last name. 😊');
            e.preventDefault();
            return;
        }
        if (!grade) {
            alert('⚠️ Please select grade & section. 📚');
            e.preventDefault();
            return;
        }
        if (!parentFname || !parentLname || !parentPhone || !parentPass) {
            alert('⚠️ Please fill in all required parent/guardian fields. 👨‍👩');
            e.preventDefault();
            return;
        }
        if (parentPass.length < 6) {
            alert('⚠️ Parent password must be at least 6 characters. 🔒');
            e.preventDefault();
            return;
        }

        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving... Please wait ⏳✨');
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