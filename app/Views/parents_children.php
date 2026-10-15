<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #6C8CFF;
    --soft-green: #66BB6A;
    --soft-amber: #F5A623;
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
    margin-bottom: 1.5rem;
}

.card-header h5 { color: #2d2d4a; }

.child-card {
    background: #fff;
    border: 1px solid #eef0f6;
    border-radius: 18px;
    padding: 1rem;
    height: 100%;
    transition: transform .15s ease, box-shadow .15s ease;
}
.child-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(108,140,255,0.12); }

.child-avatar {
    width: 52px; height: 52px; border-radius: 50%;
    background: #eef2ff; color: #4338ca;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 1.1rem; flex-shrink: 0;
}

.qr-thumb {
    width: 72px; height: 72px; border: 1px solid #e2e8f0;
    border-radius: 10px; background: #fff; cursor: zoom-in;
}
.qr-thumb:hover { border-color: var(--soft-blue); box-shadow: 0 4px 12px rgba(108,140,255,0.15); }

.badge-released { background: #dcfce7; color: #166534; font-size: 12px; }
.badge-pending  { background: #ffedd5; color: #9a3412; font-size: 12px; }
</style>

<div class="content-wrapper" style="position: relative; z-index: 1;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1><i class="fas fa-child mr-2" style="color: var(--soft-blue);"></i> My Children</h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item active">My Children</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">

 <!-- ===== CHILDREN LIST ===== -->
 <div class="card">
 <div class="card-header pt-3 pb-2">
 <h5 class="mb-0">
 <i class="fas fa-users mr-2" style="color: var(--soft-blue);"></i>
 My Children
 <span class="badge ml-2" style="background:rgba(108,140,255,0.1);color:#2d2d4a;font-weight:700;">
 <?= count($myChildren ?? []) ?> child/children
 </span>
 </h5>
 </div>
 <div class="card-body">
 <?php if (!empty($myChildren)): ?>
 <div class="row">
 <?php foreach ($myChildren as $c): ?>
 <div class="col-md-6 col-xl-4 mb-3">
 <div class="child-card d-flex" style="gap:.9rem;">
 <div class="child-avatar">
 <?= strtoupper(mb_substr($c['fname'] ?? '',0,1)) ?><?= strtoupper(mb_substr($c['lname'] ?? '',0,1)) ?>
 </div>
 <div style="flex:1;min-width:0;">
 <strong style="display:block;font-size:1rem;"><?= esc(trim(($c['fname'] ?? '').' '.($c['mname'] ?? '').' '.($c['lname'] ?? ''))) ?></strong>
 <small style="color:#64748b;display:block;"><i class="fas fa-school mr-1"></i><?= esc($c['grade_section'] ?? '-') ?></small>
 <?php if (!empty($c['teacher'])): ?>
 <small style="color:#64748b;display:block;"><i class="fas fa-chalkboard-teacher mr-1"></i>Adviser: <?= esc($c['teacher']) ?></small>
 <?php endif; ?>
 <?php if (!empty($c['relation'])): ?>
 <small style="color:#94a3b8;display:block;"><i class="fas fa-link mr-1"></i><?= esc($c['relation']) ?></small>
 <?php endif; ?>
 <div style="margin-top:.5rem;">
 <?php if (!empty($c['release_today'])): ?>
 <span class="badge badge-released px-2 py-1"><i class="fas fa-check mr-1"></i>Released <?= date('h:i A', strtotime($c['release_today'])) ?></span>
 <?php else: ?>
 <span class="badge badge-pending px-2 py-1"><i class="fas fa-clock mr-1"></i>Not yet picked up</span>
 <?php endif; ?>
 </div>
 </div>
 </div>
 </div>
 <?php endforeach; ?>
 </div>
 <?php else: ?>
 <p class="mb-0" style="color:#94a3b8;">No linked children yet — contact the school admin to link your child.</p>
 <?php endif; ?>
 </div>
 </div>

 <!-- ===== SUB-FETCHERS ===== -->
 <div class="card" id="subfetchers">
 <div class="card-header pt-3 pb-2">
 <h5 class="mb-0">
 <i class="fas fa-user-friends mr-2" style="color: var(--soft-amber);"></i>
 Sub-Fetchers
 <span class="badge ml-2" style="background:rgba(245,166,35,0.12);color:#92400e;font-weight:700;">
 <?= count($subFetchers ?? []) ?> fetcher(s)
 </span>
 </h5>
 </div>
 <div class="card-body">
 <?php if (!empty($subFetchers)): ?>
 <div class="row">
 <?php foreach ($subFetchers as $sf): ?>
 <div class="col-md-6 col-xl-4 mb-3">
 <div class="child-card d-flex align-items-center" style="gap:.9rem;">
 <?php if (!empty($sf['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$sf['qr_code'].'.png') ?>" alt="QR"
 class="qr-thumb"
 onclick="openQrModal('<?= base_url('uploads/qr/'.$sf['qr_code'].'.png') ?>','<?= esc(trim(($sf['fname'] ?? '').' '.($sf['lname'] ?? ''))) ?>')">
 <?php else: ?>
 <div class="qr-thumb d-flex align-items-center justify-content-center" style="color:#cbd5e1;"><i class="fas fa-qrcode fa-2x"></i></div>
 <?php endif; ?>
 <div style="flex:1;min-width:0;">
 <strong style="display:block;"><?= esc(trim(($sf['fname'] ?? '').' '.($sf['mname'] ?? '').' '.($sf['lname'] ?? ''))) ?></strong>
 <small style="color:#64748b;display:block;"><i class="fas fa-phone mr-1"></i><?= esc($sf['phone'] ?? '-') ?></small>
 <?php if (!empty($sf['qr_code'])): ?>
 <small style="color:#94a3b8;display:block;"><?= esc($sf['qr_code']) ?></small>
 <?php endif; ?>
 </div>
 </div>
 </div>
 <?php endforeach; ?>
 </div>
 <?php else: ?>
 <p class="mb-0" style="color:#94a3b8;">No sub-fetchers yet. Ask the school admin to add someone who can pick up on your behalf.</p>
 <?php endif; ?>
 </div>
 </div>

 </div>
 </section>
</div>

<!-- ===== QR MODAL ===== -->
<div class="modal fade" id="qrModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content" style="border-radius:20px;">
 <div class="modal-header">
 <h5 class="modal-title"><i class="fas fa-qrcode mr-2" style="color: var(--soft-blue);"></i>QR Code</h5>
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>
 <div class="text-center">
 <img id="qrFullImage" src="" style="max-width:100%;max-height:60vh;padding:20px;">
 </div>
 <div class="modal-footer justify-content-center">
 <a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary btn-sm"><i class="fas fa-download mr-1"></i> Save</a>
 <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
 </div>
 </div>
 </div>
</div>

<script>
function openQrModal(u, t) {
    if (!u) { alert('No QR code available.'); return; }
    $('#qrFullImage').attr('src', u);
    $('#qrDownloadBtn').attr('href', u);
    $('#qrDownloadBtn').attr('download', (t || 'qr').replace(/\s+/g, '_') + '.png');
    $('#qrModalTitle').text(t || 'QR Code');
    $('#qrModal').modal('show');
}
</script>

<?= $this->endSection() ?>
