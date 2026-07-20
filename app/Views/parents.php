<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SOFT PASTEL CHILD-FRIENDLY THEME - PARENTS LIST ===== */
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

.content-wrapper {
    background: transparent !important;
}

/* ===== CARDS ===== */
.card {
    border-radius: 25px !important;
    border: 1px solid rgba(255,255,255,0.6) !important;
    background: rgba(255,255,255,0.7) !important;
    backdrop-filter: blur(15px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.04) !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.06) !important;
}

.card-header {
    background: rgba(255,255,255,0.5) !important;
    border-bottom: 1px solid rgba(255,255,255,0.3) !important;
    padding: 1rem 1.5rem !important;
}

.card-title {
    color: #4a4a6a !important;
    font-weight: 700 !important;
    font-size: 1.15rem !important;
}

.card-title i {
    color: var(--soft-blue) !important;
}

.card-body {
    padding: 1.5rem !important;
}

/* ===== FILTERS SECTION ===== */
.filter-section {
    background: rgba(255,255,255,0.5);
    border-radius: 18px;
    padding: 20px 20px 12px 20px;
    margin-bottom: 20px;
    border: 1px solid rgba(255,255,255,0.4);
}

.filter-section .filter-label {
    font-size: 14px;
    font-weight: 600;
    color: #4a4a6a;
    margin-bottom: 8px;
    display: block;
}

.filter-section .filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: flex-end;
}

.filter-section .filter-item {
    flex: 1;
    min-width: 200px;
}

.filter-section .filter-item-sm {
    flex: 0 0 auto;
    min-width: 140px;
}

.filter-section .btn-reset {
    padding: 10px 30px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 14px;
    border: 2px solid rgba(160,160,180,0.2);
    color: #5a5a7a;
    background: rgba(255,255,255,0.6);
    transition: all 0.3s ease;
    cursor: pointer;
    height: 44px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-section .btn-reset:hover {
    background: rgba(168,192,255,0.15);
    border-color: var(--soft-blue);
    color: var(--soft-purple);
    transform: translateY(-2px);
}

/* ===== FORM CONTROLS - BIGGER FONT ===== */
.form-control {
    background: rgba(255,255,255,0.7) !important;
    border: 2px solid rgba(160,160,180,0.15) !important;
    color: #3d3d5c !important;
    border-radius: 12px !important;
    padding: 12px 18px !important;
    transition: all 0.3s ease !important;
    font-size: 15px !important;
    height: 44px !important;
}

.form-control:focus {
    background: rgba(255,255,255,0.9) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(168,192,255,0.15) !important;
    color: #3d3d5c !important;
}

.form-control::placeholder {
    color: #b0b0c8 !important;
    font-size: 14px !important;
}

.form-control-sm {
    border-radius: 12px !important;
    padding: 10px 16px !important;
    font-size: 14px !important;
    height: 40px !important;
}

select.form-control {
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b6b8d' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 40px !important;
    cursor: pointer;
}

select.form-control option {
    background: #ffffff !important;
    color: #3d3d5c !important;
    padding: 10px !important;
    font-size: 14px !important;
}

select.form-control optgroup {
    background: #f5f0ff !important;
    color: var(--soft-purple) !important;
    font-weight: 700 !important;
    font-size: 14px !important;
}

/* ===== TABLE ===== */
.table {
    color: #3d3d5c !important;
}

.table thead.bg-light {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink)) !important;
    border-radius: 15px 15px 0 0 !important;
}

.table thead th {
    color: #fff !important;
    font-weight: 600 !important;
    border-bottom: none !important;
    padding: 14px 10px !important;
    font-size: 14px !important;
}

.table tbody tr {
    border-bottom: 1px solid rgba(160,160,180,0.06) !important;
    transition: all 0.3s ease !important;
}

.table tbody tr:hover {
    background: rgba(168,192,255,0.06) !important;
    transform: scale(1.01);
}

.table tbody td {
    color: #4a4a6a !important;
    vertical-align: middle !important;
    border-top: none !important;
    padding: 14px 10px !important;
    font-size: 14px !important;
}

.table .small {
    color: #7a7a9a !important;
    font-size: 13px !important;
}

/* ===== BADGES ===== */
.badge {
    font-weight: 500 !important;
    padding: 6px 16px !important;
    border-radius: 50px !important;
    font-size: 13px !important;
}

.badge-light {
    background: rgba(160,160,180,0.1) !important;
    color: #5a5a7a !important;
}

.badge-info {
    background: var(--soft-teal) !important;
    color: #fff !important;
}

.badge-warning {
    background: var(--soft-orange) !important;
    color: #fff !important;
}

.badge-success {
    background: var(--soft-green) !important;
    color: #fff !important;
}

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    padding: 8px 22px !important;
    font-size: 14px !important;
}

.btn:hover {
    transform: translateY(-3px) scale(1.03);
}

.btn-outline-info {
    border-color: rgba(79,172,254,0.3) !important;
    color: #5a7a9a !important;
    background: transparent !important;
}

.btn-outline-info:hover {
    background: rgba(79,172,254,0.1) !important;
    border-color: var(--soft-teal) !important;
    color: var(--soft-purple) !important;
}

.btn-outline-secondary {
    border-color: rgba(160,160,180,0.15) !important;
    color: #7a7a9a !important;
    background: transparent !important;
}

.btn-outline-secondary:hover {
    background: rgba(168,192,255,0.08) !important;
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
}

.btn-xs {
    padding: 5px 16px !important;
    font-size: 12px !important;
    border-radius: 50px !important;
}

/* ===== ALERT ===== */
.alert-success {
    background: rgba(129,199,132,0.15) !important;
    border: 2px solid rgba(129,199,132,0.2) !important;
    color: #4a7a4a !important;
    border-radius: 18px !important;
    padding: 16px 22px !important;
    margin-bottom: 20px !important;
    font-size: 15px !important;
}

.alert-success i {
    color: var(--soft-green) !important;
}

/* ===== BREADCRUMB ===== */
.breadcrumb {
    background: transparent !important;
    padding: 0 !important;
}

.breadcrumb-item a {
    color: #7a7a9a !important;
    transition: color 0.3s ease !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    font-size: 14px !important;
}

.breadcrumb-item a:hover {
    color: var(--soft-purple) !important;
}

.breadcrumb-item.active {
    color: #4a4a6a !important;
    font-weight: 600 !important;
    font-size: 14px !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: #c0c0d8 !important;
    content: "›" !important;
}

/* ===== CONTENT HEADER ===== */
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

/* ===== PHOTO ===== */
.img-circle {
    border-radius: 50% !important;
    transition: all 0.3s ease !important;
}

.img-circle:hover {
    transform: scale(1.1);
}

/* ===== QR CODE ===== */
td img[style*="width:45px"] {
    transition: all 0.3s ease !important;
    border-radius: 8px !important;
}

td img[style*="width:45px"]:hover {
    transform: scale(1.15);
    box-shadow: 0 4px 15px rgba(168,192,255,0.3);
}

/* ===== MODALS ===== */
.modal-content {
    border-radius: 25px !important;
    border: 1px solid rgba(255,255,255,0.6) !important;
    background: rgba(255,255,255,0.9) !important;
    backdrop-filter: blur(15px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.06) !important;
}

.modal-header {
    border-bottom: 1px solid rgba(160,160,180,0.08) !important;
    border-radius: 25px 25px 0 0 !important;
    background: rgba(255,255,255,0.5) !important;
}

.modal-header h5 {
    color: #4a4a6a !important;
    font-weight: 700 !important;
    font-size: 1.1rem !important;
}

.modal-body {
    border-radius: 0 0 25px 25px !important;
    background: #f8f5ff !important;
}

.modal-footer {
    border-top: 1px solid rgba(160,160,180,0.08) !important;
    border-radius: 0 0 25px 25px !important;
    background: rgba(255,255,255,0.3) !important;
}

.modal-footer .btn-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(63,43,150,0.15) !important;
    font-size: 14px !important;
    padding: 10px 24px !important;
}

.modal-footer .btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(63,43,150,0.25) !important;
}

.modal-footer .btn-outline-light {
    border-color: rgba(160,160,180,0.2) !important;
    color: #7a7a9a !important;
    font-size: 14px !important;
    padding: 10px 24px !important;
}

.modal-footer .btn-outline-light:hover {
    background: rgba(160,160,180,0.05) !important;
    color: #3d3d5c !important;
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

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .filter-section .filter-item {
        min-width: 180px;
    }
}

@media (max-width: 768px) {
    .card-body {
        padding: 1rem !important;
    }
    .content-header h1 {
        font-size: 1.5rem !important;
    }
    .table td, .table th {
        padding: 10px 6px !important;
        font-size: 12px !important;
    }
    .card-title {
        font-size: 1rem !important;
    }
    .filter-section {
        padding: 15px 15px 8px 15px !important;
    }
    .filter-section .filter-item {
        min-width: 100% !important;
        flex: 1 1 100% !important;
    }
    .filter-section .filter-item-sm {
        min-width: 100% !important;
        flex: 1 1 100% !important;
    }
    .filter-section .btn-reset {
        width: 100% !important;
        justify-content: center !important;
    }
    .form-control {
        height: 40px !important;
        font-size: 14px !important;
        padding: 10px 14px !important;
    }
    .form-control-sm {
        height: 38px !important;
        font-size: 13px !important;
        padding: 8px 12px !important;
    }
}

@media (max-width: 480px) {
    .card {
        border-radius: 18px !important;
    }
    .table td, .table th {
        font-size: 10px !important;
        padding: 6px 3px !important;
    }
    .btn-xs {
        font-size: 9px !important;
        padding: 3px 10px !important;
    }
    .filter-section .filter-label {
        font-size: 12px !important;
    }
    .badge {
        font-size: 10px !important;
        padding: 4px 10px !important;
    }
}
</style>

<div class="content-wrapper" style="background: transparent;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-users mr-2"></i>
                        Parents & Fetchers 👨‍👩‍👧‍👦
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item active">👨‍👩 Parents</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if(session()->getFlashdata('msg')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle mr-1"></i>
                    <?= session()->getFlashdata('msg') ?> ✨
                </div>
            <?php endif; ?>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h3 class="card-title font-weight-normal mb-0">
                                    <i class="fas fa-list mr-2"></i>
                                    Parent / Fetcher List 📋
                                    <span class="badge" style="background: rgba(160,160,180,0.1); color: #7a7a9a; margin-left: 8px; font-weight: 600; font-size: 13px; padding: 6px 14px;">
                                        <?= count($parents ?? []) ?>
                                    </span>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            
                            <!-- ===== FILTERS SECTION - BIGGER FONTS ===== -->
                            <div class="filter-section">
                                <div class="filter-row">
                                    <!-- Search -->
                                    <div class="filter-item">
                                        <label class="filter-label">🔍 Search</label>
                                        <input type="text" id="searchFilter" class="form-control" placeholder="Search name or phone...">
                                    </div>
                                    
                                    <!-- Grade -->
                                    <div class="filter-item">
                                        <label class="filter-label">📚 Grade</label>
                                        <select id="gradeFilter" class="form-control">
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
                                    
                                    <!-- Section -->
                                    <div class="filter-item">
                                        <label class="filter-label">📋 Section</label>
                                        <select id="sectionFilter" class="form-control">
                                            <option value="">All Sections</option>
                                            <option value="a">Section A</option>
                                            <option value="b">Section B</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Reset Button -->
                                    <div class="filter-item-sm">
                                        <label class="filter-label">&nbsp;</label>
                                        <button class="btn-reset" id="resetFilterBtn">
                                            <i class="fas fa-times"></i> Reset 🔄
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- ===== TABLE ===== -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th style="width:60px;">📸 Photo</th>
                                            <th>👤 Name</th>
                                            <th>📱 Phone</th>
                                            <th>🎓 Student/Grade</th>
                                            <th>🤝 Relation</th>
                                            <th>📱 QR</th>
                                            <th>📅 Created</th>
                                            <th class="text-center" style="width:90px;">👁️ View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($parents)): $i=1; foreach($parents as $p): $pic=!empty($p['picture'])?base_url('uploads/parents/'.$p['picture']):''; $qrPic=!empty($p['qr_code'])?base_url('uploads/qr/'.$p['qr_code'].'.png'):''; ?>
                                        <tr class="parent-row" data-search="<?= esc(strtolower($p['fname'].' '.$p['lname'].' '.$p['phone'])) ?>" data-grade="<?= esc(strtolower($p['student_grade']??'')) ?>">
                                            <td style="color: #b0b0c8;"><?= $i++ ?></td>
                                            <td style="cursor:pointer;" onclick="openImageViewer('<?= $pic ?>','<?= esc($p['fname'].' '.$p['lname']) ?>')">
                                                <?php if(!empty($p['picture'])): ?>
                                                    <img src="<?= base_url('uploads/parents/'.$p['picture']) ?>" class="img-circle" style="width:45px;height:45px;object-fit:cover;border:2px solid var(--soft-blue);">
                                                <?php else: ?>
                                                    <div class="img-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;border:2px solid rgba(160,160,180,0.15);background:rgba(255,255,255,0.3);">
                                                        <i class="fas fa-user" style="color: #b0b0c8; font-size: 18px;"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td><strong style="color: #3d3d5c; font-size: 14px;"><?= esc($p['fname']) ?> <?= esc($p['lname']) ?></strong></td>
                                            <td style="color: #5a5a7a; font-size: 14px;"><?= esc($p['phone']) ?></td>
                                            <td>
                                                <span class="badge badge-light">
                                                    <?= esc($p['student_grade']??'—') ?> 
                                                    <?= !empty($p['student_fname']) ? ' - '.esc($p['student_fname']) : '' ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">
                                                    <?= esc($p['relation']??'—') ?>
                                                </span>
                                            </td>
                                            <td style="cursor:pointer;" onclick="openQrModal('<?= $qrPic ?>', '<?= esc($p['fname'].' '.$p['lname']) ?>')">
                                                <?php if(!empty($p['qr_code'])): ?>
                                                    <img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" style="width:50px;height:50px;border:2px solid var(--soft-blue);border-radius:8px;" title="Click to enlarge 📱">
                                                <?php else: ?>
                                                    <span class="badge badge-warning">❌ None</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="small" style="color: #b0b0c8; font-size: 13px;"><?= date('M d, Y', strtotime($p['created_at'])) ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('parents-view/'.$p['id']) ?>" class="btn btn-outline-info btn-xs">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <i class="fas fa-users fa-3x mb-3 d-block" style="color: rgba(160,160,180,0.15);"></i>
                                                <h5 style="color: #7a7a9a; font-size: 18px;">No parents registered yet 😊</h5>
                                                <p class="small" style="color: #b0b0c8; font-size: 14px;">Add parents when registering students ✨</p>
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
                <h5><i class="fas fa-qrcode mr-2" style="color: var(--soft-blue);"></i><span id="qrModalTitle">QR Code 📱</span></h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #4a4a6a; font-size: 24px;">&times;</button>
            </div>
            <div class="modal-body text-center">
                <img id="qrFullImage" src="" style="max-width:100%;max-height:70vh;padding:20px;">
            </div>
            <div class="modal-footer">
                <a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary">
                    <i class="fas fa-download"></i> Save 💾
                </a>
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close ❌</button>
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
                <button type="button" class="close" data-dismiss="modal" style="color: #4a4a6a; font-size: 24px;">&times;</button>
            </div>
            <div class="modal-body text-center" style="padding: 20px;">
                <img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh; border-radius: 15px;">
            </div>
            <div class="modal-footer">
                <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary">
                    <i class="fas fa-download"></i> Download 💾
                </a>
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close ❌</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    function filterTable(){
        var s = $('#searchFilter').val().toLowerCase();
        var g = $('#gradeFilter').val().toLowerCase();
        var sec = $('#sectionFilter').val().toLowerCase();
        
        $('.parent-row').each(function(){
            var t = $(this).data('search');
            var gr = $(this).data('grade');
            var show = true;
            
            if(s != '' && t.indexOf(s) < 0) show = false;
            if(g != '' && gr.indexOf(g) < 0) show = false;
            if(sec != '' && gr.indexOf('- '+sec) < 0 && !gr.endsWith(' '+sec)) show = false;
            
            $(this).toggle(show);
        });
    }
    
    $('#searchFilter').on('keyup', filterTable);
    $('#gradeFilter,#sectionFilter').on('change', filterTable);
    
    $('#resetFilterBtn').click(function(){
        $('#searchFilter').val('');
        $('#gradeFilter').val('');
        $('#sectionFilter').val('');
        $('.parent-row').show();
    });
});

function openImageViewer(u, t){
    if(!u) {
        alert('📸 No photo available for this person. 😊');
        return;
    }
    $('#imageViewerFull').attr('src', u);
    $('#imageDownloadBtn').attr('href', u);
    $('#imageDownloadBtn').attr('download', t.replace(/\s+/g,'_') + '.png');
    $('#imageViewerTitle').text('📸 ' + (t || 'Photo'));
    $('#imageViewerModal').modal('show');
}

function openQrModal(u, t){
    if(!u) {
        alert('📱 No QR code available for this person. 😊');
        return;
    }
    $('#qrFullImage').attr('src', u);
    $('#qrDownloadBtn').attr('href', u);
    $('#qrDownloadBtn').attr('download', (t || 'qr').replace(/\s+/g,'_') + '.png');
    $('#qrModalTitle').text('📱 ' + (t || 'QR Code'));
    $('#qrModal').modal('show');
}
</script>
<?= $this->endSection() ?>