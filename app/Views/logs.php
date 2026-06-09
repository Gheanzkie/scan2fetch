<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary"><i class="fas fa-history mr-2"></i>Activity Logs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Activity Logs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <?php 
            $f = $_GET['filter'] ?? 'today'; 
            $m = $_GET['module'] ?? ''; 
            $d = $_GET['date'] ?? date('Y-m-d'); 
            ?>

            <!-- Quick Stats -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-primary text-white"><i class="fas fa-list"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Logs</span>
                            <span class="info-box-number" id="totalCount"><?= count($logs ?? []) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-success text-white"><i class="fas fa-check-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Releases</span>
                            <span class="info-box-number" id="releaseCount"><?= count(array_filter($logs ?? [], function($l){ return ($l['action']??'') == 'release'; })) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-danger text-white"><i class="fas fa-times-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Declined</span>
                            <span class="info-box-number" id="declineCount"><?= count(array_filter($logs ?? [], function($l){ return ($l['action']??'') == 'decline'; })) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-info text-white"><i class="fas fa-calendar-day"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Today</span>
                            <span class="info-box-number"><?= count(array_filter($logs ?? [], function($l){ return date('Y-m-d', strtotime($l['created_at']??'')) == date('Y-m-d'); })) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body py-2">
                            <form method="get" action="<?= base_url('logs') ?>" class="form-inline flex-wrap" id="filterForm">
                                <div class="btn-group btn-group-sm mr-2 mb-1">
                                    <a href="<?= base_url('logs?filter=today') ?>" class="btn btn-outline-primary <?= ($f == 'today') ? 'active' : '' ?>">📅 Today</a>
                                    <a href="<?= base_url('logs?filter=yesterday') ?>" class="btn btn-outline-primary <?= ($f == 'yesterday') ? 'active' : '' ?>">📆 Yesterday</a>
                                    <a href="<?= base_url('logs?filter=week') ?>" class="btn btn-outline-primary <?= ($f == 'week') ? 'active' : '' ?>">📊 Week</a>
                                    <a href="<?= base_url('logs?filter=month') ?>" class="btn btn-outline-primary <?= ($f == 'month') ? 'active' : '' ?>">📈 Month</a>
                                    <a href="<?= base_url('logs') ?>" class="btn btn-outline-primary <?= ($f == '' || $f == 'all') ? 'active' : '' ?>">📋 All</a>
                                </div>
                                <div class="btn-group btn-group-sm mr-2 mb-1">
                                    <a href="<?= base_url('logs?filter=release') ?>" class="btn btn-outline-success <?= ($f == 'release') ? 'active' : '' ?>">✅ Releases</a>
                                    <a href="<?= base_url('logs?filter=decline') ?>" class="btn btn-outline-danger <?= ($f == 'decline') ? 'active' : '' ?>">❌ Declined</a>
                                    <a href="<?= base_url('logs?filter=create') ?>" class="btn btn-outline-warning <?= ($f == 'create') ? 'active' : '' ?>">➕ Created</a>
                                    <a href="<?= base_url('logs?filter=delete') ?>" class="btn btn-outline-dark <?= ($f == 'delete') ? 'active' : '' ?>">🗑️ Deleted</a>
                                </div>
                                <div class="input-group input-group-sm mr-2 mb-1" style="width:160px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="fas fa-cube text-muted"></i></span>
                                    </div>
                                    <select name="module" class="form-control form-control-sm" onchange="this.form.submit()">
                                        <option value="">All Modules</option>
                                        <option value="auth" <?= ($m == 'auth') ? 'selected' : '' ?>>Auth</option>
                                        <option value="student" <?= ($m == 'student') ? 'selected' : '' ?>>Students</option>
                                        <option value="parent" <?= ($m == 'parent') ? 'selected' : '' ?>>Parents</option>
                                        <option value="sub_fetcher" <?= ($m == 'sub_fetcher') ? 'selected' : '' ?>>Sub-Fetchers</option>
                                        <option value="staff" <?= ($m == 'staff') ? 'selected' : '' ?>>Staffs</option>
                                        <option value="authorization" <?= ($m == 'authorization') ? 'selected' : '' ?>>Authorization</option>
                                        <option value="scan" <?= ($m == 'scan') ? 'selected' : '' ?>>QR Scan</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-sm mr-2 mb-1" style="width:160px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="fas fa-calendar text-muted"></i></span>
                                    </div>
                                    <input type="date" name="date" class="form-control form-control-sm" value="<?= $d ?>" onchange="this.form.submit()">
                                </div>
                                <a href="<?= base_url('logs') ?>" class="btn btn-outline-secondary btn-sm mb-1 mr-1"><i class="fas fa-times"></i> Reset</a>
                                <button type="button" class="btn btn-outline-secondary btn-sm mb-1" onclick="location.reload()" title="Refresh"><i class="fas fa-sync-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-list mr-2"></i>System Activity 
                                    <span class="badge badge-light ml-1"><?= count($logs ?? []) ?></span>
                                </h5>
                                <small class="text-muted">
                                    <?php if ($f == 'today'): ?>📅 Showing today's logs
                                    <?php elseif ($f == 'yesterday'): ?>📆 Showing yesterday's logs
                                    <?php elseif ($f == 'week'): ?>📊 Showing this week's logs
                                    <?php elseif ($f == 'month'): ?>📈 Showing this month's logs
                                    <?php elseif ($f != '' && $f != 'all'): ?>🔍 Filtered by: <?= ucfirst($f) ?>
                                    <?php else: ?>📋 Showing all logs
                                    <?php endif; ?>
                                    <?= $m ? ' | Module: ' . ucfirst(str_replace('_', ' ', $m)) : '' ?>
                                    <?= $d ? ' | Date: ' . date('M d, Y', strtotime($d)) : '' ?>
                                </small>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary">
                                            <th style="width:40px;">#</th>
                                            <th style="width:140px;">Date/Time</th>
                                            <th>User</th>
                                            <th style="width:80px;">Role</th>
                                            <th style="width:100px;">Action</th>
                                            <th style="width:100px;">Module</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($logs)): $i = 1; foreach ($logs as $log): ?>
                                        <?php
                                            $role = $log['role'] ?? '';
                                            if ($role == 'admin') $rb = 'danger';
                                            elseif ($role == 'staff') $rb = 'warning';
                                            elseif ($role == 'parent') $rb = 'info';
                                            else $rb = 'secondary';

                                            $action = $log['action'] ?? '';
                                            if ($action == 'login') { $ab = 'success'; $ai = '🔑'; }
                                            elseif ($action == 'logout') { $ab = 'dark'; $ai = '🚪'; }
                                            elseif (in_array($action, ['create', 'register'])) { $ab = 'primary'; $ai = '➕'; }
                                            elseif ($action == 'update') { $ab = 'warning'; $ai = '✏️'; }
                                            elseif ($action == 'delete') { $ab = 'danger'; $ai = '🗑️'; }
                                            elseif ($action == 'release') { $ab = 'success'; $ai = '✅'; }
                                            elseif ($action == 'decline') { $ab = 'danger'; $ai = '❌'; }
                                            elseif ($action == 'approve') { $ab = 'info'; $ai = '👍'; }
                                            else { $ab = 'secondary'; $ai = '•'; }
                                        ?>
                                        <tr>
                                            <td class="text-muted small"><?= $i++ ?></td>
                                            <td class="small text-nowrap"><?= date('M d, Y h:i A', strtotime($log['created_at'])) ?></td>
                                            <td><strong><?= esc($log['user_name'] ?? 'System') ?></strong></td>
                                            <td><span class="badge badge-<?= $rb ?>"><?= ucfirst($role ?: '—') ?></span></td>
                                            <td><span class="badge badge-<?= $ab ?>"><?= $ai ?> <?= ucfirst($action) ?></span></td>
                                            <td><span class="badge badge-light"><?= ucfirst(str_replace('_', ' ', $log['module'] ?? '')) ?></span></td>
                                            <td><small class="text-muted"><?= esc($log['description'] ?? '') ?></small></td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-5">
                                                <i class="fas fa-clipboard-list fa-3x mb-3 d-block"></i>
                                                <h5>No activity logs found</h5>
                                                <p class="small">Perform actions in the system to see logs here.</p>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if (!empty($logs) && count($logs) >= 200): ?>
                        <div class="card-footer bg-white text-center py-2">
                            <small class="text-muted">Showing latest 200 records. Use filters for more specific results.</small>
                        </div>
                        <?php endif; ?>
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
.table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background 0.2s; }
.table tbody tr:hover { background: #f8f9fa; }
.btn-group .btn.active { background: #667eea; color: #fff; border-color: #667eea; }
.badge { font-weight: 400; padding: 5px 8px; }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Auto-refresh every 60 seconds (longer for logs since more data)
var idleTime = 0;
var refreshInterval = 60000;

setInterval(function() {
    idleTime += 1000;
    if (idleTime >= refreshInterval && !document.querySelector(':focus')) {
        // Only refresh if on today filter
        var url = new URL(window.location.href);
        if (url.searchParams.get('filter') === 'today' || !url.searchParams.get('filter')) {
            location.reload();
        }
    }
}, 1000);

$(document).on('mousemove keypress click scroll', function() {
    idleTime = 0;
});
</script>
<?= $this->endSection() ?>