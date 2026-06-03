<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0 font-weight-normal text-secondary"><i class="fas fa-history mr-2"></i>Activity Logs</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li><li class="breadcrumb-item active">Logs</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <?php $f = $_GET['filter'] ?? ''; $m = $_GET['module'] ?? ''; $d = $_GET['date'] ?? ''; ?>

            <!-- Filter -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body py-2">
                            <form method="get" action="<?= base_url('logs') ?>" class="form-inline flex-wrap">
                                <div class="btn-group btn-group-sm mr-2 mb-1">
                                    <a href="<?= base_url('logs') ?>" class="btn btn-outline-secondary <?= ($f == '' || $f == 'all') ? 'active' : '' ?>">All</a>
                                    <a href="<?= base_url('logs?filter=today') ?>" class="btn btn-outline-secondary <?= ($f == 'today') ? 'active' : '' ?>">Today</a>
                                    <a href="<?= base_url('logs?filter=week') ?>" class="btn btn-outline-secondary <?= ($f == 'week') ? 'active' : '' ?>">Week</a>
                                    <a href="<?= base_url('logs?filter=month') ?>" class="btn btn-outline-secondary <?= ($f == 'month') ? 'active' : '' ?>">Month</a>
                                </div>
                                <select name="module" class="form-control form-control-sm mr-2 mb-1" style="width:150px;">
                                    <option value="">All Modules</option>
                                    <option value="auth" <?= ($m == 'auth') ? 'selected' : '' ?>>Auth</option>
                                    <option value="student" <?= ($m == 'student') ? 'selected' : '' ?>>Students</option>
                                    <option value="parent" <?= ($m == 'parent') ? 'selected' : '' ?>>Parents</option>
                                    <option value="sub_fetcher" <?= ($m == 'sub_fetcher') ? 'selected' : '' ?>>Sub-Fetchers</option>
                                    <option value="staff" <?= ($m == 'staff') ? 'selected' : '' ?>>Staffs</option>
                                    <option value="authorization" <?= ($m == 'authorization') ? 'selected' : '' ?>>Authorization</option>
                                    <option value="scan" <?= ($m == 'scan') ? 'selected' : '' ?>>QR Scan</option>
                                </select>
                                <input type="date" name="date" class="form-control form-control-sm mr-2 mb-1" style="width:150px;" value="<?= $d ?>">
                                <button type="submit" class="btn btn-secondary btn-sm mr-1 mb-1"><i class="fas fa-filter"></i> Filter</button>
                                <a href="<?= base_url('logs') ?>" class="btn btn-outline-secondary btn-sm mb-1"><i class="fas fa-times"></i> Reset</a>
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
                            <h5 class="mb-0"><i class="fas fa-list mr-2"></i>System Activity (<?= count($logs ?? []) ?>)</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary">
                                            <th>#</th><th>Date/Time</th><th>User</th><th>Role</th><th>Action</th><th>Module</th><th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($logs)): $i = 1; foreach ($logs as $log): ?>
                                        <?php
                                            $role = $log['role'] ?? '';
                                            if ($role == 'admin') $rb = 'primary';
                                            elseif ($role == 'staff') $rb = 'info';
                                            elseif ($role == 'parent') $rb = 'success';
                                            else $rb = 'secondary';

                                            $action = $log['action'] ?? '';
                                            if ($action == 'login') { $ab = 'success'; $ai = 'sign-in-alt'; }
                                            elseif ($action == 'logout') { $ab = 'dark'; $ai = 'sign-out-alt'; }
                                            elseif (in_array($action, ['create', 'register'])) { $ab = 'primary'; $ai = 'plus-circle'; }
                                            elseif ($action == 'update') { $ab = 'warning'; $ai = 'edit'; }
                                            elseif ($action == 'delete') { $ab = 'danger'; $ai = 'trash'; }
                                            elseif ($action == 'release') { $ab = 'info'; $ai = 'check-circle'; }
                                            elseif ($action == 'decline') { $ab = 'danger'; $ai = 'times-circle'; }
                                            elseif ($action == 'approve') { $ab = 'success'; $ai = 'check'; }
                                            else { $ab = 'secondary'; $ai = 'circle'; }
                                        ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td class="small"><?= date('M d, Y h:i A', strtotime($log['created_at'])) ?></td>
                                            <td><strong><?= esc($log['user_name'] ?? 'System') ?></strong></td>
                                            <td><span class="badge badge-<?= $rb ?>"><?= ucfirst($role ?: '—') ?></span></td>
                                            <td><span class="badge badge-<?= $ab ?>"><i class="fas fa-<?= $ai ?> mr-1"></i><?= ucfirst($action) ?></span></td>
                                            <td><span class="badge badge-light"><?= ucfirst(str_replace('_', ' ', $log['module'])) ?></span></td>
                                            <td><small><?= esc($log['description']) ?></small></td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr><td colspan="7" class="text-center text-muted py-5"><i class="fas fa-clipboard-list fa-3x mb-3 d-block"></i><h5>No activity logs found</h5></td></tr>
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

<style>.card{border-radius:10px}.table td,.table th{vertical-align:middle;border-top:none}.table tbody tr{border-bottom:1px solid #f3f4f6}.badge{font-weight:400;padding:5px 8px}.btn-group .btn.active{background:#667eea;color:#fff;border-color:#667eea}</style>
<?= $this->endSection() ?>