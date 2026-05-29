<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-user mr-2"></i>Parent Details</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
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
            
            <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle mr-1"></i> <?= session()->getFlashdata('msg') ?></div>
            <?php endif; ?>

            <div class="row">
                <!-- LEFT: Parent Profile -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            
                            <!-- Parent Photo - Click to full view -->
                            <div class="mb-3">
                                <div id="parentPhotoPreview" style="width:140px;height:140px;margin:0 auto 10px;border-radius:50%;overflow:hidden;border:4px solid #667eea;cursor:pointer;" 
                                     onclick="openImageViewer('<?= !empty($parent['picture']) ? base_url('uploads/parents/' . $parent['picture']) : '' ?>', 'Parent Photo')">
                                    <?php if (!empty($parent['picture'])): ?>
                                        <img src="<?= base_url('uploads/parents/' . $parent['picture']) ?>" style="width:100%;height:100%;object-fit:cover;">
                                    <?php else: ?>
                                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f3f4f6;">
                                            <i class="fas fa-user fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-secondary btn-xs open-camera-btn">
                                        <i class="fas fa-camera"></i> Take Photo
                                    </button>
                                    <label class="btn btn-outline-secondary btn-xs mb-0" style="cursor:pointer;">
                                        <i class="fas fa-upload"></i> Upload
                                        <input type="file" class="d-none parent-pic-input" accept="image/*">
                                    </label>
                                </div>
                                <form class="picture-form" action="<?= base_url('parents-update-picture') ?>" method="post" enctype="multipart/form-data" style="display:none;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $parent['id'] ?>">
                                    <input type="hidden" name="picture_capture" class="picture-capture">
                                    <input type="file" name="picture" class="picture-file">
                                </form>
                            </div>

                            <h3 class="mt-2 mb-0"><?= esc($parent['fname']) ?> <?= esc($parent['mname'] ?? '') ?> <?= esc($parent['lname']) ?></h3>
                            <p class="text-muted mb-2"><i class="fas fa-phone mr-1"></i> <?= esc($parent['phone']) ?></p>
                            
                            <!-- QR Code -->
                            <?php if (!empty($parent['qr_code'])): ?>
                            <div class="mb-3">
                                <img src="<?= base_url('uploads/qr/' . $parent['qr_code'] . '.png') ?>" 
                                     style="width:120px;height:120px;border:2px solid #667eea;border-radius:8px;cursor:pointer;" 
                                     onclick="openQrModal('<?= base_url('uploads/qr/' . $parent['qr_code'] . '.png') ?>')"
                                     title="Click to enlarge">
                                <p class="text-muted small mt-1"><?= esc($parent['qr_code']) ?></p>
                            </div>
                            <?php endif; ?>

                            <p class="text-muted small"><i class="fas fa-calendar mr-1"></i> Registered: <?= date('M d, Y', strtotime($parent['created_at'])) ?></p>

                            <div class="mt-3">
                                <a href="<?= base_url('parents-edit/' . $parent['id']) ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i> Edit Parent</a>
                                <a href="<?= base_url('parents-delete/' . $parent['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this parent?')"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Students -->
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-child mr-2"></i>Children (<?= count($students ?? []) ?>)</h5>
                            <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#addStudentModal"><i class="fas fa-plus mr-1"></i> Add Student</button>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($students)): ?>
                                <?php foreach ($students as $s): ?>
                                <div class="d-flex align-items-center border rounded p-3 mb-2">
                                    <div class="mr-3" style="cursor:pointer;" 
                                         onclick="openImageViewer('<?= !empty($s['picture']) ? base_url('uploads/students/' . $s['picture']) : '' ?>', '<?= esc($s['fname'] . ' ' . $s['lname']) ?>')"
                                         title="Click to view full photo">
                                        <?php if (!empty($s['picture'])): ?>
                                            <img src="<?= base_url('uploads/students/' . $s['picture']) ?>" class="img-circle" style="width:50px;height:50px;object-fit:cover;border:2px solid #667eea;">
                                        <?php else: ?>
                                            <div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:50px;height:50px;border:2px solid #667eea;"><i class="fas fa-child text-muted"></i></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1"><strong><?= esc($s['fname']) ?> <?= esc($s['lname']) ?></strong><br><small class="text-muted"><?= esc($s['grade_section']) ?></small></div>
                                    <div>
                                        <button class="btn btn-outline-secondary btn-xs edit-student-btn" 
                                                data-id="<?= $s['id'] ?>" data-fname="<?= esc($s['fname']) ?>"
                                                data-mname="<?= esc($s['mname'] ?? '') ?>" data-lname="<?= esc($s['lname']) ?>"
                                                data-grade="<?= esc($s['grade_section']) ?>" data-toggle="modal" data-target="#editStudentModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?= base_url('students-delete/' . $s['id']) ?>" class="btn btn-outline-danger btn-xs" onclick="return confirm('Delete?')"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center text-muted py-4">No children registered yet</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="<?= base_url('students-save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="parent_id" value="<?= $parent['id'] ?>">
                <div class="modal-header border-0 pb-0"><h5><i class="fas fa-user-plus mr-2"></i> Add Student</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
                <div class="modal-body">
                    <div class="form-group text-center">
                        <label class="small">Student Picture</label>
                        <div class="add-student-photo-preview" style="width:100px;height:100px;margin:0 auto 10px;border-radius:50%;overflow:hidden;border:3px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-child fa-2x text-muted"></i>
                        </div>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-secondary btn-xs open-camera-btn"><i class="fas fa-camera"></i> Take Photo</button>
                            <label class="btn btn-outline-secondary btn-xs mb-0" style="cursor:pointer;">
                                <i class="fas fa-upload"></i> Upload
                                <input type="file" class="d-none add-student-pic-input" accept="image/*">
                            </label>
                        </div>
                        <input type="hidden" name="picture_capture" class="add-student-picture-capture">
                        <input type="file" name="picture" class="d-none add-student-picture-file">
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label class="small">First Name *</label><input type="text" name="fname" class="form-control form-control-sm" required></div>
                        <div class="col-md-4"><label class="small">Middle Name</label><input type="text" name="mname" class="form-control form-control-sm"></div>
                        <div class="col-md-4"><label class="small">Last Name *</label><input type="text" name="lname" class="form-control form-control-sm" required></div>
                    </div>
                    <div class="form-group"><label class="small">Grade & Section *</label>
                        <select name="grade_section" class="form-control form-control-sm" required>
                            <option value="">Select</option>
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
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-secondary btn-sm px-4">Save Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="<?= base_url('students-update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editStudentId">
                <input type="hidden" name="parent_id" value="<?= $parent['id'] ?>">
                <div class="modal-header border-0 pb-0"><h5><i class="fas fa-user-edit mr-2"></i> Edit Student</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
                <div class="modal-body">
                    <div class="form-group text-center">
                        <label class="small">Student Picture</label>
                        <div class="edit-student-photo-preview" style="width:100px;height:100px;margin:0 auto 10px;border-radius:50%;overflow:hidden;border:3px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-child fa-2x text-muted"></i>
                        </div>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-secondary btn-xs open-camera-btn"><i class="fas fa-camera"></i> Take Photo</button>
                            <label class="btn btn-outline-secondary btn-xs mb-0" style="cursor:pointer;">
                                <i class="fas fa-upload"></i> Upload
                                <input type="file" class="d-none edit-student-pic-input" accept="image/*">
                            </label>
                        </div>
                        <input type="hidden" name="picture_capture" class="edit-student-picture-capture">
                        <input type="file" name="picture" class="d-none edit-student-picture-file">
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label class="small">First Name *</label><input type="text" name="fname" id="editSFname" class="form-control form-control-sm" required></div>
                        <div class="col-md-4"><label class="small">Middle Name</label><input type="text" name="mname" id="editSMname" class="form-control form-control-sm"></div>
                        <div class="col-md-4"><label class="small">Last Name *</label><input type="text" name="lname" id="editSLname" class="form-control form-control-sm" required></div>
                    </div>
                    <div class="form-group"><label class="small">Grade & Section *</label>
                        <select name="grade_section" id="editSGrade" class="form-control form-control-sm" required>
                            <option value="">Select</option>
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
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-secondary btn-sm px-4">Update Student</button>
                </div>
            </form>
        </div>
    </div>
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

<!-- Image Viewer Modal -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="background:#1a1a2e;">
            <div class="modal-header border-0" style="background:#1a1a2e;">
                <h5 class="text-white"><i class="fas fa-image mr-2"></i><span id="imageViewerTitle">Photo</span></h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center bg-white p-2">
                <img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;">
            </div>
            <div class="modal-footer border-0" style="background:#1a1a2e;">
                <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a>
                <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- QR Modal -->
<div class="modal fade" id="qrModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="background:#1a1a2e;">
            <div class="modal-header border-0" style="background:#1a1a2e;"><h5 class="text-white"><i class="fas fa-qrcode mr-2"></i>QR Code - <?= esc($parent['fname']) ?> <?= esc($parent['lname']) ?></h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div>
            <div class="modal-body text-center bg-white"><img id="qrFullImage" src="" style="max-width:100%;max-height:70vh;padding:20px;"></div>
            <div class="modal-footer border-0" style="background:#1a1a2e;"><a id="qrDownloadBtn" href="" download="<?= esc($parent['fname'].'_'.$parent['lname']) ?>.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Save QR</a><button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<style>
.img-circle { border-radius: 50%; }
.btn-xs { padding: 4px 8px; font-size: 12px; border-radius: 6px; }
.modal-content { border-radius: 12px; }
.form-control-sm { border-radius: 6px; font-size: 0.85rem; }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function() {
    var stream;
    var currentTarget = null;

    $('.edit-student-btn').click(function() {
        $('#editStudentId').val($(this).data('id'));
        $('#editSFname').val($(this).data('fname'));
        $('#editSMname').val($(this).data('mname'));
        $('#editSLname').val($(this).data('lname'));
        $('#editSGrade').val($(this).data('grade'));
    });

    $(document).on('change', '.parent-pic-input', function() {
        var f = this.files[0];
        if (f) {
            var form = $('.picture-form');
            form.find('.picture-file').prop('files', this.files);
            form.find('.picture-capture').val('');
            form.submit();
        }
    });

    $(document).on('change', '.add-student-pic-input', function() {
        var f = this.files[0];
        if (f) {
            var reader = new FileReader();
            reader.onload = function(e) { $('.add-student-photo-preview').html('<img src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;">'); };
            reader.readAsDataURL(f);
            $('.add-student-picture-file').prop('files', this.files);
            $('.add-student-picture-capture').val('');
        }
    });

    $(document).on('change', '.edit-student-pic-input', function() {
        var f = this.files[0];
        if (f) {
            var reader = new FileReader();
            reader.onload = function(e) { $('.edit-student-photo-preview').html('<img src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;">'); };
            reader.readAsDataURL(f);
            $('.edit-student-picture-file').prop('files', this.files);
            $('.edit-student-picture-capture').val('');
        }
    });

    $(document).on('click', '.open-camera-btn', function() {
        var btn = $(this);
        if (btn.closest('.card-body').find('#parentPhotoPreview').length) { currentTarget = 'parent'; }
        else if (btn.closest('#addStudentModal').length) { currentTarget = 'add-student'; }
        else if (btn.closest('#editStudentModal').length) { currentTarget = 'edit-student'; }

        $('#cameraModal').modal('show');
        setTimeout(function() {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "user", width: 400, height: 400 } })
                .then(function(s) { stream = s; $('#cameraVideo')[0].srcObject = s; })
                .catch(function(err) { alert('Camera error: ' + err.message); });
        }, 500);
    });

    $('#captureBtn').click(function() {
        var v = $('#cameraVideo')[0], c = $('#cameraCanvas')[0];
        c.width = v.videoWidth || 400; c.height = v.videoHeight || 400;
        c.getContext('2d').drawImage(v, 0, 0);
        var d = c.toDataURL('image/png');

        if (currentTarget === 'parent') {
            $('#parentPhotoPreview').html('<img src="'+d+'" style="width:100%;height:100%;object-fit:cover;">');
            var form = $('.picture-form');
            form.find('.picture-capture').val(d);
            form.find('.picture-file').val('');
            form.submit();
        } else if (currentTarget === 'add-student') {
            $('.add-student-photo-preview').html('<img src="'+d+'" style="width:100%;height:100%;object-fit:cover;">');
            $('.add-student-picture-capture').val(d);
            $('.add-student-picture-file').val('');
        } else if (currentTarget === 'edit-student') {
            $('.edit-student-photo-preview').html('<img src="'+d+'" style="width:100%;height:100%;object-fit:cover;">');
            $('.edit-student-picture-capture').val(d);
            $('.edit-student-picture-file').val('');
        }

        if (stream) { stream.getTracks().forEach(function(t) { t.stop(); }); }
        $('#cameraModal').modal('hide');
    });

    $('#cameraModal').on('hidden.bs.modal', function() { if (stream) { stream.getTracks().forEach(function(t) { t.stop(); }); } });
});

// ========== IMAGE VIEWER ==========
function openImageViewer(imageUrl, title) {
    if (!imageUrl) return;
    $('#imageViewerFull').attr('src', imageUrl);
    $('#imageDownloadBtn').attr('href', imageUrl);
    $('#imageDownloadBtn').attr('download', title.replace(/\s+/g, '_') + '.png');
    $('#imageViewerTitle').text(title);
    $('#imageViewerModal').modal('show');
}

// ========== QR VIEWER ==========
function openQrModal(url) {
    $('#qrFullImage').attr('src', url);
    $('#qrDownloadBtn').attr('href', url);
    $('#qrDownloadBtn').attr('download', '<?= esc($parent['fname'].'_'.$parent['lname']) ?>.png');
    $('#qrModal').modal('show');
}
</script>
<?= $this->endSection() ?>