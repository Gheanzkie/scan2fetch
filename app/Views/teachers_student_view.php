<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #a8c0ff;
    --soft-purple: #3f2b96;
    --soft-pink: #f093fb;
    --soft-green: #81c784;
    --ink: #3d3d5c;
    --muted: #7a7a9a;
    --faint: #b0b0c8;
}

body {
    background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%) !important;
    color: var(--ink) !important;
}

.content-wrapper { background: transparent !important; position: relative; z-index: 1; }

.content-header h1 {
    color: var(--ink) !important;
    font-weight: 700 !important;
    font-size: 1.7rem !important;
}

.content-header h1 i {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.card {
    border-radius: 22px !important;
    border: 1px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.78) !important;
    box-shadow: 0 8px 30px rgba(63,43,150,0.05) !important;
    overflow: hidden !important;
}

.card-header {
    background: rgba(255,255,255,0.6) !important;
    border-bottom: 1px solid rgba(63,43,150,0.06) !important;
    padding: 1rem 1.5rem !important;
}

.card-header h5, .card-header h6 {
    color: var(--ink) !important;
    font-weight: 700 !important;
}

.card-body { padding: 1.5rem !important; }

.btn {
    border-radius: 50px !important;
    font-weight: 700 !important;
    padding: 8px 20px !important;
    font-size: 13px !important;
}

.btn-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(108,140,255,0.3) !important;
}

.btn-primary:hover { box-shadow: 0 8px 25px rgba(108,140,255,0.4) !important; color: #fff !important; }

.badge {
    font-weight: 700 !important;
    padding: 6px 16px !important;
    border-radius: 50px !important;
    font-size: 12px !important;
}

.badge-grade {
    background: linear-gradient(135deg, rgba(240,147,251,0.2), rgba(168,192,255,0.2)) !important;
    color: #5a5280 !important;
}

.badge-parent {
    background: rgba(79,172,254,0.15) !important;
    color: #2f6fd0 !important;
    font-size: 11px !important;
}

.breadcrumb { background: transparent !important; padding: 0 !important; }
.breadcrumb-item a { color: var(--muted) !important; font-weight: 600 !important; font-size: 13px !important; text-decoration: none !important; }
.breadcrumb-item a:hover { color: var(--soft-purple) !important; }
.breadcrumb-item.active { color: var(--ink) !important; font-weight: 700 !important; font-size: 13px !important; }
.breadcrumb-item + .breadcrumb-item::before { color: var(--faint) !important; content: "›" !important; }

.img-circle { border-radius: 50% !important; }

.info-label { color: var(--muted); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; }
.info-value { color: var(--ink); font-size: 14px; font-weight: 700; }

.history-row {
    background: rgba(255,255,255,0.55);
    border: 1px solid rgba(63,43,150,0.05);
    border-radius: 14px;
    transition: background 0.25s ease;
}

.history-row:hover {
    background: rgba(168,192,255,0.08);
}

@media (max-width: 768px) {
    .content-header h1 { font-size: 1.35rem !important; }
    .btn { font-size: 12px !important; padding: 6px 14px !important; }
}
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
 <li class="breadcrumb-item"><a href="<?= base_url('teachers-view/' . $teacherId) ?>">My Students</a></li>
 <li class="breadcrumb-item active">Details</li>
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
 <!-- Student Profile -->
 <div class="col-md-4">
 <div class="card">
 <div class="card-body text-center">
 <?php if (!empty($student['picture'])): ?>
 <img src="<?= base_url('uploads/students/' . $student['picture']) ?>" alt="Student Photo"
            style="width:130px;height:130px;margin:0 auto;border-radius:50%;object-fit:cover;border:4px solid #e2e8f0;box-shadow:0 1px 4px rgba(15,23,42,.12);background:#f1f5f9;cursor:pointer;"
            onclick="openImageViewer('<?= base_url('uploads/students/' . $student['picture']) ?>', '<?= esc($student['fname'] . ' ' . $student['lname']) ?>')">
 <?php else: ?>
 <div style="width:130px;height:130px;margin:0 auto;border-radius:50%;overflow:hidden;border:4px solid #e2e8f0;box-shadow:0 1px 4px rgba(15,23,42,.12);background:#f1f5f9;display:flex;align-items:center;justify-content:center;">
 <i class="fas fa-child" style="font-size:42px;color:#94a3b8;"></i>
 </div>
 <?php endif; ?>

 <h3 class="mt-3 mb-0" style="color: #0f172a;"><?= esc($student['fname']) ?> <?= esc($student['lname']) ?></h3>
 <?php if(!empty($student['mname'])): ?>
 <p class="mb-0" style="color: var(--muted);"><?= esc($student['mname']) ?></p>
 <?php endif; ?>
 <span class="badge badge-grade mt-2">
 <i class="fas fa-book mr-1"></i><?= esc($student['grade_section']) ?>
 </span>

 <div class="mt-3 text-left">
 <div class="mb-2">
 <div class="info-label">Date Enrolled</div>
 <div class="info-value"><i class="fas fa-calendar mr-1" style="color: var(--soft-blue);"></i><?= date('M d, Y', strtotime($student['created_at'])) ?></div>
 </div>
 </div>

 <div class="mt-3">
 <a href="<?= base_url('teachers-view/' . $teacherId) ?>" class="btn btn-primary btn-sm px-4">
 <i class="fas fa-arrow-left mr-1"></i> Back to My Students
 </a>
 </div>
 </div>
 </div>
 </div>

 <!-- Details -->
 <div class="col-md-8">
 <!-- Parents -->
 <div class="card mb-3">
 <div class="card-header">
 <h6 class="mb-0">
 <i class="fas fa-user-check mr-2" style="color: var(--soft-blue);"></i>Parents / Guardians (<?= count($parents) ?>)
 </h6>
 </div>
 <div class="card-body">
 <?php if(!empty($parents)): ?>
 <?php foreach($parents as $p): ?>
 <div class="d-flex align-items-center p-3 mb-2" style="border: 1px solid rgba(63,43,150,0.06); border-radius: 14px;">
 <div class="mr-3">
 <?php if(!empty($p['picture'])): ?>
 <img src="<?= base_url('uploads/parents/' . $p['picture']) ?>" class="img-circle" style="width:55px;height:55px;object-fit:cover;border:3px solid #e2e8f0;cursor:pointer;"
              onclick="openImageViewer('<?= base_url('uploads/parents/' . $p['picture']) ?>', '<?= esc($p['fname'] . ' ' . $p['lname']) ?>')">
 <?php else: ?>
 <div class="img-circle d-flex align-items-center justify-content-center" style="width:55px;height:55px;border:3px solid #e2e8f0;background:#f1f5f9;">
 <i class="fas fa-user" style="color: #94a3b8;"></i>
 </div>
 <?php endif; ?>
 </div>
 <div class="flex-grow-1">
 <strong style="color: #2d2d4a;"><?= esc($p['fname']) ?> <?= esc($p['lname']) ?></strong>
 <br><small style="color: #b0b0c8;"><?= esc($p['relation'] ?? 'Parent') ?></small>
 <br><small style="color: #b0b0c8;"><i class="fas fa-phone mr-1"></i><?= esc($p['phone']) ?></small>
 </div>
 <?php if(!empty($p['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" style="width:45px;height:45px;border:2px solid #e2e8f0;border-radius:8px;cursor:pointer;"
              onclick="openQrModal('<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>', '<?= esc($p['fname']) ?>')">
 <?php endif; ?>
 </div>
 <?php endforeach; ?>
 <?php else: ?>
 <p class="text-center py-3 mb-0" style="color: var(--faint);">No parent linked yet</p>
 <?php endif; ?>
 </div>
 </div>

 <!-- Sub-Fetchers -->
 <div class="card mb-3">
 <div class="card-header">
 <h6 class="mb-0">
 <i class="fas fa-user-friends mr-2" style="color: var(--soft-green);"></i>Sub-Fetchers (<?= count($subFetchers) ?>)
 </h6>
 </div>
 <div class="card-body">
 <?php if(!empty($subFetchers)): ?>
 <?php foreach($subFetchers as $f): ?>
 <div class="d-flex align-items-center p-3 mb-2" style="border: 1px solid rgba(63,43,150,0.06); border-radius: 14px; border-left: 3px solid var(--soft-green);">
 <div class="mr-3">
 <?php if(!empty($f['picture'])): ?>
 <img src="<?= base_url('uploads/parents/' . $f['picture']) ?>" class="img-circle" style="width:50px;height:50px;object-fit:cover;border:2px solid var(--soft-green);cursor:pointer;"
              onclick="openImageViewer('<?= base_url('uploads/parents/' . $f['picture']) ?>', '<?= esc($f['fname'] . ' ' . $f['lname']) ?>')">
 <?php else: ?>
 <div class="img-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;border:2px solid var(--soft-green);background:#f1f5f9;">
 <i class="fas fa-user" style="color: #94a3b8;"></i>
 </div>
 <?php endif; ?>
 </div>
 <div class="flex-grow-1">
 <strong style="color: #2d2d4a;"><?= esc($f['fname']) ?> <?= esc($f['lname']) ?></strong>
 <br><small style="color: #b0b0c8;"><i class="fas fa-phone mr-1"></i><?= esc($f['phone']) ?></small>
 </div>
 <?php if(!empty($f['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" style="width:40px;height:40px;border:2px solid var(--soft-green);border-radius:8px;cursor:pointer;"
              onclick="openQrModal('<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>', '<?= esc($f['fname']) ?>')">
 <?php endif; ?>
 </div>
 <?php endforeach; ?>
 <?php else: ?>
 <p class="text-center py-3 mb-0" style="color: var(--faint);">No sub-fetchers assigned</p>
 <?php endif; ?>
 </div>
 </div>

 <!-- Pickup History -->
 <div class="card">
 <div class="card-header">
 <h6 class="mb-0">
 <i class="fas fa-history mr-2" style="color: var(--soft-purple);"></i>Pickup History
 <small style="color: var(--faint); font-size: 12px;">&nbsp;Last 20 entries</small>
 </h6>
 </div>
 <div class="card-body">
 <?php if(!empty($pickupHistory)): ?>
 <?php foreach($pickupHistory as $ph): ?>
 <div class="d-flex align-items-center justify-content-between py-2 px-3 mb-2 history-row">
 <div class="d-flex align-items-center">
 <div style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-right:12px;<?= ($ph['method'] ?? '') == 'QR' ? 'background:rgba(129,199,132,0.12);' : 'background:rgba(255,183,77,0.12);' ?>">
 <i class="fas fa-<?= ($ph['method'] ?? '') == 'QR' ? 'check-circle' : 'file-alt' ?>" style="color: <?= ($ph['method'] ?? '') == 'QR' ? '#43a047' : '#f57c00' ?>;font-size:14px;"></i>
 </div>
 <div>
 <div style="font-size:13px; font-weight:700; color: var(--ink);">
 <?= esc(trim(($ph['fetcher_fname'] ?? '') . ' ' . ($ph['fetcher_lname'] ?? ''))) ?>
 </div>
 <div style="font-size:11px; color: var(--muted);">
 <?= esc($ph['fetcher_relation'] ?? 'Parent') ?>
 <?php if (!empty($ph['parent_fname'])): ?>
 <span style="color: var(--faint);"> | </span> <?= esc($ph['parent_fname']) ?> <?= esc($ph['parent_lname']) ?>
 <?php endif; ?>
 </div>
 </div>
 </div>
 <div class="text-right">
 <div style="font-size:12px; font-weight:700; color: var(--ink);">
 <?= date('M d, Y', strtotime($ph['time_released'])) ?>
 </div>
 <div style="font-size:11px; color: var(--muted);">
 <?= date('h:i A', strtotime($ph['time_released'])) ?>
 </div>
 <span class="badge badge-grade mt-1" style="font-size:10px; padding:3px 10px;"><?= esc($ph['method'] ?? '—') ?></span>
 </div>
 </div>
 <?php endforeach; ?>
 <?php else: ?>
 <div class="text-center py-4" style="color: var(--faint);">
 <i class="fas fa-history fa-2x mb-2 d-block" style="color: rgba(168,192,255,0.35);"></i>
 <p>No pickup history yet</p>
 </div>
 <?php endif; ?>
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
 <h5 class="modal-title"><i class="fas fa-qrcode mr-2" style="color: #4361ee;"></i><span id="qrModalTitle">QR Code</span></h5>
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>
 <div class="modal-body text-center" style="padding: 24px; background: #fff;">
 <img id="qrFullImage" src="" style="max-width:100%;max-height:60vh;padding:20px;">
 </div>
 <div class="modal-footer">
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
 <h5 class="modal-title"><i class="fas fa-image mr-2" style="color: #4361ee;"></i><span id="imageViewerTitle">Photo</span></h5>
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>
 <div class="modal-body text-center" style="padding: 20px; background: #fff;">
 <img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;">
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
 </div>
 </div>
 </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openQrModal(u, t) {
    if (!u) { alert('No QR code available.'); return; }
    $('#qrFullImage').attr('src', u);
    $('#qrModalTitle').text(t || 'QR Code');
    $('#qrModal').modal('show');
}

function openImageViewer(u, t) {
    if (!u) { alert('No photo available.'); return; }
    $('#imageViewerFull').attr('src', u);
    $('#imageViewerTitle').text(t || 'Photo');
    $('#imageViewerModal').modal('show');
}
</script>
<?= $this->endSection() ?>
