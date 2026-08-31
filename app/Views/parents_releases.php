<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #6C8CFF;
    --soft-purple: #7C6CFF;
    --soft-pink: #FF8A9B;
    --soft-green: #66BB6A;
    --soft-teal: #4FC3F7;
    --soft-rose: #FF6B7A;
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

.card-body { padding: 0 !important; }

.input-group-text { border: none !important; background: transparent !important; }
.form-control:focus { box-shadow: none !important; outline: none !important; }
input[type="date"]::-webkit-calendar-picker-indicator { cursor: pointer; opacity: 0.6; }
input[type="date"]::-webkit-calendar-picker-indicator:hover { opacity: 1; }

.table {
    color: #2d2d4a !important;
}

.table thead.bg-light {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
}

.table thead th {
    color: #ffffff !important;
    font-weight: 700 !important;
    font-size: 14px !important;
    border-bottom: none !important;
    padding: 14px 14px !important;
}

.table tbody tr {
    border-bottom: 1px solid rgba(108,140,255,0.08) !important;
}

.table tbody tr:hover {
    background: rgba(108,140,255,0.06) !important;
}

.table tbody td {
    color: #2d2d4a !important;
    vertical-align: middle !important;
    border-top: none !important;
    padding: 12px 14px !important;
    font-size: 14px !important;
}

.badge {
    font-weight: 700 !important;
    padding: 6px 16px !important;
    border-radius: 50px !important;
    font-size: 12px !important;
}

.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-danger { background: var(--soft-rose) !important; color: #fff !important; }
.badge-light { background: rgba(108,140,255,0.08) !important; color: #2d2d4a !important; }

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
    .table td, .table th { padding: 8px 4px !important; font-size: 11px !important; }
}
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-history mr-2"></i>
                        Release History
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item"><a href="<?= base_url('parents-logs') ?>">My Dashboard</a></li>
 <li class="breadcrumb-item active">Release History</li>
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
                                    My Children's History
 <span class="badge" style="background: rgba(108,140,255,0.08); color: #2d2d4a; margin-left: 8px; font-weight: 700; font-size: 13px; padding: 6px 16px;">
 <?= count($logs ?? []) ?> records
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
 <th>Date/Time</th>
 <th> Student</th>
 <th> Fetcher</th>
 <th> Relation</th>
 <th> Method</th>
 <th> Status</th>
 </tr>
 </thead>
 <tbody>
 <?php if (!empty($logs)): $i = 1; foreach ($logs as $r): ?>
 <tr>
 <td style="color: #b0b0c8; font-weight: 700;"><?= $i++ ?></td>
 <td style="color: #8888aa; font-size: 13px;"><?= date('M d, Y h:i A', strtotime($r['time_released'] ?? $r['created_at'])) ?></td>
 <td>
 <strong style="color: #2d2d4a;">
 <?php if(($r['action'] ?? '') == 'decline'): ?>
 <?= esc($r['sfname'] ?? 'Unknown') ?>
 <?php else: ?>
 <?= esc($r['sfname'] ?? '') ?> <?= esc($r['smname'] ?? '') ?> <?= esc($r['slname'] ?? '') ?>
 <?php endif; ?>
 </strong>
 <br>
 <small style="color: #8888aa; font-size: 12px;">
 <?= esc($r['grade_section'] ?? '') ?>
 </small>
 </td>
 <td>
 <?php if(($r['action'] ?? '') == 'decline'): ?>
 <?= esc($r['fetcher_fname'] ?? 'System') ?>
 <?php else: ?>
 <?= esc($r['fetcher_fname']) ?> <?= esc($r['fetcher_lname']) ?>
 <?php endif; ?>
 </td>
 <td>
 <?php if(($r['action'] ?? '') == 'decline'): ?>
 <span class="badge badge-light"><?= esc($r['fetcher_relation'] ?? 'Staff') ?></span>
 <?php else: ?>
 <span class="badge badge-info"><?= esc($r['fetcher_relation'] ?? 'Parent') ?></span>
 <?php endif; ?>
 </td>
 <td>
 <?php if(($r['action'] ?? '') == 'decline'): ?>
 <span class="badge badge-light">—</span>
 <?php else: ?>
 <span class="badge badge-<?= ($r['method'] ?? '') == 'QR' ? 'primary' : 'info' ?>">
 <?= $r['method'] ?? '—' ?>
 </span>
 <?php endif; ?>
 </td>
 <td>
 <?php if(($r['action'] ?? '') == 'decline'): ?>
 <span class="badge badge-danger"> Declined</span>
 <?php else: ?>
 <span class="badge badge-success"> Released</span>
 <?php endif; ?>
 </td>
 </tr>
 <?php endforeach; else: ?>
 <tr>
 <td colspan="7" class="text-center py-5">
 <i class="fas fa-history fa-3x mb-3 d-block" style="color: rgba(108,140,255,0.12);"></i>
 <h5 style="color: #7a7a9a; font-size: 18px;">No history yet</h5>
 <p style="color: #b0b0c8; font-size: 15px;">Releases and declines will appear here.</p>
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