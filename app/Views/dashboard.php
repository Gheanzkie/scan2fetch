<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper" style="position: relative; z-index: 1;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="welcome-banner">
 <div class="row align-items-center">
 <div class="col-md-8">
 <h2>Welcome, <?= ucfirst(session('fname')) ?></h2>
 <p>
 <?php if (session('role') == 'admin'): ?>
                                Here's your school overview for today.
 <?php elseif (session('role') == 'staff'): ?>
                                Here's your overview for today.
 <?php elseif (session('role') == 'teacher'): ?>
                                Here's the status of your class today.
 <?php elseif (session('role') == 'parent'): ?>
                                Here's an update on your child's day.
 <?php endif; ?>
 </p>
 </div>
 <div class="col-md-4 text-right d-none d-md-block">
 <i class="fas fa-tachometer-alt" style="font-size: 3rem; color: #dbe4f0;"></i>
 </div>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">

  <!-- ==================== ADMIN DASHBOARD ==================== -->
 <?php if (session('role') == 'admin'): ?>
 <div class="row">
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-blue">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
 <span class="number"><?= $totalStudents ?? 0 ?></span>
 <span class="label">Students</span>
 </div>
 </div>
 </div>
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-green">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
 <span class="number"><?= $releasedToday ?? 0 ?></span>
 <span class="label">Released Today</span>
 </div>
 </div>
 </div>
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-yellow">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-sms"></i></div>
 <span class="number"><?= $smsSentToday ?? 0 ?></span>
 <span class="label">SMS Today</span>
 </div>
 </div>
 </div>
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-purple">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-users"></i></div>
 <span class="number"><?= $totalParents ?? 0 ?></span>
 <span class="label">Parents</span>
 </div>
 </div>
 </div>
 </div>
 <div class="row">
 <div class="col-lg-4 col-6 mb-3">
 <div class="fun-box bg-kid-pink">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-user-check"></i></div>
 <span class="number"><?= $totalStaff ?? 0 ?></span>
 <span class="label">Staff</span>
 </div>
 </div>
 </div>
 <div class="col-lg-4 col-6 mb-3">
 <div class="fun-box bg-kid-teal">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-qrcode"></i></div>
 <span class="number"><?= $qrReleases ?? 0 ?></span>
 <span class="label">QR Releases</span>
 </div>
 </div>
 </div>
 </div>
 <?php endif; ?>

  <!-- ==================== STAFF DASHBOARD ==================== -->
 <?php if (session('role') == 'staff'): ?>
 <div class="row">
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-green">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
 <span class="number"><?= $releasedToday ?? 0 ?></span>
 <span class="label">My Releases Today</span>
 </div>
 </div>
 </div>
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-blue">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
 <span class="number"><?= $totalStudents ?? 0 ?></span>
 <span class="label">Students</span>
 </div>
 </div>
 </div>
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-yellow">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-sms"></i></div>
 <span class="number"><?= $smsSentToday ?? 0 ?></span>
 <span class="label">SMS Today</span>
 </div>
 </div>
 </div>
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-orange">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-qrcode"></i></div>
 <span class="number"><?= count($todayReleases ?? []) ?></span>
 <span class="label">Today's Releases</span>
 </div>
 </div>
 </div>
 </div>

 <!-- Today's Releases Table -->
 <div class="row">
 <div class="col-12">
 <div class="kid-card">
 <div class="card-header">
 <h5 class="mb-0">
 <i class="fas fa-history mr-2" style="color: #16a34a;"></i> Today's Releases
 <span style="font-size:0.8rem;color:#94a3b8;font-weight:400;margin-left:10px;"><?= date('F d, Y') ?></span>
 </h5>
 </div>
 <div class="card-body p-0">
 <div class="table-responsive">
 <table class="table table-fun table-hover table-sm mb-0">
 <thead><tr><th>Student</th><th>Fetcher</th><th>Method</th><th>Time</th></tr></thead>
 <tbody>
 <?php if(!empty($todayReleases)): foreach($todayReleases as $r): ?>
 <tr>
 <td>
 <strong><?= esc($r['student_fname']) ?> <?= esc($r['student_lname']) ?></strong>
 <br><small class="text-muted">#<?= esc($r['student_id']) ?> · <?= esc($r['grade_section']) ?></small>
 </td>
 <td>
 <?php $fetcherName = trim((string)($r['fetcher_fname'] ?? '') . ' ' . (string)($r['fetcher_lname'] ?? '')); ?>
 <?php if (!empty($fetcherName)): ?>
 <?= esc($fetcherName) ?>
 <?php if (!empty($r['fetcher_relation'])): ?>
 <br><small class="text-muted"><?= esc($r['fetcher_relation']) ?></small>
 <?php endif; ?>
 <?php elseif (!empty($r['parent_fname'])): ?>
 <?= esc($r['parent_fname']) ?> <?= esc($r['parent_lname']) ?>
 <br><small class="text-muted">Parent</small>
 <?php else: ?>
 <span class="text-muted">—</span>
 <?php endif; ?>
 </td>
 <td><span class="badge badge-primary" style="<?= ($r['method']??'')=='QR' ? '' : 'background-color:#eef2ff;color:#4338ca;' ?>"><?= $r['method']??'—' ?></span></td>
 <td class="small text-muted"><i class="fas fa-calendar-alt mr-1"></i><?= date('M d, Y', strtotime($r['time_released'])) ?><br><small><?= date('h:i A', strtotime($r['time_released'])) ?></small></td>
 </tr>
 <?php endforeach; else: ?>
 <tr><td colspan="4" class="text-center text-muted py-4">No releases today</td></tr>
 <?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>
 </div>
 <?php endif; ?>

  <!-- ==================== TEACHER DASHBOARD ==================== -->
 <?php if (session('role') == 'teacher'): ?>
 <div class="row">
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-blue">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
 <span class="number"><?= $totalStudents ?? 0 ?></span>
 <span class="label">My Students</span>
 </div>
 </div>
 </div>
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-green">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
 <span class="number"><?= $releasedToday ?? 0 ?></span>
 <span class="label">Released on <?= date('M d', strtotime($selectedDate ?? date('Y-m-d'))) ?></span>
 </div>
 </div>
 </div>
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-orange">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-hourglass-half"></i></div>
 <span class="number"><?= $pendingToday ?? 0 ?></span>
 <span class="label">Still Waiting</span>
 </div>
 </div>
 </div>
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-pink">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-sms"></i></div>
 <span class="number"><?= $smsCount ?? 0 ?></span>
 <span class="label">SMS Received</span>
 </div>
 </div>
 </div>
 </div>
 <?php endif; ?>

  <!-- ==================== PARENT DASHBOARD ==================== -->
 <?php if (session('role') == 'parent'): ?>

 <!-- Parent Stats -->
 <div class="row">
 <div class="col-lg-4 col-6 mb-3">
 <div class="fun-box bg-kid-blue">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-child"></i></div>
 <span class="number"><?= count($myChildren ?? []) ?></span>
 <span class="label">My Children</span>
 </div>
 </div>
 </div>
 <div class="col-lg-4 col-6 mb-3">
 <div class="fun-box bg-kid-green">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
 <span class="number"><?= $releasedToday ?? 0 ?></span>
 <span class="label">Released Today</span>
 </div>
 </div>
 </div>
 <div class="col-lg-4 col-6 mb-3">
 <div class="fun-box bg-kid-orange">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-user-friends"></i></div>
 <span class="number"><?= count($subFetchers ?? []) ?></span>
 <span class="label">Sub-Fetchers</span>
 </div>
 </div>
 </div>
 </div>

 <!-- ===== MY QR CODE (parent can finally see their own QR) ===== -->
 <div class="row">
 <div class="col-12 mb-3">
 <div class="fun-box" style="background:#fff;border:2px dashed #cbd5e1;">
 <div class="d-flex align-items-center" style="gap:1.25rem;flex-wrap:wrap;padding:.5rem;">
 <?php $myQr = $parentProfile['qr_code'] ?? null; ?>
 <?php if (!empty($myQr)): ?>
 <img src="<?= base_url('uploads/qr/'.$myQr.'.png') ?>"
 alt="My QR Code"
 style="width:120px;height:120px;cursor:zoom-in;border:1px solid #e2e8f0;border-radius:10px;background:#fff;"
 onclick="openQrModal('<?= base_url('uploads/qr/'.$myQr.'.png') ?>','<?= esc(trim(($parentProfile['fname'] ?? '').' '.($parentProfile['lname'] ?? ''))) ?>')">
 <?php else: ?>
 <div style="width:120px;height:120px;display:flex;align-items:center;justify-content:center;color:#94a3b8;border:1px solid #e2e8f0;border-radius:10px;">
 <i class="fas fa-qrcode fa-3x"></i>
 </div>
 <?php endif; ?>
 <div style="flex:1;min-width:220px;">
 <h6 style="font-weight:700;margin-bottom:.25rem;"><i class="fas fa-id-card mr-1" style="color:#4361ee;"></i> My QR Code</h6>
 <p style="margin:0;color:#64748b;font-size:13px;">Show this QR code at the school gate when picking up your child. Tap it for a bigger view, then Save to keep a copy on your phone.</p>
 <?php if (!empty($myQr)): ?>
 <div style="margin-top:.5rem;display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;">
 <code><?= esc($myQr) ?></code>
 <a href="<?= base_url('uploads/qr/'.$myQr.'.png') ?>" download="<?= esc($myQr) ?>.png" class="btn btn-sm btn-outline-primary" style="padding:.15rem .5rem;font-size:12px;"><i class="fas fa-download mr-1"></i>Save</a>
 </div>
 <?php else: ?>
 <p style="margin:.5rem 0 0;color:#dc2626;font-size:12px;">No QR code yet — contact the school admin.</p>
 <?php endif; ?>
 </div>
 </div>
 </div>
 </div>

 <!-- ===== MY CHILDREN (list, kahit 2 or more) ===== -->
 <div class="row">
 <div class="col-12 mb-3">
 <h6 style="font-weight:700;"><i class="fas fa-child mr-1" style="color:#4361ee;"></i> My Children <span class="badge badge-primary" style="font-size:11px;"><?= count($myChildren ?? []) ?></span></h6>
 <?php if (!empty($myChildren)): ?>
 <div class="row">
 <?php foreach ($myChildren as $c): ?>
 <div class="col-md-6 col-lg-4 mb-3">
 <div class="fun-box" style="background:#fff;height:100%;">
 <div class="d-flex align-items-start" style="gap:.75rem;">
 <div style="width:42px;height:42px;border-radius:50%;background:#eef2ff;color:#4338ca;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;">
 <?= strtoupper(mb_substr($c['fname'] ?? '',0,1)) ?><?= strtoupper(mb_substr($c['lname'] ?? '',0,1)) ?>
 </div>
 <div style="flex:1;min-width:0;">
 <strong style="display:block;"><?= esc(trim(($c['fname'] ?? '').' '.($c['lname'] ?? ''))) ?></strong>
 <small style="color:#64748b;"><i class="fas fa-school mr-1"></i><?= esc($c['grade_section'] ?? '-') ?></small>
 <?php if (!empty($c['teacher'])): ?>
 <br><small style="color:#64748b;"><i class="fas fa-chalkboard-teacher mr-1"></i><?= esc($c['teacher']) ?></small>
 <?php endif; ?>
 <br>
 <?php if (!empty($c['release_today'])): ?>
 <span class="badge" style="background:#dcfce7;color:#166534;font-size:11px;"><i class="fas fa-check mr-1"></i>Released <?= date('h:i A', strtotime($c['release_today'])) ?></span>
 <?php else: ?>
 <span class="badge" style="background:#ffedd5;color:#9a3412;font-size:11px;"><i class="fas fa-clock mr-1"></i>Not yet picked up</span>
 <?php endif; ?>
 </div>
 </div>
 </div>
 </div>
 <?php endforeach; ?>
 </div>
 <?php else: ?>
 <p style="color:#94a3b8;font-size:13px;margin:0;">No linked children yet — contact the school admin.</p>
 <?php endif; ?>
 </div>
 </div>

 <!-- ===== SUB-FETCHERS (hidden kapag walang laman) ===== -->
 <?php if (!empty($subFetchers)): ?>
 <div class="row">
 <div class="col-12 mb-3">
 <h6 style="font-weight:700;"><i class="fas fa-user-friends mr-1" style="color:#f59e0b;"></i> Sub-Fetchers <span class="badge badge-warning" style="font-size:11px;"><?= count($subFetchers) ?></span></h6>
 <div class="row">
 <?php foreach ($subFetchers as $sf): ?>
 <div class="col-md-6 col-lg-4 mb-3">
 <div class="fun-box d-flex align-items-center" style="background:#fff;gap:.75rem;">
 <?php if (!empty($sf['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$sf['qr_code'].'.png') ?>" alt="QR"
 style="width:64px;height:64px;border:1px solid #e2e8f0;border-radius:8px;cursor:zoom-in;background:#fff;"
 onclick="openQrModal('<?= base_url('uploads/qr/'.$sf['qr_code'].'.png') ?>','<?= esc(trim(($sf['fname'] ?? '').' '.($sf['lname'] ?? ''))) ?>')">
 <?php else: ?>
 <div style="width:64px;height:64px;display:flex;align-items:center;justify-content:center;color:#cbd5e1;"><i class="fas fa-qrcode fa-2x"></i></div>
 <?php endif; ?>
 <div style="flex:1;min-width:0;">
 <strong style="display:block;"><?= esc(trim(($sf['fname'] ?? '').' '.($sf['lname'] ?? ''))) ?></strong>
 <small style="color:#64748b;"><i class="fas fa-phone mr-1"></i><?= esc($sf['phone'] ?? '-') ?></small>
 <?php if (!empty($sf['qr_code'])): ?>
 <br><small style="color:#94a3b8;"><?= esc($sf['qr_code']) ?></small>
 <?php endif; ?>
 </div>
 </div>
 </div>
 <?php endforeach; ?>
 </div>
 </div>
 </div>
 <?php endif; ?>

 <?php endif; ?>

 </div>
 </section>
</div>

<!-- ===== QR MODAL ===== -->
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
 <a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary btn-sm"><i class="fas fa-download mr-1"></i> Save</a>
 <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
 </div>
 </div>
 </div>
</div>

<!-- ===== IMAGE VIEWER MODAL ===== -->
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
 <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm"><i class="fas fa-download mr-1"></i> Download</a>
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
    $('#qrDownloadBtn').attr('href', u);
    $('#qrDownloadBtn').attr('download', (t || 'qr').replace(/\s+/g, '_') + '.png');
    $('#qrModalTitle').text(t || 'QR Code');
    $('#qrModal').modal('show');
}

function openImageViewer(u, t) {
    if (!u) { alert('No photo available.'); return; }
    $('#imageViewerFull').attr('src', u);
    $('#imageDownloadBtn').attr('href', u);
    $('#imageDownloadBtn').attr('download', t.replace(/\s+/g, '_') + '.png');
    $('#imageViewerTitle').text(t || 'Photo');
    $('#imageViewerModal').modal('show');
}
</script>
<?= $this->endSection() ?>