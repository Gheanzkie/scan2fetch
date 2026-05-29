<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><i class="fas fa-qrcode mr-2"></i>QR Scan</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li><li class="breadcrumb-item active">QR Scan</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <div class="row">
                <!-- Left: Scanner + Manual Input -->
                <div class="col-lg-5 col-md-6 col-12">
                    
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-camera mr-2"></i>Camera</h5>
                            <div>
                                <button class="btn btn-success btn-xs" id="startCameraBtn" style="display:none;"><i class="fas fa-play"></i></button>
                                <button class="btn btn-danger btn-xs" id="stopCameraBtn"><i class="fas fa-stop"></i></button>
                            </div>
                        </div>
                        <div class="card-body text-center p-2">
                            <div id="reader" style="width:100%;margin:0 auto;"></div>
                            <div id="scanResult" class="mt-2"></div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0">
                        <div class="card-header"><h5 class="mb-0"><i class="fas fa-keyboard mr-2"></i>Manual Input</h5></div>
                        <div class="card-body text-center">
                            <input type="text" id="qrInput" class="form-control text-center mb-2" placeholder="Enter QR Code" style="font-size:1.1rem;letter-spacing:1px;">
                            <button class="btn btn-primary btn-sm" id="verifyQrBtn"><i class="fas fa-search mr-1"></i> Verify</button>
                            <div class="mt-2" id="qrResult"></div>
                        </div>
                    </div>

                </div>

                <!-- Right: Parent Info -->
                <div class="col-lg-7 col-md-6 col-12">
                    
                    <div class="card shadow-sm border-0" id="emptyState">
                        <div class="card-body text-center text-muted py-5">
                            <i class="fas fa-qrcode fa-5x mb-3 d-block" style="opacity:0.3;"></i>
                            <h5>Scan a QR Code</h5>
                            <p>Use camera or enter QR code manually</p>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0" id="parentCard" style="display:none;">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-user-check mr-2 text-success"></i>Verified Parent</h5>
                            <span class="badge badge-success">Verified</span>
                        </div>
                        <div class="card-body">
                            
                            <div class="text-center mb-3">
                                <div id="parentPhotoContainer" style="width:140px;height:140px;margin:0 auto;border-radius:50%;overflow:hidden;border:4px solid #667eea;cursor:pointer;" onclick="openImageViewer($('#parentPic').attr('src'), $('#parentName').text())">
                                    <img id="parentPic" src="" style="width:100%;height:100%;object-fit:cover;display:none;">
                                    <div id="parentNoPic" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f3f4f6;">
                                        <i class="fas fa-user fa-3x text-muted"></i>
                                    </div>
                                </div>
                                <h4 class="mt-2 mb-0" id="parentName"></h4>
                                <p class="text-muted mb-0" id="parentPhone"></p>
                            </div>

                            <hr>

                            <h6 class="mb-3"><i class="fas fa-child mr-2"></i>Students to Release</h6>
                            <div id="studentsList"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>

<!-- Confirm Action Modal (Decline / Release) -->
<div class="modal fade" id="confirmActionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h6><i class="fas fa-question-circle text-warning mr-2"></i>Confirm Action</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-1">What would you like to do?</p>
                <p class="text-muted small mb-0"><strong id="confirmStudentName"></strong></p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-danger btn-sm" id="confirmDecline"><i class="fas fa-times mr-1"></i> Decline</button>
                <button type="button" class="btn btn-success btn-sm" id="confirmRelease"><i class="fas fa-check mr-1"></i> Release</button>
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

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
$(function() {
    var html5QrCode;
    var isScanning = false;
    var pendingStudentId = null;
    var pendingParentId = null;

    startCamera();
    $('#startCameraBtn').click(function() { startCamera(); });

    function startCamera() {
        if (isScanning) return;
        isScanning = true;
        $('#reader').show();
        $('#startCameraBtn').hide();
        $('#stopCameraBtn').show();

        html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: { width: 250, height: 250 } },
            function(decodedText) {
                $('#scanResult').html('<span class="text-success"><i class="fas fa-check-circle"></i> Scanned!</span>');
                stopCamera(false);
                verifyQrCode(decodedText);
            },
            function(errorMessage) {}
        ).catch(function(err) {
            isScanning = false;
            $('#scanResult').html('<span class="text-danger">Camera error</span>');
            $('#startCameraBtn').show();
            $('#stopCameraBtn').hide();
        });
    }

    function stopCamera(showStartButton) {
        if (html5QrCode) {
            html5QrCode.stop().then(function() {
                isScanning = false;
                $('#reader').hide();
                $('#stopCameraBtn').hide();
                if (showStartButton !== false) $('#startCameraBtn').show();
            }).catch(function(err) {});
        }
    }

    $('#stopCameraBtn').click(function() { stopCamera(true); });

    $('#verifyQrBtn').click(function() {
        var qr = $('#qrInput').val().trim();
        if (!qr) { alert('Please enter QR code'); return; }
        verifyQrCode(qr);
    });

    function verifyQrCode(qrCode) {
        $('#qrResult').html('<i class="fas fa-spinner fa-spin"></i> Verifying...');

        $.post('<?= base_url('scan/verify') ?>', { 
            qr_code: qrCode, 
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>' 
        }, function(res) {
            if (res.success) {
                $('#qrResult').html('<span class="text-success"><i class="fas fa-check-circle"></i> Verified!</span>');
                var p = res.parent;
                $('#parentName').text(p.fname + ' ' + p.lname);
                $('#parentPhone').html('<i class="fas fa-phone mr-1"></i> ' + p.phone);
                
                if (p.picture) {
                    $('#parentPic').attr('src', '<?= base_url('uploads/parents/') ?>' + p.picture).show();
                    $('#parentNoPic').hide();
                } else {
                    $('#parentPic').hide();
                    $('#parentNoPic').show();
                }

                var html = '';
                res.students.forEach(function(s) {
                    var studentPicUrl = s.picture ? '<?= base_url('uploads/students/') ?>' + s.picture : '';
                    html += `
                    <div class="d-flex align-items-center border rounded p-3 mb-2">
                        <div class="mr-3" style="cursor:pointer;" onclick="openImageViewer('${studentPicUrl}', '${s.fname} ${s.lname}')" title="Click to view full photo">
                            ${s.picture ? '<img src="<?= base_url('uploads/students/') ?>'+s.picture+'" class="img-circle" style="width:55px;height:55px;object-fit:cover;border:2px solid #667eea;">' : '<div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:55px;height:55px;border:2px solid #667eea;"><i class="fas fa-child text-muted"></i></div>'}
                        </div>
                        <div class="flex-grow-1">
                            <strong>${s.fname} ${s.lname}</strong>
                            <br><small class="text-muted">${s.grade_section}</small>
                        </div>
                        <button class="btn btn-outline-secondary btn-sm action-btn" data-student-id="${s.id}" data-parent-id="${res.parent.id}" data-name="${s.fname} ${s.lname}">
                            <i class="fas fa-ellipsis-h"></i> Action
                        </button>
                    </div>`;
                });
                $('#studentsList').html(html);
                $('#parentCard').show();
                $('#emptyState').hide();

            } else {
                $('#qrResult').html('<span class="text-danger"><i class="fas fa-times-circle"></i> Invalid QR</span>');
                setTimeout(startCamera, 1500);
            }
        }, 'json').fail(function() {
            $('#qrResult').html('<span class="text-danger">Error</span>');
            setTimeout(startCamera, 1500);
        });
    }

    // Open Action Modal
    $(document).on('click', '.action-btn', function() {
        pendingStudentId = $(this).data('student-id');
        pendingParentId = $(this).data('parent-id');
        $('#confirmStudentName').text($(this).data('name'));
        $('#confirmActionModal').modal('show');
    });

    // Release
    $('#confirmRelease').click(function() {
        $('#confirmActionModal').modal('hide');
        if (!pendingStudentId) return;

        $.post('<?= base_url('scan/release') ?>', { 
            student_id: pendingStudentId, parent_id: pendingParentId, 
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>' 
        }, function(res) {
            if (res.success) {
                alert('Student released! SMS sent.');
            } else {
                alert('Error: ' + res.message);
            }
            resetAndRestart();
        }, 'json');
    });

    // Decline
    $('#confirmDecline').click(function() {
        $('#confirmActionModal').modal('hide');
        if (!pendingStudentId) return;

        $.post('<?= base_url('scan/decline') ?>', { 
            student_id: pendingStudentId, parent_id: pendingParentId, 
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>' 
        }, function(res) {
            if (res.success) {
                alert('Release declined. SMS sent to parent.');
            } else {
                alert('Error: ' + res.message);
            }
            resetAndRestart();
        }, 'json');
    });

    function resetAndRestart() {
        $('#parentCard').hide();
        $('#emptyState').show();
        $('#qrInput').val('');
        $('#qrResult').html('');
        $('#scanResult').html('');
        pendingStudentId = null;
        pendingParentId = null;
        setTimeout(startCamera, 1000);
    }
});

// Image Viewer
function openImageViewer(imageUrl, title) {
    if (!imageUrl) return;
    $('#imageViewerFull').attr('src', imageUrl);
    $('#imageDownloadBtn').attr('href', imageUrl);
    $('#imageDownloadBtn').attr('download', title.replace(/\s+/g, '_') + '.png');
    $('#imageViewerTitle').text(title || 'Photo');
    $('#imageViewerModal').modal('show');
}
</script>

<style>
.img-circle { border-radius: 50%; }
.btn-xs { padding: 4px 10px; font-size: 12px; border-radius: 6px; }
.card { border-radius: 10px; }
#reader { border-radius: 8px; overflow: hidden; }
#reader video { border-radius: 8px; }
#parentPhotoContainer { transition: all 0.3s; }
@media (max-width: 768px) {
    #parentPhotoContainer { width: 100px !important; height: 100px !important; }
}
</style>
<?= $this->endSection() ?>