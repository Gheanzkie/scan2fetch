<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-history mr-2"></i>Release History
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Release History</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-list mr-2"></i>My Children's Release History</h5>
                                <span class="badge badge-light"><?= count($releases ?? []) ?> releases</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary">
                                            <th>#</th>
                                            <th>Date/Time</th>
                                            <th>Student</th>
                                            <th>Fetcher</th>
                                            <th>Relation</th>
                                            <th>Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($releases)): ?>
                                            <?php $i = 1; foreach ($releases as $r): ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td class="small"><?= date('M d, Y h:i A', strtotime($r['time_released'])) ?></td>
                                                <td><strong><?= esc($r['sfname'] ?? '') ?> <?= esc($r['slname'] ?? '') ?></strong></td>
                                                <td><?= esc($r['fetcher_fname']) ?> <?= esc($r['fetcher_lname']) ?></td>
                                                <td><?= esc($r['fetcher_relation'] ?? 'Parent') ?></td>
                                                <td><span class="badge badge-<?= ($r['method'] ?? '') == 'QR' ? 'primary' : 'info' ?>"><?= $r['method'] ?? '—' ?></span></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-5">
                                                    <i class="fas fa-history fa-3x mb-3 d-block"></i>
                                                    <h5>No release history yet</h5>
                                                    <p>Your children's release records will appear here.</p>
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
</style>

<?= $this->endSection() ?>