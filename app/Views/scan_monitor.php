<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-monitor-heart-rate mr-2"></i>QR Scan Monitoring</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Scan Monitor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- Live Stats -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-success text-white"><i class="fas fa-check-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Released Today</span>
                            <span class="info-box-number"><?= $releasedToday ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-danger text-white"><i class="fas fa-times-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Declined Today</span>
                            <span class="info-box-number"><?= $declinedToday ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-warning text-white"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pending Release</span>
                            <span class="info-box-number"><?= $pendingRelease ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-info text-white"><i class="fas fa-qrcode"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Scans Today</span>
                            <span class="info-box-number"><?= $totalScans ?? 0 ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Recent Releases -->
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-list mr-2 text-primary"></i>Recent Releases</h5>
                                <button class="btn btn-outline-secondary btn-sm" onclick="location.reload()">
                                    <i class="fas fa-sync-alt mr-1"></i> Refresh
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="bg-light">
                                        <tr class="small">
                                            <th>#</th>
                                            <th>Time</th>
                                            <th>Student</th>
                                            <th>Grade</th>
                                            <th>Fetcher</th>
                                            <th>Relation</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($recentReleases)): $i = 1; ?>
                                        <?php foreach($recentReleases as $r): ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td class="small text-nowrap"><?= date('h:i A', strtotime($r['time_released'])) ?></td>
                                            <td><strong><?= esc($r['student_fname'] ?? '') ?> <?= esc($r['student_lname'] ?? '') ?></strong></td>
                                            <td><span class="badge badge-light"><?= esc($r['grade_section'] ?? '—') ?></span></td>
                                            <td><?= esc($r['fetcher_fname']) ?> <?= esc($r['fetcher_lname']) ?></td>
                                            <td><?= esc($r['fetcher_relation'] ?? 'Parent') ?></td>
                                            <td>
                                                <span class="badge badge-<?= $r['method'] == 'QR' ? 'primary' : 'info' ?>">
                                                    <?= $r['method'] ?>
                                                </span>
                                            </td>
                                            <td><span class="badge badge-success">Released</span></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">No releases yet today</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scan Activity Feed -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <h5 class="mb-0"><i class="fas fa-stream mr-2 text-success"></i>Scan Activity</h5>
                        </div>
                        <div class="card-body p-0" style="max-height:500px;overflow-y:auto;">
                            <?php if(!empty($scanActivities)): ?>
                            <div class="list-group list-group-flush">
                                <?php foreach($scanActivities as $activity): ?>
                                <div class="list-group-item border-0 border-bottom">
                                    <div class="d-flex w-100 justify-content-between">
                                        <small class="font-weight-bold">
                                            <?php if($activity['action'] == 'release'): ?>
                                                <i class="fas fa-check-circle text-success mr-1"></i>
                                            <?php elseif($activity['action'] == 'decline'): ?>
                                                <i class="fas fa-times-circle text-danger mr-1"></i>
                                            <?php else: ?>
                                                <i class="fas fa-qrcode text-info mr-1"></i>
                                            <?php endif; ?>
                                            <?= esc($activity['user_name']) ?>
                                        </small>
                                        <small class="text-muted"><?= date('h:i A', strtotime($activity['created_at'])) ?></small>
                                    </div>
                                    <p class="mb-0 small text-muted"><?= esc($activity['description']) ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php else: ?>
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-3x mb-2 d-block"></i>
                                No scan activity yet
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Currently in Queue / Pending -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <h5 class="mb-0">
                                <i class="fas fa-hourglass-half mr-2 text-warning"></i>
                                Students Still Inside School (Not Yet Released Today)
                                <span class="badge badge-warning ml-2"><?= count($studentsInside ?? []) ?></span>
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="bg-light">
                                        <tr class="small">
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Student Name</th>
                                            <th>Grade/Section</th>
                                            <th>Parent/Guardian</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($studentsInside)): $i = 1; ?>
                                        <?php foreach($studentsInside as $s): ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <?php if(!empty($s['picture'])): ?>
                                                <img src="<?= base_url('uploads/students/'.$s['picture']) ?>" class="img-circle" style="width:35px;height:35px;object-fit:cover;border:2px solid #667eea;">
                                                <?php else: ?>
                                                <div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:35px;height:35px;border:2px solid #667eea;"><i class="fas fa-child text-muted"></i></div>
                                                <?php endif; ?>
                                            </td>
                                            <td><strong><?= esc($s['fname']) ?> <?= esc($s['lname']) ?></strong></td>
                                            <td><span class="badge badge-light"><?= esc($s['grade_section']) ?></span></td>
                                            <td>
                                                <?php if(!empty($s['parent_fname'])): ?>
                                                    <?= esc($s['parent_fname']) ?> <?= esc($s['parent_lname']) ?>
                                                <?php else: ?>
                                                    <span class="text-muted">Not assigned</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><span class="badge badge-warning">Inside</span></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-3">All students have been released or no students registered</td>
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

<style>
.info-box { border-radius: 10px; transition: all 0.2s; }
.info-box:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
.info-box-icon { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
.card { border-radius: 10px; }
.table td, .table th { vertical-align: middle; border-top: none; }
.table tbody tr { border-bottom: 1px solid #f3f4f6; }
.table tbody tr:hover { background: #f8f9fa; }
.img-circle { border-radius: 50%; }
.list-group-item:hover { background: #f8f9fa; }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Auto-refresh every 30 seconds
var autoRefresh = setInterval(function() {
    if (!document.querySelector(':focus')) {
        location.reload();
    }
}, 30000);

// Pause refresh when user is interacting
$(document).on('focus', 'input, select, textarea', function() {
    clearInterval(autoRefresh);
}).on('blur', 'input, select, textarea', function() {
    autoRefresh = setInterval(function() {
        if (!document.querySelector(':focus')) {
            location.reload();
        }
    }, 30000);
});
</script>
<?= $this->endSection() ?>