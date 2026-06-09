<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-user-tie mr-2"></i>Staff Management
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Staffs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            
            <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle mr-1"></i> <?= session()->getFlashdata('msg') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle mr-1"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-list mr-2"></i>Staff List 
                                    <span class="badge badge-light ml-1"><?= count($staffs ?? []) ?></span>
                                </h5>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStaffModal">
                                    <i class="fas fa-plus mr-1"></i> Add Staff
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                                        </div>
                                        <input type="text" id="searchStaff" class="form-control" placeholder="Search name or phone...">
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary">
                                            <th style="width:40px;">#</th>
                                            <th>Full Name</th>
                                            <th style="width:150px;">Phone</th>
                                            <th style="width:130px;">Created</th>
                                            <th style="width:100px;" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($staffs)): ?>
                                            <?php $i = 1; foreach ($staffs as $staff): ?>
                                            <tr class="staff-row" data-search="<?= esc(strtolower($staff['fname'].' '.($staff['mname']??'').' '.$staff['lname'].' '.$staff['phone'])) ?>">
                                                <td class="text-muted small"><?= $i++ ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="img-circle bg-info d-flex align-items-center justify-content-center mr-2" style="width:40px;height:40px;min-width:40px;">
                                                            <i class="fas fa-user-tie text-white"></i>
                                                        </div>
                                                        <div>
                                                            <strong><?= esc($staff['fname']) ?> <?= esc($staff['lname']) ?></strong>
                                                            <?php if(!empty($staff['mname'])): ?>
                                                                <br><small class="text-muted"><?= esc($staff['mname']) ?></small>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><code><?= esc($staff['phone']) ?></code></td>
                                                <td class="small text-muted"><?= date('M d, Y', strtotime($staff['created_at'])) ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-outline-secondary btn-xs" 
                                                                data-toggle="modal" data-target="#editStaffModal"
                                                                data-id="<?= $staff['id'] ?>"
                                                                data-fname="<?= esc($staff['fname']) ?>"
                                                                data-mname="<?= esc($staff['mname'] ?? '') ?>"
                                                                data-lname="<?= esc($staff['lname']) ?>"
                                                                data-phone="<?= esc($staff['phone']) ?>"
                                                                title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <a href="<?= base_url('staffs-delete/' . $staff['id']) ?>" 
                                                           class="btn btn-outline-danger btn-xs"
                                                           onclick="return confirm('Delete this staff member?\n\n<?= esc($staff['fname']) ?> <?= esc($staff['lname']) ?>')"
                                                           title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-5">
                                                    <i class="fas fa-user-tie fa-3x mb-3 d-block"></i>
                                                    <h5>No staff accounts yet</h5>
                                                    <p class="small">Click "Add Staff" to register a new staff member.</p>
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


<div class="modal fade" id="addStaffModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="<?= base_url('staffs-save') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header bg-white border-0">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus mr-2 text-primary"></i>Register New Staff
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="small">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="fname" class="form-control form-control-sm" placeholder="Juan" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="small">Middle Name</label>
                                <input type="text" name="mname" class="form-control form-control-sm" placeholder="Dela">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="small">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="lname" class="form-control form-control-sm" placeholder="Cruz" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small">Phone Number <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">📱</span>
                            </div>
                            <input type="text" name="phone" class="form-control" placeholder="09XXXXXXXXX" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small">Password <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">🔒</span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Min. 6 characters" required minlength="6">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm px-4">
                        <i class="fas fa-save mr-1"></i> Save Staff
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editStaffModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="<?= base_url('staffs-update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editId">
                <div class="modal-header bg-white border-0">
                    <h5 class="modal-title">
                        <i class="fas fa-user-edit mr-2 text-warning"></i>Edit Staff
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="small">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="fname" id="editFname" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="small">Middle Name</label>
                                <input type="text" name="mname" id="editMname" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="small">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="lname" id="editLname" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small">Phone Number <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">📱</span>
                            </div>
                            <input type="text" name="phone" id="editPhone" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small">Password <span class="text-muted">(leave blank to keep current)</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">🔒</span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" minlength="6">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm px-4">
                        <i class="fas fa-check mr-1"></i> Update Staff
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card { border-radius: 10px; }
.table td, .table th { vertical-align: middle; border-top: none; }
.table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background 0.2s; }
.table tbody tr:hover { background: #f8f9fa; }
.btn-xs { padding: 4px 8px; font-size: 12px; border-radius: 6px; }
.img-circle { border-radius: 50%; }
.modal-content { border-radius: 12px; }
.form-control:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15); }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    // Search filter
    $('#searchStaff').on('keyup', function(){
        var val = $(this).val().toLowerCase();
        $('.staff-row').each(function(){
            var search = $(this).data('search');
            $(this).toggle(search.indexOf(val) > -1);
        });
    });

    // Edit modal - populate fields
    $('#editStaffModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        $('#editId').val(button.data('id'));
        $('#editFname').val(button.data('fname'));
        $('#editMname').val(button.data('mname'));
        $('#editLname').val(button.data('lname'));
        $('#editPhone').val(button.data('phone'));
    });

    // Auto-focus first field when add modal opens
    $('#addStaffModal').on('shown.bs.modal', function() {
        $(this).find('input[name="fname"]').focus();
    });

    // Auto-focus first field when edit modal opens
    $('#editStaffModal').on('shown.bs.modal', function() {
        $(this).find('input[name="fname"]').focus();
    });
});
</script>
<?= $this->endSection() ?>