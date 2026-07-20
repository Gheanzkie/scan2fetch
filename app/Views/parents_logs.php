<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #6C8CFF;
    --soft-purple: #7C6CFF;
    --soft-pink: #FF8A9B;
    --soft-green: #66BB6A;
    --soft-orange: #FFB74D;
}

body {
    background: linear-gradient(135deg, #f5f0ff 0%, #ffe8f0 100%) !important;
    color: #2d2d4a !important;
}

.content-wrapper { background: transparent !important; position: relative; z-index: 1; }

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

.card {
    border-radius: 28px !important;
    border: 2px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.85) !important;
    backdrop-filter: blur(15px);
    box-shadow: 0 8px 32px rgba(108,140,255,0.08) !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
}

.card:hover { transform: translateY(-5px); box-shadow: 0 16px 48px rgba(108,140,255,0.12) !important; }

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

.card-body { padding: 0 !important; }

.table {
    color: #2d2d4a !important;
}

.table thead.bg-light {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
}

.table thead th {
    color: #ffffff !important;
    font-weight: 700 !important;
    font-size: 15px !important;
    border-bottom: none !important;
    padding: 16px 14px !important;
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

.badge {
    font-weight: 700 !important;
    padding: 8px 20px !important;
    border-radius: 50px !important;
    font-size: 13px !important;
}

.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }

.breadcrumb { background: transparent !important; padding: 0 !important; }
.breadcrumb-item a { color: #8888aa !important; font-weight: 600 !important; font-size: 15px !important; }
.breadcrumb-item a:hover { color: var(--soft-purple) !important; }
.breadcrumb-item.active { color: #2d2d4a !important; font-weight: 700 !important; font-size: 15px !important; }
.breadcrumb-item + .breadcrumb-item::before { color: #c0c0d8 !important; content: "›" !important; }

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

.kid-emoji {
    display: inline-block;
    animation: sparkle 2s ease-in-out infinite;
}

@keyframes sparkle {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.15) rotate(8deg); }
}

@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .content-header h1 { font-size: 1.5rem !important; }
    .table td, .table th { padding: 8px 4px !important; font-size: 11px !important; }
    .floating-shapes .shape { font-size: 2rem !important; }
}
</style>

<!-- Floating Shapes -->
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
                        <i class="fas fa-history mr-2"></i>
                        Release History 📋
                        <span class="kid-emoji">🌟</span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item active">📋 Release History</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-list mr-2" style="color: var(--soft-blue);"></i>
                                    My Children's Release History 🎒
                                    <span class="badge" style="background: rgba(108,140,255,0.08); color: #2d2d4a; margin-left: 8px; font-weight: 700; font-size: 13px; padding: 6px 16px;">
                                        <?= count($releases ?? []) ?> releases
                                    </span>
                                </h5>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width:50px;">#</th>
                                            <th>⏰ Date/Time</th>
                                            <th>🎓 Student</th>
                                            <th>👤 Fetcher</th>
                                            <th>🤝 Relation</th>
                                            <th>📱 Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($releases)): $i = 1; foreach ($releases as $r): ?>
                                        <tr>
                                            <td style="color: #b0b0c8; font-weight: 700;"><?= $i++ ?></td>
                                            <td style="color: #8888aa; font-size: 13px;"><?= date('M d, Y h:i A', strtotime($r['time_released'])) ?></td>
                                            <td><strong style="color: #2d2d4a;"><?= esc($r['sfname'] ?? '') ?> <?= esc($r['smname'] ?? '') ?> <?= esc($r['slname'] ?? '') ?></strong></td>
                                            <td><?= esc($r['fetcher_fname']) ?> <?= esc($r['fetcher_lname']) ?></td>
                                            <td><span class="badge badge-info"><?= esc($r['fetcher_relation'] ?? 'Parent') ?></span></td>
                                            <td>
                                                <span class="badge badge-<?= ($r['method'] ?? '') == 'QR' ? 'primary' : 'info' ?>">
                                                    <?= $r['method'] ?? '—' ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <i class="fas fa-history fa-3x mb-3 d-block" style="color: rgba(108,140,255,0.12);"></i>
                                                <h5 style="color: #7a7a9a; font-size: 18px;">No release history yet 😊</h5>
                                                <p style="color: #b0b0c8; font-size: 15px;">Releases will appear here when students are picked up. ✨</p>
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