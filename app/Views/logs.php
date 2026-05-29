<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-history mr-2"></i>Activity Logs
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Logs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- Filter -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body py-2">
                            <form method="get" action="<?= base_url('logs') ?>" class="form-inline flex-wrap">
                                
                                <!-- Time Filters -->
                                <div class="btn-group btn-group-sm mr-2 mb-1">
                                    <a href="<?= base_url('logs') ?>" class="btn btn-outline-secondary <?= ($filter ?? '') == '' || ($filter ?? '') == 'all' ? 'active' : '' ?>">All</a>
                                    <a href="<?= base_url('logs?filter=today') ?>" class="btn btn-outline-secondary <?= ($filter ?? '') == 'today' ? 'active' : '' ?>">Today</a>
                                    <a href="<?= base_url('logs?filter=week') ?>" class="btn btn-outline-secondary <?= ($filter ?? '') == 'week' ? 'active' : '' ?>">Week</a>
                                    <a href="<?= base_url('logs?filter=month') ?>" class="btn btn-outline-secondary <?= ($filter ?? '') == 'month' ? 'active' : '' ?>">Month</a>
                                </div>

                                <!-- Module Filter -->
                                <select name="module" class="form-control form-control-sm mr-2 mb-1" style="width:140px;">
                                    <option value="">All Modules</option>
                                    <option value="auth" <?= ($module ?? '') == 'auth' ? 'selected' : '' ?>>Auth</option>
                                    <option value="parent" <?= ($module ?? '') == 'parent' ? 'selected' : '' ?>>Parents</option>
                                    <option value="student" <?= ($module ?? '') == 'student' ? 'selected' : '' ?>>Students</option>
                                    <option value="staff" <?= ($module ?? '') == 'staff' ? 'selected' : '' ?>>Staffs</option>
                                    <option value="authorization" <?= ($module ?? '') == 'authorization' ? 'selected' : '' ?>>Authorization</option>
                                    <option value="scan" <?= ($module ?? '') == 'scan' ? 'selected' : '' ?>>QR Scan</option>
                                </select>

                                <!-- Date Filter -->
                                <input type="date" name="date" class="form-control form-control-sm mr-2 mb-1" style="width:150px;" value="<?= $date ?? '' ?>">

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
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-list mr-2"></i>System Activity</h5>
                                <span class="badge badge-light"><?= count($logs ?? []) ?> entries</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary">
                                            <th width="5%">#</th>
                                            <th width="16%">Date/Time</th>
                                            <th width="14%">User</th>
                                            <th width="8%">Role</th>
                                            <th width="12%">Action</th>
                                            <th width="12%">Module</th>
                                            <th width="33%">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($logs)): ?>
                                            <?php $i = 1; foreach ($logs as $log): ?>
                                            <?php
                                                // Role badge color
                                                $role = $log['role'] ?? '';
                                                if ($role == 'admin') $roleColor = 'primary';
                                                elseif ($role == 'staff') $roleColor = 'info';
                                                elseif ($role == 'parent') $roleColor = 'success';
                                                else $roleColor = 'secondary';

                                                // Action badge color
                                                $action = $log['action'] ?? '';
                                                if ($action == 'login') $actionColor = 'success';
                                                elseif ($action == 'logout') $actionColor = 'dark';
                                                elseif (in_array($action, ['create', 'register'])) $actionColor = 'primary';
                                                elseif ($action == 'update') $actionColor = 'warning';
                                                elseif ($action == 'delete') $actionColor = 'danger';
                                                elseif ($action == 'release') $actionColor = 'info';
                                                elseif ($action == 'approve') $actionColor = 'success';
                                                else $actionColor = 'secondary';
                                            ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td class="small"><?= date('M d, Y h:i A', strtotime($log['created_at'])) ?></td>
                                                <td><strong><?= esc($log['user_name'] ?? 'System') ?></strong></td>
                                                <td><span class="badge badge-<?= $roleColor ?>"><?= ucfirst($role) ?: '—' ?></span></td>
                                                <td><span class="badge badge-<?= $actionColor ?>"><?= ucfirst($action) ?></span></td>
                                                <td><span class="badge badge-light"><?= ucfirst($log['module'] ?? '—') ?></span></td>
                                                <td><small><?= esc($log['description'] ?? '—') ?></small></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-5">
                                                    <i class="fas fa-clipboard-list fa-3x mb-3 d-block"></i>
                                                    <h5>No activity logs found</h5>
                                                    <p>Logs will appear here once there is system activity.</p>
                                                </td>
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
.card { border-radius: 10px; }
.table td, .table th { vertical-align: middle; border-top: none; }
.table tbody tr { border-bottom: 1px solid #f3f4f6; }
.table tbody tr:hover { background: #f9fafb; }
.badge { font-weight: 400; padding: 5px 8px; }
.btn-group .btn.active { background: #667eea; color: #fff; border-color: #667eea; }
</style>

<?= $this->endSection() ?>