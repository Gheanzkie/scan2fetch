<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SOFT PASTEL CHILD-FRIENDLY THEME - QR SCAN MONITOR ===== */
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
    opacity: 0.06;
    animation: floatShape 18s ease-in-out infinite;
}

.floating-shapes .shape:nth-child(1) { top: 5%; left: 3%; animation-delay: 0s; }
.floating-shapes .shape:nth-child(2) { top: 15%; right: 5%; animation-delay: 2.5s; }
.floating-shapes .shape:nth-child(3) { bottom: 20%; left: 4%; animation-delay: 5s; }
.floating-shapes .shape:nth-child(4) { bottom: 10%; right: 3%; animation-delay: 1.5s; }
.floating-shapes .shape:nth-child(5) { top: 45%; left: 45%; animation-delay: 3.5s; font-size: 5rem; opacity: 0.04; }
.floating-shapes .shape:nth-child(6) { top: 70%; left: 20%; animation-delay: 4s; }
.floating-shapes .shape:nth-child(7) { top: 30%; left: 75%; animation-delay: 6s; }

@keyframes floatShape {
    0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
    25% { transform: translateY(-25px) rotate(8deg) scale(1.05); }
    75% { transform: translateY(20px) rotate(-5deg) scale(0.95); }
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
    position: relative;
    z-index: 1;
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

.card-header h5 {
    color: #4a4a6a !important;
    font-weight: 700 !important;
    font-size: 1.1rem !important;
}

/* ===== INFO BOX ===== */
.info-box {
    border-radius: 20px !important;
    border: 1px solid rgba(255,255,255,0.5) !important;
    background: rgba(255,255,255,0.6) !important;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
    position: relative;
    z-index: 1;
    overflow: hidden;
}

.info-box::before {
    content: '';
    position: absolute;
    top: -30px;
    right: -30px;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    opacity: 0.08;
    background: currentColor;
}

.info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.06) !important;
}

.info-box .info-box-content {
    color: #3d3d5c !important;
}

.info-box .info-box-text {
    color: #7a7a9a !important;
    font-size: 14px !important;
    font-weight: 500 !important;
}

.info-box .info-box-number {
    color: #3d3d5c !important;
    font-size: 28px !important;
    font-weight: 700 !important;
}

.info-box-icon {
    width: 60px !important;
    height: 60px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1.5rem !important;
    border-radius: 15px !important;
    color: #fff !important;
}

/* ===== TABLE ===== */
.table {
    color: #3d3d5c !important;
}

.table thead.bg-light {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink)) !important;
}

.table thead th {
    color: #fff !important;
    font-weight: 600 !important;
    border-bottom: none !important;
    padding: 14px 10px !important;
    font-size: 13px !important;
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
    padding: 12px 10px !important;
    font-size: 13px !important;
}

.table .text-muted {
    color: #7a7a9a !important;
}

.table .small {
    color: #7a7a9a !important;
    font-size: 12px !important;
}

/* ===== BADGES ===== */
.badge {
    font-weight: 500 !important;
    padding: 6px 16px !important;
    border-radius: 50px !important;
    font-size: 12px !important;
}

.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-danger { background: var(--soft-rose) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }
.badge-light { background: rgba(160,160,180,0.08) !important; color: #7a7a9a !important; }

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    padding: 8px 20px !important;
    font-size: 13px !important;
}

.btn:hover {
    transform: translateY(-3px) scale(1.03);
}

.btn-outline-secondary {
    border-color: rgba(160,160,180,0.15) !important;
    color: #7a7a9a !important;
    background: rgba(255,255,255,0.3) !important;
}

.btn-outline-secondary:hover {
    background: rgba(168,192,255,0.08) !important;
    color: var(--soft-purple) !important;
}

/* ===== LIST GROUP ===== */
.list-group-item {
    background: transparent !important;
    border-color: rgba(160,160,180,0.06) !important;
    color: #4a4a6a !important;
    transition: all 0.3s ease !important;
    padding: 12px 16px !important;
}

.list-group-item:hover {
    background: rgba(168,192,255,0.05) !important;
    transform: scale(1.01);
}

.list-group-item .font-weight-bold {
    color: #3d3d5c !important;
}

.list-group-item .text-muted {
    color: #b0b0c8 !important;
}

/* ===== PHOTO ===== */
.img-circle {
    border-radius: 50% !important;
    transition: all 0.3s ease !important;
}

.img-circle:hover {
    transform: scale(1.1);
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

/* ===== EMPTY STATE ===== */
.text-center.py-4,
.text-center.py-3 {
    color: #b0b0c8 !important;
}

.text-center.py-4 i,
.text-center.py-3 i {
    color: rgba(160,160,180,0.15) !important;
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

/* ===== KID EMOJI ANIMATION ===== */
.kid-emoji {
    display: inline-block;
    animation: sparkle 2s ease-in-out infinite;
}

@keyframes sparkle {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.15) rotate(8deg); }
}

/* ===== PULSE ANIMATION FOR LIVE ===== */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.live-pulse {
    display: inline-block;
    animation: pulse 2s ease-in-out infinite;
    color: var(--soft-rose);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .card-body {
        padding: 1rem !important;
    }
    .content-header h1 {
        font-size: 1.5rem !important;
    }
    .table td, .table th {
        padding: 8px 4px !important;
        font-size: 11px !important;
    }
    .info-box .info-box-number {
        font-size: 20px !important;
    }
    .floating-shapes .shape {
        font-size: 2rem !important;
    }
}

@media (max-width: 480px) {
    .card {
        border-radius: 18px !important;
    }
    .table td, .table th {
        font-size: 9px !important;
        padding: 4px 2px !important;
    }
    .badge {
        font-size: 9px !important;
        padding: 3px 8px !important;
    }
    .btn {
        font-size: 10px !important;
        padding: 4px 10px !important;
    }
    .floating-shapes .shape {
        display: none !important;
    }
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

<div class="content-wrapper" style="background: transparent; position: relative; z-index: 1;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-monitor-heart-rate mr-2"></i>
                        QR Scan Monitoring <span class="kid-emoji">🔍</span>
                        <span class="live-pulse" style="font-size: 14px; margin-left: 8px;">● LIVE</span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item active">🔍 Scan Monitor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- ===== LIVE STATS ===== -->
            <div class="row">
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-green), #43a047);">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">✅ Released Today</span>
                            <span class="info-box-number"><?= $releasedToday ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-rose), #d32f2f);">
                            <i class="fas fa-times-circle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">❌ Declined Today</span>
                            <span class="info-box-number"><?= $declinedToday ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-orange), #f57c00);">
                            <i class="fas fa-clock"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">🕐 Pending Release</span>
                            <span class="info-box-number"><?= $pendingRelease ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple));">
                            <i class="fas fa-qrcode"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">📱 Total Scans Today</span>
                            <span class="info-box-number"><?= $totalScans ?? 0 ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- ===== RECENT RELEASES ===== -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-list mr-2" style="color: var(--soft-blue);"></i>
                                    Recent Releases 📋
                                    <span class="badge" style="background: rgba(160,160,180,0.1); color: #7a7a9a; margin-left: 6px; font-weight: 600; font-size: 11px; padding: 4px 12px;">
                                        <?= count($recentReleases ?? []) ?>
                                    </span>
                                </h5>
                                <button class="btn btn-outline-secondary btn-sm" onclick="location.reload()">
                                    <i class="fas fa-sync-alt mr-1"></i> Refresh 🔄
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="small">
                                            <th>#</th>
                                            <th>⏰ Time</th>
                                            <th>🎓 Student</th>
                                            <th>📚 Grade</th>
                                            <th>👤 Fetcher</th>
                                            <th>🤝 Relation</th>
                                            <th>📱 Method</th>
                                            <th>📌 Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($recentReleases)): $i = 1; ?>
                                        <?php foreach($recentReleases as $r): ?>
                                        <tr>
                                            <td style="color: #b0b0c8; font-size: 12px;"><?= $i++ ?></td>
                                            <td style="color: #7a7a9a; font-size: 12px;"><?= date('h:i A', strtotime($r['time_released'])) ?></td>
                                            <td><strong style="color: #3d3d5c;"><?= esc($r['student_fname'] ?? '') ?> <?= esc($r['student_lname'] ?? '') ?></strong></td>
                                            <td><span class="badge badge-light"><?= esc($r['grade_section'] ?? '—') ?></span></td>
                                            <td style="color: #4a4a6a;"><?= esc($r['fetcher_fname']) ?> <?= esc($r['fetcher_lname']) ?></td>
                                            <td><span class="badge badge-info"><?= esc($r['fetcher_relation'] ?? 'Parent') ?></span></td>
                                            <td>
                                                <span class="badge badge-<?= $r['method'] == 'QR' ? 'primary' : 'info' ?>">
                                                    <?= $r['method'] ?>
                                                </span>
                                            </td>
                                            <td><span class="badge badge-success">✅ Released</span></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <i class="fas fa-inbox fa-2x mb-2 d-block" style="color: rgba(160,160,180,0.15);"></i>
                                                <span style="color: #b0b0c8;">No releases yet today 😊</span>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== SCAN ACTIVITY FEED ===== -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header pt-3 pb-2">
                            <h5 class="mb-0">
                                <i class="fas fa-stream mr-2" style="color: var(--soft-green);"></i>
                                Scan Activity 📡
                                <span class="live-pulse" style="font-size: 10px; margin-left: 6px;">● LIVE</span>
                            </h5>
                        </div>
                        <div class="card-body p-0" style="max-height: 450px; overflow-y: auto;">
                            <?php if(!empty($scanActivities)): ?>
                            <div class="list-group list-group-flush">
                                <?php foreach($scanActivities as $activity): ?>
                                <div class="list-group-item border-0 border-bottom">
                                    <div class="d-flex w-100 justify-content-between">
                                        <small class="font-weight-bold" style="color: #3d3d5c;">
                                            <?php if($activity['action'] == 'release'): ?>
                                                <i class="fas fa-check-circle" style="color: var(--soft-green);"></i>
                                            <?php elseif($activity['action'] == 'decline'): ?>
                                                <i class="fas fa-times-circle" style="color: var(--soft-rose);"></i>
                                            <?php else: ?>
                                                <i class="fas fa-qrcode" style="color: var(--soft-blue);"></i>
                                            <?php endif; ?>
                                            <?= esc($activity['user_name']) ?>
                                        </small>
                                        <small style="color: #b0b0c8; font-size: 11px;"><?= date('h:i A', strtotime($activity['created_at'])) ?></small>
                                    </div>
                                    <p class="mb-0 small" style="color: #7a7a9a;"><?= esc($activity['description']) ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php else: ?>
                            <div class="text-center py-4" style="color: #b0b0c8;">
                                <i class="fas fa-inbox fa-3x mb-2 d-block" style="color: rgba(160,160,180,0.15);"></i>
                                <span>No scan activity yet 📭</span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== STUDENTS INSIDE ===== -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pt-3 pb-2">
                            <h5 class="mb-0">
                                <i class="fas fa-hourglass-half mr-2" style="color: var(--soft-orange);"></i>
                                Students Still Inside 🏫
                                <span class="badge" style="background: var(--soft-orange); color: #fff; margin-left: 8px; font-weight: 600; font-size: 12px; padding: 6px 14px;">
                                    <?= count($studentsInside ?? []) ?>
                                </span>
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="small">
                                            <th>#</th>
                                            <th>📸 Photo</th>
                                            <th>👤 Student Name</th>
                                            <th>📚 Grade/Section</th>
                                            <th>👨‍👩 Parent/Guardian</th>
                                            <th>📌 Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($studentsInside)): $i = 1; ?>
                                        <?php foreach($studentsInside as $s): ?>
                                        <tr>
                                            <td style="color: #b0b0c8; font-size: 12px;"><?= $i++ ?></td>
                                            <td>
                                                <?php if(!empty($s['picture'])): ?>
                                                <img src="<?= base_url('uploads/students/'.$s['picture']) ?>" class="img-circle" style="width:40px;height:40px;object-fit:cover;border:2px solid var(--soft-blue);">
                                                <?php else: ?>
                                                <div class="img-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;border:2px solid var(--soft-blue);background:rgba(255,255,255,0.3);">
                                                    <i class="fas fa-child" style="color: #b0b0c8;"></i>
                                                </div>
                                                <?php endif; ?>
                                            </td>
                                            <td><strong style="color: #3d3d5c;"><?= esc($s['fname']) ?> <?= esc($s['lname']) ?></strong></td>
                                            <td><span class="badge badge-light"><?= esc($s['grade_section']) ?></span></td>
                                            <td style="color: #4a4a6a;">
                                                <?php if(!empty($s['parent_fname'])): ?>
                                                    <?= esc($s['parent_fname']) ?> <?= esc($s['parent_lname']) ?>
                                                <?php else: ?>
                                                    <span style="color: #b0b0c8;">Not assigned</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><span class="badge badge-warning">🕐 Inside</span></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-4" style="color: #b0b0c8;">
                                                <i class="fas fa-check-circle fa-2x mb-2 d-block" style="color: rgba(129,199,132,0.3);"></i>
                                                All students have been released! 🎉
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

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Auto-refresh every 30 seconds
var autoRefresh = setInterval(function() {
    if (!document.querySelector(':focus')) {
        location.reload();
    }
}, 30000);

// Pause refresh when user is interacting
$(document).on('focus', 'input, select, textarea', function() {
    clearInterval(autoRefresh);
}).on('blur', 'input, select, textarea', function() {
    autoRefresh = setInterval(function() {
        if (!document.querySelector(':focus')) {
            location.reload();
        }
    }, 30000);
});
</script>
<?= $this->endSection() ?>