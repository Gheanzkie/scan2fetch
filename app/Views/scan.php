<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SOFT PASTEL CHILD-FRIENDLY THEME - QR SCANNER ===== */
:root {
    --soft-blue: #a8c0ff;
    --soft-purple: #3f2b96;
    --soft-pink: #f093fb;
    --soft-rose: #f5576c;
    --soft-teal: #4facfe;
    --soft-green: #81c784;
    --soft-orange: #ffb74d;
    --soft-yellow: #ffd54f;
}

body {
    background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%) !important;
    color: #3d3d5c !important;
}

.content-wrapper {
    background: transparent !important;
    position: relative;
    z-index: 1;
}

/* ===== FLOATING SHAPES ===== */
.floating-shapes {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    overflow: hidden;
    z-index: 0;
    pointer-events: none;
}

.floating-shapes .shape {
    position: absolute;
    font-size: 3rem;
    opacity: 0.06;
    animation: floatShape 18s ease-in-out infinite;
}

.floating-shapes .shape:nth-child(1) { top: 5%; left: 3%; animation-delay: 0s; }
.floating-shapes .shape:nth-child(2) { top: 15%; right: 5%; animation-delay: 2.5s; }
.floating-shapes .shape:nth-child(3) { bottom: 20%; left: 4%; animation-delay: 5s; }
.floating-shapes .shape:nth-child(4) { bottom: 10%; right: 3%; animation-delay: 1.5s; }
.floating-shapes .shape:nth-child(5) { top: 45%; left: 45%; animation-delay: 3.5s; font-size: 4.5rem; opacity: 0.04; }
.floating-shapes .shape:nth-child(6) { top: 70%; left: 20%; animation-delay: 4s; }
.floating-shapes .shape:nth-child(7) { top: 30%; left: 75%; animation-delay: 6s; }

@keyframes floatShape {
    0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
    25% { transform: translateY(-25px) rotate(8deg) scale(1.05); }
    75% { transform: translateY(20px) rotate(-5deg) scale(0.95); }
}

/* ===== CARDS ===== */
.card {
    border-radius: 25px !important;
    border: 1px solid rgba(255,255,255,0.6) !important;
    background: rgba(255,255,255,0.7) !important;
    backdrop-filter: blur(15px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.04) !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.06) !important;
}

.card-header {
    background: rgba(255,255,255,0.5) !important;
    border-bottom: 1px solid rgba(255,255,255,0.3) !important;
    padding: 1rem 1.5rem !important;
}

.card-header h5 {
    color: #4a4a6a !important;
    font-weight: 700 !important;
    font-size: 1.1rem !important;
}

.card-body {
    padding: 1.5rem !important;
}

/* ===== SCANNER ===== */
#reader {
    border: 4px solid var(--soft-blue) !important;
    border-radius: 20px !important;
    overflow: hidden !important;
    box-shadow: 0 8px 30px rgba(168,192,255,0.2) !important;
    background: #f5f0ff !important;
}

#reader video {
    border-radius: 16px !important;
}

/* ===== FORM CONTROLS ===== */
.form-control {
    background: rgba(255,255,255,0.6) !important;
    border: 2px solid rgba(160,160,180,0.12) !important;
    color: #3d3d5c !important;
    border-radius: 15px !important;
    padding: 12px 18px !important;
    transition: all 0.3s ease !important;
    font-size: 15px !important;
    height: 50px !important;
    letter-spacing: 1px !important;
}

.form-control:focus {
    background: rgba(255,255,255,0.9) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(168,192,255,0.12) !important;
    color: #3d3d5c !important;
}

.form-control::placeholder {
    color: #b0b0c8 !important;
    font-weight: 400 !important;
}

.input-group-text {
    background: rgba(255,255,255,0.4) !important;
    border: 2px solid rgba(160,160,180,0.12) !important;
    border-right: none !important;
    color: #7a7a9a !important;
    border-radius: 15px 0 0 15px !important;
    font-size: 16px !important;
}

.input-group .form-control {
    border-radius: 0 15px 15px 0 !important;
    border-left: none !important;
}

.input-group .form-control:focus {
    border-left: none !important;
}

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    padding: 10px 25px !important;
    font-size: 14px !important;
}

.btn:hover {
    transform: translateY(-3px) scale(1.03);
}

.btn-lg {
    padding: 12px 35px !important;
    font-size: 16px !important;
    border-radius: 50px !important;
}

.btn-success {
    background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(129,199,132,0.3) !important;
}

.btn-success:hover {
    box-shadow: 0 8px 25px rgba(129,199,132,0.4) !important;
}

.btn-danger {
    background: linear-gradient(135deg, var(--soft-rose), #d32f2f) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(245,87,108,0.3) !important;
}

.btn-danger:hover {
    box-shadow: 0 8px 25px rgba(245,87,108,0.4) !important;
}

.btn-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(63,43,150,0.2) !important;
}

.btn-primary:hover {
    box-shadow: 0 8px 25px rgba(63,43,150,0.3) !important;
}

.btn-outline-secondary {
    border: 2px solid rgba(160,160,180,0.15) !important;
    color: #7a7a9a !important;
    background: rgba(255,255,255,0.3) !important;
}

.btn-outline-secondary:hover {
    background: rgba(168,192,255,0.08) !important;
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
}

/* ===== BADGES ===== */
.badge {
    font-weight: 600 !important;
    padding: 8px 20px !important;
    border-radius: 50px !important;
    font-size: 13px !important;
}

.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-light { background: rgba(160,160,180,0.08) !important; color: #7a7a9a !important; }
.badge-primary { background: var(--soft-blue) !important; color: #fff !important; }

/* ===== STUDENT ITEM ===== */
.student-item {
    border-radius: 18px !important;
    border: 1px solid rgba(160,160,180,0.08) !important;
    background: rgba(255,255,255,0.3) !important;
    transition: all 0.3s ease !important;
}

.student-item:hover {
    background: rgba(168,192,255,0.06) !important;
    border-color: var(--soft-blue) !important;
    transform: scale(1.01);
}

/* ===== PHOTO ===== */
.img-circle {
    border-radius: 50% !important;
    transition: all 0.3s ease !important;
}

.img-circle:hover {
    transform: scale(1.1);
}

#parentPhotoContainer {
    transition: all 0.3s ease !important;
    border: 5px solid var(--soft-blue) !important;
    box-shadow: 0 8px 30px rgba(168,192,255,0.2) !important;
}

#parentPhotoContainer:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 40px rgba(168,192,255,0.3) !important;
}

/* ===== BREADCRUMB ===== */
.breadcrumb {
    background: transparent !important;
    padding: 0 !important;
}

.breadcrumb-item a {
    color: #7a7a9a !important;
    transition: color 0.3s ease !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    font-size: 14px !important;
}

.breadcrumb-item a:hover {
    color: var(--soft-purple) !important;
}

.breadcrumb-item.active {
    color: #4a4a6a !important;
    font-weight: 600 !important;
    font-size: 14px !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: #c0c0d8 !important;
    content: "›" !important;
}

/* ===== CONTENT HEADER ===== */
.content-header h1 {
    color: #3d3d5c !important;
    font-weight: 700 !important;
    font-size: 2rem !important;
}

.content-header h1 i {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== EMPTY STATE ===== */
.empty-state {
    color: #b0b0c8 !important;
}

.empty-state i {
    color: rgba(160,160,180,0.15) !important;
}

.empty-state h4 {
    color: #7a7a9a !important;
}

/* ===== MODAL ===== */
.modal-content {
    border-radius: 25px !important;
    border: 1px solid rgba(255,255,255,0.6) !important;
    background: rgba(255,255,255,0.9) !important;
    backdrop-filter: blur(15px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.06) !important;
}

.modal-header {
    border-bottom: 1px solid rgba(160,160,180,0.08) !important;
    border-radius: 25px 25px 0 0 !important;
    background: rgba(255,255,255,0.5) !important;
}

.modal-header h5 {
    color: #4a4a6a !important;
    font-weight: 700 !important;
}

.modal-footer {
    border-top: 1px solid rgba(160,160,180,0.08) !important;
    border-radius: 0 0 25px 25px !important;
    background: rgba(255,255,255,0.3) !important;
}

/* ===== ALERT ===== */
.alert {
    border-radius: 18px !important;
    padding: 14px 20px !important;
    font-size: 14px !important;
    border: 2px solid transparent !important;
}

.alert-success {
    background: rgba(129,199,132,0.15) !important;
    border-color: rgba(129,199,132,0.2) !important;
    color: #4a7a4a !important;
}

.alert-danger {
    background: rgba(245,87,108,0.15) !important;
    border-color: rgba(245,87,108,0.2) !important;
    color: #8a4a4a !important;
}

.alert-warning {
    background: rgba(255,183,77,0.15) !important;
    border-color: rgba(255,183,77,0.2) !important;
    color: #8a7a4a !important;
}

/* ===== KID EMOJI ANIMATION ===== */
.kid-emoji {
    display: inline-block;
    animation: sparkle 2s ease-in-out infinite;
}

@keyframes sparkle {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.15) rotate(8deg); }
}

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f5f0ff;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple));
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--soft-pink);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .card-body {
        padding: 1rem !important;
    }
    .content-header h1 {
        font-size: 1.5rem !important;
    }
    #reader {
        max-width: 100% !important;
    }
    #parentPhotoContainer {
        width: 120px !important;
        height: 120px !important;
    }
    .floating-shapes .shape {
        font-size: 2rem !important;
    }
    .btn-lg {
        padding: 10px 20px !important;
        font-size: 14px !important;
    }
}

@media (max-width: 480px) {
    .card {
        border-radius: 18px !important;
    }
    .badge {
        font-size: 10px !important;
        padding: 4px 12px !important;
    }
    .floating-shapes .shape {
        display: none !important;
    }
    #parentPhotoContainer {
        width: 100px !important;
        height: 100px !important;
    }
    .student-item {
        flex-wrap: wrap !important;
        justify-content: center !important;
        text-align: center !important;
    }
}
</style>

<!-- ===== FLOATING SHAPES ===== -->
<div class="floating-shapes">
    <div class="shape">🌈</div>
    <div class="shape">⭐</div>
    <div class="shape">🎈</div>
    <div class="shape">🌸</div>
    <div class="shape">☁️</div>
    <div class="shape">🌟</div>
    <div class="shape">🎉</div>
</div>

<div class="content-wrapper" style="background: transparent;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-qrcode mr-2"></i>
                        QR Code Scanner <span class="kid-emoji">🔍</span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item active">🔍 QR Scan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <!-- ===== ALERT AREA ===== -->
            <div id="alertArea" style="display:none;"></div>

            <div class="row">
                <!-- ===== LEFT: Scanner + Manual Input ===== -->
                <div class="col-lg-5 col-md-6 col-12">
                    
                    <!-- Camera Scanner -->
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                            <h5 class="mb-0">
                                <i class="fas fa-camera mr-2" style="color: var(--soft-blue);"></i>
                                Camera Scanner 📷
                            </h5>
                            <div class="btn-group btn-group-sm mt-1 mt-md-0" style="gap: 4px;">
                                <button class="btn btn-success" id="startCameraBtn" style="display:none;">
                                    <i class="fas fa-play mr-1"></i> Start
                                </button>
                                <button class="btn btn-danger" id="stopCameraBtn">
                                    <i class="fas fa-stop mr-1"></i> Stop
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <div id="reader" style="width:100%;max-width:400px;margin:0 auto;"></div>
                            <div id="scanResult" class="mt-3"></div>
                            <small class="text-muted mt-2 d-block" style="color: #b0b0c8 !important;">
                                <i class="fas fa-info-circle mr-1"></i> Point camera at the QR code 📸
                            </small>
                        </div>
                    </div>

                    <!-- Manual Input -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-keyboard mr-2" style="color: var(--soft-teal);"></i>
                                Manual QR Code Input ⌨️
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-qrcode"></i></span>
                                </div>
                                <input type="text" id="qrInput" class="form-control text-center font-weight-bold" 
                                       placeholder="Enter QR Code (e.g. QR-4A2B8C3D1E5F)" 
                                       style="font-size:1rem;letter-spacing:1px;text-transform:uppercase;">
                            </div>
                            <button class="btn btn-primary btn-lg px-4" id="verifyQrBtn">
                                <i class="fas fa-search mr-1"></i> Verify QR Code 🔍
                            </button>
                            <div class="mt-3" id="qrResult"></div>
                        </div>
                    </div>
                </div>

                <!-- ===== RIGHT: Results ===== -->
                <div class="col-lg-7 col-md-6 col-12">
                    
                    <!-- Empty State -->
                    <div class="card" id="emptyState">
                        <div class="card-body text-center py-5 empty-state">
                            <i class="fas fa-qrcode fa-5x mb-4 d-block"></i>
                            <h4>Ready to Scan 🎯</h4>
                            <p class="mb-0">Scan a QR code using the camera or type the code manually</p>
                            <hr class="my-4" style="max-width:200px; margin: 1.5rem auto; border-color: rgba(160,160,180,0.15);">
                            <small><i class="fas fa-lightbulb" style="color: var(--soft-orange);"></i> The QR code number is printed below each QR image</small>
                        </div>
                    </div>

                    <!-- Parent/Fetcher Card -->
                    <div class="card" id="parentCard" style="display:none;">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                            <h5 class="mb-0">
                                <i class="fas fa-user-check mr-2" style="color: var(--soft-green);"></i>
                                Verified ✅
                            </h5>
                            <span class="badge badge-success badge-pill px-3 py-1">✅ Verified</span>
                        </div>
                        <div class="card-body">
                            
                            <!-- Fetcher/Parent Profile -->
                            <div class="text-center mb-4">
                                <div id="parentPhotoContainer" 
                                     style="width:160px;height:160px;margin:0 auto;border-radius:50%;overflow:hidden;border:5px solid var(--soft-blue);cursor:pointer;box-shadow:0 8px 30px rgba(168,192,255,0.2);" 
                                     onclick="openImageViewer($('#parentPic').attr('src'), $('#parentName').text())">
                                    <img id="parentPic" src="" style="width:100%;height:100%;object-fit:cover;display:none;">
                                    <div id="parentNoPic" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg, var(--soft-blue), var(--soft-purple));">
                                        <i class="fas fa-user fa-4x text-white"></i>
                                    </div>
                                </div>
                                <h3 class="mt-3 mb-1" id="parentName" style="color: #3d3d5c;"></h3>
                                <p class="mb-1" id="parentPhone" style="color: #7a7a9a;"></p>
                                <span class="badge badge-pill px-3 py-1 mt-1" id="fetcherType" style="display:none;font-size:0.9rem;"></span>
                            </div>

                            <hr style="border-color: rgba(160,160,180,0.1);">

                            <!-- Students List -->
                            <h5 class="mb-3" style="color: #4a4a6a;">
                                <i class="fas fa-child mr-2" style="color: var(--soft-orange);"></i>
                                Students to Release 🎓
                                <span class="badge badge-light ml-1" id="studentCount" style="font-size: 13px;">0</span>
                            </h5>
                            <div id="studentsList"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- ===== CONFIRM ACTION MODAL ===== -->
<div class="modal fade" id="confirmActionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5><i class="fas fa-question-circle mr-2" style="color: var(--soft-orange);"></i>Confirm Action 🤔</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #4a4a6a;">&times;</button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-user-graduate fa-3x mb-3" style="color: var(--soft-blue);"></i>
                <h5 class="mb-2" style="color: #3d3d5c;">Release Student? 🚀</h5>
                <p class="mb-0" style="color: #7a7a9a;"><strong id="confirmStudentName" style="color: #3d3d5c;"></strong></p>
                <small style="color: #b0b0c8;">An SMS notification will be sent to the parent. 📱</small>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-danger btn-lg px-4 mx-2" id="confirmDecline">
                    <i class="fas fa-times-circle mr-1"></i> Decline ❌
                </button>
                <button type="button" class="btn btn-success btn-lg px-4 mx-2" id="confirmRelease">
                    <i class="fas fa-check-circle mr-1"></i> Release ✅
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ===== IMAGE VIEWER MODAL ===== -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5><i class="fas fa-image mr-2" style="color: var(--soft-blue);"></i><span id="imageViewerTitle">📸 Photo</span></h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #4a4a6a;">&times;</button>
            </div>
            <div class="modal-body text-center p-3" style="background: #f8f5ff; border-radius: 0 0 25px 25px;">
                <img id="imageViewerFull" src="" style="max-width:100%;max-height:65vh;border-radius:15px;">
            </div>
            <div class="modal-footer">
                <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm">
                    <i class="fas fa-download mr-1"></i> Download 💾
                </a>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close ❌</button>
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
        $('#scanResult').html('<span style="color: #7a7a9a;"><i class="fas fa-sync-alt fa-spin mr-1"></i> Starting camera...</span>');
        
        html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            { facingMode: "environment" }, 
            { fps: 10, qrbox: { width: 250, height: 250 } },
            function(decodedText) {
                $('#scanResult').html('<span style="color: var(--soft-green); font-weight: bold;"><i class="fas fa-check-circle mr-1"></i> QR Code Scanned! ✅</span>');
                stopCamera(false);
                verifyQrCode(decodedText);
            },
            function(errorMessage) {
                // Scanning in progress, do nothing
            }
        ).then(function() {
            $('#scanResult').html('<span style="color: var(--soft-green);"><i class="fas fa-camera mr-1"></i> Camera ready. Point at QR code. 📸</span>');
        }).catch(function(err) {
            isScanning = false;
            $('#scanResult').html('<span style="color: var(--soft-rose);"><i class="fas fa-exclamation-triangle mr-1"></i> Camera error: ' + err.message + '</span>');
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
            showAlert('Please enter a QR code 📱', 'warning');
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
            '<button type="button" class="close" data-dismiss="alert" style="color: #4a4a6a;">&times;</button>' +
            '</div>'
        ).show().delay(5000).fadeOut();
    }

    function verifyQrCode(qrCode) {
        $('#qrResult').html('<span style="color: var(--soft-teal);"><i class="fas fa-spinner fa-spin mr-1"></i> Verifying QR code...</span>');
        
        var formData = new FormData();
        formData.append('qr_code', qrCode);
        formData.append(CSRF_NAME, CSRF_HASH);
        
        fetch(BASE_URL + 'scan/verify', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                $('#qrResult').html('<span style="color: var(--soft-green); font-weight: bold;"><i class="fas fa-check-circle mr-1"></i> Verified! ✅</span>');
                
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
                            html += '<img src="' + studentPic + '" class="img-circle" style="width:60px;height:60px;object-fit:cover;border:3px solid var(--soft-blue);">';
                        } else {
                            html += '<div class="img-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;border:3px solid var(--soft-blue);background:rgba(255,255,255,0.3);"><i class="fas fa-child fa-2x" style="color: #b0b0c8;"></i></div>';
                        }
                        html += '</div>';
                        html += '<div class="flex-grow-1"><strong style="font-size:1.1rem; color: #3d3d5c;">' + s.fname + ' ' + s.lname + '</strong><br><span class="badge badge-light">' + (s.grade_section || 'N/A') + '</span></div>';
                        html += '<button class="btn btn-outline-primary action-btn" data-student-id="' + sid + '" data-parent-id="' + res.parent.id + '" data-name="' + s.fname + ' ' + s.lname + '"><i class="fas fa-exchange-alt mr-1"></i> Action</button>';
                        html += '</div>';
                    });
                    $('#studentCount').text(res.students.length);
                } else {
                    html = '<div class="text-center py-4" style="color: #b0b0c8;"><i class="fas fa-user-slash fa-3x mb-3 d-block" style="color: rgba(160,160,180,0.15);"></i><p>No students linked to this parent/fetcher 😊</p></div>';
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
                $('#qrResult').html('<span style="color: var(--soft-rose); font-weight: bold;"><i class="fas fa-times-circle mr-1"></i> ' + (res.message || 'Invalid QR Code') + '</span>');
                showAlert(res.message || 'Invalid QR Code', 'danger');
                setTimeout(startCamera, 2000);
            }
        })
        .catch(err => {
            console.error('Verify error:', err);
            $('#qrResult').html('<span style="color: var(--soft-rose);"><i class="fas fa-exclamation-triangle mr-1"></i> Connection error</span>');
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
                showAlert('✅ Student released! SMS sent to parent. 📱', 'success');
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
                showAlert('❌ Pickup declined. SMS sent. 📱', 'warning');
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
    $('#imageViewerTitle').text('📸 ' + (t || 'Photo')); 
    $('#imageViewerModal').modal('show'); 
}
</script>
<?= $this->endSection() ?>