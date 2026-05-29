<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><i class="fas fa-user-edit mr-2"></i>Edit Parent</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('parents') ?>">Parents</a></li><li class="breadcrumb-item active">Edit</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('parents-update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?><input type="hidden" name="id" value="<?= $parent['id'] ?>">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-header"><h5><i class="fas fa-user mr-2"></i>Parent Info</h5></div>
                            <div class="card-body">
                                
                                <div class="form-group text-center">
                                    <label>Profile Picture</label>
                                    <div id="parentPhotoPreview" style="width:150px;height:150px;margin:0 auto 10px;border-radius:50%;overflow:hidden;border:4px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
                                        <?php if (!empty($parent['picture'])): ?>
                                            <img src="<?= base_url('uploads/parents/'.$parent['picture']) ?>" style="width:100%;height:100%;object-fit:cover;">
                                        <?php else: ?>
                                            <i class="fas fa-user fa-3x text-muted"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-secondary" id="openCameraBtn"><i class="fas fa-camera mr-1"></i> Take Photo</button>
                                        <label class="btn btn-outline-secondary mb-0" style="cursor:pointer;">
                                            <i class="fas fa-upload mr-1"></i> Upload
                                            <input type="file" name="picture" id="pictureInput" class="d-none" accept="image/*">
                                        </label>
                                    </div>
                                    <input type="hidden" name="picture_capture" id="pictureCapture">
                                </div>

                                <div class="row">
                                    <div class="col-4"><label>First Name</label><input type="text" name="fname" class="form-control" value="<?= esc($parent['fname']) ?>" required></div>
                                    <div class="col-4"><label>Middle Name</label><input type="text" name="mname" class="form-control" value="<?= esc($parent['mname'] ?? '') ?>"></div>
                                    <div class="col-4"><label>Last Name</label><input type="text" name="lname" class="form-control" value="<?= esc($parent['lname']) ?>" required></div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Phone</label><input type="text" name="phone" class="form-control" value="<?= esc($parent['phone']) ?>" required></div>
                                    <div class="col-6"><label>Password <small>(leave blank)</small></label><input type="password" name="password" class="form-control"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-header"><h5><i class="fas fa-child mr-2"></i>Students</h5></div>
                            <div class="card-body">
                                <?php if (!empty($students)): ?>
                                    <?php foreach ($students as $s): ?>
                                    <div class="border rounded p-3 mb-2">
                                        <input type="hidden" name="student_id[]" value="<?= $s['id'] ?>">
                                        <div class="row">
                                            <div class="col-4"><label class="small">First Name</label><input type="text" name="student_fname[]" class="form-control form-control-sm" value="<?= esc($s['fname']) ?>" required></div>
                                            <div class="col-4"><label class="small">Middle Name</label><input type="text" name="student_mname[]" class="form-control form-control-sm" value="<?= esc($s['mname'] ?? '') ?>"></div>
                                            <div class="col-4"><label class="small">Last Name</label><input type="text" name="student_lname[]" class="form-control form-control-sm" value="<?= esc($s['lname']) ?>" required></div>
                                        </div>
                                        <div class="form-group mb-0"><label class="small">Grade & Section</label><input type="text" name="grade_section[]" class="form-control form-control-sm" value="<?= esc($s['grade_section']) ?>" required></div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?><p class="text-muted">No students</p><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <a href="<?= base_url('parents-view/'.$parent['id']) ?>" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-secondary px-4">Update All</button>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- Camera Modal (same as add) -->
<div class="modal fade" id="cameraModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0"><h6><i class="fas fa-camera mr-2"></i>Take Photo</h6><button type="button" class="close" data-dismiss="modal">&times;</button></div>
            <div class="modal-body text-center p-2">
                <video id="cameraVideo" autoplay playsinline style="width:100%;max-height:350px;border-radius:8px;background:#000;"></video>
                <canvas id="cameraCanvas" style="display:none;"></canvas>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="captureBtn"><i class="fas fa-camera"></i> Capture</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function() {
    var stream;
    $('#pictureInput').on('change',function(){
        var f=this.files[0];
        if(f){var r=new FileReader();r.onload=function(e){$('#parentPhotoPreview').html('<img src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;">');};r.readAsDataURL(f);}
    });
    $('#openCameraBtn').click(function(){
        $('#cameraModal').modal('show');
        setTimeout(function(){
            navigator.mediaDevices.getUserMedia({video:{facingMode:"user",width:400,height:400}})
            .then(function(s){stream=s;$('#cameraVideo')[0].srcObject=s;})
            .catch(function(err){alert('Camera error: '+err.message);});
        },500);
    });
    $('#captureBtn').click(function(){
        var v=$('#cameraVideo')[0],c=$('#cameraCanvas')[0];
        c.width=v.videoWidth||400;c.height=v.videoHeight||400;
        c.getContext('2d').drawImage(v,0,0);
        var d=c.toDataURL('image/png');
        $('#parentPhotoPreview').html('<img src="'+d+'" style="width:100%;height:100%;object-fit:cover;">');
        $('#pictureCapture').val(d);
        if(stream){stream.getTracks().forEach(function(t){t.stop();});}
        $('#cameraModal').modal('hide');
    });
    $('#cameraModal').on('hidden.bs.modal',function(){if(stream){stream.getTracks().forEach(function(t){t.stop();});}});
});
</script>
<?= $this->endSection() ?>