<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1><i class="fas fa-user-plus mr-2"></i>Add Student & Parents/Fetchers</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('students') ?>">Students</a></li><li class="breadcrumb-item active">Add</li></ol></div></div></div></div>

    <section class="content"><div class="container-fluid">
        <form action="<?= base_url('students-save') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                
                <div class="col-md-6">
                    <div class="card shadow-sm border-0"><div class="card-header"><h5><i class="fas fa-user-graduate mr-2"></i>Student Information</h5></div><div class="card-body">
                        <div class="form-group text-center">
                            <label>Student Picture</label>
                            <div id="studentPhotoPreview" style="width:130px;height:130px;margin:0 auto 10px;border-radius:50%;overflow:hidden;border:4px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;"><i class="fas fa-child fa-3x text-muted"></i></div>
                            <div class="btn-group btn-group-sm" role="group"><button type="button" class="btn btn-outline-secondary open-camera-btn"><i class="fas fa-camera mr-1"></i> Take Photo</button><label class="btn btn-outline-secondary mb-0" style="cursor:pointer;"><i class="fas fa-upload mr-1"></i> Upload<input type="file" name="picture" id="pictureInput" class="d-none" accept="image/*"></label></div>
                            <input type="hidden" name="picture_capture" id="pictureCapture">
                        </div>
                        <div class="row"><div class="col-4"><label>First Name *</label><input type="text" name="fname" class="form-control" required></div><div class="col-4"><label>Middle Name</label><input type="text" name="mname" class="form-control"></div><div class="col-4"><label>Last Name *</label><input type="text" name="lname" class="form-control" required></div></div>
                        <div class="form-group"><label>Grade & Section *</label><select name="grade_section" class="form-control" required><option value="">Select</option><option>Kindergarten</option><option>Grade 1 - A</option><option>Grade 1 - B</option><option>Grade 2 - A</option><option>Grade 2 - B</option><option>Grade 3 - A</option><option>Grade 3 - B</option><option>Grade 4 - A</option><option>Grade 4 - B</option><option>Grade 5 - A</option><option>Grade 5 - B</option><option>Grade 6 - A</option><option>Grade 6 - B</option></select></div>
                    </div></div>
                </div>

                
                <div class="col-md-6">
                    <div class="card shadow-sm border-0"><div class="card-header"><h5 class="mb-0"><i class="fas fa-users mr-2"></i>Parent / Guardians / Fetchers</h5></div>
                    <div class="card-body">
                        
                        
                        <div class="border rounded p-3 mb-3" style="border-left: 4px solid #667eea;">
                            <h6 class="text-muted mb-2"><i class="fas fa-user mr-1"></i> Parent / Guardian (Required)</h6>
                            <div class="row"><div class="col-4"><label class="small">First Name *</label><input type="text" name="parent_fname[]" class="form-control form-control-sm" required></div><div class="col-4"><label class="small">Middle Name</label><input type="text" name="parent_mname[]" class="form-control form-control-sm"></div><div class="col-4"><label class="small">Last Name *</label><input type="text" name="parent_lname[]" class="form-control form-control-sm" required></div></div>
                            <div class="row"><div class="col-6"><label class="small">Phone *</label><input type="text" name="parent_phone[]" class="form-control form-control-sm" required></div><div class="col-6"><label class="small">Password *</label><input type="password" name="parent_password[]" class="form-control form-control-sm" required></div></div>
                            <input type="hidden" name="parent_relation[]" value="Parent">
                        </div>

                        
                        <div class="border rounded p-3 mb-2" style="border-left: 4px solid #28a745;">
                            <div class="d-flex justify-content-between"><h6 class="text-muted mb-2"><i class="fas fa-user-friends mr-1"></i> Fetcher 1 (Optional)</h6></div>
                            <div class="row"><div class="col-4"><label class="small">First Name</label><input type="text" name="fetcher_fname[]" class="form-control form-control-sm"></div><div class="col-4"><label class="small">Middle Name</label><input type="text" name="fetcher_mname[]" class="form-control form-control-sm"></div><div class="col-4"><label class="small">Last Name</label><input type="text" name="fetcher_lname[]" class="form-control form-control-sm"></div></div>
                            <div class="row"><div class="col-12"><label class="small">Phone</label><input type="text" name="fetcher_phone[]" class="form-control form-control-sm"></div></div>
                        </div>

                        
                        <div class="border rounded p-3 mb-2" style="border-left: 4px solid #ffc107;">
                            <div class="d-flex justify-content-between"><h6 class="text-muted mb-2"><i class="fas fa-user-friends mr-1"></i> Fetcher 2 (Optional)</h6></div>
                            <div class="row"><div class="col-4"><label class="small">First Name</label><input type="text" name="fetcher_fname[]" class="form-control form-control-sm"></div><div class="col-4"><label class="small">Middle Name</label><input type="text" name="fetcher_mname[]" class="form-control form-control-sm"></div><div class="col-4"><label class="small">Last Name</label><input type="text" name="fetcher_lname[]" class="form-control form-control-sm"></div></div>
                            <div class="row"><div class="col-12"><label class="small">Phone</label><input type="text" name="fetcher_phone[]" class="form-control form-control-sm"></div></div>
                        </div>

                    </div></div>
                </div>
            </div>
            <div class="text-right mt-3"><a href="<?= base_url('students') ?>" class="btn btn-outline-secondary">Cancel</a><button type="submit" class="btn btn-secondary px-4">Save All</button></div>
        </form>
    </div></section>
</div>

<div class="modal fade" id="cameraModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content border-0 shadow"><div class="modal-header border-0 pb-0"><h6><i class="fas fa-camera mr-2"></i>Take Photo</h6><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body text-center p-2"><video id="cameraVideo" autoplay playsinline style="width:100%;max-height:350px;border-radius:8px;background:#000;"></video><canvas id="cameraCanvas" style="display:none;"></canvas><button type="button" class="btn btn-primary btn-sm mt-2" id="captureBtn"><i class="fas fa-camera"></i> Capture</button></div></div></div></div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
$(function(){var s;$('#pictureInput').on('change',function(){var f=this.files[0];if(f){var r=new FileReader();r.onload=function(e){$('#studentPhotoPreview').html('<img src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;">')};r.readAsDataURL(f)}});
$('.open-camera-btn').click(function(){$('#cameraModal').modal('show');setTimeout(function(){navigator.mediaDevices.getUserMedia({video:{facingMode:"user",width:400,height:400}}).then(function(st){s=st;$('#cameraVideo')[0].srcObject=s}).catch(function(e){alert('Camera error: '+e.message)})},500)});
$('#captureBtn').click(function(){var v=$('#cameraVideo')[0],c=$('#cameraCanvas')[0];c.width=v.videoWidth||400;c.height=v.videoHeight||400;c.getContext('2d').drawImage(v,0,0);var d=c.toDataURL('image/png');$('#studentPhotoPreview').html('<img src="'+d+'" style="width:100%;height:100%;object-fit:cover;">');$('#pictureCapture').val(d);if(s){s.getTracks().forEach(function(t){t.stop()})}$('#cameraModal').modal('hide')});
$('#cameraModal').on('hidden.bs.modal',function(){if(s){s.getTracks().forEach(function(t){t.stop()})}})});
</script>
<?= $this->endSection() ?>