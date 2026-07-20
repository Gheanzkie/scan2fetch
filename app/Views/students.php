<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== CHILD-FRIENDLY SOFT PASTEL THEME - STUDENTS ===== */
:root {
    --soft-blue: #6C8CFF;
    --soft-purple: #7C6CFF;
    --soft-pink: #FF8A9B;
    --soft-rose: #FF6B7A;
    --soft-teal: #4FC3F7;
    --soft-green: #66BB6A;
    --soft-orange: #FFB74D;
    --soft-yellow: #FFD54F;
}

body {
    background: linear-gradient(135deg, #f5f0ff 0%, #ffe8f0 100%) !important;
    color: #2d2d4a !important;
}

.content-wrapper {
    background: transparent !important;
    position: relative;
    z-index: 1;
}

/* ===== FLOATING SHAPES ===== */
.floating-shapes {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    overflow: hidden;
    z-index: 0;
    pointer-events: none;
}

.floating-shapes .shape {
    position: absolute;
    font-size: 3.5rem;
    opacity: 0.08;
    animation: floatShape 20s ease-in-out infinite;
}

.floating-shapes .shape:nth-child(1) { top: 5%; left: 3%; animation-delay: 0s; }
.floating-shapes .shape:nth-child(2) { top: 15%; right: 5%; animation-delay: 2.5s; }
.floating-shapes .shape:nth-child(3) { bottom: 20%; left: 4%; animation-delay: 5s; }
.floating-shapes .shape:nth-child(4) { bottom: 10%; right: 3%; animation-delay: 1.5s; }
.floating-shapes .shape:nth-child(5) { top: 45%; left: 45%; animation-delay: 3.5s; font-size: 5rem; opacity: 0.06; }

@keyframes floatShape {
    0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
    25% { transform: translateY(-30px) rotate(8deg) scale(1.05); }
    75% { transform: translateY(20px) rotate(-5deg) scale(0.95); }
}

/* ===== CARDS ===== */
.card {
    border-radius: 28px !important;
    border: 2px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.85) !important;
    backdrop-filter: blur(15px);
    box-shadow: 0 8px 32px rgba(108,140,255,0.08) !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 48px rgba(108,140,255,0.12) !important;
}

.card-header {
    background: rgba(255,255,255,0.6) !important;
    border-bottom: 2px solid rgba(255,255,255,0.3) !important;
    padding: 1.2rem 1.8rem !important;
}

.card-header h5 {
    color: #2d2d4a !important;
    font-weight: 700 !important;
    font-size: 1.25rem !important;
}

.card-body {
    padding: 1.8rem !important;
}

/* ===== TABLE - FIXED COLORS ===== */
.table {
    color: #2d2d4a !important;
}

.table thead.bg-light {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
}

/* ===== ITO ANG FIX - MALINAW NA TEXT SA HEADER ===== */
.table thead th {
    color: #ffffff !important;  /* PUTI NA TEXT PARA MAKITA SA DARK BACKGROUND */
    font-weight: 700 !important;
    font-size: 16px !important;
    border-bottom: none !important;
    padding: 18px 16px !important;
    text-shadow: 0 1px 3px rgba(0,0,0,0.15) !important;
}

.table tbody tr {
    border-bottom: 1px solid rgba(108,140,255,0.08) !important;
    transition: all 0.3s ease !important;
}

.table tbody tr:hover {
    background: rgba(108,140,255,0.06) !important;
    transform: scale(1.02);
}

/* ===== ITO ANG FIX - MADILIM NA TEXT SA BODY ===== */
.table tbody td {
    color: #2d2d4a !important;  /* MADILIM NA TEXT PARA MAKITA SA LIGHT BACKGROUND */
    vertical-align: middle !important;
    border-top: none !important;
    padding: 16px 16px !important;
    font-size: 16px !important;
}

.table .text-muted {
    color: #8888aa !important;
}

.table .small {
    color: #8888aa !important;
    font-size: 14px !important;
}

/* ===== BADGES ===== */
.badge {
    font-weight: 700 !important;
    padding: 8px 20px !important;
    border-radius: 50px !important;
    font-size: 14px !important;
}

.badge-light {
    background: rgba(108,140,255,0.08) !important;
    color: #2d2d4a !important;
}

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 700 !important;
    transition: all 0.3s ease !important;
    padding: 12px 32px !important;
    font-size: 15px !important;
}

.btn:hover {
    transform: translateY(-3px) scale(1.03);
}

.btn-outline-info {
    border: 2px solid rgba(79,172,254,0.25) !important;
    color: #4a7a9a !important;
    background: transparent !important;
    padding: 8px 20px !important;
    font-size: 14px !important;
}

.btn-outline-info:hover {
    background: rgba(79,172,254,0.08) !important;
    border-color: var(--soft-teal) !important;
    color: var(--soft-purple) !important;
}

.btn-outline-secondary {
    border: 2px solid rgba(108,140,255,0.15) !important;
    color: #6a6a8a !important;
    background: rgba(255,255,255,0.3) !important;
    padding: 10px 24px !important;
    font-size: 14px !important;
}

.btn-outline-secondary:hover {
    background: rgba(108,140,255,0.08) !important;
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
}

/* ===== ACTION BUTTONS - MALAKI AT MALINAW ===== */
.btn-action-view {
    background: linear-gradient(135deg, #b3d9ff, #6C8CFF) !important;
    border: 2px solid rgba(108,140,255,0.3) !important;
    color: #ffffff !important;
    padding: 8px 20px !important;
    font-size: 14px !important;
    border-radius: 50px !important;
    font-weight: 700 !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    cursor: pointer !important;
}

.btn-action-view:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 4px 15px rgba(108,140,255,0.3) !important;
    color: #ffffff !important;
    text-decoration: none !important;
}

/* ===== FILTER SECTION - MALAKI AT MALINAW ===== */
.filter-section {
    background: rgba(255,255,255,0.6);
    border-radius: 20px;
    padding: 24px 24px 16px 24px;
    margin-bottom: 20px;
    border: 2px solid rgba(255,255,255,0.5);
}

.filter-section .filter-label {
    font-size: 16px;
    font-weight: 700;
    color: #2d2d4a;
    margin-bottom: 10px;
    display: block;
}

.filter-section .filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    align-items: flex-end;
}

.filter-section .filter-item {
    flex: 1;
    min-width: 220px;
}

/* ===== FORM CONTROLS - MALAKI ===== */
.form-control {
    background: rgba(255,255,255,0.85) !important;
    border: 2px solid rgba(108,140,255,0.12) !important;
    color: #2d2d4a !important;
    border-radius: 14px !important;
    padding: 14px 20px !important;
    transition: all 0.3s ease !important;
    font-size: 16px !important;
    height: 52px !important;
}

.form-control:focus {
    background: rgba(255,255,255,0.95) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(108,140,255,0.15) !important;
    color: #2d2d4a !important;
}

.form-control::placeholder {
    color: #b0b0c8 !important;
    font-size: 15px !important;
}

.form-control-sm {
    border-radius: 12px !important;
    padding: 12px 18px !important;
    font-size: 15px !important;
    height: 46px !important;
}

select.form-control {
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 12 12'%3E%3Cpath fill='%236a6a8a' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 18px center;
    padding-right: 48px !important;
    cursor: pointer;
    font-size: 16px !important;
}

select.form-control option {
    background: #ffffff !important;
    color: #2d2d4a !important;
    padding: 12px !important;
    font-size: 15px !important;
}

/* ===== PHOTO ===== */
.img-circle {
    border-radius: 50% !important;
    transition: all 0.3s ease !important;
    border: 2px solid var(--soft-blue) !important;
}

.img-circle:hover {
    transform: scale(1.1);
    border-color: var(--soft-pink) !important;
}

/* ===== ALERT ===== */
.alert {
    border-radius: 20px !important;
    padding: 18px 26px !important;
    font-size: 16px !important;
    border: 2px solid transparent !important;
    font-weight: 600 !important;
}

.alert-success {
    background: rgba(102,187,106,0.12) !important;
    border-color: rgba(102,187,106,0.2) !important;
    color: #3a7a3a !important;
}

/* ===== BREADCRUMB ===== */
.breadcrumb {
    background: transparent !important;
    padding: 0 !important;
}

.breadcrumb-item a {
    color: #8888aa !important;
    transition: color 0.3s ease !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    font-size: 16px !important;
}

.breadcrumb-item a:hover {
    color: var(--soft-purple) !important;
}

.breadcrumb-item.active {
    color: #2d2d4a !important;
    font-weight: 700 !important;
    font-size: 16px !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: #c0c0d8 !important;
    content: "›" !important;
}

/* ===== CONTENT HEADER ===== */
.content-header h1 {
    color: #2d2d4a !important;
    font-weight: 800 !important;
    font-size: 2.2rem !important;
}

.content-header h1 i {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== EMPTY STATE ===== */
.text-center.py-5 {
    color: #b0b0c8 !important;
}

.text-center.py-5 h5 {
    color: #7a7a9a !important;
    font-size: 20px !important;
}

.text-center.py-5 i {
    color: rgba(108,140,255,0.12) !important;
}

/* ===== MODAL ===== */
.modal-content {
    border-radius: 28px !important;
    border: 2px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.92) !important;
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

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f5f0ff;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple));
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--soft-pink);
}

/* ===== KID EMOJI ===== */
.kid-emoji {
    display: inline-block;
    animation: sparkle 2s ease-in-out infinite;
}

@keyframes sparkle {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.15) rotate(8deg); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .content-header h1 { font-size: 1.5rem !important; }
    .table td, .table th { padding: 10px 6px !important; font-size: 12px !important; }
    .floating-shapes .shape { font-size: 2rem !important; }
    .btn { font-size: 12px !important; padding: 8px 16px !important; }
    .filter-section .filter-item { min-width: 100% !important; flex: 1 1 100% !important; }
    .filter-section .filter-label { font-size: 14px !important; }
    .form-control { font-size: 14px !important; height: 46px !important; }
}

@media (max-width: 480px) {
    .card { border-radius: 18px !important; }
    .table td, .table th { font-size: 10px !important; padding: 6px 3px !important; }
    .floating-shapes .shape { display: none !important; }
}
</style>

<!-- ===== FLOATING SHAPES ===== -->
<div class="floating-shapes">
    <div class="shape">🌈</div>
    <div class="shape">⭐</div>
    <div class="shape">🎈</div>
    <div class="shape">🌸</div>
    <div class="shape">☁️</div>
    <div class="shape">🌟</div>
    <div class="shape">🎉</div>
</div>

<div class="content-wrapper" style="background: transparent;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-user-graduate mr-2"></i>
                        Students 🎓
                        <span class="kid-emoji">🌟</span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item active">🎓 Students</li>
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
                <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('msg') ?> ✨
                <button type="button" class="close" data-dismiss="alert" style="color: #2d2d4a;">&times;</button>
            </div>
            <?php endif; ?>

            <!-- REGISTRATION RESULT MODAL -->
            <?php if(session()->getFlashdata('registration_success')): ?>
            <div class="modal fade" id="registrationResultModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(135deg, var(--soft-green), #43a047);">
                            <h4 class="mb-0 text-white">
                                <i class="fas fa-check-circle mr-2"></i>Registration Successful! 🎉
                            </h4>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body px-4 py-4">
                            <div class="text-center mb-4 p-3" style="background: rgba(240,245,255,0.5); border-radius: 15px;">
                                <i class="fas fa-user-graduate fa-2x" style="color: var(--soft-green); margin-bottom: 8px;"></i>
                                <h3 style="color: var(--soft-green);" class="mb-1"><?= session()->getFlashdata('student_name') ?></h3>
                                <p style="color: #7a7a9a; margin-bottom: 0;">has been registered successfully! ✨</p>
                            </div>
                            
                            <?php $parents = session()->getFlashdata('registered_parents'); ?>
                            <?php if(!empty($parents)): ?>
                            <h5 class="mb-3">
                                <i class="fas fa-users mr-2" style="color: var(--soft-blue);"></i>
                                Registered Parents / Fetchers 👨‍👩‍👧
                            </h5>
                            
                            <?php foreach($parents as $index => $p): ?>
                            <div class="card border mb-3" style="border-color: var(--soft-green) !important;">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-5 border-right" style="border-color: rgba(160,160,180,0.1) !important;">
                                            <h5 class="mb-1" style="color: #2d2d4a;">
                                                <span class="badge badge-success mr-2">#<?= $index + 1 ?></span>
                                                <?= esc($p['fname']) ?> <?= esc($p['lname']) ?>
                                            </h5>
                                            <p style="color: #7a7a9a; margin-bottom: 4px;"><i class="fas fa-tag mr-1"></i> Relation: <strong style="color: #2d2d4a;"><?= esc($p['relation']) ?></strong></p>
                                            <p style="color: #7a7a9a; margin-bottom: 0;"><i class="fas fa-qrcode mr-1"></i> QR Code: <code style="color: var(--soft-green);"><?= esc($p['qr_code']) ?></code></p>
                                        </div>
                                        <div class="col-md-7 text-center">
                                            <div style="display:inline-block;border:3px solid var(--soft-green);border-radius:12px;padding:10px;background:#fff;">
                                                <img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" 
                                                     style="width:200px;height:auto;display:block;" 
                                                     alt="QR Code">
                                                <div style="background: var(--soft-green); color: #fff; padding: 5px 10px; border-radius: 0 0 8px 8px; margin-top: 5px; font-weight: bold; font-size: 14px;">
                                                    <?= esc($p['qr_code']) ?>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <a href="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" 
                                                   download="<?= esc($p['qr_code']) ?>.png" 
                                                   class="btn btn-success btn-sm">
                                                    <i class="fas fa-download mr-1"></i> Download 💾
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>

                            <?php $fetchers = session()->getFlashdata('registered_fetchers'); ?>
                            <?php if(!empty($fetchers)): ?>
                            <h5 class="mb-3 mt-4">
                                <i class="fas fa-user-friends mr-2" style="color: var(--soft-orange);"></i>
                                Sub-Fetchers 👤
                            </h5>
                            
                            <?php foreach($fetchers as $index => $f): ?>
                            <div class="card border mb-3" style="border-color: var(--soft-orange) !important;">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-5 border-right" style="border-color: rgba(160,160,180,0.1) !important;">
                                            <h5 class="mb-1" style="color: #2d2d4a;">
                                                <span class="badge badge-warning mr-2">#<?= $index + 1 ?></span>
                                                <?= esc($f['fname']) ?> <?= esc($f['lname']) ?>
                                            </h5>
                                            <p style="color: #7a7a9a; margin-bottom: 0;"><i class="fas fa-qrcode mr-1"></i> QR Code: <code style="color: var(--soft-orange);"><?= esc($f['qr_code']) ?></code></p>
                                        </div>
                                        <div class="col-md-7 text-center">
                                            <div style="display:inline-block;border:3px solid var(--soft-orange);border-radius:12px;padding:10px;background:#fff;">
                                                <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" 
                                                     style="width:200px;height:auto;display:block;" 
                                                     alt="QR Code">
                                                <div style="background: var(--soft-orange); color: #fff; padding: 5px 10px; border-radius: 0 0 8px 8px; margin-top: 5px; font-weight: bold; font-size: 14px;">
                                                    <?= esc($f['qr_code']) ?>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <a href="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" 
                                                   download="<?= esc($f['qr_code']) ?>.png" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fas fa-download mr-1"></i> Download 💾
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>

                            <div class="alert alert-info mb-0 mt-3">
                                <i class="fas fa-info-circle mr-1"></i> 
                                <strong>Important:</strong> QR codes have been generated with text labels. Parents can scan the QR code or manually type the code number for student pickup. 📱
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close ❌</button>
                            <a href="<?= base_url('students-add') ?>" class="btn btn-primary">Register Another ➕</a>
                            <a href="<?= base_url('students') ?>" class="btn btn-outline-primary">View All 📋</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- MAIN CARD -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h5 class="mb-0">
                                    <i class="fas fa-list mr-2" style="color: var(--soft-blue);"></i>
                                    All Students 📋
                                    <span class="badge" style="background: rgba(108,140,255,0.08); color: #2d2d4a; margin-left: 8px; font-weight: 700; font-size: 14px; padding: 8px 18px;">
                                        <?= count($students ?? []) ?>
                                    </span>
                                </h5>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            
                            <!-- FILTER SECTION -->
                            <div class="filter-section">
                                <div class="filter-row">
                                    <div class="filter-item">
                                        <label class="filter-label">🔍 Search Student</label>
                                        <input type="text" id="searchStudent" class="form-control form-control-sm" placeholder="Search name...">
                                    </div>
                                    <div class="filter-item">
                                        <label class="filter-label">📚 Grade</label>
                                        <select id="filterGrade" class="form-control form-control-sm">
                                            <option value="">All Grades</option>
                                            <option value="kindergarten">🌈 Kindergarten</option>
                                            <option value="grade 1">📖 Grade 1</option>
                                            <option value="grade 2">📖 Grade 2</option>
                                            <option value="grade 3">📖 Grade 3</option>
                                            <option value="grade 4">📖 Grade 4</option>
                                            <option value="grade 5">📖 Grade 5</option>
                                            <option value="grade 6">📖 Grade 6</option>
                                        </select>
                                    </div>
                                    <div class="filter-item">
                                        <label class="filter-label">📋 Section</label>
                                        <select id="filterSection" class="form-control form-control-sm">
                                            <option value="">All Sections</option>
                                            <option value="a">Section A</option>
                                            <option value="b">Section B</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- TABLE - FIXED COLORS -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width:50px;">#</th>
                                            <th style="width:60px;">📸 Photo</th>
                                            <th>👤 Name</th>
                                            <th>📚 Grade</th>
                                            <th>📅 Created</th>
                                            <th class="text-center" style="width:120px;">👁️ View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($students)): $i=1; foreach($students as $s): $pic=!empty($s['picture'])?base_url('uploads/students/'.$s['picture']):''; ?>
                                        <tr class="student-row" data-name="<?= esc(strtolower($s['fname'].' '.$s['lname'])) ?>" data-grade="<?= esc(strtolower($s['grade_section'])) ?>">
                                            <td style="color: #b0b0c8; font-size: 15px; font-weight: 700;"><?= $i++ ?></td>
                                            <td style="cursor:pointer;" onclick="openImageViewer('<?= $pic ?>','<?= esc($s['fname'].' '.$s['lname']) ?>')">
                                                <?php if(!empty($s['picture'])): ?>
                                                    <img src="<?= base_url('uploads/students/'.$s['picture']) ?>" class="img-circle" style="width:45px;height:45px;object-fit:cover;">
                                                <?php else: ?>
                                                    <div class="img-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:rgba(108,140,255,0.08);">
                                                        <i class="fas fa-child" style="color: #b0b0c8; font-size: 20px;"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('students-view/'.$s['id']) ?>" style="color: #2d2d4a !important; font-weight: 700; font-size: 16px;">
                                                    <?= esc($s['fname']) ?> <?= esc($s['lname']) ?>
                                                </a>
                                            </td>
                                            <td><span class="badge badge-light"><?= esc($s['grade_section']) ?></span></td>
                                            <td style="color: #8888aa; font-size: 14px;"><?= date('M d, Y', strtotime($s['created_at'])) ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('students-view/'.$s['id']) ?>" class="btn-action-view">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <i class="fas fa-user-graduate fa-3x mb-3 d-block" style="color: rgba(108,140,255,0.12);"></i>
                                                <h5 style="color: #7a7a9a; font-size: 20px;">No students yet 😊</h5>
                                                <p style="color: #b0b0c8; font-size: 16px;">Register a student to get started! ✨</p>
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
                <h5><i class="fas fa-qrcode mr-2" style="color: var(--soft-blue);"></i><span id="qrModalTitle">QR Code 📱</span></h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #2d2d4a;">&times;</button>
            </div>
            <div class="modal-body text-center" style="background: #fff; border-radius: 0 0 25px 25px; padding: 30px;">
                <img id="qrFullImage" src="" style="max-width:100%;max-height:65vh;">
            </div>
            <div class="modal-footer">
                <a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i> Download 💾
                </a>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close ❌</button>
            </div>
        </div>
    </div>
</div>

<!-- ===== IMAGE VIEWER MODAL ===== -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5><i class="fas fa-image mr-2" style="color: var(--soft-blue);"></i><span id="imageViewerTitle">📸 Photo</span></h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #2d2d4a;">&times;</button>
            </div>
            <div class="modal-body text-center" style="background: #fff; border-radius: 0 0 25px 25px; padding: 20px;">
                <img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh; border-radius: 15px;">
            </div>
            <div class="modal-footer">
                <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i> Download 💾
                </a>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close ❌</button>
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
        alert('📸 No photo available for this student. 😊');
        return;
    }
    $('#imageViewerFull').attr('src',u);
    $('#imageDownloadBtn').attr('href',u);
    $('#imageDownloadBtn').attr('download',t.replace(/\s+/g,'_')+'.png');
    $('#imageViewerTitle').text('📸 ' + (t||'Photo'));
    $('#imageViewerModal').modal('show');
}

function openQrModal(u,t){
    if(!u) {
        alert('📱 No QR code available. 😊');
        return;
    }
    $('#qrFullImage').attr('src',u);
    $('#qrDownloadBtn').attr('href',u);
    $('#qrDownloadBtn').attr('download',(t||'qr').replace(/\s+/g,'_')+'.png');
    $('#qrModalTitle').text('📱 ' + (t||'QR Code'));
    $('#qrModal').modal('show');
}

<?php if(session()->getFlashdata('registration_success')): ?>
$(document).ready(function() {
    $('#registrationResultModal').modal('show');
});
<?php endif; ?>
</script>
<?= $this->endSection() ?>