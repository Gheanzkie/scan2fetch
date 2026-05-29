<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><i class="fas fa-file-signature mr-2"></i>Authorization Letters</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li><li class="breadcrumb-item active">Authorizations</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0"><h5 class="mb-0"><i class="fas fa-list mr-2"></i>All Authorization Letters</h5></div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm mb-0">
                                <thead class="bg-light">
                                    <tr class="small"><th>#</th><th>Student</th><th>Parent</th><th>Fetcher</th><th>Relation</th><th>Phone</th><th>Status</th><th>Date</th><th class="text-center">Action</th></tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($authorizations)): $i=1; foreach ($authorizations as $a): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><strong><?= esc($a['sfname'] ?? '') ?> <?= esc($a['slname'] ?? '') ?></strong></td>
                                        <td><?= esc($a['pfname'] ?? '') ?> <?= esc($a['plname'] ?? '') ?></td>
                                        <td>
                                            <?php if (!empty($a['fetcher_picture'])): ?>
                                                <img src="<?= base_url('uploads/fetchers/'.$a['fetcher_picture']) ?>" class="img-circle" style="width:30px;height:30px;object-fit:cover;">
                                            <?php endif; ?>
                                            <?= esc($a['fetcher_fname']) ?> <?= esc($a['fetcher_lname']) ?>
                                        </td>
                                        <td><?= esc($a['relation']) ?></td>
                                        <td><?= esc($a['fetcher_phone'] ?? '—') ?></td>
                                        <td><span class="badge badge-<?= $a['status']=='approved'?'success':($a['status']=='released'?'info':'warning') ?>"><?= ucfirst($a['status']) ?></span></td>
                                        <td class="small"><?= date('M d', strtotime($a['created_at'])) ?></td>
                                        <td class="text-center">
                                            <?php if ($a['status'] == 'pending'): ?>
                                                <a href="<?= base_url('authorization-approve/'.$a['id']) ?>" class="btn btn-success btn-xs" onclick="return confirm('Approve this authorization?')"><i class="fas fa-check"></i> Approve</a>
                                            <?php elseif ($a['status'] == 'approved'): ?>
                                                <a href="<?= base_url('authorization-release/'.$a['id']) ?>" class="btn btn-info btn-xs" onclick="return confirm('Confirm release? SMS will be sent.')"><i class="fas fa-door-open"></i> Release</a>
                                            <?php else: ?>
                                                <span class="badge badge-success">Released</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; else: ?>
                                    <tr><td colspan="9" class="text-center text-muted py-4">No authorization letters</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>