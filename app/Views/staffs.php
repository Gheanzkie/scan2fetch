<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== CHILD-FRIENDLY SOFT PASTEL THEME - STAFF ===== */
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

.table code {
    background: rgba(108,140,255,0.08) !important;
    color: #2d2d4a !important;
    padding: 6px 14px !important;
    border-radius: 8px !important;
    font-size: 15px !important;
    font-weight: 600 !important;
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

.btn-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(108,140,255,0.3) !important;
}

.btn-primary:hover {
    box-shadow: 0 8px 25px rgba(108,140,255,0.4) !important;
}

.btn-warning {
    background: linear-gradient(135deg, var(--soft-orange), #f57c00) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(255,183,77,0.3) !important;
}

.btn-warning:hover {
    box-shadow: 0 8px 25px rgba(255,183,77,0.4) !important;
}

/* ===== ACTION BUTTONS - MALAKI AT MALINAW ===== */
.btn-action-edit {
    background: linear-gradient(135deg, #a8e6cf, #88d8b0) !important;
    border: 2px solid rgba(136,216,176,0.3) !important;
    color: #2d2d4a !important;
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

.btn-action-edit:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 4px 15px rgba(136,216,176,0.3) !important;
    color: #1a1a2e !important;
    text-decoration: none !important;
}

.btn-action-delete {
    background: linear-gradient(135deg, #ffb3ba, #ff8a9b) !important;
    border: 2px solid rgba(255,138,155,0.3) !important;
    color: #2d2d4a !important;
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

.btn-action-delete:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 4px 15px rgba(255,138,155,0.3) !important;
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

/* ===== PHOTO/AVATAR ===== */
.img-circle {
    border-radius: 50% !important;
    transition: all 0.3s ease !important;
}

.img-circle i {
    font-size: 22px !important;
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

.modal-body label {
    font-weight: 700 !important;
    color: #2d2d4a !important;
    font-size: 15px !important;
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
    .btn-action-edit, .btn-action-delete { font-size: 12px !important; padding: 6px 14px !important; }
}

@media (max-width: 480px) {
    .card { border-radius: 18px !important; }
    .table td, .table th { font-size: 10px !important; padding: 6px 3px !important; }
    .floating-shapes .shape { display: none !important; }
    .btn-action-edit, .btn-action-delete { font-size: 10px !important; padding: 4px 10px !important; }
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
                        <i class="fas fa-user-tie mr-2"></i>
                        Staff Management 👨‍🏫
                        <span class="kid-emoji">🌟</span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item active">👨‍🏫 Staff</li>
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
                                    Staff List 📋
                                    <span class="badge" style="background: rgba(108,140,255,0.08); color: #2d2d4a; margin-left: 8px; font-weight: 700; font-size: 14px; padding: 8px 18px;">
                                        <?= count($staffs ?? []) ?>
                                    </span>
                                </h5>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStaffModal">
                                    <i class="fas fa-plus mr-1"></i> Add Staff ➕
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            
                            <!-- FILTER SECTION -->
                            <div class="filter-section">
                                <div class="filter-row">
                                    <div class="filter-item">
                                        <label class="filter-label">🔍 Search Staff</label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input type="text" id="searchStaff" class="form-control form-control-sm" placeholder="Search name or phone...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TABLE - FIXED COLORS -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width:50px;">#</th>
                                            <th>👤 Full Name</th>
                                            <th style="width:170px;">📱 Phone</th>
                                            <th style="width:150px;">📅 Created</th>
                                            <th style="width:200px;" class="text-center">⚡ Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($staffs)): ?>
                                            <?php $i = 1; foreach ($staffs as $staff): ?>
                                            <tr class="staff-row" data-search="<?= esc(strtolower($staff['fname'].' '.($staff['mname']??'').' '.$staff['lname'].' '.$staff['phone'])) ?>">
                                                <td style="color: #b0b0c8; font-size: 15px; font-weight: 700;"><?= $i++ ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="img-circle d-flex align-items-center justify-content-center mr-2" style="width:48px;height:48px;min-width:48px;background:linear-gradient(135deg, var(--soft-blue), var(--soft-purple));">
                                                            <i class="fas fa-user-tie text-white" style="font-size: 22px;"></i>
                                                        </div>
                                                        <div>
                                                            <strong style="color: #2d2d4a; font-size: 16px;"><?= esc($staff['fname']) ?> <?= esc($staff['lname']) ?></strong>
                                                            <?php if(!empty($staff['mname'])): ?>
                                                                <br><small style="color: #b0b0c8; font-size: 14px;"><?= esc($staff['mname']) ?></small>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><code><?= esc($staff['phone']) ?></code></td>
                                                <td style="color: #8888aa; font-size: 14px;"><?= date('M d, Y', strtotime($staff['created_at'])) ?></td>
                                                <td class="text-center">
                                                    <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                                                        <button class="btn-action-edit" 
                                                                data-toggle="modal" data-target="#editStaffModal"
                                                                data-id="<?= $staff['id'] ?>"
                                                                data-fname="<?= esc($staff['fname']) ?>"
                                                                data-mname="<?= esc($staff['mname'] ?? '') ?>"
                                                                data-lname="<?= esc($staff['lname']) ?>"
                                                                data-phone="<?= esc($staff['phone']) ?>"
                                                                title="Edit ✏️">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <a href="<?= base_url('staffs-delete/' . $staff['id']) ?>" 
                                                           class="btn-action-delete"
                                                           onclick="return confirm('Delete this staff member?\n\n<?= esc($staff['fname']) ?> <?= esc($staff['lname']) ?>')"
                                                           title="Delete 🗑️">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center py-5">
                                                    <i class="fas fa-user-tie fa-3x mb-3 d-block" style="color: rgba(108,140,255,0.12);"></i>
                                                    <h5 style="color: #7a7a9a; font-size: 20px;">No staff accounts yet 😊</h5>
                                                    <p style="color: #b0b0c8; font-size: 16px;">Click "Add Staff" to register a new staff member. ✨</p>
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
            <form action="<?= base_url('staffs-save') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus mr-2" style="color: var(--soft-blue);"></i>
                        Register New Staff ✨
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" style="color: #2d2d4a;">&times;</button>
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
                        <label>📱 Phone Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">📱</span>
                            </div>
                            <input type="text" name="phone" class="form-control" placeholder="09XXXXXXXXX" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>🔒 Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">🔒</span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Min. 6 characters" required minlength="6">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel ❌</button>
                    <button type="submit" class="btn btn-primary btn-sm px-4">
                        <i class="fas fa-save mr-1"></i> Save Staff 💾
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
            <form action="<?= base_url('staffs-update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editId">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-edit mr-2" style="color: var(--soft-orange);"></i>
                        Edit Staff ✏️
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" style="color: #2d2d4a;">&times;</button>
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
                        <label>📱 Phone Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">📱</span>
                            </div>
                            <input type="text" name="phone" id="editPhone" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>🔒 Password <span class="text-muted">(leave blank to keep current)</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">🔒</span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" minlength="6">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel ❌</button>
                    <button type="submit" class="btn btn-warning btn-sm px-4">
                        <i class="fas fa-check mr-1"></i> Update Staff ✅
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