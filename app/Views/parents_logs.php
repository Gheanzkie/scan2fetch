<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #6C8CFF;
    --soft-purple: #7C6CFF;
    --soft-pink: #FF8A9B;
    --soft-green: #66BB6A;
    --soft-orange: #FFB74D;
    --soft-teal: #4FC3F7;
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
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-success { background: var(--soft-green) !important; color: #fff !important; }
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

.sms-badge {
    background: rgba(255,183,77,0.15);
    border: 1px solid rgba(255,183,77,0.2);
    border-radius: 12px;
    padding: 4px 12px;
    font-size: 12px;
    color: #8a7a4a;
}

.sms-badge i {
    color: var(--soft-orange);
}

/* ===== TABS ===== */
.nav-tabs {
    border-bottom: 2px solid rgba(108,140,255,0.08);
    padding: 0 20px;
}

.nav-tabs .nav-link {
    border: none;
    border-radius: 12px 12px 0 0;
    padding: 12px 24px;
    font-weight: 700;
    color: #8888aa;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link:hover {
    color: var(--soft-purple);
    background: rgba(108,140,255,0.05);
}

.nav-tabs .nav-link.active {
    color: var(--soft-purple);
    background: rgba(108,140,255,0.08);
    border-bottom: 3px solid var(--soft-blue);
}

.nav-tabs .nav-link i {
    margin-right: 8px;
}

.tab-content {
    padding: 0;
}

.tab-pane {
    padding: 0;
}

@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .content-header h1 { font-size: 1.5rem !important; }
    .table td, .table th { padding: 8px 4px !important; font-size: 11px !important; }
    .nav-tabs .nav-link { padding: 8px 12px; font-size: 12px; }
}
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-history mr-2"></i>
                        My Dashboard
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item active">Notifications</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">
            
 <!-- ===== TABS ===== -->
 <div class="card">
 <div class="card-header pt-3 pb-0">
 <ul class="nav nav-tabs" id="parentLogsTabs" role="tablist">
 <li class="nav-item">
 <a class="nav-link active" id="releases-tab" data-toggle="tab" href="#releases" role="tab">
 <i class="fas fa-check-circle" style="color: var(--soft-green);"></i>
                                Release History
 <span class="badge badge-light ml-1"><?= count($releases ?? []) ?></span>
 </a>
 </li>
 <li class="nav-item">
 <a class="nav-link" id="sms-tab" data-toggle="tab" href="#sms" role="tab">
 <i class="fas fa-sms" style="color: var(--soft-orange);"></i>
                                SMS Notifications
 <span class="badge badge-light ml-1"><?= count($smsNotifications ?? []) ?></span>
 </a>
 </li>
 </ul>
 </div>
 <div class="card-body p-0">
 <div class="tab-content">
                        
 <!-- ===== TAB 1: RELEASE HISTORY ===== -->
 <div class="tab-pane fade show active" id="releases" role="tabpanel">
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
 <h5 style="color: #7a7a9a; font-size: 18px;">No release history yet</h5>
 <p style="color: #b0b0c8; font-size: 15px;">Releases will appear here when students are picked up.</p>
 </td>
 </tr>
 <?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>

 <!-- ===== TAB 2: SMS NOTIFICATIONS ===== -->
 <div class="tab-pane fade" id="sms" role="tabpanel">
 <div class="table-responsive">
 <table class="table table-hover mb-0">
 <thead class="bg-light">
 <tr>
 <th style="width:50px;">#</th>
 <th>Date/Time</th>
 <th> Student</th>
 <th> Message</th>
 <th> Status</th>
 </tr>
 </thead>
 <tbody>
 <?php if (!empty($smsNotifications)): $i = 1; foreach ($smsNotifications as $s): ?>
 <tr>
 <td style="color: #b0b0c8; font-weight: 700;"><?= $i++ ?></td>
 <td style="color: #8888aa; font-size: 13px;"><?= date('M d, Y h:i A', strtotime($s['sent_at'])) ?></td>
 <td>
 <strong style="color: #2d2d4a;">
 <?= esc($s['student_fname'] ?? '') ?> <?= esc($s['student_lname'] ?? '') ?>
 </strong>
 <br>
 <small style="color: #8888aa; font-size: 12px;">
 <?= esc($s['grade_section'] ?? '') ?>
 </small>
 </td>
 <td style="font-size: 13px; color: #4a4a6a; max-width: 300px;">
 <?= esc(substr($s['message'], 0, 80)) ?>
 <?php if (strlen($s['message']) > 80): ?>...<?php endif; ?>
 <div class="mt-1">
 <span class="sms-badge">
 <i class="fas fa-phone"></i> <?= esc($s['parent_phone'] ?? '') ?>
 </span>
 </div>
 </td>
 <td>
 <span class="badge badge-success">
 <i class="fas fa-check-circle mr-1"></i> Sent
 </span>
 </td>
 </tr>
 <?php endforeach; else: ?>
 <tr>
 <td colspan="5" class="text-center py-5">
 <i class="fas fa-sms fa-3x mb-3 d-block" style="color: rgba(255,183,77,0.12);"></i>
 <h5 style="color: #7a7a9a; font-size: 18px;">No SMS notifications yet</h5>
 <p style="color: #b0b0c8; font-size: 15px;">SMS reminders will appear here when the school sends notifications.</p>
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