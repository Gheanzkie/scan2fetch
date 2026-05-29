<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><i class="fas fa-user-plus mr-2"></i>Add Parent & Student</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('parents') ?>">Parents</a></li><li class="breadcrumb-item active">Add</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('parents-save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="row">
                    <!-- PARENT INFO -->
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-header"><h5><i class="fas fa-user mr-2"></i>Parent Information</h5></div>
                            <div class="card-body">
                                
                                <div class="form-group text-center">
                                    <label>Profile Picture</label>
                                    <div id="parentPhotoPreview" style="width:150px;height:150px;margin:0 auto 10px;border-radius:50%;overflow:hidden;border:4px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-user fa-3x text-muted"></i>
                                    </div>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-secondary open-camera-btn" data-target="parent"><i class="fas fa-camera mr-1"></i> Take Photo</button>
                                        <label class="btn btn-outline-secondary mb-0" style="cursor:pointer;">
                                            <i class="fas fa-upload mr-1"></i> Upload
                                            <input type="file" name="picture" id="pictureInput" class="d-none" accept="image/*">
                                        </label>
                                    </div>
                                    <input type="hidden" name="picture_capture" id="pictureCapture">
                                </div>

                                <div class="row">
                                    <div class="col-4"><label>First Name</label><input type="text" name="fname" class="form-control" required></div>
                                    <div class="col-4"><label>Middle Name</label><input type="text" name="mname" class="form-control"></div>
                                    <div class="col-4"><label>Last Name</label><input type="text" name="lname" class="form-control" required></div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Phone</label><input type="text" name="phone" class="form-control" required></div>
                                    <div class="col-6"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STUDENTS -->
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-header d-flex justify-content-between"><h5 class="mb-0"><i class="fas fa-child mr-2"></i>Students</h5><button type="button" class="btn btn-outline-secondary btn-xs" id="addStudentBtn">+ Add Student</button></div>
                            <div class="card-body" id="studentsContainer">
                                <div class="border rounded p-3 mb-2 student-entry">
                                    <div class="form-group text-center">
                                        <div class="student-photo-preview" style="width:80px;height:80px;margin:0 auto 5px;border-radius:50%;overflow:hidden;border:3px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
                                            <i class="fas fa-child text-muted"></i>
                                        </div>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-secondary btn-xs open-camera-btn" data-target="student-0"><i class="fas fa-camera"></i></button>
                                            <label class="btn btn-outline-secondary btn-xs mb-0" style="cursor:pointer;">
                                                <i class="fas fa-upload"></i>
                                                <input type="file" class="d-none student-pic-input" accept="image/*" data-index="0">
                                            </label>
                                        </div>
                                        <input type="hidden" name="student_picture_capture[]" class="student-picture-capture" data-index="0">
                                        <input type="file" name="student_picture[]" class="d-none student-picture-file" data-index="0">
                                    </div>
                                    <div class="row">
                                        <div class="col-4"><label class="small">First Name</label><input type="text" name="student_fname[]" class="form-control form-control-sm" required></div>
                                        <div class="col-4"><label class="small">Middle Name</label><input type="text" name="student_mname[]" class="form-control form-control-sm"></div>
                                        <div class="col-4"><label class="small">Last Name</label><input type="text" name="student_lname[]" class="form-control form-control-sm" required></div>
                                    </div>
                                    <div class="form-group mb-0"><label class="small">Grade & Section</label>
                                        <select name="grade_section[]" class="form-control form-control-sm" required>
                                            <option value="">-- Select --</option>
                                            <option value="Kindergarten">Kindergarten</option>
                                            <option value="Grade 1 - A">Grade 1 - A</option><option value="Grade 1 - B">Grade 1 - B</option>
                                            <option value="Grade 2 - A">Grade 2 - A</option><option value="Grade 2 - B">Grade 2 - B</option>
                                            <option value="Grade 3 - A">Grade 3 - A</option><option value="Grade 3 - B">Grade 3 - B</option>
                                            <option value="Grade 4 - A">Grade 4 - A</option><option value="Grade 4 - B">Grade 4 - B</option>
                                            <option value="Grade 5 - A">Grade 5 - A</option><option value="Grade 5 - B">Grade 5 - B</option>
                                            <option value="Grade 6 - A">Grade 6 - A</option><option value="Grade 6 - B">Grade 6 - B</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <a href="<?= base_url('parents') ?>" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-secondary px-4">Save All</button>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- Camera Modal -->
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
    var currentTarget = 'parent';
    var studentIndex = 0;

    // Add Student
    $('#addStudentBtn').click(function() {
        studentIndex++;
        var html = `<div class="border rounded p-3 mb-2 student-entry"><button type="button" class="close remove-student">&times;</button>
            <div class="form-group text-center">
                <div class="student-photo-preview" style="width:80px;height:80px;margin:0 auto 5px;border-radius:50%;overflow:hidden;border:3px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-child text-muted"></i>
                </div>
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-secondary btn-xs open-camera-btn" data-target="student-${studentIndex}"><i class="fas fa-camera"></i></button>
                    <label class="btn btn-outline-secondary btn-xs mb-0" style="cursor:pointer;">
                        <i class="fas fa-upload"></i>
                        <input type="file" class="d-none student-pic-input" accept="image/*" data-index="${studentIndex}">
                    </label>
                </div>
                <input type="hidden" name="student_picture_capture[]" class="student-picture-capture" data-index="${studentIndex}">
                <input type="file" name="student_picture[]" class="d-none student-picture-file" data-index="${studentIndex}">
            </div>
            <div class="row">
                <div class="col-4"><label class="small">First Name</label><input type="text" name="student_fname[]" class="form-control form-control-sm" required></div>
                <div class="col-4"><label class="small">Middle Name</label><input type="text" name="student_mname[]" class="form-control form-control-sm"></div>
                <div class="col-4"><label class="small">Last Name</label><input type="text" name="student_lname[]" class="form-control form-control-sm" required></div>
            </div>
            <div class="form-group mb-0"><label class="small">Grade & Section</label><select name="grade_section[]" class="form-control form-control-sm" required><option value="">-- Select --</option><option value="Kindergarten">Kindergarten</option><option value="Grade 1 - A">Grade 1 - A</option><option value="Grade 1 - B">Grade 1 - B</option><option value="Grade 2 - A">Grade 2 - A</option><option value="Grade 2 - B">Grade 2 - B</option><option value="Grade 3 - A">Grade 3 - A</option><option value="Grade 3 - B">Grade 3 - B</option><option value="Grade 4 - A">Grade 4 - A</option><option value="Grade 4 - B">Grade 4 - B</option><option value="Grade 5 - A">Grade 5 - A</option><option value="Grade 5 - B">Grade 5 - B</option><option value="Grade 6 - A">Grade 6 - A</option><option value="Grade 6 - B">Grade 6 - B</option></select></div></div>`;
        $('#studentsContainer').append(html);
    });
    $(document).on('click','.remove-student',function(){$(this).closest('.student-entry').remove();});

    // File Upload - Parent
    $('#pictureInput').on('change',function(){
        var f=this.files[0];
        if(f){var r=new FileReader();r.onload=function(e){$('#parentPhotoPreview').html('<img src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;">');};r.readAsDataURL(f);}
    });

    // File Upload - Student
    $(document).on('change', '.student-pic-input', function() {
        var index = $(this).data('index');
        var f = this.files[0];
        if (f) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(this).closest('.student-entry').find('.student-photo-preview').html('<img src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;">');
            }.bind(this);
            reader.readAsDataURL(f);
            $('.student-picture-file[data-index="'+index+'"]').prop('files', this.files);
            $('.student-picture-capture[data-index="'+index+'"]').val('');
        }
    });

    // Open Camera
    $(document).on('click', '.open-camera-btn', function() {
        currentTarget = $(this).data('target');
        $('#cameraModal').modal('show');
        setTimeout(function(){
            navigator.mediaDevices.getUserMedia({video:{facingMode:"user",width:400,height:400}})
            .then(function(s){stream=s;$('#cameraVideo')[0].srcObject=s;})
            .catch(function(err){alert('Camera error: '+err.message);});
        },500);
    });

    // Capture
    $('#captureBtn').click(function(){
        var v=$('#cameraVideo')[0],c=$('#cameraCanvas')[0];
        c.width=v.videoWidth||400;c.height=v.videoHeight||400;
        c.getContext('2d').drawImage(v,0,0);
        var d=c.toDataURL('image/png');

        if (currentTarget === 'parent') {
            $('#parentPhotoPreview').html('<img src="'+d+'" style="width:100%;height:100%;object-fit:cover;">');
            $('#pictureCapture').val(d);
        } else {
            // Student target like "student-0", "student-1"
            var index = currentTarget.replace('student-', '');
            $('.student-picture-capture[data-index="'+index+'"]').val(d);
            $('.student-picture-file[data-index="'+index+'"]').val('');
            // Find and update preview
            $('.student-picture-capture[data-index="'+index+'"]').closest('.student-entry').find('.student-photo-preview').html('<img src="'+d+'" style="width:100%;height:100%;object-fit:cover;">');
        }

        if(stream){stream.getTracks().forEach(function(t){t.stop();});}
        $('#cameraModal').modal('hide');
    });

    $('#cameraModal').on('hidden.bs.modal',function(){if(stream){stream.getTracks().forEach(function(t){t.stop();});}});
});
</script>
<?= $this->endSection() ?>