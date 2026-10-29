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
    transition: all 0.3s ease !important;
}

.card:hover { box-shadow: 0 16px 48px rgba(108,140,255,0.12) !important; }

.card-header {
    background: rgba(255,255,255,0.6) !important;
    border-bottom: 2px solid rgba(255,255,255,0.3) !important;
    padding: 1rem 1.5rem !important;
}

.card-header h5, .card-header h6 {
    color: #2d2d4a !important;
    font-weight: 700 !important;
}

.card-body { padding: 1.5rem !important; }

.btn {
    border-radius: 50px !important;
    font-weight: 700 !important;
    transition: all 0.3s ease !important;
    padding: 8px 20px !important;
    font-size: 13px !important;
}

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

.btn-outline-danger {
    border: 2px solid rgba(255,107,122,0.2) !important;
    color: #cc6a7a !important;
    background: transparent !important;
}

.btn-outline-danger:hover {
    background: rgba(255,107,122,0.08) !important;
    border-color: var(--soft-rose) !important;
    color: var(--soft-rose) !important;
}

.btn-xs { padding: 4px 12px !important; font-size: 11px !important; border-radius: 50px !important; }

.badge {
    font-weight: 700 !important;
    padding: 6px 16px !important;
    border-radius: 50px !important;
    font-size: 12px !important;
}

.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }

.alert {
    border-radius: 20px !important;
    padding: 16px 24px !important;
    font-size: 15px !important;
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

.img-circle { border-radius: 50% !important; transition: all 0.3s ease !important; }

/* ===== PICKUP HISTORY (activity-log layout) ===== */
.history-filter {
    background: rgba(255,255,255,0.7);
    border: 1px solid rgba(255,255,255,0.85);
    border-radius: 18px;
    padding: 16px 18px 14px;
    margin-bottom: 16px;
    box-shadow: 0 4px 18px rgba(108,140,255,0.06);
}
.history-filter .filter-row { display: flex; flex-wrap: wrap; gap: 14px; align-items: flex-end; }
.history-filter .filter-item { flex: 1 1 260px; min-width: 200px; }
.history-filter .filter-label {
    display: block; font-size: 11.5px; font-weight: 700; letter-spacing: .03em;
    text-transform: uppercase; color: #7a7a9a; margin-bottom: 7px;
}
.history-filter .form-control {
    height: 42px !important; border-radius: 11px !important; background: #fff !important;
    border: 1.5px solid rgba(108,140,255,0.14) !important; font-size: 13.5px !important;
    color: #2d2d4a !important; padding: 8px 14px !important;
}
.history-filter .form-control:focus {
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(108,140,255,0.12) !important;
}
.history-filter .btn { border-radius: 11px !important; padding: 9px 18px !important; font-size: 13px !important; }

.pickup-table thead th {
    background: rgba(108,140,255,0.08);
    color: #5a5280 !important;
    font-size: 11.5px !important;
    font-weight: 700 !important;
    letter-spacing: .03em;
    text-transform: uppercase;
    border-bottom: 1px solid rgba(108,140,255,0.12) !important;
    border-top: none !important;
    padding: 12px 14px !important;
    white-space: nowrap;
}
.pickup-table tbody td {
    padding: 12px 14px !important;
    font-size: 13px !important;
    vertical-align: middle !important;
    border-top: 1px solid rgba(108,140,255,0.06) !important;
}
.pickup-table tbody tr:hover { background: rgba(108,140,255,0.04) !important; }

.h-num { color: #b0b0c8 !important; font-weight: 700 !important; font-size: 12px !important; }
.h-date { font-weight: 700; color: #2d2d4a; white-space: nowrap; font-size: 13px; }
.h-time { font-size: 11.5px; color: #7a7a9a; font-weight: 500; }

.h-person { display: flex; align-items: center; gap: 12px; }
.h-avatar {
    width: 40px; height: 40px; flex: 0 0 40px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple));
    color: #fff; font-weight: 800; font-size: 13px; letter-spacing: .03em;
    box-shadow: 0 3px 10px rgba(108,140,255,0.25);
}
.h-avatar.off { background: rgba(160,160,180,0.18); color: #9a9ab8; box-shadow: none; }
.h-person-name { font-weight: 700; color: #2d2d4a; font-size: 13.5px; line-height: 1.2; }
.h-person-name.muted { color: #9a9ab8; font-weight: 600; }
.h-person-meta {
    font-size: 11.5px; color: #7a7a9a; margin-top: 3px;
    display: flex; flex-wrap: wrap; gap: 8px; align-items: center;
}
.h-person-meta .badge { font-size: 10px !important; padding: 3px 9px !important; border-radius: 50px !important; }
.h-guardian { font-size: 11px; color: #9a9ab8; margin-top: 2px; }

@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .content-header h1 { font-size: 1.5rem !important; }
}
/* ===== Avatars + Go to buttons (matches parents-view) ===== */
.mini-avatar{
    display:inline-flex;align-items:center;justify-content:center;
    width:55px;height:55px;border-radius:50%;overflow:hidden;
    border:3px solid var(--soft-blue);background:rgba(255,255,255,.55);
    color:#b0b0c8;font-size:22px;flex:0 0 auto;
    box-shadow:0 3px 10px rgba(108,140,255,.18);
}
.mini-avatar img{width:100%;height:100%;object-fit:cover;display:block;border-radius:50%;}
.photo-zoom{transition:transform .15s ease, box-shadow .15s ease;}
.photo-zoom:hover{transform:scale(1.05);box-shadow:0 6px 18px rgba(108,140,255,.35);}
.btn-go-student{
    display:inline-flex;align-items:center;gap:8px;
    padding:8px 16px;border-radius:10px;
    font-size:13px;font-weight:700;line-height:1;white-space:nowrap;
    color:#fff;text-decoration:none;
    background:linear-gradient(135deg,#6C8CFF 0%,#7C6CFF 100%);
    box-shadow:0 4px 12px rgba(108,140,255,.35);
    transition:transform .15s ease, box-shadow .15s ease, filter .15s ease;
}
.btn-go-student:hover{color:#fff;text-decoration:none;transform:translateY(-1px);
    box-shadow:0 8px 18px rgba(108,140,255,.45);filter:brightness(1.05);}
.btn-go-student:active{transform:translateY(0);}
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-user-graduate mr-2"></i>
                        Student Details
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item"><a href="<?= base_url('students') ?>">Students</a></li>
 <li class="breadcrumb-item active">Details</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">
 <?php if(session()->getFlashdata('msg')): ?>
 <div class="alert alert-success"> <?= session()->getFlashdata('msg') ?></div>
 <?php endif; ?>
 <?php if(session()->getFlashdata('error')): ?>
 <div class="alert alert-danger"> <?= session()->getFlashdata('error') ?></div>
 <?php endif; ?>

 <div class="row">
 <!-- Student Profile -->
 <div class="col-md-4">
 <div class="card">
 <div class="card-body text-center">
 <?php helper('photo'); $__sPhoto = student_photo_url((string) ($student['student_no'] ?? '')); ?>
 <div style="width:110px;height:110px;margin:0 auto;border-radius:50%;overflow:hidden;border:4px solid #e2e8f0;box-shadow:0 1px 4px rgba(15,23,42,.12);background:#f1f5f9;display:flex;align-items:center;justify-content:center;">
 <?php if ($__sPhoto): ?>
 <img src="<?= esc($__sPhoto) ?>" alt="Student picture" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
 <?php else: ?>
 <i class="fas fa-child fa-3x" style="color: #94a3b8;"></i>
 <?php endif; ?>
 </div>
 <h3 class="mt-3 mb-0" style="color: #0f172a;"><?= esc(full_name($student)) ?></h3>
 <?php if (!empty($student['student_no'])): ?>
 <p class="mb-1" style="color: #555577 !important; font-size: 14px; font-weight: 700;">
 <i class="fas fa-id-card mr-1" style="color: var(--soft-blue);"></i> Student ID: <span style="font-family: ui-monospace, monospace;"><?= esc($student['student_no']) ?></span>
 </p>
 <?php endif; ?>
 <p class="text-muted mb-0" style="color: #8888aa !important;"><?= esc($student['grade_section']) ?></p>
 <?php if (!empty($adviser)): ?>
 <p class="mb-0" style="color: #555577 !important; font-size: 14px;">
 <i class="fas fa-chalkboard-teacher mr-1" style="color: var(--soft-blue);"></i>
 <strong>Adviser:</strong> <?= esc(full_name($adviser)) ?>
 <span style="color:#b0b0c8;">(<?= esc($adviser['grade_section'] ?? '') ?>)</span>
 </p>
 <?php endif; ?>
 <p class="text-muted small mb-0" style="color: #b0b0c8 !important;"><i class="fas fa-calendar mr-1"></i> <?= date('M d, Y', strtotime($student['created_at'])) ?></p>
 </div>
 </div>
 </div>

 <!-- Parents & Sub-Fetchers -->
 <div class="col-md-8">
                    
 <!-- Main Parent -->
 <div class="card mb-3">
 <div class="card-header d-flex justify-content-between align-items-center">
 <h6 class="mb-0"><i class="fas fa-user-check mr-2" style="color: var(--soft-blue);"></i>Main Parent / Guardian</h6>
 </div>
 <div class="card-body">
 <?php if(!empty($parents)): ?>
 <?php foreach($parents as $p): ?>
 <div class="d-flex align-items-center border rounded p-3 mb-2" style="border-color: rgba(108,140,255,0.08) !important;">
 <div class="mr-3">
 <?php $__pp = parent_photo_url((string) ($p['parent_no'] ?? '')); ?>
 <?php if ($__pp !== ''): ?>
 <span class="mini-avatar photo-zoom" style="cursor:zoom-in;" data-photo="<?= esc($__pp) ?>" data-title="<?= esc(full_name($p)) ?>">
 <img src="<?= esc($__pp) ?>" alt="<?= esc(full_name($p)) ?>">
 </span>
 <?php else: ?>
 <?php endif; ?>
 </div>
 <div class="flex-grow-1">
 <strong style="color: #2d2d4a;"><?= esc(full_name($p)) ?></strong>
 <br><small style="color: #b0b0c8;"><?= esc($p['relation'] ?? 'Parent') ?> | <?= esc($p['phone']) ?></small>
 </div>
 <?php if(!empty($p['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" style="width:50px;height:50px;border:2px solid var(--soft-blue);border-radius:8px;cursor:pointer;margin-right:5px;" onclick="openQrModal('<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>')">
 <?php endif; ?>
 <a href="<?= base_url('parents-view/'.$p['parent_id']) ?>" class="btn-go-student ml-2" title="Open parent profile">
 <i class="fas fa-arrow-right"></i><span>Go to Parent</span>
 </a>
 </div>
 <?php endforeach; ?>
 <?php else: ?>
 <p class="text-center text-muted small py-3 mb-0" style="color: #b0b0c8 !important;">No parent linked yet</p>
 <?php endif; ?>
 </div>
 </div>

 <!-- Sub-Fetchers -->
 <div class="card">
 <div class="card-header d-flex justify-content-between align-items-center">
 <h6 class="mb-0"><i class="fas fa-user-friends mr-2" style="color: var(--soft-green);"></i>Sub-Fetchers (<?= count($subFetchers ?? []) ?>)</h6>
 </div>
 <div class="card-body">
 <?php if(!empty($subFetchers)): ?>
 <?php foreach($subFetchers as $f): ?>
 <div class="d-flex align-items-center border rounded p-3 mb-2" style="border-color: rgba(108,140,255,0.08) !important; border-left: 3px solid var(--soft-green) !important;">
 <div class="mr-3">
 <?php $__fp = subfetcher_photo_url($f['id'] ?? 0); ?>
 <?php if ($__fp !== ''): ?>
 <span class="mini-avatar photo-zoom" style="cursor:zoom-in;border-color:var(--soft-green);"
       data-photo="<?= esc($__fp) ?>" data-title="<?= esc(full_name($f)) ?>">
 <img src="<?= esc($__fp) ?>" alt="<?= esc(full_name($f)) ?>">
 </span>
 <?php else: ?>
 <?php endif; ?>
 </div>
 <div class="flex-grow-1">
 <strong style="color: #2d2d4a;"><?= esc(full_name($f)) ?></strong>
 <br><small style="color: #b0b0c8;">Fetcher | <?= esc($f['phone']) ?></small>
 </div>
 <?php if(!empty($f['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" style="width:45px;height:45px;border:2px solid var(--soft-green);border-radius:8px;cursor:pointer;" onclick="openQrModal('<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>')">
 <?php endif; ?>
 <a href="<?= base_url('parents-view/'.$f['parent_id']) ?>" class="btn-go-student ml-2" title="Open parent profile">
 <i class="fas fa-arrow-right"></i><span>Go to Parent</span>
 </a>
 </div>
 <?php endforeach; ?>
 <?php else: ?>
 <p class="text-center text-muted small py-3 mb-0" style="color: #b0b0c8 !important;">No sub-fetchers assigned</p>
 <?php endif; ?>
 </div>
 </div>

 </div>
 </div>

 <!-- ===== PICKUP HISTORY (activity-log layout) ===== -->
 <div class="row mt-3">
 <div class="col-12">

 <div class="history-filter">
 <form method="get" action="<?= base_url('students-view/'.$student['id']) ?>">
 <div class="filter-row">
 <div class="filter-item">
 <label class="filter-label"><i class="fas fa-search mr-1"></i> Search</label>
 <input type="text" name="q" class="form-control form-control-sm"
        placeholder="Search fetcher, guardian, session, method or staff..."
        value="<?= esc($search ?? '') ?>">
 </div>
 <div class="filter-item" style="flex:0 0 230px;">
 <label class="filter-label"><i class="fas fa-calendar-day mr-1"></i> Date</label>
 <input type="date" name="date" class="form-control form-control-sm" value="<?= esc($selectedDate ?? '') ?>">
 </div>
 <div class="filter-item" style="flex:0 0 auto;">
 <label class="filter-label">&nbsp;</label>
 <div style="display:flex; gap:8px;">
 <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter mr-1"></i> Apply</button>
 <a href="<?= base_url('students-view/'.$student['id']) ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-times mr-1"></i> Reset</a>
 </div>
 </div>
 </div>
 </form>
 </div>

 <div class="card">
 <div class="card-header pt-3 pb-2">
 <div class="d-flex justify-content-between align-items-center flex-wrap">
 <h5 class="mb-0">
 <i class="fas fa-history mr-2" style="color: var(--soft-blue);"></i>Pickup History
 <span class="badge" style="background: rgba(160,160,180,0.1); color: #7a7a9a; margin-left: 8px; font-weight: 600; font-size: 12px; padding: 6px 14px;"><?= count($historyRows ?? []) ?></span>
 </h5>
 <?php if (!empty($historyRows)): ?>
 <div style="font-size: 12px; color: #7a7a9a;">
 <i class="fas fa-arrow-down"></i> Latest pickup first
 </div>
 <?php endif; ?>
 </div>
 </div>
 <div class="card-body p-0">
 <div class="table-responsive">
 <table class="table table-hover mb-0 pickup-table">
 <thead>
 <tr>
 <th style="width:45px;">#</th>
 <th style="width:165px;">Date / Time</th>
 <th style="width:115px;">Session</th>
 <th>Fetched By</th>
 <th style="width:105px;">Method</th>
 </tr>
 </thead>
 <tbody>
 <?php if (!empty($historyRows)): $hi = 1; foreach ($historyRows as $h): ?>
 <?php
   $fetcherName = $h['fetcher'] ?? '';
   $parts = preg_split('/\s+/', trim((string) $fetcherName));
   $initials = strtoupper(mb_substr($parts[0] ?? '', 0, 1) . mb_substr($parts[1] ?? '', 0, 1));
 ?>
 <tr>
 <td class="h-num"><?= $hi++ ?></td>
 <td>
 <div class="h-date"><?= date('M d, Y', strtotime($h['date'])) ?></div>
 <div class="h-time"><?= esc($h['time']) ?></div>
 </td>
 <td>
 <?php if (($h['session'] ?? '') === 'morning'): ?>
 <span class="badge" style="background:rgba(255,183,77,0.22);color:#8a6420;"><i class="fas fa-sun mr-1"></i>Morning</span>
 <?php elseif (($h['session'] ?? '') === 'afternoon'): ?>
 <span class="badge" style="background:rgba(108,140,255,0.18);color:#3b4a9e;"><i class="fas fa-cloud-sun mr-1"></i>Afternoon</span>
 <?php else: ?>
 <span class="badge" style="background:rgba(160,160,180,0.12);color:#7a7a9a;"><?= esc(ucfirst((string) ($h['session'] ?? 'unspecified'))) ?></span>
 <?php endif; ?>
 </td>
 <td>
 <div class="h-person">
 <?php if (!empty($h['fetcher_photo'])): ?>
 <div class="h-avatar" style="padding:0;overflow:hidden;background:transparent;">
 <img src="<?= esc($h['fetcher_photo']) ?>" alt="<?= esc($fetcherName) ?>" style="width:100%;height:100%;object-fit:cover;border-radius:50%;cursor:zoom-in;"
 onclick="openImageViewer('<?= esc($h['fetcher_photo']) ?>','<?= esc($fetcherName) ?>')">
 </div>
 <?php else: ?>
 <div class="h-avatar"><?= esc($initials ?: '?') ?></div>
 <?php endif; ?>
 <div>
 <div class="h-person-name"><?= esc($fetcherName ?: 'Unnamed fetcher') ?></div>
 <div class="h-person-meta">
 <span class="badge" style="background:rgba(108,140,255,0.14);color:#3b4a9e;"><?= esc($h['relation'] ?: 'Fetcher') ?></span>
 <?php if (!empty($h['guardian_phone'])): ?>
 <span><i class="fas fa-phone" style="color:#9a9ab8;"></i> <?= esc($h['guardian_phone']) ?></span>
 <?php endif; ?>
 <?php if (!empty($h['guardian_no'])): ?>
 <span><i class="fas fa-id-card" style="color:#9a9ab8;"></i> <?= esc($h['guardian_no']) ?></span>
 <?php endif; ?>
 </div>
 <?php if (!empty($h['guardian']) && strcasecmp($h['guardian'], $fetcherName) !== 0): ?>
 <div class="h-guardian">Guardian account: <?= esc($h['guardian']) ?></div>
 <?php endif; ?>
 </div>
 </div>
 </td>
 <td>
 <?php if (!empty($h['method'])): ?>
 <span class="badge" style="background:rgba(160,160,180,0.12);color:#5a5a7a;"><?= esc($h['method']) ?></span>
 <?php else: ?>
 <span class="h-time">—</span>
 <?php endif; ?>
 </td>
 </tr>
 <?php endforeach; ?>
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

<!-- QR Modal -->
<div class="modal fade" id="qrModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content">
 <div class="modal-header">
 <h5><i class="fas fa-qrcode mr-2" style="color: var(--soft-blue);"></i>QR Code</h5>
 <button type="button" class="close" data-dismiss="modal" style="color: #2d2d4a;">&times;</button>
 </div>
 <div class="modal-body text-center" style="background: #fff; border-radius: 0 0 25px 25px; padding: 30px;">
 <img id="qrFullImage" src="" style="max-width:100%;max-height:65vh;">
 </div>
 <div class="modal-footer">
 <a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a>
 <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
 </div>
 </div>
 </div>
</div>

<!-- Image Viewer Modal -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content">
 <div class="modal-header">
 <h5><i class="fas fa-image mr-2" style="color: var(--soft-blue);"></i><span id="imageViewerTitle">Photo</span></h5>
 <button type="button" class="close" data-dismiss="modal" style="color: #2d2d4a;">&times;</button>
 </div>
 <div class="modal-body text-center" style="background: #fff; border-radius: 0 0 25px 25px; padding: 20px;">
 <img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh; border-radius: 15px;">
 </div>
 <div class="modal-footer">
 <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a>
 <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
 </div>
 </div>
 </div>
</div>


<script>
document.addEventListener('click', function (e) {
    var z = e.target.closest ? e.target.closest('.photo-zoom') : null;
    if (!z) { return; }
    e.preventDefault(); e.stopPropagation();
    var src = z.getAttribute('data-photo');
    if (!src) { return; }
    if (typeof window.openGlobalPhoto === 'function') {
        window.openGlobalPhoto(src, z.getAttribute('data-title'));
    } else {
        window.open(src, '_blank');
    }
});
</script>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openImageViewer(u, t) {
    if (!u) { alert(' No photo available. '); return; }
    $('#imageViewerFull').attr('src', u);
    $('#imageDownloadBtn').attr('href', u);
    $('#imageDownloadBtn').attr('download', t.replace(/\s+/g, '_') + '.png');
    $('#imageViewerTitle').text(' ' + (t || 'Photo'));
    $('#imageViewerModal').modal('show');
}

function openQrModal(u) {
    if (!u) { alert(' No QR code available. '); return; }
    $('#qrFullImage').attr('src', u);
    $('#qrDownloadBtn').attr('href', u);
    $('#qrModal').modal('show');
}
</script>

<script>
document.addEventListener('click', function (e) {
    var z = e.target.closest ? e.target.closest('.photo-zoom') : null;
    if (!z) { return; }
    e.preventDefault(); e.stopPropagation();
    var src = z.getAttribute('data-photo');
    if (!src) { return; }
    if (typeof window.openGlobalPhoto === 'function') {
        window.openGlobalPhoto(src, z.getAttribute('data-title'));
    } else {
        window.open(src, '_blank');
    }
});
</script>
<?= $this->endSection() ?>