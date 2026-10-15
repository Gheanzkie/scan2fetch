<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #6C8CFF;
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
}

.sf-card {
    background: #fff;
    border: 1px solid #eef0f6;
    border-radius: 18px;
    padding: 1rem;
    height: 100%;
    transition: transform .15s ease, box-shadow .15s ease;
}
.sf-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(245,166,35,0.15); }

.qr-thumb {
    width: 80px; height: 80px; border: 1px solid #e2e8f0;
    border-radius: 10px; background: #fff; cursor: zoom-in;
}
.qr-thumb:hover { border-color: var(--soft-blue); box-shadow: 0 4px 12px rgba(108,140,255,0.15); }
</style>

<div class="content-wrapper" style="position: relative; z-index: 1;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1><i class="fas fa-user-friends mr-2" style="color: var(--soft-amber);"></i> Sub-Fetchers</h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item active">Sub-Fetchers</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">

 <div class="card">
 <div class="card-header pt-3 pb-2">
 <h5 class="mb-0">
 <i class="fas fa-user-friends mr-2" style="color: var(--soft-amber);"></i>
 My Sub-Fetchers
 <span class="badge ml-2" style="background:rgba(245,166,35,0.12);color:#92400e;font-weight:700;">
 <?= count($subFetchers ?? []) ?> fetcher(s)
 </span>
 </h5>
 </div>
 <div class="card-body">

 <!-- ===== INFO: adding sub-fetchers is done by the school admin ===== -->
 <div class="alert d-flex align-items-start" style="gap:.75rem;border-radius:14px;border:1px solid #fcd34d;background:#fffbeb;color:#92400e;font-size:13.5px;">
 <i class="fas fa-info-circle mt-1" style="font-size:1.1rem;color:#f59e0b;"></i>
 <div>
 <strong style="display:block;margin-bottom:.15rem;">Want to add a sub-fetcher?</strong>
 Sub-fetchers can only be added by the school admin. Please go to the school admin office (or use
 <a href="<?= base_url('messages') ?>" style="color:#b45309;font-weight:700;">Contact Admin</a>)
 with your name and the person you want to authorize — they will create the account and QR code for you.
 </div>
 </div>

 <?php if (!empty($subFetchers)): ?>
 <p style="color:#64748b;font-size:13px;margin-top:-.5rem;">
 These people can pick up your child on your behalf. They scan their own QR at the school gate — tap a QR to enlarge or save it.
 </p>
 <div class="row">
 <?php foreach ($subFetchers as $sf): ?>
 <div class="col-md-6 col-xl-4 mb-3">
 <div class="sf-card d-flex align-items-center" style="gap:.9rem;">
 <?php if (!empty($sf['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$sf['qr_code'].'.png') ?>" alt="QR"
 class="qr-thumb"
 onclick="openQrModal('<?= base_url('uploads/qr/'.$sf['qr_code'].'.png') ?>','<?= esc(trim(($sf['fname'] ?? '').' '.($sf['lname'] ?? ''))) ?>')">
 <?php else: ?>
 <div class="qr-thumb d-flex align-items-center justify-content-center" style="color:#cbd5e1;"><i class="fas fa-qrcode fa-2x"></i></div>
 <?php endif; ?>
 <div style="flex:1;min-width:0;">
 <strong style="display:block;font-size:1rem;"><?= esc(trim(($sf['fname'] ?? '').' '.($sf['mname'] ?? '').' '.($sf['lname'] ?? ''))) ?></strong>
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
