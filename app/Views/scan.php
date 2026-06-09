<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-qrcode mr-2"></i>QR Code Scanner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">QR Scan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <!-- Alert messages -->
            <div id="alertArea" style="display:none;"></div>

            <div class="row">
                <!-- LEFT: Scanner + Manual Input -->
                <div class="col-lg-5 col-md-6 col-12">
                    
                    <!-- Camera Scanner -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-camera mr-2 text-primary"></i>Camera Scanner</h5>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-success" id="startCameraBtn" style="display:none;">
                                    <i class="fas fa-play mr-1"></i> Start Camera
                                </button>
                                <button class="btn btn-danger" id="stopCameraBtn">
                                    <i class="fas fa-stop mr-1"></i> Stop Camera
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <div id="reader" style="width:100%;max-width:400px;margin:0 auto;border:3px solid #667eea;border-radius:12px;"></div>
                            <div id="scanResult" class="mt-3"></div>
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle mr-1"></i> Point camera at the QR code
                            </small>
                        </div>
                    </div>

                    <!-- Manual Input -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fas fa-keyboard mr-2 text-info"></i>Manual QR Code Input</h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white"><i class="fas fa-qrcode text-muted"></i></span>
                                </div>
                                <input type="text" id="qrInput" class="form-control text-center font-weight-bold" 
                                       placeholder="Enter QR Code (e.g. QR-4A2B8C3D1E5F)" 
                                       style="font-size:1rem;letter-spacing:1px;text-transform:uppercase;">
                            </div>
                            <button class="btn btn-primary btn-lg px-4" id="verifyQrBtn">
                                <i class="fas fa-search mr-1"></i> Verify QR Code
                            </button>
                            <div class="mt-3" id="qrResult"></div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Results -->
                <div class="col-lg-7 col-md-6 col-12">
                    
                    <!-- Empty State -->
                    <div class="card shadow-sm border-0" id="emptyState">
                        <div class="card-body text-center text-muted py-5">
                            <i class="fas fa-qrcode fa-5x mb-4 d-block" style="opacity:0.2;"></i>
                            <h4>Ready to Scan</h4>
                            <p class="mb-0">Scan a QR code using the camera or type the code manually</p>
                            <hr class="my-4" style="max-width:200px;">
                            <small><i class="fas fa-lightbulb text-warning mr-1"></i> The QR code number is printed below each QR image</small>
                        </div>
                    </div>

                    <!-- Parent/Fetcher Card -->
                    <div class="card shadow-sm border-0" id="parentCard" style="display:none;">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                            <h5 class="mb-0">
                                <i class="fas fa-user-check mr-2 text-success"></i>Verified
                            </h5>
                            <span class="badge badge-success badge-pill px-3 py-1">✅ Verified</span>
                        </div>
                        <div class="card-body">
                            
                            <!-- Fetcher/Parent Profile -->
                            <div class="text-center mb-4">
                                <div id="parentPhotoContainer" 
                                     style="width:160px;height:160px;margin:0 auto;border-radius:50%;overflow:hidden;border:5px solid #667eea;cursor:pointer;box-shadow:0 4px 15px rgba(0,0,0,0.1);" 
                                     onclick="openImageViewer($('#parentPic').attr('src'), $('#parentName').text())">
                                    <img id="parentPic" src="" style="width:100%;height:100%;object-fit:cover;display:none;">
                                    <div id="parentNoPic" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg, #667eea, #764ba2);">
                                        <i class="fas fa-user fa-4x text-white"></i>
                                    </div>
                                </div>
                                <h3 class="mt-3 mb-1" id="parentName"></h3>
                                <p class="text-muted mb-1" id="parentPhone"></p>
                                <span class="badge badge-pill px-3 py-1 mt-1" id="fetcherType" style="display:none;font-size:0.9rem;"></span>
                            </div>

                            <hr>

                            <!-- Students List -->
                            <h5 class="mb-3">
                                <i class="fas fa-child mr-2 text-primary"></i>Students to Release
                                <span class="badge badge-light ml-1" id="studentCount">0</span>
                            </h5>
                            <div id="studentsList"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Confirm Action Modal -->
<div class="modal fade" id="confirmActionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-0">
                <h5><i class="fas fa-question-circle text-warning mr-2"></i>Confirm Action</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-user-graduate fa-3x text-primary mb-3"></i>
                <h5 class="mb-2">Release Student?</h5>
                <p class="text-muted mb-0"><strong id="confirmStudentName"></strong></p>
                <small class="text-muted">An SMS notification will be sent to the parent.</small>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-danger btn-lg px-4 mx-2" id="confirmDecline">
                    <i class="fas fa-times-circle mr-1"></i> Decline
                </button>
                <button type="button" class="btn btn-success btn-lg px-4 mx-2" id="confirmRelease">
                    <i class="fas fa-check-circle mr-1"></i> Release
                </button>
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
            <div class="modal-body text-center bg-white p-3">
                <img id="imageViewerFull" src="" style="max-width:100%;max-height:65vh;border-radius:8px;">
            </div>
            <div class="modal-footer border-0" style="background:#1a1a2e;">
                <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm">
                    <i class="fas fa-download mr-1"></i> Download
                </a>
                <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('html5qrcode/html5-qrcode.min.js') ?>"></script>

<script>
var BASE_URL = '<?= base_url() ?>/';
var CSRF_NAME = '<?= csrf_token() ?>';
var CSRF_HASH = '<?= csrf_hash() ?>';

$(function() {
    var html5QrCode, isScanning = false, pendingStudentId = null, pendingParentId = null;

    startCamera();
    $('#startCameraBtn').click(function() { startCamera(); });

    function startCamera() {
        if (isScanning) return;
        isScanning = true;
        $('#reader').show(); 
        $('#startCameraBtn').hide(); 
        $('#stopCameraBtn').show();
        $('#scanResult').html('<span class="text-muted"><i class="fas fa-sync-alt fa-spin mr-1"></i> Starting camera...</span>');
        
        html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            { facingMode: "environment" }, 
            { fps: 10, qrbox: { width: 250, height: 250 } },
            function(decodedText) {
                $('#scanResult').html('<span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i> QR Code Scanned!</span>');
                stopCamera(false);
                verifyQrCode(decodedText);
            },
            function(errorMessage) {
                // Scanning in progress, do nothing
            }
        ).then(function() {
            $('#scanResult').html('<span class="text-success"><i class="fas fa-camera mr-1"></i> Camera ready. Point at QR code.</span>');
        }).catch(function(err) {
            isScanning = false;
            $('#scanResult').html('<span class="text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Camera error: ' + err.message + '</span>');
            $('#startCameraBtn').show(); 
            $('#stopCameraBtn').hide();
        });
    }

    function stopCamera(showStart) {
        if (html5QrCode) {
            html5QrCode.stop().then(function() {
                isScanning = false;
                $('#reader').hide(); 
                $('#stopCameraBtn').hide();
                if (showStart !== false) $('#startCameraBtn').show();
                $('#scanResult').html('');
            }).catch(function() {});
        }
    }

    $('#stopCameraBtn').click(function() { stopCamera(true); });

    // Manual verify
    $('#verifyQrBtn').click(function() {
        var qr = $('#qrInput').val().trim().toUpperCase();
        if (!qr) { 
            showAlert('Please enter a QR code', 'warning');
            return; 
        }
        stopCamera(true);
        verifyQrCode(qr);
    });

    // Enter key
    $('#qrInput').on('keypress', function(e) {
        if (e.which === 13) { $('#verifyQrBtn').click(); }
    });

    function showAlert(message, type) {
        var alertClass = type === 'success' ? 'success' : (type === 'danger' ? 'danger' : 'warning');
        var icon = type === 'success' ? 'check-circle' : (type === 'danger' ? 'times-circle' : 'exclamation-triangle');
        $('#alertArea').html(
            '<div class="alert alert-' + alertClass + ' alert-dismissible fade show">' +
            '<i class="fas fa-' + icon + ' mr-1"></i> ' + message +
            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '</div>'
        ).show().delay(5000).fadeOut();
    }

    function verifyQrCode(qrCode) {
        $('#qrResult').html('<span class="text-info"><i class="fas fa-spinner fa-spin mr-1"></i> Verifying QR code...</span>');
        
        var formData = new FormData();
        formData.append('qr_code', qrCode);
        formData.append(CSRF_NAME, CSRF_HASH);
        
        fetch(BASE_URL + 'scan/verify', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                $('#qrResult').html('<span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i> Verified!</span>');
                
                var p = res.parent, f = res.fetcher;
                
                // Update fetcher info
                if (f && f.type === 'Sub-Fetcher') {
                    $('#parentName').text(f.fname + ' ' + f.lname);
                    $('#parentPhone').html('<i class="fas fa-phone mr-1"></i> ' + f.phone);
                    $('#fetcherType').text('🔄 Sub-Fetcher').removeClass('badge-info badge-success').addClass('badge-warning').show();
                    if (f.picture) {
                        $('#parentPic').attr('src', BASE_URL + 'uploads/parents/' + f.picture).show();
                        $('#parentNoPic').hide();
                    } else {
                        $('#parentPic').hide(); 
                        $('#parentNoPic').show();
                    }
                } else {
                    $('#parentName').text(p.fname + ' ' + p.lname);
                    $('#parentPhone').html('<i class="fas fa-phone mr-1"></i> ' + p.phone);
                    $('#fetcherType').text('👤 Main Parent').removeClass('badge-warning badge-success').addClass('badge-info').show();
                    if (p.picture) {
                        $('#parentPic').attr('src', BASE_URL + 'uploads/parents/' + p.picture).show();
                        $('#parentNoPic').hide();
                    } else {
                        $('#parentPic').hide(); 
                        $('#parentNoPic').show();
                    }
                }

                // Build students list
                var html = '';
                if (res.students && res.students.length > 0) {
                    res.students.forEach(function(s) {
                        var sid = s.student_id || s.id;
                        var studentPic = s.picture ? BASE_URL + 'uploads/students/' + s.picture : '';
                        html += '<div class="d-flex align-items-center border rounded p-3 mb-2 student-item" style="transition: all 0.2s;">';
                        html += '<div class="mr-3" style="cursor:pointer;" onclick="openImageViewer(\'' + studentPic + '\', \'' + s.fname + ' ' + s.lname + '\')">';
                        if (s.picture) {
                            html += '<img src="' + studentPic + '" class="img-circle" style="width:60px;height:60px;object-fit:cover;border:3px solid #667eea;">';
                        } else {
                            html += '<div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:60px;height:60px;border:3px solid #667eea;"><i class="fas fa-child fa-2x text-muted"></i></div>';
                        }
                        html += '</div>';
                        html += '<div class="flex-grow-1"><strong style="font-size:1.1rem;">' + s.fname + ' ' + s.lname + '</strong><br><span class="badge badge-light">' + (s.grade_section || 'N/A') + '</span></div>';
                        html += '<button class="btn btn-outline-primary action-btn" data-student-id="' + sid + '" data-parent-id="' + res.parent.id + '" data-name="' + s.fname + ' ' + s.lname + '"><i class="fas fa-exchange-alt mr-1"></i> Action</button>';
                        html += '</div>';
                    });
                    $('#studentCount').text(res.students.length);
                } else {
                    html = '<div class="text-center text-muted py-4"><i class="fas fa-user-slash fa-3x mb-3 d-block"></i><p>No students linked to this parent/fetcher</p></div>';
                    $('#studentCount').text('0');
                }
                $('#studentsList').html(html);
                $('#parentCard').show(); 
                $('#emptyState').hide();
                
                // Scroll to parent card on mobile
                if ($(window).width() < 768) {
                    $('html, body').animate({ scrollTop: $('#parentCard').offset().top - 20 }, 300);
                }
            } else {
                $('#qrResult').html('<span class="text-danger font-weight-bold"><i class="fas fa-times-circle mr-1"></i> ' + (res.message || 'Invalid QR Code') + '</span>');
                showAlert(res.message || 'Invalid QR Code', 'danger');
                setTimeout(startCamera, 2000);
            }
        })
        .catch(err => {
            console.error('Verify error:', err);
            $('#qrResult').html('<span class="text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Connection error</span>');
            showAlert('Connection error. Please try again.', 'danger');
            setTimeout(startCamera, 2000);
        });
    }

    // Action button click
    $(document).on('click', '.action-btn', function() {
        pendingStudentId = $(this).data('student-id');
        pendingParentId = $(this).data('parent-id');
        $('#confirmStudentName').text($(this).data('name'));
        $('#confirmActionModal').modal('show');
    });

    // Release
    $('#confirmRelease').click(function() {
        $('#confirmActionModal').modal('hide');
        if (!pendingStudentId || !pendingParentId) return;
        
        var formData = new FormData();
        formData.append('student_id', pendingStudentId);
        formData.append('parent_id', pendingParentId);
        formData.append(CSRF_NAME, CSRF_HASH);
        
        fetch(BASE_URL + 'scan/release', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                showAlert('✅ Student released! SMS sent to parent.', 'success');
            } else {
                showAlert('❌ ' + (res.message || 'Failed to release'), 'danger');
            }
            resetAndRestart();
        })
        .catch(err => {
            console.error('Release error:', err);
            showAlert('Connection error', 'danger');
            resetAndRestart();
        });
    });

    // Decline
    $('#confirmDecline').click(function() {
        $('#confirmActionModal').modal('hide');
        if (!pendingStudentId || !pendingParentId) return;
        
        var formData = new FormData();
        formData.append('student_id', pendingStudentId);
        formData.append('parent_id', pendingParentId);
        formData.append(CSRF_NAME, CSRF_HASH);
        
        fetch(BASE_URL + 'scan/decline', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                showAlert('❌ Pickup declined. SMS sent.', 'warning');
            } else {
                showAlert('Error: ' + (res.message || 'Failed'), 'danger');
            }
            resetAndRestart();
        })
        .catch(err => {
            console.error('Decline error:', err);
            showAlert('Connection error', 'danger');
            resetAndRestart();
        });
    });

    function resetAndRestart() {
        $('#parentCard').hide(); 
        $('#emptyState').show();
        $('#qrInput').val(''); 
        $('#qrResult').html(''); 
        $('#scanResult').html('');
        $('#studentsList').html(''); 
        $('#fetcherType').hide();
        pendingStudentId = null; 
        pendingParentId = null;
        setTimeout(startCamera, 1500);
    }
});

function openImageViewer(u, t) { 
    if (!u) return; 
    $('#imageViewerFull').attr('src', u); 
    $('#imageDownloadBtn').attr('href', u); 
    $('#imageDownloadBtn').attr('download', t.replace(/\s+/g, '_') + '.png'); 
    $('#imageViewerTitle').text(t || 'Photo'); 
    $('#imageViewerModal').modal('show'); 
}
</script>

<style>
.img-circle { border-radius: 50%; }
.card { border-radius: 10px; }
#reader { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
#reader video { border-radius: 12px; }
#parentPhotoContainer { transition: all 0.3s; }
#parentPhotoContainer:hover { transform: scale(1.05); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
.student-item:hover { background: #f8f9fa; border-color: #667eea !important; }
.btn-lg { border-radius: 8px; }
@media (max-width: 768px) { 
    #parentPhotoContainer { width: 120px !important; height: 120px !important; } 
    #reader { max-width: 300px; }
}
</style>
<?= $this->endSection() ?>