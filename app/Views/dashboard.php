<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SOFT PASTEL CHILD-FRIENDLY THEME ===== */
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
    animation: floatShape 20s ease-in-out infinite;
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

/* ===== WELCOME BANNER ===== */
.welcome-banner {
    background: linear-gradient(135deg, #a8c0ff, #f093fb);
    border-radius: 25px;
    padding: 2rem 2.5rem;
    color: #fff;
    position: relative;
    overflow: hidden;
    margin-bottom: 2rem;
    box-shadow: 0 8px 30px rgba(168,192,255,0.25);
}

.welcome-banner::before {
    content: '🌈';
    position: absolute;
    font-size: 6rem;
    right: 20px;
    top: -10px;
    opacity: 0.12;
}

.welcome-banner h2 { font-weight: 700; font-size: 1.8rem; }
.welcome-banner p { opacity: 0.9; font-size: 1rem; }

/* ===== FUN CARDS ===== */
.kid-card {
    border-radius: 20px !important;
    border: 1px solid rgba(255,255,255,0.6) !important;
    background: rgba(255,255,255,0.7) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.04) !important;
    transition: all 0.3s ease !important;
}

.kid-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.06) !important;
}

.kid-card .card-header {
    background: rgba(255,255,255,0.5) !important;
    border-bottom: 1px solid rgba(255,255,255,0.3) !important;
}

.kid-card .card-header h5 { color: #4a4a6a !important; }

/* ===== FUN BOX CARDS ===== */
.fun-box {
    border-radius: 20px !important;
    border: 1px solid rgba(255,255,255,0.5) !important;
    padding: 1.2rem !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
    position: relative !important;
    overflow: hidden !important;
    background: rgba(255,255,255,0.7) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
}

.fun-box:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 8px 30px rgba(0,0,0,0.06) !important;
}

.fun-box .icon-circle {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    margin: 0 auto 10px;
    background: rgba(255,255,255,0.4);
    transition: all 0.3s ease;
}

.fun-box:hover .icon-circle { transform: rotate(8deg) scale(1.05); }

.fun-box .number {
    font-size: 2rem;
    font-weight: 700;
    color: #3d3d5c;
    display: block;
}

.fun-box .label {
    font-size: 0.85rem;
    color: #7a7a9a;
    font-weight: 500;
}

/* ===== COLORFUL BACKGROUNDS ===== */
.bg-kid-blue { background: linear-gradient(135deg, #a8c0ff, #8ab4f5) !important; color: #fff; }
.bg-kid-green { background: linear-gradient(135deg, #81c784, #66bb6a) !important; color: #fff; }
.bg-kid-orange { background: linear-gradient(135deg, #ffb74d, #ffa726) !important; color: #fff; }
.bg-kid-pink { background: linear-gradient(135deg, #f093fb, #f5576c) !important; color: #fff; }
.bg-kid-purple { background: linear-gradient(135deg, #a8c0ff, #3f2b96) !important; color: #fff; }
.bg-kid-yellow { background: linear-gradient(135deg, #ffd54f, #ffca28) !important; color: #3d3d5c; }
.bg-kid-teal { background: linear-gradient(135deg, #4facfe, #00f2fe) !important; color: #fff; }

.fun-box .icon-circle { background: rgba(255,255,255,0.2); }

/* ===== TABLE ===== */
.table-fun thead {
    background: linear-gradient(135deg, #a8c0ff, #f093fb);
    color: #fff;
}

.table-fun thead th { color: #fff !important; font-weight: 600; }

.table-fun tbody tr {
    border-bottom: 1px solid rgba(160,160,180,0.08);
    transition: all 0.3s ease;
}

.table-fun tbody tr:hover {
    background: rgba(168,192,255,0.06);
    transform: scale(1.01);
}

.table-fun tbody td { color: #4a4a6a; }

/* ===== BUTTONS ===== */
.btn-kid {
    border-radius: 50px !important;
    padding: 10px 25px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    border: none !important;
}

.btn-kid:hover { transform: translateY(-3px) scale(1.03); }

.btn-kid-primary { background: linear-gradient(135deg, #a8c0ff, #3f2b96); color: #fff; }
.btn-kid-success { background: linear-gradient(135deg, #81c784, #43a047); color: #fff; }
.btn-kid-purple { background: linear-gradient(135deg, #ce93d8, #8e24aa); color: #fff; }
.btn-kid-pink { background: linear-gradient(135deg, #f093fb, #f5576c); color: #fff; }

/* ===== CHILD ITEMS ===== */
.child-item {
    border-radius: 15px !important;
    border: 1px solid rgba(160,160,180,0.08) !important;
    background: rgba(255,255,255,0.4) !important;
    transition: all 0.3s ease !important;
}

.child-item:hover {
    background: rgba(168,192,255,0.06) !important;
    border-color: var(--soft-blue) !important;
    transform: scale(1.02);
}

.subfetcher-item {
    border-radius: 15px !important;
    border: 1px solid rgba(160,160,180,0.08) !important;
    background: rgba(255,255,255,0.3) !important;
    transition: all 0.3s ease !important;
}

.subfetcher-item:hover {
    background: rgba(168,192,255,0.06) !important;
    border-color: var(--soft-green) !important;
    transform: scale(1.02);
}

/* ===== ANIMATIONS ===== */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}

.float-animation { animation: float 3s ease-in-out infinite; }

@keyframes sparkle {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.sparkle { animation: sparkle 2s ease-in-out infinite; }

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .welcome-banner { padding: 1.5rem; }
    .welcome-banner h2 { font-size: 1.3rem; }
    .fun-box .number { font-size: 1.5rem; }
    .fun-box .icon-circle { width: 50px; height: 50px; font-size: 1.3rem; }
    .child-item { padding: 1rem !important; }
    .subfetcher-item { padding: 0.8rem !important; }
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

<div class="content-wrapper" style="position: relative; z-index: 1;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="welcome-banner">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>👋 Hi, <?= ucfirst(session('fname')) ?>! <span class="sparkle">🌟</span></h2>
                        <p>
                            <?php if (session('role') == 'admin'): ?>
                                Welcome to your school dashboard! You're the captain of this ship! 🚀
                            <?php elseif (session('role') == 'staff'): ?>
                                Welcome back! Ready to help our students today? 📚
                            <?php elseif (session('role') == 'parent'): ?>
                                Welcome to your child's learning adventure! 🎒
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="col-md-4 text-right d-none d-md-block">
                        <span style="font-size: 3.5rem;"><?= session('role') == 'admin' ? '👨‍🏫' : (session('role') == 'staff' ? '🧑‍🏫' : '👨‍👩‍👧') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- ==================== ADMIN DASHBOARD ==================== -->
            <?php if (session('role') == 'admin'): ?>
            <div class="row">
                <div class="col-lg-3 col-6 mb-3">
                    <div class="fun-box bg-kid-blue float-animation">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
                            <span class="number"><?= $totalStudents ?? 0 ?></span>
                            <span class="label">🎓 Students</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="fun-box bg-kid-green float-animation" style="animation-delay: 0.2s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                            <span class="number"><?= $releasedToday ?? 0 ?></span>
                            <span class="label">✅ Released Today</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="fun-box bg-kid-yellow float-animation" style="animation-delay: 0.4s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-sms"></i></div>
                            <span class="number"><?= $smsSentToday ?? 0 ?></span>
                            <span class="label">💬 SMS Today</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="fun-box bg-kid-purple float-animation" style="animation-delay: 0.6s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-users"></i></div>
                            <span class="number"><?= $totalParents ?? 0 ?></span>
                            <span class="label">👨‍👩‍👧 Parents</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-6 mb-3">
                    <div class="fun-box bg-kid-pink float-animation" style="animation-delay: 0.8s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-user-check"></i></div>
                            <span class="number"><?= $totalStaff ?? 0 ?></span>
                            <span class="label">🧑‍🏫 Staff</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 mb-3">
                    <div class="fun-box bg-kid-teal float-animation" style="animation-delay: 1s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-qrcode"></i></div>
                            <span class="number"><?= $qrReleases ?? 0 ?></span>
                            <span class="label">📱 QR Releases</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 mb-3">
                    <div class="fun-box bg-kid-orange float-animation" style="animation-delay: 1.2s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-history"></i></div>
                            <span class="number"><?= count($recentReleases ?? []) ?></span>
                            <span class="label">📋 Recent Releases</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="row">
                <div class="col-12">
                    <div class="kid-card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-history mr-2" style="color: #a8c0ff;"></i> Recent Releases 🕒 <span style="font-size:0.8rem;color:#b0b0c8;font-weight:400;margin-left:10px;">Latest 10 entries</span></h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-fun table-hover table-sm mb-0">
                                    <thead><tr><th>🎓 Student ID</th><th>👤 Fetcher</th><th>📱 Method</th><th>⏰ Time</th></tr></thead>
                                    <tbody>
                                        <?php if(!empty($recentReleases)): foreach($recentReleases as $r): ?>
                                        <tr>
                                            <td><strong>#<?= esc($r['student_id']) ?></strong></td>
                                            <td><?= esc($r['fetcher_fname']) ?> <?= esc($r['fetcher_lname']) ?></td>
                                            <td><span class="badge" style="background:<?= ($r['method']??'')=='QR'?'#a8c0ff':'#81c784' ?>;color:#fff;padding:5px 14px;border-radius:50px;"><?= $r['method']??'—' ?></span></td>
                                            <td class="small text-muted"><?= date('h:i A', strtotime($r['time_released'])) ?></td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr><td colspan="4" class="text-center text-muted py-4"><span style="font-size:2rem;">📭</span><br>No releases yet</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- ==================== STAFF DASHBOARD ==================== -->
            <?php if (session('role') == 'staff'): ?>
            <div class="row">
                <div class="col-lg-3 col-6 mb-3">
                    <div class="fun-box bg-kid-green float-animation">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                            <span class="number"><?= $releasedToday ?? 0 ?></span>
                            <span class="label">✅ My Releases Today</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="fun-box bg-kid-blue float-animation" style="animation-delay: 0.2s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
                            <span class="number"><?= $totalStudents ?? 0 ?></span>
                            <span class="label">🎓 Students</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="fun-box bg-kid-yellow float-animation" style="animation-delay: 0.4s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-sms"></i></div>
                            <span class="number"><?= $smsSentToday ?? 0 ?></span>
                            <span class="label">💬 SMS Today</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="fun-box bg-kid-orange float-animation" style="animation-delay: 0.6s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-qrcode"></i></div>
                            <span class="number"><?= count($todayReleases ?? []) ?></span>
                            <span class="label">📋 Today's Releases</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Action Buttons -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="kid-card">
                        <div class="card-body">
                            <h5 class="mb-3">🚀 Quick Actions</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="<?= base_url('scan') ?>" class="btn btn-kid btn-kid-primary">
                                    <i class="fas fa-qrcode mr-1"></i> Scan QR 📱
                                </a>
                                <a href="<?= base_url('students') ?>" class="btn btn-kid btn-kid-success">
                                    <i class="fas fa-user-graduate mr-1"></i> Students 🎓
                                </a>
                                <a href="<?= base_url('parents') ?>" class="btn btn-kid btn-kid-purple">
                                    <i class="fas fa-users mr-1"></i> Parents 👨‍👩‍👧
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Releases Table -->
            <div class="row">
                <div class="col-12">
                    <div class="kid-card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-history mr-2" style="color: #81c784;"></i> Today's Releases 📋 <span style="font-size:0.8rem;color:#b0b0c8;font-weight:400;margin-left:10px;"><?= date('F d, Y') ?></span></h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-fun table-hover table-sm mb-0">
                                    <thead><tr><th>🎓 Student ID</th><th>📱 Method</th><th>⏰ Time</th></tr></thead>
                                    <tbody>
                                        <?php if(!empty($todayReleases)): foreach($todayReleases as $r): ?>
                                        <tr>
                                            <td><strong>#<?= esc($r['student_id']) ?></strong></td>
                                            <td><span class="badge" style="background:<?= ($r['method']??'')=='QR'?'#a8c0ff':'#81c784' ?>;color:#fff;padding:5px 14px;border-radius:50px;"><?= $r['method']??'—' ?></span></td>
                                            <td class="small text-muted"><?= date('h:i A', strtotime($r['time_released'])) ?></td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr><td colspan="3" class="text-center text-muted py-4"><span style="font-size:2rem;">📭</span><br>No releases today</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- ==================== PARENT DASHBOARD - FIXED ==================== -->
            <?php if (session('role') == 'parent'): ?>
            
            <!-- Parent Stats -->
            <div class="row">
                <div class="col-lg-4 col-6 mb-3">
                    <div class="fun-box bg-kid-blue float-animation">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-child"></i></div>
                            <span class="number"><?= count($myChildren ?? []) ?></span>
                            <span class="label">👶 My Children</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 mb-3">
                    <div class="fun-box bg-kid-green float-animation" style="animation-delay: 0.2s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                            <span class="number"><?= $releasedToday ?? 0 ?></span>
                            <span class="label">✅ Released Today</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 mb-3">
                    <div class="fun-box bg-kid-orange float-animation" style="animation-delay: 0.4s;">
                        <div class="text-center">
                            <div class="icon-circle"><i class="fas fa-user-friends"></i></div>
                            <span class="number"><?= count($subFetchers ?? []) ?></span>
                            <span class="label">👥 Sub-Fetchers</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parent Profile & My Children -->
            <div class="row">
                <!-- Parent Profile Card -->
                <div class="col-md-4 mb-3">
                    <div class="kid-card" style="background: linear-gradient(135deg, #a8c0ff, #f093fb); color: #fff;">
                        <div class="card-body text-center">
                            <div style="width:120px;height:120px;margin:0 auto;border-radius:50%;overflow:hidden;border:4px solid #fff;box-shadow: 0 8px 25px rgba(0,0,0,0.1);cursor:pointer;" 
                                 onclick="openImageViewer('<?= !empty($parentProfile['picture']) ? base_url('uploads/parents/' . $parentProfile['picture']) : '' ?>', '<?= esc(($parentProfile['fname'] ?? session('fname')) . ' ' . ($parentProfile['lname'] ?? session('lname'))) ?>')">
                                <?php if (!empty($parentProfile['picture'])): ?>
                                    <img src="<?= base_url('uploads/parents/' . $parentProfile['picture']) ?>" style="width:100%;height:100%;object-fit:cover;">
                                <?php else: ?>
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.2);">
                                        <i class="fas fa-user fa-3x" style="color: rgba(255,255,255,0.7);"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="mt-3 mb-0" style="color: #fff;">
                                <?= esc($parentProfile['fname'] ?? session('fname')) ?> 
                                <?= esc($parentProfile['lname'] ?? session('lname')) ?>
                            </h3>
                            <p class="mb-2" style="color: rgba(255,255,255,0.85);">
                                <i class="fas fa-phone mr-1"></i> <?= esc($parentProfile['phone'] ?? session('phone')) ?>
                            </p>
                            <?php if (!empty($parentProfile['qr_code'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/qr/' . $parentProfile['qr_code'] . '.png') ?>" 
                                     style="width:100px;height:100px;border:3px solid rgba(255,255,255,0.3);border-radius:15px;cursor:pointer;" 
                                     onclick="openQrModal('<?= base_url('uploads/qr/' . $parentProfile['qr_code'] . '.png') ?>', '<?= esc($parentProfile['fname'] ?? session('fname')) ?>')">
                                <p style="color: rgba(255,255,255,0.8); font-size: 0.8rem; margin-top: 5px;">
                                    🌟 My QR Code
                                </p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Sub-Fetchers -->
                    <?php if (!empty($subFetchers)): ?>
                    <div class="kid-card mt-3">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-user-friends mr-2" style="color: #81c784;"></i>
                                My Sub-Fetchers 👥 (<?= count($subFetchers) ?>)
                            </h6>
                        </div>
                        <div class="card-body">
                            <?php foreach ($subFetchers as $f): ?>
                            <div class="subfetcher-item d-flex align-items-center p-2 mb-2">
                                <div class="mr-2" style="cursor:pointer;" onclick="openImageViewer('<?= !empty($f['picture']) ? base_url('uploads/parents/' . $f['picture']) : '' ?>', '<?= esc($f['fname'] . ' ' . $f['lname']) ?>')">
                                    <?php if(!empty($f['picture'])): ?>
                                        <img src="<?= base_url('uploads/parents/' . $f['picture']) ?>" class="img-circle" style="width:45px;height:45px;object-fit:cover;border:2px solid #81c784;">
                                    <?php else: ?>
                                        <div class="img-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;border:2px solid #81c784;background:rgba(255,255,255,0.3);">
                                            <i class="fas fa-user" style="color: #b0b0c8;"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1">
                                    <strong style="color: #3d3d5c;"><?= esc($f['fname']) ?> <?= esc($f['lname']) ?></strong>
                                    <br><small class="text-muted">📱 <?= esc($f['phone']) ?></small>
                                </div>
                                <?php if(!empty($f['qr_code'])): ?>
                                    <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" 
                                         style="width:35px;height:35px;border:2px solid #81c784;border-radius:8px;cursor:pointer;" 
                                         onclick="openQrModal('<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>', '<?= esc($f['fname']) ?>')">
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- My Children -->
                <div class="col-md-8">
                    <div class="kid-card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-child mr-2" style="color: #ffb74d;"></i>
                                My Children 👶 (<?= count($myChildren ?? []) ?>)
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($myChildren)): ?>
                            <div class="row">
                                <?php foreach ($myChildren as $child): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="child-item d-flex align-items-center p-3">
                                        <div class="mr-3" style="cursor:pointer;" onclick="openImageViewer('<?= !empty($child['picture']) ? base_url('uploads/students/' . $child['picture']) : '' ?>', '<?= esc($child['fname'] . ' ' . $child['lname']) ?>')">
                                            <?php if (!empty($child['picture'])): ?>
                                                <img src="<?= base_url('uploads/students/' . $child['picture']) ?>" class="img-circle" style="width:60px;height:60px;object-fit:cover;border:3px solid #ffb74d;">
                                            <?php else: ?>
                                                <div class="img-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;border:3px solid #ffb74d;background:rgba(255,255,255,0.3);">
                                                    <i class="fas fa-child" style="color: #ffb74d; font-size: 1.5rem;"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-grow-1">
                                            <strong style="color: #3d3d5c;"><?= esc($child['fname']) ?> <?= esc($child['lname']) ?></strong>
                                            <br><small class="text-muted">📚 <?= esc($child['grade_section']) ?></small>
                                            <?php if (!empty($child['relation'])): ?>
                                                <br><span class="badge" style="background: #ffb74d; color: #fff; border-radius: 50px; padding: 3px 12px; font-size: 11px;">
                                                    <?= esc($child['relation']) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php else: ?>
                            <div class="text-center text-muted py-5">
                                <span style="font-size: 4rem;">👶</span>
                                <p class="mt-3">No children registered yet</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>
</div>

<!-- ===== QR MODAL ===== -->
<div class="modal fade" id="qrModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                <h5><i class="fas fa-qrcode mr-2" style="color: #a8c0ff;"></i><span id="qrModalTitle">QR Code 📱</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center" style="padding: 30px; background: #fff; border-radius: 0 0 25px 25px;">
                <img id="qrFullImage" src="" style="max-width:100%;max-height:60vh;padding:20px;">
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(0,0,0,0.05);">
                <a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Save 💾</a>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close ❌</button>
            </div>
        </div>
    </div>
</div>

<!-- ===== IMAGE VIEWER MODAL ===== -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                <h5><i class="fas fa-image mr-2" style="color: #a8c0ff;"></i><span id="imageViewerTitle">📸 Photo</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center" style="padding: 20px; background: #fff; border-radius: 0 0 25px 25px;">
                <img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh; border-radius: 15px;">
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(0,0,0,0.05);">
                <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download 💾</a>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close ❌</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openQrModal(u, t) {
    if (!u) { alert('📱 No QR code available. 😊'); return; }
    $('#qrFullImage').attr('src', u);
    $('#qrDownloadBtn').attr('href', u);
    $('#qrDownloadBtn').attr('download', (t || 'qr').replace(/\s+/g, '_') + '.png');
    $('#qrModalTitle').text('📱 ' + (t || 'QR Code'));
    $('#qrModal').modal('show');
}

function openImageViewer(u, t) {
    if (!u) { alert('📸 No photo available. 😊'); return; }
    $('#imageViewerFull').attr('src', u);
    $('#imageDownloadBtn').attr('href', u);
    $('#imageDownloadBtn').attr('download', t.replace(/\s+/g, '_') + '.png');
    $('#imageViewerTitle').text('📸 ' + (t || 'Photo'));
    $('#imageViewerModal').modal('show');
}
</script>
<?= $this->endSection() ?>