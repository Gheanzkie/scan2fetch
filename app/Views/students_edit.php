<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #6C8CFF;
    --soft-purple: #7C6CFF;
    --soft-pink: #FF8A9B;
    --soft-green: #66BB6A;
    --soft-orange: #FFB74D;
}

body {
    background: linear-gradient(135deg, #f5f0ff 0%, #ffe8f0 100%) !important;
    color: #2d2d4a !important;
}

.content-wrapper { background: transparent !important; position: relative; z-index: 1; }

.card {
    border-radius: 28px !important;
    border: 2px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.85) !important;
    box-shadow: 0 8px 32px rgba(108,140,255,0.08) !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
}

.card:hover { box-shadow: 0 16px 48px rgba(108,140,255,0.12) !important; }

.card-header {
    background: rgba(255,255,255,0.6) !important;
    border-bottom: 2px solid rgba(255,255,255,0.3) !important;
    padding: 1.2rem 1.8rem !important;
}

.card-header h5 {
    color: #2d2d4a !important;
    font-weight: 700 !important;
    font-size: 1.25rem !important;
}

.card-body { padding: 1.8rem !important; }

.form-control {
    background: rgba(255,255,255,0.85) !important;
    border: 2px solid rgba(108,140,255,0.12) !important;
    color: #2d2d4a !important;
    border-radius: 14px !important;
    padding: 14px 20px !important;
    font-size: 16px !important;
    height: 52px !important;
    transition: all 0.3s ease !important;
}

.form-control:focus {
    background: rgba(255,255,255,0.95) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(108,140,255,0.15) !important;
    color: #2d2d4a !important;
}

select.form-control {
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 12 12'%3E%3Cpath fill='%236a6a8a' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 18px center;
    padding-right: 48px !important;
    cursor: pointer;
}

select.form-control option {
    background: #ffffff !important;
    color: #2d2d4a !important;
    padding: 12px !important;
}

label {
    font-weight: 700 !important;
    color: #2d2d4a !important;
    font-size: 15px !important;
}

.btn {
    border-radius: 50px !important;
    font-weight: 700 !important;
    transition: all 0.3s ease !important;
    padding: 12px 32px !important;
    font-size: 15px !important;
}

.btn-warning {
    background: linear-gradient(135deg, var(--soft-orange), #f57c00) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(255,183,77,0.3) !important;
}

.btn-warning:hover { box-shadow: 0 8px 25px rgba(255,183,77,0.4) !important; }

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

.breadcrumb { background: transparent !important; padding: 0 !important; }
.breadcrumb-item a { color: #8888aa !important; font-weight: 600 !important; font-size: 15px !important; }
.breadcrumb-item a:hover { color: var(--soft-purple) !important; }
.breadcrumb-item.active { color: #2d2d4a !important; font-weight: 700 !important; font-size: 15px !important; }
.breadcrumb-item + .breadcrumb-item::before { color: #c0c0d8 !important; content: "›" !important; }

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

#studentPhotoPreview {
    border: 4px solid var(--soft-blue) !important;
    box-shadow: 0 4px 15px rgba(108,140,255,0.15) !important;
    transition: all 0.3s ease !important;
}

@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    .content-header h1 { font-size: 1.5rem !important; }
    .form-control { font-size: 14px !important; height: 46px !important; }
    .btn { font-size: 12px !important; padding: 8px 16px !important; }
}
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-user-edit mr-2"></i>
                        Edit Student
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('students') ?>">Students</a></li>
 <li class="breadcrumb-item active">Edit</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">
 <form action="<?= base_url('students-update') ?>" method="post" enctype="multipart/form-data">
 <?= csrf_field() ?>
 <input type="hidden" name="id" value="<?= $student['id'] ?>">
 <div class="row">
 <div class="col-md-6">
 <div class="card">
 <div class="card-header">
 <h5> Student Information</h5>
 </div>
 <div class="card-body">
 <div class="form-group text-center">
 <label> Student Picture</label>
 <div id="studentPhotoPreview" style="width:130px;height:130px;margin:0 auto 10px;border-radius:50%;overflow:hidden;border:4px solid var(--soft-blue);background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
 <?php if(!empty($student['picture'])): ?>
 <img src="<?= base_url('uploads/students/'.$student['picture']) ?>" style="width:100%;height:100%;object-fit:cover;">
 <?php else: ?>
 <i class="fas fa-child fa-3x" style="color: #b0b0c8;"></i>
 <?php endif; ?>
 </div>
 <div class="btn-group btn-group-sm" role="group">
 <button type="button" class="btn btn-outline-secondary open-camera-btn"><i class="fas fa-camera mr-1"></i> Take Photo</button>
 <label class="btn btn-outline-secondary mb-0" style="cursor:pointer;"><i class="fas fa-upload mr-1"></i> Upload<input type="file" name="picture" id="pictureInput" class="d-none" accept="image/*"></label>
 </div>
 <input type="hidden" name="picture_capture" id="pictureCapture">
 </div>
 <div class="row">
 <div class="col-4">
 <label>First Name <span class="text-danger">*</span></label>
 <input type="text" name="fname" class="form-control" value="<?= esc($student['fname']) ?>" required>
 </div>
 <div class="col-4">
 <label>Middle Name</label>
 <input type="text" name="mname" class="form-control" value="<?= esc($student['mname']??'') ?>">
 </div>
 <div class="col-4">
 <label>Last Name <span class="text-danger">*</span></label>
 <input type="text" name="lname" class="form-control" value="<?= esc($student['lname']) ?>" required>
 </div>
 </div>
 <div class="form-group mt-3">
 <label> Grade & Section <span class="text-danger">*</span></label>
 <select name="grade_section" class="form-control" required>
 <option value="">-- Select --</option>
 <?php $g=['Kindergarten','Grade 1 - A','Grade 1 - B','Grade 2 - A','Grade 2 - B','Grade 3 - A','Grade 3 - B','Grade 4 - A','Grade 4 - B','Grade 5 - A','Grade 5 - B','Grade 6 - A','Grade 6 - B'];foreach($g as $x): ?>
 <option value="<?= $x ?>" <?= $student['grade_section']==$x?'selected':'' ?>><?= $x ?></option>
 <?php endforeach; ?>
 </select>
 </div>
 </div>
 </div>
 </div>
 </div>
 <div class="text-right mt-3" style="display: flex; gap: 10px; justify-content: flex-end;">
 <a href="<?= base_url('students-view/'.$student['id']) ?>" class="btn btn-outline-secondary">Cancel</a>
 <button type="submit" class="btn btn-warning px-4">
 <i class="fas fa-check mr-1"></i> Update Student
 </button>
 </div>
 </form>
 </div>
 </section>
</div>

<!-- Camera Modal -->
<div class="modal fade" id="cameraModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <div class="modal-header">
 <h6><i class="fas fa-camera mr-2" style="color: var(--soft-blue);"></i>Take Photo</h6>
 <button type="button" class="close" data-dismiss="modal" style="color: #2d2d4a;">&times;</button>
 </div>
 <div class="modal-body text-center p-2" style="background: #f5f0ff; border-radius: 0 0 20px 20px;">
 <video id="cameraVideo" autoplay playsinline style="width:100%;max-height:350px;border-radius:12px;background:#000;"></video>
 <canvas id="cameraCanvas" style="display:none;"></canvas>
 <button type="button" class="btn btn-primary btn-sm mt-2" id="captureBtn"><i class="fas fa-camera"></i> Capture</button>
 <button type="button" class="btn btn-outline-secondary btn-sm mt-2 ml-1" id="cameraFallbackBtn">
 <i class="fas fa-mobile-alt mr-1"></i> Use Phone Camera / Upload
 </button>
 <input type="file" id="cameraFallbackInput" class="d-none" accept="image/*" capture="environment">
 </div>
 </div>
 </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function() {
    var s;

    $('#pictureInput').on('change', function() {
        var f = this.files[0];
        if (f) {
            var r = new FileReader();
            r.onload = function(e) {
                $('#studentPhotoPreview').html('<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">');
            };
            r.readAsDataURL(f);
        }
    });

    $('.open-camera-btn').click(function() {
        $('#cameraModal').modal('show');
        // Chrome blocks the in-page camera on plain http:// (non-localhost).
        // Open the phone's native camera app directly instead.
        if (!window.isSecureContext && !/^(localhost|127\.0\.0\.1)$/.test(location.hostname)) {
            $('#cameraFallbackInput').click();
            return;
        }
        setTimeout(function() {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "user", width: 400, height: 400 } })
            .then(function(st) { s = st; $('#cameraVideo')[0].srcObject = s; })
            .catch(function() { $('#cameraFallbackBtn').show(); });
        }, 500);
    });

    $('#cameraFallbackBtn').click(function() {
        $('#cameraFallbackInput').click();
    });

    $('#cameraFallbackInput').on('change', function() {
        var f = this.files[0];
        if (!f) return;
        var r2 = new FileReader();
        r2.onload = function(e) {
            $('#studentPhotoPreview').html('<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">');
            $('#pictureCapture').val(e.target.result);
            $('#cameraModal').modal('hide');
        };
        r2.readAsDataURL(f);
        this.value = '';
    });

    $('#captureBtn').click(function() {
        var v = $('#cameraVideo')[0], c = $('#cameraCanvas')[0];
        c.width = v.videoWidth || 400; c.height = v.videoHeight || 400;
        c.getContext('2d').drawImage(v, 0, 0);
        var d = c.toDataURL('image/png');
        $('#studentPhotoPreview').html('<img src="' + d + '" style="width:100%;height:100%;object-fit:cover;">');
        $('#pictureCapture').val(d);
        if (s) { s.getTracks().forEach(function(t) { t.stop(); }); }
        $('#cameraModal').modal('hide');
    });

    $('#cameraModal').on('hidden.bs.modal', function() {
        if (s) { s.getTracks().forEach(function(t) { t.stop(); }); }
    });
});
</script>
<?= $this->endSection() ?>