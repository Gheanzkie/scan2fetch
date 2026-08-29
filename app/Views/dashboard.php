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
 <div class="col-lg-4 col-6 mb-3">
 <div class="fun-box bg-kid-orange">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-history"></i></div>
 <span class="number"><?= count($recentReleases ?? []) ?></span>
 <span class="label">Recent Releases</span>
 </div>
 </div>
 </div>
 </div>
 <!-- Table -->
 <div class="row">
 <div class="col-12">
 <div class="kid-card">
 <div class="card-header">
 <h5 class="mb-0">
 <i class="fas fa-history mr-2" style="color: #4361ee;"></i> Recent Releases
 <span style="font-size:0.8rem;color:#94a3b8;font-weight:400;margin-left:10px;">Latest 10 entries</span>
 </h5>
 </div>
 <div class="card-body p-0">
 <div class="table-responsive">
 <table class="table table-fun table-hover table-sm mb-0">
 <thead><tr><th>Student</th><th>Fetcher</th><th>Method</th><th>Time</th></tr></thead>
 <tbody>
 <?php if(!empty($recentReleases)): foreach($recentReleases as $r): ?>
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
 <td class="small text-muted"><?= date('h:i A', strtotime($r['time_released'])) ?></td>
 </tr>
 <?php endforeach; else: ?>
 <tr><td colspan="4" class="text-center text-muted py-4">No releases yet</td></tr>
 <?php endif; ?>
 </tbody>
 </table>
 </div>
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

 <!-- Quick Action Buttons -->
 <div class="row mb-4">
 <div class="col-12">
 <div class="kid-card">
 <div class="card-body">
 <h5 class="mb-3" style="color:#0f172a;font-weight:700;font-size:1rem;">Quick Actions</h5>
 <div class="d-flex flex-wrap gap-2">
 <a href="<?= base_url('scan') ?>" class="btn btn-primary">
 <i class="fas fa-qrcode mr-1"></i> Scan QR
 </a>
 <a href="<?= base_url('students') ?>" class="btn btn-success">
 <i class="fas fa-user-graduate mr-1"></i> Students
 </a>
 <a href="<?= base_url('parents') ?>" class="btn btn-kid-purple">
 <i class="fas fa-users mr-1"></i> Parents
 </a>
 </div>
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
 <td class="small text-muted"><?= date('h:i A', strtotime($r['time_released'])) ?></td>
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
 <span class="label">Released Today</span>
 </div>
 </div>
 </div>
 <div class="col-lg-3 col-6 mb-3">
 <div class="fun-box bg-kid-orange">
 <div class="text-center">
 <div class="icon-circle"><i class="fas fa-hourglass-half"></i></div>
 <span class="number"><?= $pendingToday ?? 0 ?></span>
 <span class="label">Still at School</span>
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

 <div class="row">
 <!-- Teacher profile -->
 <div class="col-md-4">
 <div class="kid-card">
 <div class="card-header">
 <h5 class="mb-0">
 <i class="fas fa-chalkboard-teacher mr-2" style="color: #4361ee;"></i>
                                My Profile
 </h5>
 </div>
 <div class="card-body text-center py-4">
 <div style="width:80px;height:80px;margin:0 auto;border-radius:50%;background:#eef2ff;
                                        display:flex;align-items:center;justify-content:center;">
 <i class="fas fa-chalkboard-teacher" style="font-size:30px;color:#4361ee;"></i>
 </div>
 <h5 class="mt-3 mb-1" style="color: #0f172a;">
 <?= esc(($teacherProfile['fname'] ?? session('fname'))) ?> <?= esc(($teacherProfile['lname'] ?? session('lname'))) ?>
 </h5>
 <span class="badge badge-light mt-1">
 <i class="fas fa-book mr-1"></i><?= esc(session('grade_section')) ?>
 </span>
 <div class="mt-3" style="color: #64748b; font-size: 13px;">
 <i class="fas fa-phone mr-1"></i> <?= esc($teacherProfile['phone'] ?? session('phone')) ?>
 </div>
 <a href="<?= base_url('teachers-view/' . session('user_id')) ?>" class="btn btn-primary btn-sm mt-3 px-3">
 <i class="fas fa-eye mr-1"></i> View My Students
 </a>
 </div>
 </div>
 </div>

 <!-- My Students -->
 <div class="col-md-8">
 <div class="kid-card">
 <div class="card-header d-flex justify-content-between align-items-center">
 <h5 class="mb-0">
 <i class="fas fa-child mr-2" style="color: #4361ee;"></i>
                                My Students (<?= count($myStudents ?? []) ?>)
 </h5>
 </div>
 <div class="card-body">
 <?php if (!empty($myStudents)): ?>
 <div class="row">
 <?php foreach ($myStudents as $st): ?>
 <div class="col-md-6 mb-3">
 <div class="child-item d-flex align-items-center p-3">
 <div class="mr-3" style="cursor:pointer;" onclick="openImageViewer('<?= !empty($st['picture']) ? base_url('uploads/students/' . $st['picture']) : '' ?>', '<?= esc($st['fname'] . ' ' . $st['lname']) ?>')">
 <?php if (!empty($st['picture'])): ?>
 <img src="<?= base_url('uploads/students/' . $st['picture']) ?>" class="img-circle" style="width:50px;height:50px;object-fit:cover;">
 <?php else: ?>
 <div class="img-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:#f1f5f9;">
 <i class="fas fa-child" style="color: #94a3b8; font-size: 1.3rem;"></i>
 </div>
 <?php endif; ?>
 </div>
 <div class="flex-grow-1">
 <strong style="color: #0f172a;"><?= esc($st['fname']) ?> <?= esc($st['lname']) ?></strong>
 <br><small class="text-muted"><?= esc($st['grade_section']) ?></small>
 <?php if (!empty($todayReleasedMap[$st['id']])): ?>
 <br><span class="badge badge-success mt-1">Picked up <?= date('h:i A', strtotime($todayReleasedMap[$st['id']])) ?></span>
 <?php else: ?>
 <br><span class="badge badge-warning mt-1">Still in school</span>
 <?php endif; ?>
 </div>
 <a href="<?= base_url('students-view/' . $st['id']) ?>" class="btn btn-sm btn-outline-secondary ml-1">
 <i class="fas fa-eye"></i>
 </a>
 </div>
 </div>
 <?php endforeach; ?>
 </div>
 <?php else: ?>
 <div class="text-center text-muted py-5">
 <i class="fas fa-user-graduate" style="font-size: 3rem; color: #cbd5e1;"></i>
 <p class="mt-3">No students under your class yet</p>
 </div>
 <?php endif; ?>
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

 <!-- Parent Profile & My Children -->
 <div class="row">
 <!-- Parent Profile Card -->
 <div class="col-md-4 mb-3">
 <div class="kid-card">
 <div class="card-body text-center">
 <div style="width:110px;height:110px;margin:0 auto;border-radius:50%;overflow:hidden;border:4px solid #eef2ff;box-shadow: 0 4px 12px rgba(15,23,42,.08);cursor:pointer;"
                                 onclick="openImageViewer('<?= !empty($parentProfile['picture']) ? base_url('uploads/parents/' . $parentProfile['picture']) : '' ?>', '<?= esc(($parentProfile['fname'] ?? session('fname')) . ' ' . ($parentProfile['lname'] ?? session('lname'))) ?>')">
 <?php if (!empty($parentProfile['picture'])): ?>
 <img src="<?= base_url('uploads/parents/' . $parentProfile['picture']) ?>" style="width:100%;height:100%;object-fit:cover;">
 <?php else: ?>
 <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f1f5f9;">
 <i class="fas fa-user fa-3x" style="color: #94a3b8;"></i>
 </div>
 <?php endif; ?>
 </div>
 <h5 class="mt-3 mb-1" style="color: #0f172a;">
 <?= esc($parentProfile['fname'] ?? session('fname')) ?>
 <?= esc($parentProfile['lname'] ?? session('lname')) ?>
 </h5>
 <p class="mb-3" style="color: #64748b;">
 <i class="fas fa-phone mr-1"></i> <?= esc($parentProfile['phone'] ?? session('phone')) ?>
 </p>
 <?php if (!empty($parentProfile['qr_code'])): ?>
 <div class="mb-2">
 <img src="<?= base_url('uploads/qr/' . $parentProfile['qr_code'] . '.png') ?>"
                                     style="width:100px;height:100px;border:2px solid #e2e8f0;border-radius:8px;cursor:pointer;"
                                     onclick="openQrModal('<?= base_url('uploads/qr/' . $parentProfile['qr_code'] . '.png') ?>', '<?= esc($parentProfile['fname'] ?? session('fname')) ?>')">
 <p style="color: #64748b; font-size: 0.8rem; margin-top: 5px;">
                                    My QR Code
 </p>
 </div>
 <?php endif; ?>
 </div>
 </div>

 <!-- Sub-Fetchers -->
 <?php if (!empty($subFetchers)): ?>
 <div class="kid-card mt-3">
 <div class="card-header">
 <h6 class="mb-0">
 <i class="fas fa-user-friends mr-2" style="color: #16a34a;"></i>
                                My Sub-Fetchers (<?= count($subFetchers) ?>)
 </h6>
 </div>
 <div class="card-body">
 <?php foreach ($subFetchers as $f): ?>
 <div class="subfetcher-item d-flex align-items-center p-2 mb-2">
 <div class="mr-2" style="cursor:pointer;" onclick="openImageViewer('<?= !empty($f['picture']) ? base_url('uploads/parents/' . $f['picture']) : '' ?>', '<?= esc($f['fname'] . ' ' . $f['lname']) ?>')">
 <?php if(!empty($f['picture'])): ?>
 <img src="<?= base_url('uploads/parents/' . $f['picture']) ?>" class="img-circle" style="width:40px;height:40px;object-fit:cover;">
 <?php else: ?>
 <div class="img-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#f1f5f9;">
 <i class="fas fa-user" style="color: #94a3b8;"></i>
 </div>
 <?php endif; ?>
 </div>
 <div class="flex-grow-1">
 <strong style="color: #0f172a;"><?= esc($f['fname']) ?> <?= esc($f['lname']) ?></strong>
 <br><small class="text-muted"><?= esc($f['phone']) ?></small>
 </div>
 <?php if(!empty($f['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>"
                                         style="width:32px;height:32px;border:1px solid #e2e8f0;border-radius:4px;cursor:pointer;"
                                         onclick="openQrModal('<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>', '<?= esc($f['fname']) ?>')">
 <?php endif; ?>
 </div>
 <?php endforeach; ?>
 </div>
 </div>
 <?php endif; ?>
 </div>

 <!-- My Children -->
 <div class="col-md-8">
 <div class="kid-card">
 <div class="card-header">
 <h5 class="mb-0">
 <i class="fas fa-child mr-2" style="color: #4361ee;"></i>
                                My Children (<?= count($myChildren ?? []) ?>)
 </h5>
 </div>
 <div class="card-body">
 <?php if (!empty($myChildren)): ?>
 <div class="row">
 <?php foreach ($myChildren as $child): ?>
 <div class="col-md-6 mb-3">
 <div class="child-item d-flex align-items-center p-3">
 <div class="mr-3" style="cursor:pointer;" onclick="openImageViewer('<?= !empty($child['picture']) ? base_url('uploads/students/' . $child['picture']) : '' ?>', '<?= esc($child['fname'] . ' ' . $child['lname']) ?>')">
 <?php if (!empty($child['picture'])): ?>
 <img src="<?= base_url('uploads/students/' . $child['picture']) ?>" class="img-circle" style="width:50px;height:50px;object-fit:cover;">
 <?php else: ?>
 <div class="img-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:#f1f5f9;">
 <i class="fas fa-child" style="color: #94a3b8; font-size: 1.3rem;"></i>
 </div>
 <?php endif; ?>
 </div>
 <div class="flex-grow-1">
 <strong style="color: #0f172a;"><?= esc($child['fname']) ?> <?= esc($child['lname']) ?></strong>
 <br><small class="text-muted"><?= esc($child['grade_section']) ?></small>
 <?php if (!empty($child['teacher'])): ?>
 <br><small class="text-muted" style="color: #7c3aed !important;"><i class="fas fa-chalkboard-teacher"></i> <?= esc($child['teacher']) ?></small>
 <?php endif; ?>
 <?php if (!empty($child['relation'])): ?>
 <br><span class="badge badge-light">
 <?= esc($child['relation']) ?>
 </span>
 <?php endif; ?>
 </div>
 </div>
 </div>
 <?php endforeach; ?>
 </div>
 <?php else: ?>
 <div class="text-center text-muted py-5">
 <i class="fas fa-child" style="font-size: 3rem; color: #cbd5e1;"></i>
 <p class="mt-3">No children registered yet</p>
 </div>
 <?php endif; ?>
 </div>
 </div>
 </div>
 </div>
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