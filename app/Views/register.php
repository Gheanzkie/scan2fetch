<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-plus mr-2"></i>Register Student & Parents/Fetchers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('students') ?>">Students</a></li>
                        <li class="breadcrumb-item active">Register</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('students-save') ?>" method="post" enctype="multipart/form-data" id="registrationForm">
                <?= csrf_field() ?>
                
                <div class="row">
                    
                    <!-- LEFT COLUMN: Student Info -->
                    <div class="col-md-5">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-white border-0 pt-3">
                                <h5 class="mb-0"><i class="fas fa-user-graduate mr-2 text-primary"></i>Student Information</h5>
                            </div>
                            <div class="card-body">
                                
                                <!-- Student Photo -->
                                <div class="form-group text-center mb-4">
                                    <label class="font-weight-bold">Student Picture</label>
                                    <div id="studentPhotoPreview" style="width:150px;height:150px;margin:0 auto 15px;border-radius:50%;overflow:hidden;border:4px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;cursor:pointer;" onclick="$('#pictureInput').click()">
                                        <i class="fas fa-child fa-4x text-muted"></i>
                                    </div>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-primary open-camera-btn">
                                            <i class="fas fa-camera mr-1"></i> Take Photo
                                        </button>
                                        <label class="btn btn-outline-primary mb-0" style="cursor:pointer;">
                                            <i class="fas fa-upload mr-1"></i> Upload
                                            <input type="file" name="picture" id="pictureInput" class="d-none" accept="image/*">
                                        </label>
                                    </div>
                                    <input type="hidden" name="picture_capture" id="pictureCapture">
                                </div>

                                <!-- Student Name -->
                                <div class="row">
                                    <div class="col-4">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="fname" class="form-control" placeholder="Juan" required>
                                    </div>
                                    <div class="col-4">
                                        <label>Middle Name</label>
                                        <input type="text" name="mname" class="form-control" placeholder="Dela">
                                    </div>
                                    <div class="col-4">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="lname" class="form-control" placeholder="Cruz" required>
                                    </div>
                                </div>

                                <!-- Grade & Section -->
                                <div class="form-group mt-3">
                                    <label>Grade & Section <span class="text-danger">*</span></label>
                                    <select name="grade_section" class="form-control" required>
                                        <option value="">— Select Grade & Section —</option>
                                        <optgroup label="Kindergarten">
                                            <option>Kindergarten - A</option>
                                            <option>Kindergarten - B</option>
                                        </optgroup>
                                        <optgroup label="Grade 1">
                                            <option>Grade 1 - A</option>
                                            <option>Grade 1 - B</option>
                                        </optgroup>
                                        <optgroup label="Grade 2">
                                            <option>Grade 2 - A</option>
                                            <option>Grade 2 - B</option>
                                        </optgroup>
                                        <optgroup label="Grade 3">
                                            <option>Grade 3 - A</option>
                                            <option>Grade 3 - B</option>
                                        </optgroup>
                                        <optgroup label="Grade 4">
                                            <option>Grade 4 - A</option>
                                            <option>Grade 4 - B</option>
                                        </optgroup>
                                        <optgroup label="Grade 5">
                                            <option>Grade 5 - A</option>
                                            <option>Grade 5 - B</option>
                                        </optgroup>
                                        <optgroup label="Grade 6">
                                            <option>Grade 6 - A</option>
                                            <option>Grade 6 - B</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="alert alert-info mt-3 mb-0">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    <small>Fill in student details first, then add parents/fetchers on the right.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: Parents & Fetchers -->
                    <div class="col-md-7">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-white border-0 pt-3">
                                <h5 class="mb-0"><i class="fas fa-users mr-2 text-success"></i>Parents / Guardians / Fetchers</h5>
                            </div>
                            <div class="card-body">
                                
                                <!-- Parent 1 (Required) -->
                                <div class="border rounded p-3 mb-3" style="border-left: 5px solid #28a745;">
                                    <h6 class="mb-3">
                                        <span class="badge badge-success mr-2">Required</span>
                                        <i class="fas fa-user mr-1"></i> Parent / Guardian
                                    </h6>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="small">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="parent_fname[]" class="form-control form-control-sm" placeholder="Maria" required>
                                        </div>
                                        <div class="col-4">
                                            <label class="small">Middle Name</label>
                                            <input type="text" name="parent_mname[]" class="form-control form-control-sm" placeholder="Santos">
                                        </div>
                                        <div class="col-4">
                                            <label class="small">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="parent_lname[]" class="form-control form-control-sm" placeholder="Dela Cruz" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label class="small">Phone Number <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">📱</span>
                                                </div>
                                                <input type="text" name="parent_phone[]" class="form-control" placeholder="09XXXXXXXXX" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="small">Password <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">🔒</span>
                                                </div>
                                                <input type="password" name="parent_password[]" class="form-control" placeholder="Min. 6 characters" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="parent_relation[]" value="Parent">
                                </div>

                                <!-- Fetcher 1 (Optional) -->
                                <div class="border rounded p-3 mb-3" style="border-left: 5px solid #17a2b8;">
                                    <h6 class="mb-3">
                                        <span class="badge badge-info mr-2">Optional</span>
                                        <i class="fas fa-user-friends mr-1"></i> Fetcher 1
                                    </h6>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="small">First Name</label>
                                            <input type="text" name="fetcher_fname[]" class="form-control form-control-sm" placeholder="Juan">
                                        </div>
                                        <div class="col-4">
                                            <label class="small">Middle Name</label>
                                            <input type="text" name="fetcher_mname[]" class="form-control form-control-sm" placeholder="Dela">
                                        </div>
                                        <div class="col-4">
                                            <label class="small">Last Name</label>
                                            <input type="text" name="fetcher_lname[]" class="form-control form-control-sm" placeholder="Cruz">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label class="small">Phone Number</label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">📱</span>
                                                </div>
                                                <input type="text" name="fetcher_phone[]" class="form-control" placeholder="09XXXXXXXXX">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fetcher 2 (Optional) -->
                                <div class="border rounded p-3 mb-2" style="border-left: 5px solid #ffc107;">
                                    <h6 class="mb-3">
                                        <span class="badge badge-warning mr-2">Optional</span>
                                        <i class="fas fa-user-friends mr-1"></i> Fetcher 2
                                    </h6>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="small">First Name</label>
                                            <input type="text" name="fetcher_fname[]" class="form-control form-control-sm" placeholder="Pedro">
                                        </div>
                                        <div class="col-4">
                                            <label class="small">Middle Name</label>
                                            <input type="text" name="fetcher_mname[]" class="form-control form-control-sm" placeholder="Santos">
                                        </div>
                                        <div class="col-4">
                                            <label class="small">Last Name</label>
                                            <input type="text" name="fetcher_lname[]" class="form-control form-control-sm" placeholder="Dela Cruz">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label class="small">Phone Number</label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">📱</span>
                                                </div>
                                                <input type="text" name="fetcher_phone[]" class="form-control" placeholder="09XXXXXXXXX">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-warning mt-3 mb-0">
                                    <i class="fas fa-lightbulb mr-1"></i>
                                    <small>QR codes will be automatically generated for all registered parents and fetchers.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('students') ?>" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left mr-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success btn-lg px-5" id="submitBtn">
                                <i class="fas fa-save mr-1"></i> Save All & Generate QR Codes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- Camera Modal -->
<div class="modal fade" id="cameraModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white border-0">
                <h6><i class="fas fa-camera mr-2"></i>Take Student Photo</h6>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center p-2 bg-dark">
                <video id="cameraVideo" autoplay playsinline style="width:100%;max-height:400px;border-radius:8px;background:#000;"></video>
                <canvas id="cameraCanvas" style="display:none;"></canvas>
                <button type="button" class="btn btn-primary btn-lg mt-3" id="captureBtn">
                    <i class="fas fa-camera mr-1"></i> Capture Photo
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.card { border-radius: 10px; }
.form-control:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25); }
.btn-success { background: #28a745; border-color: #28a745; }
.btn-success:hover { background: #218838; border-color: #1e7e34; }
#studentPhotoPreview { transition: all 0.3s; }
#studentPhotoPreview:hover { border-color: #28a745; }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    var stream;

    // Upload photo preview
    $('#pictureInput').on('change', function(){
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#studentPhotoPreview').html('<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">');
            };
            reader.readAsDataURL(file);
        }
    });

    // Open camera
    $('.open-camera-btn').click(function(){
        $('#cameraModal').modal('show');
        setTimeout(function(){
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "user", width: 640, height: 480 } })
            .then(function(st) {
                stream = st;
                $('#cameraVideo')[0].srcObject = stream;
            })
            .catch(function(e) {
                alert('Camera error: ' + e.message);
            });
        }, 500);
    });

    // Capture photo
    $('#captureBtn').click(function(){
        var video = $('#cameraVideo')[0];
        var canvas = $('#cameraCanvas')[0];
        canvas.width = video.videoWidth || 640;
        canvas.height = video.videoHeight || 480;
        canvas.getContext('2d').drawImage(video, 0, 0);
        var dataUrl = canvas.toDataURL('image/png');
        
        $('#studentPhotoPreview').html('<img src="' + dataUrl + '" style="width:100%;height:100%;object-fit:cover;">');
        $('#pictureCapture').val(dataUrl);
        
        if (stream) {
            stream.getTracks().forEach(function(track) { track.stop(); });
        }
        $('#cameraModal').modal('hide');
    });

    // Stop camera when modal closes
    $('#cameraModal').on('hidden.bs.modal', function(){
        if (stream) {
            stream.getTracks().forEach(function(track) { track.stop(); });
        }
    });

    // Form validation
    $('#registrationForm').on('submit', function(e) {
        var fname = $('input[name="fname"]').val().trim();
        var lname = $('input[name="lname"]').val().trim();
        var grade = $('select[name="grade_section"]').val();
        var parentFname = $('input[name="parent_fname[]"]').first().val().trim();
        var parentLname = $('input[name="parent_lname[]"]').first().val().trim();
        var parentPhone = $('input[name="parent_phone[]"]').first().val().trim();
        var parentPass = $('input[name="parent_password[]"]').first().val().trim();

        if (!fname || !lname) {
            alert('Please fill in student first name and last name.');
            e.preventDefault();
            return;
        }
        if (!grade) {
            alert('Please select grade & section.');
            e.preventDefault();
            return;
        }
        if (!parentFname || !parentLname || !parentPhone || !parentPass) {
            alert('Please fill in all required parent/guardian fields.');
            e.preventDefault();
            return;
        }
        if (parentPass.length < 6) {
            alert('Parent password must be at least 6 characters.');
            e.preventDefault();
            return;
        }

        // Show loading state
        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');
    });
});
</script>
<?= $this->endSection() ?>