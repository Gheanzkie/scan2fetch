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

@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .content-header h1 { font-size: 1.5rem !important; }
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
 <div style="width:130px;height:130px;margin:0 auto;border-radius:50%;overflow:hidden;border:4px solid #e2e8f0;cursor:pointer;box-shadow:0 1px 4px rgba(15,23,42,.12);" onclick="openImageViewer('<?= !empty($student['picture']) ? base_url('uploads/students/' . $student['picture']) : '' ?>', '<?= esc($student['fname'] . ' ' . $student['lname']) ?>')">
 <?php if (!empty($student['picture'])): ?>
 <img src="<?= base_url('uploads/students/' . $student['picture']) ?>" style="width:100%;height:100%;object-fit:cover;">
 <?php else: ?>
 <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f1f5f9;"><i class="fas fa-child fa-3x" style="color: #94a3b8;"></i></div>
 <?php endif; ?>
 </div>
 <h3 class="mt-3 mb-0" style="color: #0f172a;"><?= esc($student['fname']) ?> <?= esc($student['lname']) ?></h3>
 <p class="text-muted mb-0" style="color: #8888aa !important;"><?= esc($student['grade_section']) ?></p>
 <p class="text-muted small" style="color: #b0b0c8 !important;"><i class="fas fa-calendar mr-1"></i> <?= date('M d, Y', strtotime($student['created_at'])) ?></p>
 <div class="mt-3">
 <a href="<?= base_url('students-edit/' . $student['id']) ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i> Edit</a>
 <a href="<?= base_url('students-delete/' . $student['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this student?')"><i class="fas fa-trash"></i> Delete</a>
 </div>
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
 <div class="mr-3" style="cursor:pointer;" onclick="openImageViewer('<?= !empty($p['picture']) ? base_url('uploads/parents/' . $p['picture']) : '' ?>', '<?= esc($p['fname'] . ' ' . $p['lname']) ?>')">
 <?php if(!empty($p['picture'])): ?>
 <img src="<?= base_url('uploads/parents/' . $p['picture']) ?>" class="img-circle" style="width:55px;height:55px;object-fit:cover;border:3px solid var(--soft-blue);">
 <?php else: ?>
 <div class="img-circle d-flex align-items-center justify-content-center" style="width:55px;height:55px;border:3px solid var(--soft-blue);background:rgba(255,255,255,0.3);"><i class="fas fa-user" style="color: #b0b0c8;"></i></div>
 <?php endif; ?>
 </div>
 <div class="flex-grow-1">
 <strong style="color: #2d2d4a;"><?= esc($p['fname']) ?> <?= esc($p['lname']) ?></strong>
 <br><small style="color: #b0b0c8;"><?= esc($p['relation'] ?? 'Parent') ?> | <?= esc($p['phone']) ?></small>
 </div>
 <?php if(!empty($p['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" style="width:50px;height:50px;border:2px solid var(--soft-blue);border-radius:8px;cursor:pointer;margin-right:5px;" onclick="openQrModal('<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>')">
 <?php endif; ?>
 <a href="<?= base_url('parents-view/'.$p['parent_id']) ?>" class="btn btn-outline-secondary btn-xs ml-1" title="Go to Parent">
 <i class="fas fa-user-check"></i> Go to Parent
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
 <div class="mr-3" style="cursor:pointer;" onclick="openImageViewer('<?= !empty($f['picture']) ? base_url('uploads/parents/' . $f['picture']) : '' ?>', '<?= esc($f['fname'] . ' ' . $f['lname']) ?>')">
 <?php if(!empty($f['picture'])): ?>
 <img src="<?= base_url('uploads/parents/' . $f['picture']) ?>" class="img-circle" style="width:50px;height:50px;object-fit:cover;border:2px solid var(--soft-green);">
 <?php else: ?>
 <div class="img-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;border:2px solid var(--soft-green);background:rgba(255,255,255,0.3);"><i class="fas fa-user" style="color: #b0b0c8;"></i></div>
 <?php endif; ?>
 </div>
 <div class="flex-grow-1">
 <strong style="color: #2d2d4a;"><?= esc($f['fname']) ?> <?= esc($f['lname']) ?></strong>
 <br><small style="color: #b0b0c8;">Fetcher | <?= esc($f['phone']) ?></small>
 </div>
 <?php if(!empty($f['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" style="width:45px;height:45px;border:2px solid var(--soft-green);border-radius:8px;cursor:pointer;margin-right:5px;" onclick="openQrModal('<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>')">
 <?php endif; ?>
 <a href="<?= base_url('parents-view/'.$f['parent_id']) ?>" class="btn btn-outline-secondary btn-xs ml-1" title="Go to Fetcher">
 <i class="fas fa-user-friends"></i> Go to Fetcher
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
<?= $this->endSection() ?>