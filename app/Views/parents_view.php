<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #6C8CFF;
    --soft-purple: #7C6CFF;
    --soft-pink: #FF8A9B;
    --soft-green: #66BB6A;
    --soft-orange: #FFB74D;
    --soft-teal: #4FC3F7;
}

body {
    background: linear-gradient(135deg, #f5f0ff 0%, #ffe8f0 100%) !important;
    color: #2d2d4a !important;
}

.content-wrapper { background: transparent !important; position: relative; z-index: 1; }

/* ===== CARDS ===== */
.card {
    border-radius: 28px !important;
    border: 2px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.85) !important;
    box-shadow: 0 8px 32px rgba(108,140,255,0.08) !important;
    overflow: hidden !important;
}

.card:hover { box-shadow: 0 16px 48px rgba(108,140,255,0.12) !important; }

.card-header {
    background: rgba(255,255,255,0.6) !important;
    border-bottom: 2px solid rgba(255,255,255,0.3) !important;
    padding: 1rem 1.5rem !important;
}

.card-header h5, .card-header h6 {
    color: #2d2d4a !important;
    font-weight: 700 !important;
}

.card-body { padding: 1.5rem !important; }

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 700 !important;
    padding: 8px 20px !important;
    font-size: 13px !important;
}

.btn-outline-secondary {
    border: 2px solid rgba(108,140,255,0.15) !important;
    color: #6a6a8a !important;
    background: rgba(255,255,255,0.3) !important;
}

.btn-outline-secondary:hover {
    background: rgba(108,140,255,0.08) !important;
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
}

.btn-outline-danger {
    border: 2px solid rgba(255,107,122,0.2) !important;
    color: #cc6a7a !important;
    background: transparent !important;
}

.btn-outline-danger:hover {
    background: rgba(255,107,122,0.08) !important;
    border-color: var(--soft-rose) !important;
    color: var(--soft-rose) !important;
}

.btn-outline-info {
    border: 2px solid rgba(79,172,254,0.2) !important;
    color: #4a7a9a !important;
    background: transparent !important;
}

.btn-outline-info:hover {
    background: rgba(79,172,254,0.08) !important;
    border-color: var(--soft-teal) !important;
    color: var(--soft-purple) !important;
}

.btn-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(108,140,255,0.3) !important;
}

.btn-primary:hover { box-shadow: 0 8px 25px rgba(108,140,255,0.4) !important; }

.btn-warning {
    background: linear-gradient(135deg, var(--soft-orange), #f57c00) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(255,183,77,0.3) !important;
}

.btn-warning:hover { box-shadow: 0 8px 25px rgba(255,183,77,0.4) !important; }

.btn-xs { padding: 4px 12px !important; font-size: 11px !important; border-radius: 50px !important; }

.btn-kid-success {
    background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(76,175,80,0.2) !important;
}

.btn-kid-success:hover { box-shadow: 0 8px 25px rgba(76,175,80,0.3) !important; }

/* ===== BADGES ===== */
.badge {
    font-weight: 700 !important;
    padding: 6px 16px !important;
    border-radius: 50px !important;
    font-size: 12px !important;
}

.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-light { background: rgba(108,140,255,0.08) !important; color: #2d2d4a !important; }

/* ===== ALERTS ===== */
.alert {
    border-radius: 20px !important;
    padding: 16px 24px !important;
    font-size: 15px !important;
    border: 2px solid transparent !important;
    font-weight: 600 !important;
}

.alert-success {
    background: rgba(102,187,106,0.12) !important;
    border-color: rgba(102,187,106,0.2) !important;
    color: #3a7a3a !important;
}

.alert-danger {
    background: rgba(255,107,122,0.12) !important;
    border-color: rgba(255,107,122,0.2) !important;
    color: #aa4a5a !important;
}

.alert-info {
    background: rgba(108,140,255,0.10) !important;
    border-color: rgba(108,140,255,0.2) !important;
    color: #4a5a8a !important;
}

/* ===== BREADCRUMB ===== */
.breadcrumb { background: transparent !important; padding: 0 !important; }
.breadcrumb-item a { color: #8888aa !important; font-weight: 600 !important; font-size: 15px !important; }
.breadcrumb-item a:hover { color: var(--soft-purple) !important; }
.breadcrumb-item.active { color: #2d2d4a !important; font-weight: 700 !important; font-size: 15px !important; }
.breadcrumb-item + .breadcrumb-item::before { color: #c0c0d8 !important; content: "›" !important; }

/* ===== CONTENT HEADER ===== */
.content-header h1 {
    color: #2d2d4a !important;
    font-weight: 800 !important;
    font-size: 2.2rem !important;
}

.content-header h1 i {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== MODAL ===== */
.modal-content {
    border-radius: 28px !important;
    border: 2px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.92) !important;
    box-shadow: 0 20px 60px rgba(108,140,255,0.08) !important;
}

.modal-header {
    border-bottom: 2px solid rgba(108,140,255,0.08) !important;
    border-radius: 28px 28px 0 0 !important;
    background: rgba(255,255,255,0.5) !important;
    padding: 1.2rem 1.8rem !important;
}

.modal-header h5 {
    color: #2d2d4a !important;
    font-weight: 700 !important;
    font-size: 1.3rem !important;
}

.modal-footer {
    border-top: 2px solid rgba(108,140,255,0.08) !important;
    border-radius: 0 0 28px 28px !important;
    background: rgba(255,255,255,0.3) !important;
    padding: 1rem 1.8rem !important;
}

.modal-body {
    padding: 1.8rem !important;
}

.modal-body label {
    font-weight: 700 !important;
    color: #2d2d4a !important;
    font-size: 14px !important;
}

/* ===== FORM CONTROLS ===== */
.form-control {
    background: rgba(255,255,255,0.85) !important;
    border: 2px solid rgba(108,140,255,0.12) !important;
    color: #2d2d4a !important;
    border-radius: 14px !important;
    padding: 12px 18px !important;
    font-size: 15px !important;
    height: 46px !important;
}

.form-control:focus {
    background: rgba(255,255,255,0.95) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(108,140,255,0.15) !important;
    color: #2d2d4a !important;
}

.form-control::placeholder {
    color: #8f8fae !important;
    opacity: 1;
    font-size: 14px !important;
}

.form-control-sm {
    border-radius: 12px !important;
    padding: 10px 16px !important;
    font-size: 14px !important;
    height: 40px !important;
}

.input-group-text {
    background: rgba(255,255,255,0.5) !important;
    border: 2px solid rgba(108,140,255,0.12) !important;
    border-right: none !important;
    color: #8888aa !important;
    border-radius: 14px 0 0 14px !important;
    font-size: 15px !important;
    padding: 0 18px !important;
}

.input-group .form-control {
    border-radius: 0 6px 6px 0 !important;
    border-left: none !important;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .content-header h1 { font-size: 1.5rem !important; }
    #parentPhotoContainer { width: 100px !important; height: 100px !important; }
    .photo-preview { width: 60px; height: 60px; }
    .btn { font-size: 12px !important; padding: 6px 14px !important; }
    .form-control { font-size: 14px !important; height: 42px !important; }
}

@media (max-width: 480px) {
    .card { border-radius: 18px !important; }
    #parentPhotoContainer { width: 80px !important; height: 80px !important; }
    .photo-preview { width: 50px; height: 50px; }
    .modal-body { padding: 1rem !important; }
    .btn { font-size: 11px !important; padding: 4px 10px !important; }
}
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-user mr-2"></i>
                        Parent / Fetcher Details
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item"><a href="<?= base_url('parents') ?>">Parents</a></li>
 <li class="breadcrumb-item active">Details</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">
 <?php if(session()->getFlashdata('msg')): ?>
 <div class="alert alert-success"> <?= session()->getFlashdata('msg') ?></div>
 <?php endif; ?>
 <?php if(session()->getFlashdata('error')): ?>
 <div class="alert alert-danger"> <?= session()->getFlashdata('error') ?></div>
 <?php endif; ?>

 <div class="row">
 <!-- ===== LEFT: Parent Profile + Sub-Fetchers ===== -->
 <div class="col-md-4">
                    
 <!-- ===== PARENT PROFILE WITH PHOTO UPLOAD ===== -->
 <div class="card">
 <div class="card-body text-center">
                            
 <!-- Parent Info -->
 <h3 class="mt-3 mb-0" style="color: #2d2d4a;"><?= esc($parent['fname']) ?> <?= esc($parent['lname']) ?></h3>
 <p class="text-muted mb-2" style="color: #8888aa !important;">
 <i class="fas fa-phone mr-1"></i> <?= esc($parent['phone']) ?>
 </p>
                            
 <!-- QR Code -->
 <?php if(!empty($parent['qr_code'])): ?>
 <div class="mb-2">
 <img src="<?= base_url('uploads/qr/'.$parent['qr_code'].'.png') ?>" 
                                     style="width:100px;height:100px;border:3px solid var(--soft-blue);border-radius:12px;cursor:pointer;" 
                                     onclick="openQrModal('<?= base_url('uploads/qr/'.$parent['qr_code'].'.png') ?>')">
 </div>
 <?php endif; ?>

 <!-- Action Buttons (Edit / Reset Password / Delete now live in the Parents list) -->
 </div>
 </div>

 <!-- ===== SUB-FETCHERS ===== -->
 <div class="card mt-3">
 <div class="card-header d-flex justify-content-between align-items-center">
 <h6 class="mb-0">
 <i class="fas fa-user-friends mr-2" style="color: var(--soft-green);"></i>
                                Sub-Fetchers (<?= count($subFetchers ?? []) ?>/2)
 </h6>
 <?php if(count($subFetchers ?? []) < 2 && !empty($students)): ?>
 <button class="btn btn-outline-secondary btn-xs" data-toggle="modal" data-target="#addSubFetcherModal">
 <i class="fas fa-plus"></i> Add
 </button>
 <?php endif; ?>
 </div>
 <div class="card-body">
 <?php if(!empty($subFetchers)): foreach($subFetchers as $f): ?>
 <div class="d-flex align-items-center border rounded p-2 mb-2" style="border-color: rgba(108,140,255,0.08) !important;">
 <div class="mr-2">
 <div class="img-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;border:2px solid var(--soft-green);background:rgba(255,255,255,0.3);">
 <i class="fas fa-user" style="color: #b0b0c8;"></i>
 </div>
 </div>
 <div class="flex-grow-1">
 <strong style="color: #2d2d4a;"><?= esc($f['fname']) ?> <?= esc($f['lname']) ?></strong>
 <br><small style="color: #b0b0c8;"><?= esc($f['phone']) ?></small>
 </div>
 <?php if(!empty($f['qr_code'])): ?>
 <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" 
                                         style="width:35px;height:35px;border:2px solid var(--soft-blue);border-radius:8px;cursor:pointer;margin-right:4px;" 
                                         onclick="openQrModal('<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>')">
 <?php endif; ?>
 <button class="btn btn-outline-secondary btn-xs mr-1 edit-subfetcher-btn" 
                                        data-id="<?= $f['id'] ?>" 
                                        data-fname="<?= esc($f['fname']) ?>" 
                                        data-mname="<?= esc($f['mname']??'') ?>" 
                                        data-lname="<?= esc($f['lname']) ?>" 
                                        data-phone="<?= esc($f['phone']) ?>" 
                                        data-toggle="modal" data-target="#editSubFetcherModal">
 <i class="fas fa-pencil-alt"></i>
 </button>
 <a href="<?= base_url('subfetchers-delete/'.$parent['id'].'/'.$f['id']) ?>" 
                                   class="btn btn-outline-danger btn-xs" 
                                   onclick="return confirm('Remove this sub-fetcher?')">
 <i class="fas fa-times"></i>
 </a>
 </div>
 <?php endforeach; else: ?>
 <p class="text-center text-muted small py-2 mb-0" style="color: #b0b0c8 !important;">
                                No sub-fetchers yet
 </p>
 <?php endif; ?>
 </div>
 </div>
 </div>

 <!-- ===== RIGHT: Linked Students ===== -->
 <div class="col-md-8">
 <?php if(!empty($students)): foreach($students as $s): ?>
 <div class="card mb-3">
 <div class="card-header d-flex justify-content-between align-items-center">
 <h5 class="mb-0">
 <a href="<?= base_url('students-view/'.$s['student_id']) ?>" style="color: #2d2d4a; text-decoration:none;">
 <i class="fas fa-user-graduate mr-2" style="color: var(--soft-blue);"></i>
 <?= esc($s['fname']) ?> <?= esc($s['lname']) ?>
 <small style="color: #b0b0c8; font-size: 13px;">(<?= esc($s['grade_section']) ?>)</small>
 </a>
 </h5>
 <a href="<?= base_url('students-view/'.$s['student_id']) ?>" class="btn btn-outline-info btn-xs">
 <i class="fas fa-eye"></i> Go to Student
 </a>
 </div>
 <div class="card-body">
 <div class="row">
 <div class="col-md-6">
 <p class="mb-1"><strong style="color: #2d2d4a;">Student:</strong>
 <a href="<?= base_url('students-view/'.$s['student_id']) ?>" style="color: var(--soft-purple); font-weight:700; text-decoration:none;">
 <?= esc($s['fname']) ?> <?= esc($s['lname']) ?>
 </a>
 </p>
 <p class="mb-1"><strong style="color: #2d2d4a;">Grade:</strong> <?= esc($s['grade_section']) ?></p>
 <?php if (!empty($teacherMap[$s['grade_section']] ?? '')): ?>
 <p class="mb-1"><strong style="color: #2d2d4a;">Teacher:</strong> <i class="fas fa-chalkboard-teacher" style="color: #7a5ad0;"></i> <?= esc($teacherMap[$s['grade_section']]) ?></p>
 <?php endif; ?>
 <p class="mb-0"><strong style="color: #2d2d4a;">Relation:</strong> <span class="badge badge-primary"><?= esc($s['relation'] ?? 'Parent') ?></span></p>
 </div>
 <div class="col-md-6 text-right">
 <a href="<?= base_url('students-view/'.$s['student_id']) ?>">
 <div class="img-circle d-inline-flex align-items-center justify-content-center" 
                                              style="width:70px;height:70px;border:3px solid var(--soft-blue);background:rgba(255,255,255,0.3);cursor:pointer;">
 <i class="fas fa-child fa-2x" style="color: #b0b0c8;"></i>
 </div>
 </a>
 </div>
 </div>
 </div>
 </div>
 <?php endforeach; else: ?>
 <div class="card">
 <div class="card-body text-center py-5" style="color: #b0b0c8;">
 <i class="fas fa-user-graduate fa-3x mb-3 d-block" style="color: rgba(108,140,255,0.12);"></i>
 <h5 style="color: #7a7a9a;">No students linked</h5>
 </div>
 </div>
 <?php endif; ?>
 </div>
 </div>
 </div>
 </section>
</div>

<!-- ===== ADD SUB-FETCHER MODAL ===== -->
<div class="modal fade" id="addSubFetcherModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <form action="<?= base_url('subfetchers-save') ?>" method="post" enctype="multipart/form-data">
 <?= csrf_field() ?>
 <input type="hidden" name="parent_id" value="<?= $parent['id'] ?>">
 <?php if(!empty($students)): ?>
 <input type="hidden" name="student_id" value="<?= $students[0]['student_id'] ?>">
 <?php endif; ?>
                
 <div class="modal-header">
 <h5><i class="fas fa-user-plus mr-2" style="color: var(--soft-green);"></i>Add Sub-Fetcher</h5>
 <button type="button" class="close" data-dismiss="modal" style="color: #2d2d4a;">&times;</button>
 </div>
 <div class="modal-body">
 <div class="alert alert-info mb-3" style="font-size:13px;padding:10px 14px;">
 <i class="fas fa-info-circle mr-1"></i> 
                        Sub-fetcher will be linked to <strong><?= esc($parent['fname']) ?> <?= esc($parent['lname']) ?></strong>'s account.
 <?php if(!empty($students)): ?>
 <br>Authorized to pick up: <strong><?= esc($students[0]['fname']) ?> <?= esc($students[0]['lname']) ?></strong>
 <?php endif; ?>
 </div>
                    
 <div class="row">
 <div class="col-4">
 <label>First Name <span class="text-danger">*</span></label>
 <input type="text" name="fname" class="form-control form-control-sm" required>
 </div>
 <div class="col-4">
 <label>Middle Name</label>
 <input type="text" name="mname" class="form-control form-control-sm">
 </div>
 <div class="col-4">
 <label>Last Name <span class="text-danger">*</span></label>
 <input type="text" name="lname" class="form-control form-control-sm" required>
 </div>
 </div>
 <div class="form-group">
 <label> Phone <span class="text-danger">*</span></label>
 <input type="text" name="phone" class="form-control form-control-sm" required>
 </div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
 <button type="submit" class="btn btn-primary btn-sm px-4">
 <i class="fas fa-save mr-1"></i> Save
 </button>
 </div>
 </form>
 </div>
 </div>
</div>

<!-- ===== EDIT SUB-FETCHER MODAL ===== -->
<div class="modal fade" id="editSubFetcherModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <form action="<?= base_url('subfetchers-update') ?>" method="post" enctype="multipart/form-data">
 <?= csrf_field() ?>
 <input type="hidden" name="id" id="editSubFetcherId">
 <input type="hidden" name="parent_id" value="<?= $parent['id'] ?>">
 <div class="modal-header">
 <h5><i class="fas fa-edit mr-2" style="color: var(--soft-orange);"></i>Edit Sub-Fetcher</h5>
 <button type="button" class="close" data-dismiss="modal" style="color: #2d2d4a;">&times;</button>
 </div>
 <div class="modal-body">
 <div class="row">
 <div class="col-4">
 <label>First Name <span class="text-danger">*</span></label>
 <input type="text" name="fname" id="editSubFetcherFname" class="form-control form-control-sm" required>
 </div>
 <div class="col-4">
 <label>Middle Name</label>
 <input type="text" name="mname" id="editSubFetcherMname" class="form-control form-control-sm">
 </div>
 <div class="col-4">
 <label>Last Name <span class="text-danger">*</span></label>
 <input type="text" name="lname" id="editSubFetcherLname" class="form-control form-control-sm" required>
 </div>
 </div>
 <div class="form-group">
 <label> Phone <span class="text-danger">*</span></label>
 <input type="text" name="phone" id="editSubFetcherPhone" class="form-control form-control-sm" required>
 </div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
 <button type="submit" class="btn btn-warning btn-sm px-4">
 <i class="fas fa-check mr-1"></i> Update
 </button>
 </div>
 </form>
 </div>
 </div>
</div>

<!-- ===== QR MODAL ===== -->
<div class="modal fade" id="qrModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content">
 <div class="modal-header">
 <h5><i class="fas fa-qrcode mr-2" style="color: var(--soft-blue);"></i>QR Code</h5>
 <button type="button" class="close" data-dismiss="modal" style="color: #2d2d4a;">&times;</button>
 </div>
 <div class="modal-body text-center" style="background: #fff; border-radius: 0 0 25px 25px; padding: 30px;">
 <img id="qrFullImage" src="" style="max-width:100%;max-height:65vh;">
 </div>
 <div class="modal-footer">
 <a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary btn-sm">
 <i class="fas fa-download"></i> Download
 </a>
 <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
 </div>
 </div>
 </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    // ===== EDIT SUB-FETCHER - POPULATE FIELDS =====
    $(document).on('click', '.edit-subfetcher-btn', function() {
        $('#editSubFetcherId').val($(this).data('id'));
        $('#editSubFetcherFname').val($(this).data('fname'));
        $('#editSubFetcherMname').val($(this).data('mname'));
        $('#editSubFetcherLname').val($(this).data('lname'));
        $('#editSubFetcherPhone').val($(this).data('phone'));
    });

    // ===== OPEN QR MODAL =====
    function openQrModal(u) {
        if (!u) { 
            alert(' No QR code available. '); 
            return; 
        }
        $('#qrFullImage').attr('src', u);
        $('#qrDownloadBtn').attr('href', u);
        $('#qrModal').modal('show');
    }
});
</script>
<?= $this->endSection() ?>