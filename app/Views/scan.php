<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SHARED PROFESSIONAL PASTEL THEME - QR SCANNER ===== */
:root {
    --soft-blue: #a8c0ff;
    --soft-purple: #3f2b96;
    --soft-pink: #f093fb;
    --soft-rose: #f5576c;
    --soft-teal: #4facfe;
    --soft-green: #81c784;
    --soft-orange: #ffb74d;
    --soft-yellow: #ffd54f;
    --ink: #3d3d5c;
    --muted: #7a7a9a;
    --faint: #b0b0c8;
}

body {
    background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%) !important;
    color: var(--ink) !important;
}

.content-wrapper { background: transparent !important; position: relative; z-index: 1; }

/* ===== CONTENT HEADER ===== */
.content-header h1 {
    color: var(--ink) !important;
    font-weight: 700 !important;
    font-size: 1.7rem !important;
}

.content-header h1 i {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== BREADCRUMB ===== */
.breadcrumb { background: transparent !important; padding: 0 !important; }

.breadcrumb-item a {
    color: var(--muted) !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    text-decoration: none !important;
    transition: color 0.25s ease !important;
}

.breadcrumb-item a:hover { color: var(--soft-purple) !important; }
.breadcrumb-item.active { color: var(--ink) !important; font-weight: 700 !important; font-size: 13px !important; }
.breadcrumb-item + .breadcrumb-item::before { color: var(--faint) !important; content: "›" !important; }

/* ===== CARDS ===== */
.card {
    border-radius: 22px !important;
    border: 1px solid rgba(255,255,255,0.7) !important;
    background: rgba(255,255,255,0.78) !important;
    box-shadow: 0 8px 30px rgba(63,43,150,0.05) !important;
    overflow: hidden !important;
}

.card-header {
    background: rgba(255,255,255,0.6) !important;
    border-bottom: 1px solid rgba(63,43,150,0.06) !important;
    padding: 1rem 1.5rem !important;
}

.card-header h5 { color: var(--ink) !important; font-weight: 700 !important; font-size: 1.05rem !important; }
.card-body { padding: 1.4rem !important; }

/* ===== SCANNER ===== */
#reader {
    border: 3px solid rgba(168,192,255,0.5) !important;
    border-radius: 16px !important;
    overflow: hidden !important;
    background: rgba(255,255,255,0.6) !important;
}

#reader video { border-radius: 12px !important; }

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 700 !important;
    transition: box-shadow 0.25s ease, color 0.25s ease, background 0.25s ease, border-color 0.25s ease !important;
}

.btn-kid-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(63,43,150,0.20) !important;
}

.btn-kid-primary:hover { box-shadow: 0 8px 25px rgba(63,43,150,0.30) !important; color: #fff !important; }

.btn-kid-success {
    background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(76,175,80,0.20) !important;
}

.btn-kid-success:hover { box-shadow: 0 8px 25px rgba(76,175,80,0.30) !important; color: #fff !important; }

.btn-outline-kid {
    border: 1.5px solid rgba(63,43,150,0.15) !important;
    color: var(--muted) !important;
    background: rgba(255,255,255,0.4) !important;
}

.btn-outline-kid:hover {
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
    background: rgba(168,192,255,0.10) !important;
}

.btn-outline-kid.active {
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
    background: rgba(168,192,255,0.15) !important;
}

.btn-sm { padding: 7px 16px !important; font-size: 12.5px !important; }

/* ===== FORM CONTROLS ===== */
.form-control {
    background: rgba(255,255,255,0.8) !important;
    border: 1.5px solid rgba(63,43,150,0.10) !important;
    color: var(--ink) !important;
    border-radius: 12px !important;
    padding: 10px 14px !important;
    transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease !important;
    font-size: 13.5px !important;
    height: 44px !important;
}

.form-control:focus {
    background: rgba(255,255,255,0.95) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(168,192,255,0.15) !important;
    color: var(--ink) !important;
}

.form-control::placeholder { color: #8f8fae !important; opacity: 1; }

.input-group-text {
    background: rgba(168,192,255,0.12) !important;
    border: 1.5px solid rgba(63,43,150,0.10) !important;
    border-right: none !important;
    color: var(--soft-purple) !important;
    border-radius: 12px 0 0 12px !important;
    font-size: 13px !important;
}

.input-group .form-control { border-radius: 0 6px 6px 0 !important; border-left: none !important; }

/* ===== BADGES ===== */
.badge {
    font-weight: 700 !important;
    padding: 6px 14px !important;
    border-radius: 50px !important;
    font-size: 11.5px !important;
}

.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-info { background: var(--soft-teal) !important; color: #fff !important; }
.badge-light { background: rgba(168,192,255,0.15) !important; color: #5a5280 !important; }

.released-badge {
    font-size: 15px !important;
    font-weight: 800 !important;
    padding: 8px 20px !important;
    border-radius: 50px !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
    box-shadow: 0 4px 14px rgba(76,175,80,0.30) !important;
    white-space: nowrap !important;
}

.released-badge i { font-size: 18px !important; }

/* ===== PARENT / STUDENT CARDS ===== */
#parentPhotoContainer {
    width: 150px;
    height: 150px;
    margin: 0 auto;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid rgba(168,192,255,0.5);
    cursor: pointer;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
}

#parentPhotoContainer:hover {
    border-color: var(--soft-pink);
    box-shadow: 0 8px 30px rgba(168,192,255,0.25);
}

#parentPhotoContainer img { width: 100%; height: 100%; object-fit: cover; }

#parentNoPic {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e2e8f0;
    color: #94a3b8;
}

.student-item {
    border-radius: 14px !important;
    border: 1px solid rgba(63,43,150,0.08) !important;
    background: rgba(255,255,255,0.45) !important;
    transition: border-color 0.25s ease, background 0.25s ease !important;
}

.student-item:hover {
    background: rgba(168,192,255,0.06) !important;
    border-color: rgba(168,192,255,0.4) !important;
}

.img-circle { border-radius: 50% !important; object-fit: cover !important; }

/* ===== ALERTS ===== */
.alert {
    border-radius: 16px !important;
    padding: 14px 20px !important;
    font-size: 13.5px !important;
    border: 1.5px solid transparent !important;
    font-weight: 600 !important;
}

.alert-success {
    background: rgba(129,199,132,0.12) !important;
    border-color: rgba(129,199,132,0.22) !important;
    color: #2e6b4f !important;
}

.alert-danger {
    background: rgba(245,87,108,0.10) !important;
    border-color: rgba(245,87,108,0.20) !important;
    color: #a83748 !important;
}

.alert-warning {
    background: rgba(255,183,77,0.12) !important;
    border-color: rgba(255,183,77,0.22) !important;
    color: #7a5a1e !important;
}

/* ===== EMPTY STATE ===== */
.empty-state { color: var(--faint) !important; }
.empty-state h4 { color: var(--muted) !important; font-weight: 700; font-size: 1.15rem !important; }
.empty-state p { color: var(--faint) !important; font-size: 13.5px !important; }
.empty-state i { color: rgba(168,192,255,0.35) !important; }

/* ===== MODAL ===== */
.modal-content {
    border-radius: 20px !important;
    border: 1px solid rgba(255,255,255,0.8) !important;
    background: rgba(255,255,255,0.97) !important;
    box-shadow: 0 20px 60px rgba(63,43,150,0.12) !important;
}

.modal-header {
    border-bottom: 1px solid rgba(63,43,150,0.06) !important;
    border-radius: 20px 20px 0 0 !important;
    background: rgba(255,255,255,0.6) !important;
    padding: 1rem 1.5rem !important;
}

.modal-header h5 { color: var(--ink) !important; font-weight: 700 !important; font-size: 1.05rem !important; }

.modal-footer {
    border-top: 1px solid rgba(63,43,150,0.06) !important;
    border-radius: 0 0 20px 20px !important;
    background: rgba(255,255,255,0.5) !important;
    padding: 0.9rem 1.5rem !important;
}

.modal-body { padding: 1.5rem !important; }

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .card-body { padding: 1rem !important; }
    #parentPhotoContainer { width: 120px; height: 120px; }
    .content-header h1 { font-size: 1.35rem !important; }
    .btn { font-size: 12px !important; padding: 7px 14px !important; }
}

@media (max-width: 480px) {
    .card { border-radius: 16px !important; }
    .student-item { flex-wrap: wrap !important; justify-content: center !important; text-align: center !important; }
}
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-qrcode mr-2"></i>
                        QR Code Scanner
 </h1>
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

 <!-- ===== ALERT AREA ===== -->
 <div id="alertArea" style="display:none;"></div>

 <div class="row justify-content-center">
 <!-- ===== SCANNER + MANUAL INPUT ===== -->
 <div class="col-lg-8 col-md-10 col-12" id="scannerCol">

 <!-- Camera Scanner -->
 <div class="card mb-3">
 <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
 <h5 class="mb-0">
 <i class="fas fa-camera mr-2" style="color: var(--soft-blue);"></i>
                                Camera Scanner
 </h5>
 <div class="d-flex align-items-center" style="gap: 6px;">
 <button class="btn btn-kid-success btn-sm" id="startCameraBtn">
 <i class="fas fa-play mr-1"></i> Start
 </button>
 <button class="btn btn-danger btn-sm" id="stopCameraBtn" style="display:none;">
 <i class="fas fa-stop mr-1"></i> Stop
 </button>
 <button class="btn btn-outline-primary btn-sm" id="photoScanBtn" title="Opens the camera app and reads the QR from the photo (works even when the live camera is blocked)">
 <i class="fas fa-image mr-1"></i> Scan from Photo
 </button>
 <label for="photoScanInput" id="mobileCamBtn" class="btn btn-kid-success btn-sm mb-1" style="display:none; margin:0;">
 <i class="fas fa-camera mr-1"></i> Open Camera
 </label>
 <input type="file" id="photoScanInput" class="d-none" accept="image/*" capture="environment">
 </div>
 </div>
 <div class="card-body text-center">
 <div id="cameraControl" style="display:none;" class="mb-3 text-left">
 <select id="cameraSelect" class="form-control">
 <option value="back">Back Camera</option>
 <option value="front">Front Camera</option>
 </select>
 </div>
 <div id="reader" style="width:100%;max-width:560px;margin:0 auto;display:none;"></div>
 <div id="photoReader" style="width:100%;max-width:560px;margin:0 auto;display:none;"></div>
 <div id="scanResult" class="mt-3"></div>
 <small class="text-muted mt-2 d-block" style="font-size:12.5px;">
 <i class="fas fa-info-circle mr-1"></i> Point the camera at the QR code
 </small>
 </div>
 </div>

 <!-- Manual Input -->
 <div class="card mb-4">
 <div class="card-header">
 <h5 class="mb-0">
 <i class="fas fa-keyboard mr-2" style="color: var(--soft-teal);"></i>
                                Manual QR Code Input
 </h5>
 </div>
 <div class="card-body text-center">
 <div class="input-group mb-3">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-qrcode"></i></span>
 </div>
 <input type="text" id="qrInput" class="form-control text-center font-weight-bold"
                                        placeholder="Enter QR Code (e.g. QR-4A2B8C3D1E5F)"
                                        style="text-transform:uppercase;">
 </div>
  <button class="btn btn-kid-primary px-4" id="verifyQrBtn">
 <i class="fas fa-search mr-1"></i> Verify QR Code
 </button>
 <div class="mt-3" id="qrResult"></div>
 </div>
 </div>
 </div>

 <!-- ===== BELOW: Results (Full Width) ===== -->
 <div class="col-12">

 <!-- Empty State -->
 <div class="card" id="emptyState">
 <div class="card-body text-center py-5 empty-state">
 <i class="fas fa-qrcode fa-5x mb-4 d-block"></i>
 <h4>Ready to Scan</h4>
 <p class="mb-0">Scan a QR code using the camera or type the code manually</p>
 <hr class="my-4" style="max-width:200px; margin: 1.5rem auto; border-color: rgba(63,43,150,0.10);">
 <small><i class="fas fa-lightbulb" style="color: var(--soft-orange);"></i> The QR code number is printed below each QR image</small>
 </div>
 </div>

 <!-- Parent/Fetcher Card -->
 <div class="card" id="parentCard" style="display:none;">
 <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
 <h5 class="mb-0">
 <i class="fas fa-user-check mr-2" style="color: var(--soft-green);"></i>
                                Verified
 </h5>
 <span class="badge badge-success">Verified</span>
 </div>
 <div class="card-body">

 <!-- Fetcher/Parent Profile -->
 <div class="text-center mb-4">
 <div id="parentPhotoContainer" onclick="openImageViewer($('#parentPic').attr('src'), $('#parentName').text())">
 <img id="parentPic" src="" style="display:none;">
 <div id="parentNoPic">
 <i class="fas fa-user fa-4x text-white"></i>
 </div>
 </div>
 <h4 class="mt-3 mb-1" id="parentName" style="color: var(--ink); font-weight: 700;"></h4>
 <p class="mb-1" id="parentPhone" style="color: var(--muted);"></p>
 <span class="badge badge-pill mt-1" id="fetcherType" style="display:none;"></span>
 </div>

 <hr style="border-color: rgba(63,43,150,0.08);">

 <!-- Students List -->
 <h5 class="mb-3" style="color: var(--ink); font-weight: 700;">
 <i class="fas fa-child mr-2" style="color: var(--soft-orange);"></i>
                                Students to Release
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

<!-- ===== IMAGE VIEWER MODAL ===== -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content">
 <div class="modal-header">
 <h5><i class="fas fa-image mr-2" style="color: var(--soft-blue);"></i><span id="imageViewerTitle">Photo</span></h5>
 <button type="button" class="close" data-dismiss="modal" style="color: var(--ink);">&times;</button>
 </div>
 <div class="modal-body text-center">
 <img id="imageViewerFull" src="" style="max-width:100%;max-height:65vh;border-radius:12px;">
 </div>
 <div class="modal-footer">
 <a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-kid-primary btn-sm">
 <i class="fas fa-download mr-1"></i> Download
 </a>
 <button type="button" class="btn btn-outline-kid btn-sm" data-dismiss="modal">Close</button>
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
    var availableCameras = [];
    var selectedCamera = 'back';

    initCameraSelector();

    // On insecure http the browser BLOCKS the live in-page camera. Split behaviour:
    //   - Phone/tablet : use the native camera app (open the photo input via a <label>).
    //   - Laptop/desktop: keep the normal live-camera UI (works on localhost/https)
    //                     and only add the camera-app button as a backup.
    if (isInsecureHttp()) {
        if (isMobileDevice()) {
            $('#startCameraBtn, #stopCameraBtn, #photoScanBtn, #cameraControl').hide();
            $('#mobileCamBtn').show();
            $('#mobileCamBtn').html('<i class="fas fa-camera mr-1"></i> TAP to Open Camera &amp; Scan QR');
            $('#mobileCamBtn').addClass('btn-lg btn-block');
            $('#scanResult').html('<span style="color: var(--soft-orange);"><i class="fas fa-info-circle mr-1"></i> Live camera is blocked here, so the green button uses your phone\'s camera app. Steps: <strong>1)</strong> tap the green button  camera opens. <strong>2)</strong> take the photo close-up (QR code fills the screen, good light). <strong>3)</strong> wait — it is read automatically.</span>');
        } else {
            $('#mobileCamBtn').show();
            $('#mobileCamBtn').html('<i class="fas fa-image mr-1"></i> Camera / Photo');
            $('#scanResult').html('<span style="color: var(--soft-orange);"><i class="fas fa-info-circle mr-1"></i> Live camera is blocked on this connection (needs localhost or https). On this laptop open <strong>http://localhost:8080/scan</strong> to use the live external camera.</span>');
        }
    }

    // Enumerate available cameras and populate the Back/Front selector
    function initCameraSelector() {
        if (!Html5Qrcode.getCameras) return;
        Html5Qrcode.getCameras().then(function(devices) {
            availableCameras = devices || [];
            if (availableCameras.length === 0) return;

            var backFound = false, frontFound = false;
            availableCameras.forEach(function(cam) {
                var label = (cam.label || '').toLowerCase();
                if (/back|rear|environment|后|右/i.test(label)) backFound = true;
                if (/front|user|前置|自拍/i.test(label)) frontFound = true;
            });

            var $sel = $('#cameraSelect');
            $sel.find('option:not(.base)').remove();
            $sel.append('<option value="back">Back Camera</option>');
            $sel.append('<option value="front">Front Camera</option>');
            availableCameras.forEach(function(cam, i) {
                $sel.append('<option value="' + cam.id + '">' + (cam.label || ('Camera ' + (i + 1))) + '</option>');
            });

            // Thumbnail heuristic: preferred default stays "back"
            if (backFound) selectedCamera = 'back';
            else if (frontFound) selectedCamera = 'front';
            else selectedCamera = availableCameras[0].id;
            $sel.val(selectedCamera);
            $('#cameraControl').show();
        }).catch(function() {});
    }

    // Rebuild html5QrCode and read the selected device
    function getCameraConfig() {
        var val = $('#cameraSelect').val() || selectedCamera;
        if (val === 'back') return { facingMode: { exact: 'environment' } };
        if (val === 'front') return { facingMode: { exact: 'user' } };
        return { deviceId: { exact: val } };
    }

    function startCamera() {
        if (isScanning) return;
        // On plain http (non-localhost) the in-page live camera is always
        // blocked by the browser.
        if (isInsecureHttp()) {
            if (isMobileDevice()) {
                // Phone: go straight to the phone's camera app (same QR-photo flow).
                $('#scanResult').html('<span style="color: var(--muted);"><i class="fas fa-camera mr-1"></i> Live camera is blocked on this connection — opening the camera app instead...</span>');
                $('#photoScanInput').click();
            } else {
                // Desktop: explain how to get the live (external) camera back.
                $('#scanResult').html('<span style="color: var(--soft-orange);"><i class="fas fa-info-circle mr-1"></i> Live camera is blocked on this connection. On this laptop open <strong>http://localhost:8080/scan</strong> to use the live external camera, or tap "Camera / Photo".</span>');
            }
            return;
        }
        isScanning = true;
        $('#reader').show();
        $('#startCameraBtn').hide();
        $('#stopCameraBtn').show();
        $('#cameraSelect').prop('disabled', true);
        $('#scanResult').html('<span style="color: var(--muted);"><i class="fas fa-sync-alt fa-spin mr-1"></i> Starting camera...</span>');

        html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            getCameraConfig(),
            { fps: 10, qrbox: { width: 320, height: 320 } },
            function(decodedText) {
                $('#scanResult').html('<span style="color: var(--soft-green); font-weight: bold;"><i class="fas fa-check-circle mr-1"></i> QR Code Scanned!</span>');
                stopCamera(false, true);
                verifyQrCode(decodedText);
            },
            function(errorMessage) {
                // Scanning in progress, do nothing
            }
        ).then(function() {
            $('#scanResult').html('<span style="color: var(--soft-green);"><i class="fas fa-camera mr-1"></i> Camera ready. Point at the QR code.</span>');
        }).catch(function(err) {
            isScanning = false;
            $('#startCameraBtn').show();
            $('#stopCameraBtn').hide();
            $('#cameraSelect').prop('disabled', false);
            var msg = (err && err.message) ? err.message : 'Camera error';
            $('#scanResult').html('<span style="color: var(--soft-rose);"><i class="fas fa-exclamation-triangle mr-1"></i> Camera error: ' + msg + '</span>');
            setTimeout(function() {
                if (isInsecureHttp() && !isMobileDevice()) {
                    $('#scanResult').html('<span style="color: var(--muted);"><i class="fas fa-exclamation-circle mr-1"></i> Tip: open <strong>http://localhost:8080/scan</strong> on this laptop for the live external camera.</span>');
                } else {
                    $('#scanResult').html('<span style="color: var(--muted);"><i class="fas fa-exclamation-circle mr-1"></i> If the camera does not open, tap Start above to retry.</span>');
                }
            }, 6000);
        });
    }

    function stopCamera(showStart, keepScanning) {
        if (html5QrCode) {
            html5QrCode.stop().then(function() {
                isScanning = false;
                $('#reader').hide();
                $('#stopCameraBtn').hide();
                $('#cameraSelect').prop('disabled', false);
                if (showStart !== false) $('#startCameraBtn').show();
                if (!keepScanning) $('#scanResult').html('');
            }).catch(function() {});
        }
    }

    $('#stopCameraBtn').click(function() { stopCamera(true); });

    $('#startCameraBtn').click(function() {
        startCamera();
    });

    // ===== SCAN QR CODE FROM A PHOTO (uses the phone camera app, works over http) =====
    function isInsecureHttp() {
        return !window.isSecureContext && !/^(localhost|127\.0\.0\.1)$/.test(location.hostname);
    }

    // True for phones/tablets that need the native camera app on http.
    // Uses UA + touch-points + userAgentData so it stays correct even on
    // phones whose UA string is abbreviated or custom.
    function isMobileDevice() {
        if (/Mobi|Android|iPhone|iPad|iPod|Opera Mini|IEMobile|BlackBerry/i.test(navigator.userAgent)) return true;
        if (navigator.maxTouchPoints > 1 && (screen.width < 1024 || /Android/i.test(navigator.userAgent))) return true;
        if (navigator.userAgentData && navigator.userAgentData.mobile) return true;
        return false;
    }

    // Load a picked File into an <img> element (browser applies EXIF orientation).
    function loadImage(file) {
        return new Promise(function(resolve, reject) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = new Image();
                img.onload = function() { resolve(img); };
                img.onerror = reject;
                img.src = e.target.result;
            };
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }

    // Redraw the image onto a white canvas at a max dimension and export as a
    // normalized JPEG File. This fixes HEIC/PNG/rotate formats that the QR
    // decoder cannot read and clips huge photos to a scan-friendly size.
    function normalizeImage(img, maxDim) {
        var scale = Math.min(1, maxDim / Math.max(img.width, img.height));
        var cw = Math.max(1, Math.round(img.width * scale));
        var ch = Math.max(1, Math.round(img.height * scale));
        var canvas = document.createElement('canvas');
        canvas.width = cw;
        canvas.height = ch;
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = '#fff';
        ctx.fillRect(0, 0, cw, ch);
        ctx.drawImage(img, 0, 0, cw, ch);
        return new Promise(function(resolve) {
            canvas.toBlob(function(blob) {
                if (blob) {
                    resolve(new File([blob], 'scan.jpg', { type: 'image/jpeg' }));
                } else {
                    resolve(null);
                }
            }, 'image/jpeg', 0.95);
        });
    }

    // Zoom into the center of the photo where the QR usually sits and re-encode
    // as a JPEG. Helps when the QR is small inside the shot.
    function centerCropCandidate(img, zoom) {
        var srcW = img.naturalWidth || img.width;
        var srcH = img.naturalHeight || img.height;
        var cw = Math.max(1, Math.round(srcW / zoom));
        var ch = Math.max(1, Math.round(srcH / zoom));
        var sx = Math.floor((srcW - cw) / 2);
        var sy = Math.floor((srcH - ch) / 2);
        var outMax = 1400;
        var scale = outMax / Math.max(cw, ch);
        if (scale > 1) scale = 1;
        var dw = Math.max(1, Math.round(cw * scale));
        var dh = Math.max(1, Math.round(ch * scale));
        var canvas = document.createElement('canvas');
        canvas.width = dw;
        canvas.height = dh;
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = '#fff';
        ctx.fillRect(0, 0, dw, dh);
        ctx.drawImage(img, sx, sy, cw, ch, 0, 0, dw, dh);
        return new Promise(function(resolve) {
            canvas.toBlob(function(blob) {
                resolve(blob ? new File([blob], 'crop.jpg', { type: 'image/jpeg' }) : null);
            }, 'image/jpeg', 0.95);
        });
    }

    // Convert the photo to high-contrast black & white (Otsu threshold).
    // This is the single most effective trick for phone photos affected by
    // glare, low light, moiré or slight blur — the QR becomes sharp black/white.
    function binarizeCandidate(img, maxDim) {
        var scale = Math.min(1, maxDim / Math.max(img.width, img.height));
        var cw = Math.max(1, Math.round(img.width * scale));
        var ch = Math.max(1, Math.round(img.height * scale));
        var canvas = document.createElement('canvas');
        canvas.width = cw;
        canvas.height = ch;
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = '#fff';
        ctx.fillRect(0, 0, cw, ch);
        ctx.drawImage(img, 0, 0, cw, ch);
        var px = ctx.getImageData(0, 0, cw, ch).data;

        var hist = new Array(256).fill(0);
        for (var i = 0; i < px.length; i += 4) {
            hist[Math.round(0.299 * px[i] + 0.587 * px[i + 1] + 0.114 * px[i + 2])]++;
        }
        var total = cw * ch, sum = 0, sumB = 0, wB = 0, maxVar = -1, threshold = 128;
        for (var t = 0; t < 256; t++) sum += t * hist[t];
        for (var t = 0; t < 256; t++) {
            wB += hist[t];
            if (wB === 0) continue;
            var wF = total - wB;
            if (wF === 0) break;
            sumB += t * hist[t];
            var mB = sumB / wB, mF = (sum - sumB) / wF;
            var between = wB * wF * (mB - mF) * (mB - mF);
            if (between > maxVar) { maxVar = between; threshold = t; }
        }

        var out = ctx.createImageData(cw, ch);
        var d = out.data;
        for (var j = 0; j < px.length; j += 4) {
            var lum = Math.round(0.299 * px[j] + 0.587 * px[j + 1] + 0.114 * px[j + 2]);
            var v = lum < threshold ? 0 : 255;
            d[j] = d[j + 1] = d[j + 2] = v;
            d[j + 3] = 255;
        }
        ctx.putImageData(out, 0, 0);
        return new Promise(function(resolve) {
            canvas.toBlob(function(blob) {
                resolve(blob ? new File([blob], 'bin.jpg', { type: 'image/jpeg' }) : null);
            }, 'image/jpeg', 0.92);
        });
    }

    function tryScan(files, attempt) {
        $('#scanResult').html('<span style="color: var(--muted);"><i class="fas fa-sync-alt fa-spin mr-1"></i> Reading QR code from photo... (attempt ' + (attempt + 1) + ' of ' + files.length + ')</span>');
        var scanner = new Html5Qrcode("photoReader");
        return scanner.scanFile(files[attempt], true)
            .then(function(decodedText) {
                scanner.clear();
                return decodedText;
            })
            .catch(function() {
                scanner.clear();
                if (attempt + 1 < files.length) {
                    return tryScan(files, attempt + 1);
                }
                return Promise.reject(null);
            });
    }

    $('#photoScanBtn').click(function() {
        if (isScanning) { stopCamera(true, true); }
        $('#photoScanInput').click();
    });

    $('#photoScanInput').on('change', function() {
        var file = this.files[0];
        this.value = '';
        if (!file) return;
        $('#photoReader').show();
        $('#scanResult').html('<span style="color: var(--muted);"><i class="fas fa-spinner fa-spin mr-1"></i> Reading QR code from photo...</span>');
        loadImage(file)
            .then(function(img) {
                var candidates = [];
                var chain = Promise.resolve();
                var add = function(f) { if (f) candidates.push(f); };
                chain = chain.then(function() { return binarizeCandidate(img, 1200); }).then(add);
                chain = chain.then(function() { return normalizeImage(img, 1600); }).then(add);
                chain = chain.then(function() { return centerCropCandidate(img, 2.2); }).then(add);
                chain = chain.then(function() { return centerCropCandidate(img, 3.5); }).then(add);
                chain = chain.then(function() { return normalizeImage(img, 700); }).then(add);
                chain = chain.then(function() { return Promise.resolve(file); }).then(add);
                return chain.then(function() { return tryScan(candidates, 0); });
            })
            .then(function(decodedText) {
                $('#photoReader').hide();
                $('#scanResult').html('<span style="color: var(--soft-green); font-weight: bold;"><i class="fas fa-check-circle mr-1"></i> QR Code Scanned!</span>');
                verifyQrCode(decodedText);
            })
            .catch(function() {
                $('#photoReader').hide();
                $('#scanResult').html('<span style="color: var(--soft-rose);"><i class="fas fa-exclamation-triangle mr-1"></i> Could not read the QR code from the photo. Take the shot close-up with the QR code filling the frame and good lighting, then retry, or type the code manually.</span>');
                setTimeout(function() {
                    $('#scanResult').html('');
                }, 8000);
            });
    });

    // Switch front/back camera live
    $('#cameraSelect').on('change', function() {
        if (isScanning) {
            html5QrCode.stop().then(function() {
                isScanning = false;
                $('#reader').hide();
                startCamera();
            }).catch(function() {
                startCamera();
            });
        } else {
            startCamera();
        }
    });

    // Manual verify
    $('#verifyQrBtn').click(function() {
        var qr = $('#qrInput').val().trim().toUpperCase();
        if (!qr) {
            showAlert('Please enter a QR code.', 'warning');
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
            '<button type="button" class="close" data-dismiss="alert" style="color: var(--ink);">&times;</button>' +
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
                $('#qrResult').html('<span style="color: var(--soft-green); font-weight: bold;"><i class="fas fa-check-circle mr-1"></i> Auto-releasing...</span>');

                var p = res.parent, f = res.fetcher;
                var fetcherName = p.fname + ' ' + p.lname;
                if (f && f.type === 'Sub-Fetcher') {
                    fetcherName = f.fname + ' ' + f.lname;
                }

                // Update fetcher / parent profile
                if (f && f.type === 'Sub-Fetcher') {
                    $('#parentName').text(f.fname + ' ' + f.lname);
                    $('#parentPhone').html('<i class="fas fa-phone mr-1"></i> ' + f.phone);
                    $('#fetcherType').text('Sub-Fetcher').removeClass('badge-info badge-success').addClass('badge-warning').show();
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
                    $('#fetcherType').text('Main Parent').removeClass('badge-warning badge-success').addClass('badge-info').show();
                    if (p.picture) {
                        $('#parentPic').attr('src', BASE_URL + 'uploads/parents/' + p.picture).show();
                        $('#parentNoPic').hide();
                    } else {
                        $('#parentPic').hide();
                        $('#parentNoPic').show();
                    }
                }

                // Build student profiles to release
                var html = '';
                if (res.students && res.students.length > 0) {
                    res.students.forEach(function(s) {
                        var sid = s.student_id || s.id;
                        var studentPic = s.picture ? BASE_URL + 'uploads/students/' + s.picture : '';
                        html += '<div class="d-flex align-items-center border rounded p-3 mb-2 student-item">';
                        html += '<div class="mr-3">';
                        if (s.picture) {
                            html += '<img src="' + studentPic + '" class="img-circle" style="width:56px;height:56px;border:3px solid rgba(129,199,132,0.5);">';
                        } else {
                            html += '<div class="img-circle d-flex align-items-center justify-content-center" style="width:56px;height:56px;border:3px solid rgba(129,199,132,0.35);background:rgba(129,199,132,0.10);"><i class="fas fa-child" style="color: var(--soft-green); font-size:22px;"></i></div>';
                        }
                        html += '</div>';
                        html += '<div class="flex-grow-1"><strong style="font-size:1.05rem; color: var(--ink);">' + s.fname + ' ' + s.lname + '</strong><br><span class="badge badge-light" style="font-size:12px; padding:5px 12px;">' + (s.grade_section || 'N/A') + '</span></div>';
                        html += '<span class="badge badge-success released-badge" data-student-id="' + sid + '" data-name="' + s.fname + ' ' + s.lname + '"><i class="fas fa-check-circle mr-1"></i>Released</span>';
                        html += '</div>';
                    });
                    $('#studentCount').text(res.students.length);
                } else {
                    html = '<div class="text-center py-4 empty-state"><i class="fas fa-user-slash fa-3x mb-3 d-block"></i><p>No students linked to this parent/fetcher.</p></div>';
                    $('#studentCount').text('0');
                }
                $('#studentsList').html(html);
                $('#parentCard').show();
                $('#emptyState').hide();
                $('#scannerCol').hide();

                // Auto-release every linked student
                autoReleaseAll(res.students, res.parent.id, qrCode, fetcherName);

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

    // Automatically release every linked student, then reset & scan the next fetcher
    function autoReleaseAll(students, parentId, qrCode, fetcherName) {
        var list = students || [];
        if (list.length === 0) {
            resetAndRestart();
            return;
        }

        var index = 0;
        var releasedCount = 0;
        var alreadyCount = 0;

        function releaseNext() {
            if (index >= list.length) {
                var msg;
                if (alreadyCount > 0 && releasedCount === 0) {
                    msg = 'All students already released today.';
                    showAlert(msg, 'success');
                } else if (alreadyCount > 0) {
                    msg = 'Released ' + releasedCount + ', already released ' + alreadyCount + '.';
                    showAlert(msg, 'success');
                } else {
                    msg = 'Released ' + releasedCount + ' student(s). Ready for next scan.';
                    showAlert(msg, 'success');
                }
                setTimeout(resetAndRestart, 3000);
                return;
            }

            var s = list[index];
            var sid = s.student_id || s.id;
            index++;

            var formData = new FormData();
            formData.append('student_id', sid);
            formData.append('parent_id', parentId);
            formData.append('qr_code', qrCode);
            formData.append(CSRF_NAME, CSRF_HASH);

            fetch(BASE_URL + 'scan/release', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(res => {
                if (res.already_released) {
                    alreadyCount++;
                    var $badge = $('.released-badge[data-student-id="' + sid + '"]');
                    if ($badge.length) {
                        $badge.removeClass('badge-success').addClass('badge-warning')
                               .html('<i class="fas fa-check-double mr-1"></i>Already Released');
                    }
                } else if (res.success) {
                    releasedCount++;
                } else {
                    console.error('Release failed:', res.message);
                }
                releaseNext();
            })
            .catch(err => {
                console.error('Release error:', err, 'Fetcher:', fetcherName);
                releaseNext();
            });
        }

        releaseNext();
    }

    function resetAndRestart() {
        $('#parentCard').hide();
        $('#emptyState').show();
        $('#scannerCol').show();
        $('#qrInput').val('');
        $('#qrResult').html('');
        $('#scanResult').html('');
        $('#studentsList').html('');
        $('#fetcherType').hide();
        pendingStudentId = null;
        pendingParentId = null;
        setTimeout(startCamera, 800);
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
<?= $this->endSection() ?>