<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1><i class="fas fa-user-edit mr-2"></i>Edit Student</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('students') ?>">Students</a></li><li class="breadcrumb-item active">Edit</li></ol></div></div></div></div>

    <section class="content"><div class="container-fluid">
        <form action="<?= base_url('students-update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?><input type="hidden" name="id" value="<?= $student['id'] ?>">
            <div class="row"><div class="col-md-6"><div class="card shadow-sm border-0"><div class="card-header"><h5>Student Info</h5></div><div class="card-body">
                <div class="form-group text-center"><label>Student Picture</label>
                    <div id="studentPhotoPreview" style="width:130px;height:130px;margin:0 auto 10px;border-radius:50%;overflow:hidden;border:4px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;"><?php if(!empty($student['picture'])): ?><img src="<?= base_url('uploads/students/'.$student['picture']) ?>" style="width:100%;height:100%;object-fit:cover;"><?php else: ?><i class="fas fa-child fa-3x text-muted"></i><?php endif; ?></div>
                    <div class="btn-group btn-group-sm" role="group"><button type="button" class="btn btn-outline-secondary open-camera-btn"><i class="fas fa-camera mr-1"></i> Take Photo</button><label class="btn btn-outline-secondary mb-0" style="cursor:pointer;"><i class="fas fa-upload mr-1"></i> Upload<input type="file" name="picture" id="pictureInput" class="d-none" accept="image/*"></label></div>
                    <input type="hidden" name="picture_capture" id="pictureCapture">
                </div>
                <div class="row"><div class="col-4"><label>First Name</label><input type="text" name="fname" class="form-control" value="<?= esc($student['fname']) ?>" required></div><div class="col-4"><label>Middle Name</label><input type="text" name="mname" class="form-control" value="<?= esc($student['mname']??'') ?>"></div><div class="col-4"><label>Last Name</label><input type="text" name="lname" class="form-control" value="<?= esc($student['lname']) ?>" required></div></div>
                <div class="form-group"><label>Grade & Section</label><select name="grade_section" class="form-control" required><option value="">-- Select --</option><?php $g=['Kindergarten','Grade 1 - A','Grade 1 - B','Grade 2 - A','Grade 2 - B','Grade 3 - A','Grade 3 - B','Grade 4 - A','Grade 4 - B','Grade 5 - A','Grade 5 - B','Grade 6 - A','Grade 6 - B'];foreach($g as $x): ?><option value="<?= $x ?>" <?= $student['grade_section']==$x?'selected':'' ?>><?= $x ?></option><?php endforeach; ?></select></div>
            </div></div></div></div>
            <div class="text-right mt-3"><a href="<?= base_url('students-view/'.$student['id']) ?>" class="btn btn-outline-secondary">Cancel</a><button type="submit" class="btn btn-secondary px-4">Update</button></div>
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