<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-tachometer-alt mr-2"></i> 
                        <?= ucfirst(session('role')) ?> Dashboard
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- ==================== ADMIN ==================== -->
            <?php if (session('role') == 'admin'): ?>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-primary text-white"><i class="fas fa-user-graduate"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total Students</span><span class="info-box-number"><?= $totalStudents ?? 0 ?></span></div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-success text-white"><i class="fas fa-check-circle"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Released Today</span><span class="info-box-number"><?= $releasedToday ?? 0 ?></span></div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-warning text-white"><i class="fas fa-file-alt"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Pending Auth</span><span class="info-box-number"><?= $pendingAuth ?? 0 ?></span></div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-info text-white"><i class="fas fa-sms"></i></span>
                        <div class="info-box-content"><span class="info-box-text">SMS Today</span><span class="info-box-number"><?= $smsSentToday ?? 0 ?></span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-secondary text-white"><i class="fas fa-users"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total Parents</span><span class="info-box-number"><?= $totalParents ?? 0 ?></span></div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-secondary text-white"><i class="fas fa-user-check"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total Staff</span><span class="info-box-number"><?= $totalStaff ?? 0 ?></span></div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-secondary text-white"><i class="fas fa-qrcode"></i></span>
                        <div class="info-box-content"><span class="info-box-text">QR Releases</span><span class="info-box-number"><?= $qrReleases ?? 0 ?></span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3"><h5 class="mb-0"><i class="fas fa-history mr-2 text-primary"></i>Recent Releases</h5></div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm mb-0">
                                <thead class="bg-light"><tr class="small text-secondary"><th>Student</th><th>Fetcher</th><th>Method</th><th>Time</th></tr></thead>
                                <tbody>
                                    <?php if (!empty($recentReleases)): ?>
                                        <?php foreach ($recentReleases as $r): ?>
                                        <tr>
                                            <td><strong><?= esc($r['sfname'] ?? '') ?> <?= esc($r['slname'] ?? '') ?></strong></td>
                                            <td><?= esc($r['fetcher_fname']) ?> <?= esc($r['fetcher_lname']) ?></td>
                                            <td><span class="badge badge-<?= ($r['method'] ?? '') == 'QR' ? 'primary' : 'info' ?>"><?= $r['method'] ?? '—' ?></span></td>
                                            <td class="small"><?= date('h:i A', strtotime($r['time_released'])) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="4" class="text-center text-muted py-3">No releases yet</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- ==================== STAFF ==================== -->
            <?php if (session('role') == 'staff'): ?>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-success text-white"><i class="fas fa-check-circle"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Released Today</span><span class="info-box-number"><?= $releasedToday ?? 0 ?></span></div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-warning text-white"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Pending Auth</span><span class="info-box-number"><?= count($pendingAuthLetters ?? []) ?></span></div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-primary text-white"><i class="fas fa-user-graduate"></i></span>
                        <div class="info-box-content"><span class="info-box-text">Total Students</span><span class="info-box-number"><?= $totalStudents ?? 0 ?></span></div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-info text-white"><i class="fas fa-sms"></i></span>
                        <div class="info-box-content"><span class="info-box-text">SMS Today</span><span class="info-box-number"><?= $smsSentToday ?? 0 ?></span></div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <a href="<?= base_url('scan') ?>" class="btn btn-primary btn-sm"><i class="fas fa-qrcode mr-1"></i> QR Scan</a>
                    <a href="<?= base_url('students') ?>" class="btn btn-outline-secondary btn-sm ml-2"><i class="fas fa-user-graduate mr-1"></i> Students</a>
                    <a href="<?= base_url('parents') ?>" class="btn btn-outline-secondary btn-sm ml-2"><i class="fas fa-users mr-1"></i> Parents</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3"><h5 class="mb-0"><i class="fas fa-file-signature mr-2 text-warning"></i>Pending Authorizations</h5></div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm mb-0">
                                <thead class="bg-light"><tr class="small"><th>Student</th><th>Fetcher</th><th>Date</th><th class="text-center">Action</th></tr></thead>
                                <tbody>
                                    <?php if (!empty($pendingAuthLetters)): ?>
                                        <?php foreach ($pendingAuthLetters as $a): ?>
                                        <tr>
                                            <td><strong><?= esc($a['sfname'] ?? '') ?> <?= esc($a['slname'] ?? '') ?></strong></td>
                                            <td><?= esc($a['fetcher_fname']) ?> <?= esc($a['fetcher_lname']) ?></td>
                                            <td class="small"><?= date('M d', strtotime($a['created_at'])) ?></td>
                                            <td class="text-center"><a href="<?= base_url('authorization-release/'.$a['id']) ?>" class="btn btn-success btn-xs" onclick="return confirm('Release?')"><i class="fas fa-check"></i> Release</a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="4" class="text-center text-muted py-3">No pending</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3"><h5 class="mb-0"><i class="fas fa-history mr-2 text-success"></i>Today's Releases</h5></div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm mb-0">
                                <thead class="bg-light"><tr class="small"><th>Student</th><th>Method</th><th>Time</th></tr></thead>
                                <tbody>
                                    <?php if (!empty($todayReleases)): ?>
                                        <?php foreach ($todayReleases as $r): ?>
                                        <tr>
                                            <td><strong><?= esc($r['sfname'] ?? '') ?> <?= esc($r['slname'] ?? '') ?></strong></td>
                                            <td><span class="badge badge-<?= ($r['method'] ?? '') == 'QR' ? 'primary' : 'info' ?>"><?= $r['method'] ?? '—' ?></span></td>
                                            <td class="small"><?= date('h:i A', strtotime($r['time_released'])) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="3" class="text-center text-muted py-3">No releases</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- ==================== PARENT ==================== -->
            <?php if (session('role') == 'parent'): ?>
            <div class="row">
                <!-- Parent Profile -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <!-- Parent Photo - Click to full view -->
                            <div style="width:130px;height:130px;margin:0 auto;border-radius:50%;overflow:hidden;border:4px solid #667eea;cursor:pointer;" 
                                 onclick="openImageViewer('<?= !empty($parentProfile['picture']) ? base_url('uploads/parents/' . $parentProfile['picture']) : '' ?>', '<?= esc($parentProfile['fname'] . ' ' . $parentProfile['lname']) ?>')">
                                <?php if (!empty($parentProfile['picture'])): ?>
                                    <img src="<?= base_url('uploads/parents/' . $parentProfile['picture']) ?>" style="width:100%;height:100%;object-fit:cover;">
                                <?php else: ?>
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f3f4f6;">
                                        <i class="fas fa-user fa-3x text-muted"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="mt-3 mb-0"><?= esc($parentProfile['fname'] ?? session('fname')) ?> <?= esc($parentProfile['lname'] ?? session('lname')) ?></h3>
                            <p class="text-muted mb-2"><i class="fas fa-phone mr-1"></i> <?= esc($parentProfile['phone'] ?? session('phone')) ?></p>
                            
                            <!-- QR Code -->
                            <?php if (!empty($parentProfile['qr_code'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/qr/' . $parentProfile['qr_code'] . '.png') ?>" style="width:100px;height:100px;border:2px solid #667eea;border-radius:8px;cursor:pointer;" onclick="openQrModal('<?= base_url('uploads/qr/' . $parentProfile['qr_code'] . '.png') ?>')" title="Click to enlarge">
                                <p class="text-muted small mt-1 mb-0"><?= esc($parentProfile['qr_code']) ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Children -->
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0"><h5 class="mb-0"><i class="fas fa-child mr-2"></i>My Children (<?= count($myChildren ?? []) ?>)</h5></div>
                        <div class="card-body">
                            <?php if (!empty($myChildren)): ?>
                                <div class="row">
                                    <?php foreach ($myChildren as $child): ?>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center border rounded p-3">
                                            <div class="mr-3" style="cursor:pointer;" 
                                                 onclick="openImageViewer('<?= !empty($child['picture']) ? base_url('uploads/students/' . $child['picture']) : '' ?>', '<?= esc($child['fname'] . ' ' . $child['lname']) ?>')"
                                                 title="Click to view full photo">
                                                <?php if (!empty($child['picture'])): ?>
                                                    <img src="<?= base_url('uploads/students/' . $child['picture']) ?>" class="img-circle" style="width:55px;height:55px;object-fit:cover;border:2px solid #667eea;">
                                                <?php else: ?>
                                                    <div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:55px;height:55px;border:2px solid #667eea;"><i class="fas fa-child text-muted"></i></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-grow-1">
                                                <strong><?= esc($child['fname']) ?> <?= esc($child['lname']) ?></strong>
                                                <br><small class="text-muted"><?= esc($child['grade_section']) ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center text-muted py-4"><i class="fas fa-child fa-2x mb-2 d-block"></i>No children registered</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>
</div>

<!-- Image Viewer Modal -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="background:#1a1a2e;">
            <div class="modal-header border-0" style="background:#1a1a2e;">
                <h5 class="text-white"><i class="fas fa-image mr-2"></i><span id="imageViewerTitle">Photo</span></h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center bg-white p-2">
                <img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;">
            </div>
            <div class="modal-footer border-0" style="background:#1a1a2e;">
                <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a>
                <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- QR Modal -->
<?php if (session('role') == 'parent' && !empty($parentProfile['qr_code'])): ?>
<div class="modal fade" id="qrModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="background:#1a1a2e;">
            <div class="modal-header border-0" style="background:#1a1a2e;">
                <h5 class="text-white"><i class="fas fa-qrcode mr-2"></i>QR Code - <?= esc($parentProfile['fname']) ?> <?= esc($parentProfile['lname']) ?></h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center bg-white">
                <img id="qrFullImage" src="" style="max-width:100%;max-height:70vh;padding:20px;">
                <p class="text-muted small mt-2"><?= esc($parentProfile['qr_code']) ?></p>
            </div>
            <div class="modal-footer border-0" style="background:#1a1a2e;">
                <a id="qrDownloadBtn" href="" download="<?= esc($parentProfile['fname'].'_'.$parentProfile['lname']) ?>.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Save QR</a>
                <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<style>
.info-box { border-radius: 10px; transition: all 0.2s; }
.info-box:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
.info-box-icon { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
.card { border-radius: 10px; }
.table td, .table th { vertical-align: middle; border-top: none; }
.table tbody tr { border-bottom: 1px solid #f3f4f6; }
.img-circle { border-radius: 50%; }
.btn-xs { padding: 4px 10px; font-size: 12px; border-radius: 6px; }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openQrModal(url) {
    $('#qrFullImage').attr('src', url);
    $('#qrDownloadBtn').attr('href', url);
    $('#qrModal').modal('show');
}

function openImageViewer(imageUrl, title) {
    if (!imageUrl) return;
    $('#imageViewerFull').attr('src', imageUrl);
    $('#imageDownloadBtn').attr('href', imageUrl);
    $('#imageDownloadBtn').attr('download', title.replace(/\s+/g, '_') + '.png');
    $('#imageViewerTitle').text(title || 'Photo');
    $('#imageViewerModal').modal('show');
}
</script>
<?= $this->endSection() ?>