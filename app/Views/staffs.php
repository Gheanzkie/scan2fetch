<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-user-check mr-2"></i> Staff Management
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item active text-secondary">Staffs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-1"></i> <?= session()->getFlashdata('msg') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-1"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-normal text-secondary mb-0">
                                    <i class="fas fa-list mr-2"></i>Staff List
                                </h3>
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#addStaffModal">
                                    <i class="fas fa-plus mr-1"></i>Register Staff
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary text-uppercase">
                                            <th width="5%">#</th>
                                            <th width="35%">Full Name</th>
                                            <th width="20%">Phone</th>
                                            <th width="20%">Created</th>
                                            <th width="20%" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($staffs)): ?>
                                            <?php $i = 1; foreach ($staffs as $staff): ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td>
                                                    <strong><?= esc($staff['fname']) ?> <?= esc($staff['mname'] ?? '') ?> <?= esc($staff['lname']) ?></strong>
                                                </td>
                                                <td><?= esc($staff['phone']) ?></td>
                                                <td><?= date('M d, Y', strtotime($staff['created_at'])) ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-outline-secondary btn-xs mr-1" 
                                                            data-toggle="modal" data-target="#editStaffModal"
                                                            data-id="<?= $staff['id'] ?>"
                                                            data-fname="<?= esc($staff['fname']) ?>"
                                                            data-mname="<?= esc($staff['mname'] ?? '') ?>"
                                                            data-lname="<?= esc($staff['lname']) ?>"
                                                            data-phone="<?= esc($staff['phone']) ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="<?= base_url('staffs-delete/' . $staff['id']) ?>" 
                                                       class="btn btn-outline-danger btn-xs"
                                                       onclick="return confirm('Delete this staff?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-4">
                                                    <i class="fas fa-user-check fa-2x mb-2 d-block"></i>
                                                    No staff accounts yet
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

<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <form action="<?= base_url('staffs-save') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-normal text-secondary">
                        <i class="fas fa-user-plus mr-2"></i> Add Staff
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small text-secondary">First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First name" required>
                    </div>
                    <div class="form-group">
                        <label class="small text-secondary">Middle Name</label>
                        <input type="text" name="mname" class="form-control" placeholder="Middle name (optional)">
                    </div>
                    <div class="form-group">
                        <label class="small text-secondary">Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last name" required>
                    </div>
                    <div class="form-group">
                        <label class="small text-secondary">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="0917xxxxxxx" required>
                    </div>
                    <div class="form-group">
                        <label class="small text-secondary">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-secondary btn-sm px-4">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Staff Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <form action="<?= base_url('staffs-update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editId">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-normal text-secondary">
                        <i class="fas fa-user-edit mr-2"></i> Edit Staff
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small text-secondary">First Name</label>
                        <input type="text" name="fname" id="editFname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="small text-secondary">Middle Name</label>
                        <input type="text" name="mname" id="editMname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="small text-secondary">Last Name</label>
                        <input type="text" name="lname" id="editLname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="small text-secondary">Phone Number</label>
                        <input type="text" name="phone" id="editPhone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="small text-secondary">Password <span class="text-muted">(leave blank to keep)</span></label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-secondary btn-sm px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card { border-radius: 10px; }
.table td, .table th { vertical-align: middle; border-top: none; }
.table tbody tr { border-bottom: 1px solid #f3f4f6; }
.btn-xs { padding: 4px 8px; font-size: 12px; border-radius: 6px; }
.modal-content { border-radius: 12px; }
.custom-select, .form-control { border-radius: 8px; font-size: 0.9rem; }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$('#editStaffModal').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    $('#editId').val(button.data('id'));
    $('#editFname').val(button.data('fname'));
    $('#editMname').val(button.data('mname'));
    $('#editLname').val(button.data('lname'));
    $('#editPhone').val(button.data('phone'));
});
</script>
<?= $this->endSection() ?>