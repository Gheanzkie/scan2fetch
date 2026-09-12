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

.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-light { background: rgba(108,140,255,0.08) !important; color: #2d2d4a !important; }

.sms-badge {
    background: rgba(255,183,77,0.15);
    border: 1px solid rgba(255,183,77,0.2);
    border-radius: 12px;
    padding: 4px 12px;
    font-size: 12px;
    color: #8a7a4a;
    display: inline-block;
}

.sms-badge i {
    color: var(--soft-orange);
}

.message-cell {
    max-width: 400px;
    word-wrap: break-word;
    white-space: normal;
}

.message-cell .message-text {
    font-size: 13px;
    color: #4a4a6a;
    line-height: 1.6;
    word-break: break-word;
}

.message-toggle {
    color: var(--soft-blue);
    cursor: pointer;
    font-size: 12px;
    font-weight: 600;
    text-decoration: underline;
}

.message-toggle:hover {
    color: var(--soft-purple);
}

.message-full {
    display: none;
}

.message-full.show {
    display: block;
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

.filter-section {
    background: rgba(255,255,255,0.6);
    border-radius: 18px;
    padding: 16px 20px 12px 20px;
    border: 1px solid rgba(108,140,255,0.12);
}

.filter-section .filter-label {
    font-size: 13px;
    font-weight: 600;
    color: #5a5a7a;
    margin-bottom: 6px;
    display: block;
}

.filter-section .filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: flex-end;
}

.filter-section .filter-item {
    flex: 1;
    min-width: 180px;
}

.filter-section .filter-item-sm {
    flex: 0 0 auto;
    min-width: 100px;
}

.form-control {
    border-radius: 12px !important;
    font-size: 14px !important;
    border: 2px solid rgba(160,160,180,0.15) !important;
    color: #2d2d4a !important;
    height: 42px !important;
}

.form-control:focus {
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(108,140,255,0.12) !important;
}

.btn-outline-secondary {
    border-color: rgba(160,160,180,0.2) !important;
    color: #7a7a9a !important;
    border-radius: 50px !important;
    font-weight: 700 !important;
}

.btn-outline-secondary:hover {
    background: rgba(108,140,255,0.08) !important;
    color: var(--soft-purple) !important;
}

.btn-outline-danger {
    border-radius: 50px !important;
    font-weight: 700 !important;
    font-size: 12px !important;
    padding: 6px 14px !important;
}

@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .content-header h1 { font-size: 1.5rem !important; }
    .table td, .table th { padding: 8px 4px !important; font-size: 11px !important; }
    .message-cell { max-width: 200px; }
    .filter-section .filter-item { min-width: 100% !important; flex: 1 1 100% !important; }
    .filter-section .filter-item-sm { min-width: 100% !important; flex: 1 1 100% !important; }
}

@media (max-width: 480px) {
    .message-cell { max-width: 150px; }
    .message-cell .message-text { font-size: 11px; }
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
 <li class="breadcrumb-item"><a href="<?= base_url('parents-logs') ?>">My Dashboard</a></li>
 <li class="breadcrumb-item active">SMS Notifications</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">
 <?php if(session()->getFlashdata('msg')): ?>
 <div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i><?= session()->getFlashdata('msg') ?></div>
 <?php endif; ?>
 <?php if(session()->getFlashdata('error')): ?>
 <div class="alert alert-danger"><i class="fas fa-exclamation-circle mr-2"></i><?= session()->getFlashdata('error') ?></div>
 <?php endif; ?>
 <div class="row">
 <div class="col-12">
 <div class="card">
 <div class="card-header pt-3 pb-2">
 <div class="d-flex justify-content-between align-items-center flex-wrap">
 <h5 class="mb-0">
 <i class="fas fa-list mr-2" style="color: var(--soft-blue);"></i>
                                    SMS Notification History
 <span class="badge" style="background: rgba(108,140,255,0.08); color: #2d2d4a; margin-left: 8px; font-weight: 700; font-size: 13px; padding: 6px 16px;" id="msgCount">
 <?= count($smsNotifications ?? []) ?> messages
 </span>
 </h5>
 <div class="mt-1 mt-md-0">
 <a href="<?= base_url('parents-notifications-clear') ?>" class="btn btn-outline-danger btn-sm"
                 onclick="return confirm('Delete ALL your SMS notifications? This cannot be undone.');">
 <i class="fas fa-trash-alt mr-1"></i> Delete All
 </a>
 </div>
 </div>
 </div>
 <div class="card-body p-0 pt-3">
 <div style="padding: 0 20px 16px 20px;">
 <div class="filter-section">
 <div class="filter-row">
 <div class="filter-item">
 <label class="filter-label"> Search</label>
 <input type="text" id="searchFilter" class="form-control form-control-sm" placeholder="Search student, phone or message...">
 </div>
 <div class="filter-item-sm">
 <label class="filter-label"> Date</label>
 <input type="date" id="dateFilter" class="form-control form-control-sm">
 </div>
 <div class="filter-item-sm">
 <label class="filter-label">&nbsp;</label>
 <button class="btn btn-outline-secondary btn-sm" id="resetFilterBtn" style="width:100%;">
 <i class="fas fa-times"></i> Clear
 </button>
 </div>
 </div>
 </div>
 </div>
 <div class="table-responsive">
 <table class="table table-hover mb-0">
 <thead class="bg-light">
 <tr>
 <th style="width:50px;">#</th>
 <th>Date/Time</th>
 <th> Student</th>
 <th> Message</th>
 <th> Status</th>
 <th style="width:90px;"> Action</th>
 </tr>
 </thead>
 <tbody>
 <?php if (!empty($smsNotifications)): $i = 1; foreach ($smsNotifications as $s): ?>
 <tr class="sms-row"
                    data-search="<?= esc(strtolower(($s['student_fname'] ?? '') . ' ' . ($s['student_lname'] ?? '') . ' ' . ($s['grade_section'] ?? '') . ' ' . ($s['parent_phone'] ?? '') . ' ' . ($s['message'] ?? ''))) ?>"
                    data-date="<?= date('Y-m-d', strtotime($s['sent_at'])) ?>">
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
 <td>
 <a href="<?= base_url('parents-notifications-delete/' . $s['id']) ?>" class="btn btn-outline-danger btn-sm"
                onclick="return confirm('Delete this SMS notification?' +
 '\n\nSent: ' + '<?= date('M d, Y h:i A', strtotime($s['sent_at'])) ?>' +
 '\nTo: ' + '<?= esc($s['parent_phone'] ?? '') ?>');">
 <i class="fas fa-trash-alt mr-1"></i> Delete
 </a>
 </td>
 </tr>
 <?php endforeach; else: ?>
 <tr>
 <td colspan="6" class="text-center py-5">
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

$(function() {
    function filterTable() {
        var searchVal = ($('#searchFilter').val() || '').toLowerCase();
        var dateVal = $('#dateFilter').val();
        var visibleCount = 0;

        $('.sms-row').each(function() {
            var search = $(this).data('search') || '';
            var date = $(this).data('date') || '';
            var matchSearch = searchVal === '' || search.indexOf(searchVal) > -1;
            var matchDate = dateVal === '' || date === dateVal;

            if (matchSearch && matchDate) {
                $(this).show();
                visibleCount++;
            } else {
                $(this).hide();
            }
        });

        $('#msgCount').text(visibleCount + ' message' + (visibleCount === 1 ? '' : 's'));
    }

    $('#searchFilter').on('keyup', filterTable);
    $('#dateFilter').on('change', filterTable);

    $('#resetFilterBtn').click(function() {
        $('#searchFilter').val('');
        $('#dateFilter').val('');
        filterTable();
    });

    filterTable();
});

var idleTime = 0;
var refreshInterval = 30000;

setInterval(function() {
    idleTime += 1000;
    if (idleTime >= refreshInterval && !document.querySelector(':focus')) {
        location.reload();
    }
}, 1000);

$(document).on('mousemove keypress click scroll', function() {
    idleTime = 0;
});
</script>
<?= $this->endSection() ?>