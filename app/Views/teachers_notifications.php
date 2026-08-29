<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #6C8CFF;
    --soft-purple: #7C6CFF;
    --soft-pink: #FF8A9B;
    --soft-green: #66BB6A;
    --soft-teal: #4FC3F7;
    --soft-orange: #FFB74D;
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

.table { color: #2d2d4a !important; }

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

.table tbody tr { border-bottom: 1px solid rgba(108,140,255,0.08) !important; }
.table tbody tr:hover { background: rgba(108,140,255,0.06) !important; }

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
}

.badge-success {
    background: var(--soft-green) !important;
    color: #fff !important;
}

.sms-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: rgba(108,140,255,0.10);
    color: #4a5a8a;
    border-radius: 50px;
    padding: 3px 12px;
    font-size: 11px;
    font-weight: 600;
}

.message-cell { max-width: 380px; }
.message-preview { display: block; }
.message-full { display: none; }
.message-toggle {
    color: var(--soft-purple);
    font-weight: 700;
    cursor: pointer;
    font-size: 13px;
}
.message-text { white-space: pre-line; }

.content-header h1 {
    color: #2d2d4a !important;
    font-weight: 700 !important;
    font-size: 1.7rem !important;
}

.content-header h1 i {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.breadcrumb { background: transparent !important; padding: 0 !important; }
.breadcrumb-item a { color: #8888aa !important; font-weight: 600 !important; text-decoration: none !important; }
.breadcrumb-item.active { color: #2d2d4a !important; font-weight: 700 !important; }
.breadcrumb-item + .breadcrumb-item::before { color: #c0c0d8 !important; content: "›" !important; }

@media (max-width: 768px) {
    .content-header h1 { font-size: 1.4rem !important; }
    .message-cell { max-width: 150px; }
    .message-cell .message-text { font-size: 12px; }
}
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-sms mr-2"></i>
                        SMS Notifications
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item"><a href="<?= base_url('teachers-view/' . session('user_id')) ?>">My Students</a></li>
 <li class="breadcrumb-item active">SMS Notifications</li>
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
                                    SMS Notification History
 <span class="badge" style="background: rgba(108,140,255,0.08); color: #2d2d4a; margin-left: 8px; font-weight: 700; font-size: 13px; padding: 6px 16px;">
 <?= count($smsNotifications ?? []) ?> messages
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
 <?= esc($s['student_fname'] ?? 'Unknown') ?> <?= esc($s['student_lname'] ?? '') ?>
 </strong>
 <br>
 <small style="color: #8888aa; font-size: 12px;">
 <?= esc($s['grade_section'] ?? '') ?>
 </small>
 </td>
 <td class="message-cell">
 <div class="message-preview">
 <span class="message-text">
 <?= esc(substr($s['message'], 0, 100)) ?>
 <?php if (strlen($s['message']) > 100): ?>
 <span class="message-toggle" onclick="toggleMessage(this)">... Read More</span>
 <?php endif; ?>
 </span>
 </div>

 <?php if (strlen($s['message']) > 100): ?>
 <div class="message-full">
 <span class="message-text">
 <?= esc($s['message']) ?>
 <span class="message-toggle" onclick="toggleMessage(this)"> Show Less</span>
 </span>
 </div>
 <?php endif; ?>

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
 <p style="color: #b0b0c8; font-size: 15px;">SMS reminders for your class will appear here when the school sends notifications.</p>
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
function toggleMessage(element) {
    var parent = element.closest('td');
    var preview = parent.querySelector('.message-preview');
    var full = parent.querySelector('.message-full');

    if (full) {
        if (full.style.display === 'none' || full.style.display === '') {
            full.style.display = 'block';
            preview.style.display = 'none';
            element.textContent = ' Show Less';
        } else {
            full.style.display = 'none';
            preview.style.display = 'block';
            element.textContent = '... Read More';
        }
    }
}
</script>
<?= $this->endSection() ?>