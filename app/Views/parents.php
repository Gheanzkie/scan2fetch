<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #6C8CFF;
    --soft-purple: #7C6CFF;
    --soft-pink: #FF8A9B;
    --soft-rose: #FF6B7A;
    --soft-teal: #4FC3F7;
    --soft-green: #66BB6A;
    --soft-orange: #FFB74D;
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
    padding: 0 !important;
}

/* ===== TABLE ===== */
.table {
    color: #2d2d4a !important;
}

.table thead.bg-light {
    background: linear-gradient(135deg, #e8e0f0, #d5c8e8) !important;
}

.table thead th {
    color: #2d2d4a !important;
    font-weight: 700 !important;
    font-size: 14px !important;
    border-bottom: none !important;
    padding: 16px 14px !important;
    text-shadow: none !important;
}

.table tbody tr {
    border-bottom: 1px solid rgba(108,140,255,0.08) !important;
    transition: all 0.3s ease !important;
}

.table tbody tr:hover {
    background: rgba(108,140,255,0.06) !important;
    transform: scale(1.02);
}

.table tbody td {
    color: #2d2d4a !important;
    vertical-align: middle !important;
    border-top: none !important;
    padding: 14px 14px !important;
    font-size: 15px !important;
}

.table .text-muted {
    color: #8888aa !important;
}

.table .small {
    color: #8888aa !important;
    font-size: 13px !important;
}

/* ===== BADGES ===== */
.badge {
    font-weight: 700 !important;
    padding: 8px 20px !important;
    border-radius: 50px !important;
    font-size: 13px !important;
}

.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-light { background: rgba(108,140,255,0.08) !important; color: #2d2d4a !important; }

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

.btn-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(108,140,255,0.3) !important;
}

.btn-primary:hover {
    box-shadow: 0 8px 25px rgba(108,140,255,0.4) !important;
}

.btn-action-view {
    background: linear-gradient(135deg, #b8d4ff, #a8c0ff) !important;
    border: 2px solid rgba(168,192,255,0.3) !important;
    color: #2d2d4a !important;
    padding: 6px 18px !important;
    font-size: 13px !important;
    border-radius: 50px !important;
    font-weight: 700 !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
}

.btn-action-view:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 4px 15px rgba(168,192,255,0.3) !important;
    color: #1a1a2e !important;
    text-decoration: none !important;
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

/* ===== FILTER SECTION ===== */
.filter-section {
    background: rgba(255,255,255,0.6);
    border-radius: 20px;
    padding: 20px 24px 16px 24px;
    margin: 20px 20px 16px 20px;
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
    gap: 16px;
    align-items: flex-end;
}

.filter-section .filter-item {
    flex: 1;
    min-width: 200px;
}

/* ===== FORM CONTROLS ===== */
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

.input-group-text {
    background: rgba(255,255,255,0.5) !important;
    border: 2px solid rgba(108,140,255,0.12) !important;
    border-right: none !important;
    color: #8888aa !important;
    border-radius: 14px 0 0 14px !important;
    font-size: 16px !important;
    padding: 0 20px !important;
}

.input-group .form-control {
    border-radius: 0 14px 14px 0 !important;
    border-left: none !important;
}

/* ===== ALERTS ===== */
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

.alert-danger {
    background: rgba(255,107,122,0.12) !important;
    border-color: rgba(255,107,122,0.2) !important;
    color: #aa4a5a !important;
}

/* ===== BREADCRUMB ===== */
.breadcrumb {
    background: transparent !important;
    padding: 0 !important;
}

.breadcrumb-item a {
    color: #8888aa !important;
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

/* ===== IMAGES ===== */
.img-circle {
    border-radius: 50% !important;
    transition: all 0.3s ease !important;
    object-fit: cover !important;
}

.img-circle:hover {
    transform: scale(1.1);
}

/* ===== QR CODE ===== */
.qr-thumb {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    border: 2px solid rgba(108,140,255,0.1);
    cursor: pointer;
    transition: all 0.3s ease;
    object-fit: cover;
}

.qr-thumb:hover {
    transform: scale(1.1);
    border-color: var(--soft-blue);
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
    .filter-section { padding: 16px 16px 12px 16px !important; margin: 12px 12px 12px 12px !important; }
    .btn-action-view { font-size: 11px !important; padding: 4px 12px !important; }
}

@media (max-width: 480px) {
    .card { border-radius: 18px !important; }
    .table td, .table th { font-size: 10px !important; padding: 6px 3px !important; }
    .floating-shapes .shape { display: none !important; }
    .btn-action-view { font-size: 10px !important; padding: 3px 8px !important; }
    .qr-thumb { width: 35px; height: 35px; }
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
                        <i class="fas fa-user-friends mr-2"></i>
                        Parents Management 👨‍👩
                        <span class="kid-emoji">🌟</span>
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
            
            <!-- ALERTS -->
            <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('msg') ?> ✨
                <button type="button" class="close" data-dismiss="alert" style="color: #2d2d4a;">&times;</button>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle mr-2"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" style="color: #2d2d4a;">&times;</button>
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
                                    Parent List 📋
                                    <span class="badge" style="background: rgba(108,140,255,0.08); color: #2d2d4a; margin-left: 8px; font-weight: 700; font-size: 14px; padding: 8px 18px;">
                                        <?= count($parents ?? []) ?>
                                    </span>
                                </h5>
                                <span style="color: #b0b0c8; font-size: 13px;">
                                    <i class="fas fa-info-circle"></i> Parents are added via Student Registration
                                </span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            
                            <!-- FILTER SECTION -->
                            <div class="filter-section">
                                <div class="filter-row">
                                    <div class="filter-item">
                                        <label class="filter-label">🔍 Search Parent</label>
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
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width:50px;">#</th>
                                            <th style="width:70px;">📸 Photo</th>
                                            <th>👤 Name</th>
                                            <th style="width:130px;">📱 Phone</th>
                                            <th>🎓 Student/Grade</th>
                                            <th style="width:100px;">🤝 Relation</th>
                                            <th style="width:80px;">📱 QR</th>
                                            <th style="width:130px;">📅 Created</th>
                                            <th style="width:100px;">👁️ View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($parents)): ?>
                                            <?php $i = 1; foreach ($parents as $p): ?>
                                            <tr class="parent-row" data-search="<?= esc(strtolower($p['fname'].' '.($p['mname']??'').' '.$p['lname'].' '.$p['phone'])) ?>">
                                                <td style="color: #b0b0c8; font-size: 15px; font-weight: 700;"><?= $i++ ?></td>
                                                <td>
                                                    <?php if(!empty($p['picture'])): ?>
                                                        <img src="<?= base_url('uploads/parents/'.$p['picture']) ?>" class="img-circle" style="width:50px;height:50px;border:3px solid var(--soft-blue);">
                                                    <?php else: ?>
                                                        <div class="img-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;border:3px solid var(--soft-blue);background:rgba(255,255,255,0.3);">
                                                            <i class="fas fa-user fa-2x" style="color: #b0b0c8;"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <strong style="color: #2d2d4a; font-size: 16px;"><?= esc($p['fname']) ?> <?= esc($p['lname']) ?></strong>
                                                    <?php if(!empty($p['mname'])): ?>
                                                        <br><small style="color: #b0b0c8; font-size: 13px;"><?= esc($p['mname']) ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td><code><?= esc($p['phone']) ?></code></td>
                                                <td>
                                                    <?php if(!empty($p['student_fname'])): ?>
                                                        <strong style="color: #2d2d4a;"><?= esc($p['student_fname']) ?> <?= esc($p['student_lname'] ?? '') ?></strong>
                                                        <br><small style="color: #b0b0c8;"><?= esc($p['student_grade'] ?? '') ?></small>
                                                    <?php else: ?>
                                                        <span style="color: #b0b0c8;">No students</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if(!empty($p['relation'])): ?>
                                                        <span class="badge badge-primary"><?= esc($p['relation']) ?></span>
                                                    <?php else: ?>
                                                        <span class="badge badge-light">Parent</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if(!empty($p['qr_code'])): ?>
                                                        <img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" 
                                                             class="qr-thumb"
                                                             onclick="openQrModal('<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>')"
                                                             title="Click to enlarge 📱">
                                                    <?php else: ?>
                                                        <span style="color: #b0b0c8; font-size: 12px;">No QR</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="color: #8888aa; font-size: 14px;"><?= date('M d, Y', strtotime($p['created_at'])) ?></td>
                                                <td>
                                                    <a href="<?= base_url('parents-view/'.$p['id']) ?>" class="btn-action-view" title="View Parent Details 👁️">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="9" class="text-center py-5">
                                                    <i class="fas fa-user-friends fa-3x mb-3 d-block" style="color: rgba(108,140,255,0.12);"></i>
                                                    <h5 style="color: #7a7a9a; font-size: 20px;">No parents registered yet 😊</h5>
                                                    <p style="color: #b0b0c8; font-size: 16px;">Parents are automatically registered when adding a student. ✨</p>
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
                <h5><i class="fas fa-qrcode mr-2" style="color: var(--soft-blue);"></i>QR Code 📱</h5>
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
});

// ===== OPEN QR MODAL =====
function openQrModal(u) {
    if (!u) { 
        alert('📱 No QR code available. 😊'); 
        return; 
    }
    $('#qrFullImage').attr('src', u);
    $('#qrDownloadBtn').attr('href', u);
    $('#qrModal').modal('show');
}
</script>
<?= $this->endSection() ?>