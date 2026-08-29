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

.card {
    border-radius: 28px !important;
    border: 2px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.85) !important;
    box-shadow: 0 8px 32px rgba(108,140,255,0.08) !important;
    overflow: hidden !important;
}

.card:hover { box-shadow: 0 16px 48px rgba(108,140,255,0.12) !important; }

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
    padding: 12px 32px !important;
    font-size: 15px !important;
}

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

@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .content-header h1 { font-size: 1.5rem !important; }
    .form-control { font-size: 14px !important; height: 46px !important; }
    .btn { font-size: 12px !important; padding: 8px 16px !important; }
}
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-user-edit mr-2"></i>
                        Edit Parent
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item"><a href="<?= base_url('parents') ?>">Parents</a></li>
 <li class="breadcrumb-item active">Edit</li>
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
 <h5> Parent Information</h5>
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
 <div class="col-12">
 <label> Phone <span class="text-danger">*</span></label>
 <input type="text" name="phone" class="form-control" value="<?= esc($parent['phone']) ?>" required>
 </div>
 </div>
 <div class="alert alert-info mt-3 mb-0">
 <i class="fas fa-sms mr-1"></i>
 <small>Passwords are auto-generated and sent to this number via SMS.</small>
 </div>
 </div>
 </div>
 </div>
 </div>
 <div class="text-right mt-3" style="display: flex; gap: 10px; justify-content: flex-end;">
 <a href="<?= base_url('parents-view/'.$parent['id']) ?>" class="btn btn-outline-secondary">Cancel</a>
 <button type="submit" class="btn btn-warning px-4">
 <i class="fas fa-check mr-1"></i> Update Parent
 </button>
 </div>
 </form>
 </div>
 </section>
</div>
<?= $this->endSection() ?>