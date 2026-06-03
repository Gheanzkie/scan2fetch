<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><i class="fas fa-user-edit mr-2"></i>Edit Parent</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li><li class="breadcrumb-item"><a href="<?= base_url('parents') ?>">Parents</a></li><li class="breadcrumb-item active">Edit</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('parents-update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $parent['id'] ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-header"><h5>Parent Information</h5></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4"><label>First Name</label><input type="text" name="fname" class="form-control" value="<?= esc($parent['fname']) ?>" required></div>
                                    <div class="col-4"><label>Middle Name</label><input type="text" name="mname" class="form-control" value="<?= esc($parent['mname'] ?? '') ?>"></div>
                                    <div class="col-4"><label>Last Name</label><input type="text" name="lname" class="form-control" value="<?= esc($parent['lname']) ?>" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6"><label>Phone</label><input type="text" name="phone" class="form-control" value="<?= esc($parent['phone']) ?>" required></div>
                                    <div class="col-6"><label>Password <small>(leave blank to keep)</small></label><input type="password" name="password" class="form-control"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-3">
                    <a href="<?= base_url('parents-view/'.$parent['id']) ?>" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-secondary px-4">Update</button>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>