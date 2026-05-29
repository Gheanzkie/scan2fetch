<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary"><i class="fas fa-users mr-2"></i>Parents / Fetchers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item active text-secondary">Parents</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle mr-1"></i> <?= session()->getFlashdata('msg') ?><button type="button" class="close" data-dismiss="alert">&times;</button></div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-normal text-secondary mb-0"><i class="fas fa-list mr-2"></i>List</h3>
                                <a href="<?= base_url('parents-add') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-plus mr-1"></i>Add Parent & Student</a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary text-uppercase">
                                            <th>#</th><th>Photo</th><th>Name</th><th>Phone</th><th>QR</th><th>Created</th><th class="text-center">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($parents)): ?>
                                            <?php $i = 1; foreach ($parents as $parent): ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td>
                                                    <?php if (!empty($parent['picture'])): ?>
                                                        <img src="<?= base_url('uploads/parents/' . $parent['picture']) ?>" class="img-circle" style="width:40px;height:40px;object-fit:cover;border:2px solid #667eea;">
                                                    <?php else: ?>
                                                        <div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;border:2px solid #667eea;"><i class="fas fa-user text-muted"></i></div>
                                                    <?php endif; ?>
                                                </td>
                                                <td><a href="<?= base_url('parents-view/' . $parent['id']) ?>" class="text-dark font-weight-bold"><?= esc($parent['fname']) ?> <?= esc($parent['lname']) ?></a></td>
                                                <td><?= esc($parent['phone']) ?></td>
                                                <td><?= !empty($parent['qr_code']) ? '<span class="badge badge-success"><i class="fas fa-qrcode"></i></span>' : '<span class="badge badge-warning">None</span>' ?></td>
                                                <td class="small"><?= date('M d, Y', strtotime($parent['created_at'])) ?></td>
                                                <td class="text-center"><a href="<?= base_url('parents-view/' . $parent['id']) ?>" class="btn btn-outline-info btn-xs"><i class="fas fa-eye"></i> View</a></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="7" class="text-center text-muted py-4">No parents registered yet</td></tr>
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
.img-circle { border-radius: 50%; }
.btn-xs { padding: 4px 10px; font-size: 12px; border-radius: 6px; }
.btn-secondary { background: #6b7280; border-color: #6b7280; }
</style>

<?= $this->endSection() ?>