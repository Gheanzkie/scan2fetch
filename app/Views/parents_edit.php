<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #6C8CFF;
    --soft-purple: #7C6CFF;
    --soft-pink: #FF8A9B;
    --soft-green: #66BB6A;
    --soft-orange: #FFB74D;
    --soft-yellow: #FFD54F;
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

.card-body { padding: 1.8rem !important; }

.form-control {
    background: rgba(255,255,255,0.85) !important;
    border: 2px solid rgba(108,140,255,0.12) !important;
    color: #2d2d4a !important;
    border-radius: 14px !important;
    padding: 14px 20px !important;
    font-size: 16px !important;
    height: 52px !important;
    transition: all 0.3s ease !important;
}

.form-control:focus {
    background: rgba(255,255,255,0.95) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(108,140,255,0.15) !important;
    color: #2d2d4a !important;
}

label {
    font-weight: 700 !important;
    color: #2d2d4a !important;
    font-size: 15px !important;
}

.btn {
    border-radius: 50px !important;
    font-weight: 700 !important;
    transition: all 0.3s ease !important;
    padding: 12px 32px !important;
    font-size: 15px !important;
}

.btn:hover { transform: translateY(-3px) scale(1.03); }

.btn-warning {
    background: linear-gradient(135deg, var(--soft-orange), #f57c00) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(255,183,77,0.3) !important;
}

.btn-warning:hover { box-shadow: 0 8px 25px rgba(255,183,77,0.4) !important; }

.btn-outline-secondary {
    border: 2px solid rgba(108,140,255,0.15) !important;
    color: #6a6a8a !important;
    background: rgba(255,255,255,0.3) !important;
}

.btn-outline-secondary:hover {
    background: rgba(108,140,255,0.08) !important;
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
}

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
    .form-control { font-size: 14px !important; height: 46px !important; }
    .btn { font-size: 12px !important; padding: 8px 16px !important; }
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
                        <i class="fas fa-user-edit mr-2"></i>
                        Edit Parent ✏️
                        <span class="kid-emoji">🌟</span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('parents') ?>">👨‍👩 Parents</a></li>
                        <li class="breadcrumb-item active">✏️ Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('parents-update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $parent['id'] ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>📝 Parent Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="fname" class="form-control" value="<?= esc($parent['fname']) ?>" required>
                                    </div>
                                    <div class="col-4">
                                        <label>Middle Name</label>
                                        <input type="text" name="mname" class="form-control" value="<?= esc($parent['mname'] ?? '') ?>">
                                    </div>
                                    <div class="col-4">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="lname" class="form-control" value="<?= esc($parent['lname']) ?>" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label>📱 Phone <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" value="<?= esc($parent['phone']) ?>" required>
                                    </div>
                                    <div class="col-6">
                                        <label>🔒 Password <small>(leave blank to keep)</small></label>
                                        <input type="password" name="password" class="form-control" placeholder="••••••••">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-3" style="display: flex; gap: 10px; justify-content: flex-end;">
                    <a href="<?= base_url('parents-view/'.$parent['id']) ?>" class="btn btn-outline-secondary">Cancel ❌</a>
                    <button type="submit" class="btn btn-warning px-4">
                        <i class="fas fa-check mr-1"></i> Update Parent ✅
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
<?= $this->endSection() ?>