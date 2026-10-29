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
 <!-- ===== DAY STATUS BANNER (Date Management gate) ===== -->
 <?php if (empty($gateAllowed)): ?>
 <div class="alert alert-danger mb-3" style="border-radius:12px;" id="gateClosedBanner">
  <i class="fas fa-lock mr-1"></i>
  <strong>System CLOSED</strong> - <?= esc($gateMessage) ?>
  <br><small>Releases and declines are disabled until the day is opened (Date Management).</small>
 </div>
 <?php endif; ?>

 <!-- ===== STATUS STRIP ===== -->
 <div class="card mb-3">
 <div class="card-body d-flex align-items-center flex-wrap justify-content-between" style="padding:1rem 1.5rem;">
 <div class="d-flex align-items-center flex-wrap" style="gap:8px;">
 <span class="badge badge-light" id="opHoursBadge" title="Operating hours from Date Management"
 style="background:rgba(168,192,255,0.18);color:var(--soft-purple);font-size:13px;padding:7px 14px;">
 <i class="far fa-clock mr-1"></i>
 <?= esc($gateHours['open'] ?? '07:00') ?> &ndash; <?= esc($gateHours['close'] ?? '17:00') ?>
 </span>
 <span class="badge" id="sessionBadge"
 style="background:<?= ($currentSession ?? 'morning') === 'morning' ? '#fef3c7' : '#e0e7ff' ?>;color:<?= ($currentSession ?? 'morning') === 'morning' ? '#b45309' : '#3730a3' ?>;font-size:13px;padding:7px 14px;">
 <i class="fas fa-sun mr-1" id="sessionIcon"></i><span id="sessionLabel"><?= strtoupper($currentSession ?? 'MORNING') ?></span>
 <span id="sessionManualTag" style="display:<?= !empty($sessionOverride) ? 'inline' : 'none' ?>;font-weight:700;">&middot; MANUAL</span>
 </span>
 <span class="badge badge-success" id="dayStatusBadge" style="display:none;font-size:13px;padding:7px 14px;">
 <i class="fas fa-lock-open mr-1"></i>OPEN
 </span>
 </div>
 </div>
 </div>

 <div class="row" id="scannerCol">

 <!-- ===== LEFT: LAUNCH FULLSCREEN SCANNER ===== -->
 <div class="col-lg-7 col-md-6 col-12 mb-3">
 <div class="card h-100">
 <div class="card-header">
 <h5 class="mb-0">
 <i class="fas fa-camera mr-2" style="color: var(--soft-blue);"></i>
                                        Fullscreen Scanner
 </h5>
 </div>
 <div class="card-body d-flex flex-column align-items-center justify-content-center text-center" style="min-height:420px;">
 <h4 style="color: var(--ink); font-weight:800; margin-bottom:6px;">Open the live camera scanner</h4>
 <p style="color: var(--muted); font-size:14px; max-width:440px; margin:0 auto 26px; line-height:1.6;">
 Fullscreen camera in a new tab - no sidebar, no menus. Detects QR codes anywhere in view,
 any size, any angle. Results appear here automatically. Exit = close that tab.
 </p>
 <a href="<?= base_url('scan-kiosk') ?>" target="_blank" rel="noopener"
 class="btn btn-kid-success btn-lg px-5" style="font-size:16px; padding:14px 48px !important;">
 <i class="fas fa-qrcode mr-2"></i> Launch Scanner
 </a>
 <div class="mt-4" style="font-size:12.5px; color: var(--faint);">
 <i class="fas fa-lightbulb mr-1"></i>
                                    Keep this tab open - scanned results show in the panel below.
 </div>
 </div>
 </div>
 </div>

 <!-- ===== RIGHT: MANUAL INPUT ===== -->
 <div class="col-lg-5 col-md-6 col-12 mb-3">
 <div class="card h-100">
 <div class="card-header">
 <h5 class="mb-0">
 <i class="fas fa-keyboard mr-2" style="color: var(--soft-teal);"></i>
                                        Manual QR Code Input
 </h5>
 </div>
 <div class="card-body d-flex flex-column justify-content-center" style="min-height:420px;">
 <p style="color: var(--muted); font-size:13px; margin-bottom:16px;">
 Backup mode - type the QR code printed on the parent/fetcher card if the camera is unavailable.
 </p>
 <div class="input-group mb-3">
 <div class="input-group-prepend">
 </div>
 <input type="text" id="qrInput" class="form-control text-center font-weight-bold"
 autocomplete="off" autocorrect="off" autocapitalize="characters" spellcheck="false"
 placeholder="e.g. QR-QAJUA"
 style="text-transform:uppercase;">
 </div>
 <button class="btn btn-kid-primary btn-block" id="verifyQrBtn" style="padding:12px;">
 <i class="fas fa-search mr-1"></i> Verify QR Code
 </button>
 </div>
 </div>
 </div>

 </div>

 <!-- ===== BELOW: Results (Full Width) ===== -->
 <div class="row">
 <div class="col-12">

 <!-- Empty State -->
 <div class="card" id="emptyState">
 <div class="card-body text-center py-5 empty-state">
 <i class="fas fa-qrcode fa-5x mb-4 d-block"></i>
 <h4 class="mb-0">Ready to Scan</h4>
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
 </div>
 <h4 class="mt-3 mb-1" id="parentName" style="color: var(--ink); font-weight: 700;"></h4>
 </div>

 <hr style="border-color: rgba(63,43,150,0.08);">

 <!-- Students List -->
 <h5 class="mb-3" style="color: var(--ink); font-weight: 700;">
 <i class="fas fa-child mr-2" style="color: var(--soft-orange);"></i>
                                Students to Release
 <span class="badge badge-light ml-1" id="studentCount">0</span>
 </h5>
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
 <div id="studentsList"></div>
 <span class="badge badge-pill mt-1" id="fetcherType" style="display:none;"></span>
 <p class="mb-1" id="parentPhone" style="color: var(--muted);"></p>
 <div id="parentNoPic">
 <i class="fas fa-user fa-4x text-white"></i>
 </div>
 <div class="mt-3 text-center" id="qrResult"></div>
 <div id="scanResult" style="font-size:13px;"></div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('html5qrcode/html5-qrcode.min.js') ?>"></script>

<script>
var BASE_URL = '<?= base_url() ?>/';
var CSRF_NAME = '<?= csrf_token() ?>';
var CSRF_HASH = '<?= csrf_hash() ?>';
/* Same as the kiosk: send the CURRENT csrf_cookie_name value, not the hash
   baked when the page was rendered, or long-lived tabs start getting
   "The action you requested is not allowed." */
function csrfToken() {
  var m = document.cookie.match(/(?:^|;\s*)csrf_cookie_name=([^;]+)/);
  return m ? decodeURIComponent(m[1]) : CSRF_HASH;
}

$(function() {
    var html5QrCode, isScanning = false, pendingStudentId = null, pendingParentId = null;
    var scanStartTime = 0;

    // Camera now lives on the fullscreen kiosk page (/scan-kiosk). These are
    // no-op stubs so verify/release/reset flows below keep working unchanged.
    var html5QrCode = null, isScanning = false, pendingStudentId = null, pendingParentId = null;
    function startCamera() {}
    function stopCamera() {}

    // Manual verify
    $('#verifyQrBtn').click(function() {
        // Strip every space, not just the ends: codes are printed as
        // "QR-XXXXX" and hand-typed input picks up stray spaces.
        var qr = $('#qrInput').val().replace(/\s+/g, '').toUpperCase();
        $('#qrInput').val(qr);
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

    // ===== DATE MANAGEMENT LIVE GATE =====
    // Show/refresh the CLOSED banner and shut the scanner down.
    function showClosedBanner(message) {
        refreshStatusBadges(null, null, sessionOverride, false);
        var $banner = $('#gateClosedBanner');
        if ($banner.length) {
            $banner.show();
        } else {
            $('#alertArea').before(
                '<div class="alert alert-danger mb-3" style="border-radius:12px;" id="gateClosedBanner">' +
                '<i class="fas fa-lock mr-1"></i>' +
                '<strong>System CLOSED</strong> - Scanner is not available this time.' +
                (message ? ' ' + $('<span>').text(message).html() : '') +
                '<br><small>Releases and declines are disabled until the day is opened (Date Management).</small>' +
                '</div>'
            );
        }
        $('#gateOpenBanner').hide();
        $('#verifyQrBtn').prop('disabled', true);
    }

    // The scan-session switch itself lives in Date Management > Edit.
    // Here we only track the override so the released session stays
    // consistent with the admin's pick.

    // Sync the card-header strip (hours badge, session badge, MANUAL tag)
    // with the latest server state from /schedule/status.
    function refreshStatusBadges(hours, session, override, allowed) {
        if (hours && hours.open && hours.close) {
            $('#opHoursBadge').html('<i class="far fa-clock mr-1"></i>' + hours.open + ' \u2013 ' + hours.close);
        }
        if (session) {
            currentSession = session;
            var isMorning = session === 'morning';
            $('#sessionLabel').text(session.toUpperCase());
            $('#sessionIcon').attr('class', isMorning ? 'fas fa-sun mr-1' : 'fas fa-moon mr-1');
            $('#sessionBadge').css({
                background: isMorning ? '#fef3c7' : '#e0e7ff',
                color: isMorning ? '#b45309' : '#3730a3'
            });
        }
        if (override) {
            sessionOverride = override;
            $('#sessionManualTag').show();
        } else {
            sessionOverride = null;
            $('#sessionManualTag').hide();
        }
        if (typeof allowed !== 'undefined') {
            if (allowed) {
                $('#dayStatusBadge').show().removeClass('badge-danger').addClass('badge-success')
                    .html('<i class="fas fa-lock-open mr-1"></i>OPEN');
            } else {
                $('#dayStatusBadge').show().removeClass('badge-success').addClass('badge-danger')
                    .html('<i class="fas fa-lock mr-1"></i>CLOSED');
            }
        }
    }

    var currentSession = <?= json_encode($currentSession ?? 'morning') ?>;
    var sessionOverride = <?= json_encode($sessionOverride ?? null) ?>;
    var gateClosed = <?= empty($gateAllowed) ? 'true' : 'false' ?>;

    // Initial paint from PHP-passed values
    refreshStatusBadges(
        <?= json_encode($gateHours ?? []) ?>,
        currentSession,
        sessionOverride,
        !gateClosed
    );

    function showOpenBanner(hours, session) {
        if (session) { currentSession = session; }
        refreshStatusBadges(hours, session, sessionOverride, true);
        $('#gateClosedBanner').hide();
        $('#verifyQrBtn').prop('disabled', false);
    }

    if (gateClosed) {
        showClosedBanner(<?= json_encode($gateMessage ?? '') ?>);
        stopCamera(true);
    }

    // Poll the schedule so the page auto-closes (and flashes the message)
    // the moment the closing time is reached - and so the MORNING -> AFTERNOON
    // switch at 12:00 updates the banner live (server clock is authoritative).
    // An admin's manual switch (st.override) wins over the clock.
    setInterval(function() {
        fetch(BASE_URL + 'schedule/status')
        .then(function(r) { return r.json(); })
        .then(function(st) {
            if (!st.success) return;
            var wasClosed = gateClosed;
            var ovChanged = (st.override || null) !== (sessionOverride || null);
            var sessionChanged = !!st.session && st.session !== currentSession;
            gateClosed = !st.allowed;
            if (gateClosed) {
                if (!wasClosed) {
                    // Transitioned open -> closed: kill scanner, flash message.
                    stopCamera(true);
                    showClosedBanner(st.message || '');
                    showAlert('Scanner is not available this time.', 'danger');
                    $('#qrResult').html('<span style="color: var(--soft-rose); font-weight: bold;"><i class="fas fa-lock mr-1"></i> Scanner is not available this time.</span>');
                    $('#qrInput').prop('disabled', true);
                }
            } else {
                if (wasClosed) {
                    showOpenBanner(st.hours || {}, st.session);
                    showAlert('System is now OPEN.', 'success');
                    $('#qrResult').html('');
                    $('#qrInput').prop('disabled', false);
                } else if (sessionChanged) {
                    // 12:00 clock switch, or admin changed it in Date Management
                    currentSession = st.session;
                    showOpenBanner(st.hours || {}, st.session);
                    showAlert(st.session.toUpperCase() + ' session active. Students not yet released in this session can now be scanned.', 'success');
                } else {
                    showOpenBanner(st.hours || {}, st.session);
                }
            }
            // Track override changes (set from Date Management > Edit) so the
            // banner's MANUAL SWITCH badge re-renders correctly.
            if (ovChanged) {
                sessionOverride = st.override || null;
                if (!gateClosed) showOpenBanner(st.hours || {}, st.session);
            }
        })
        .catch(function() {});
    }, 15000);

    if (gateClosed) {
        $('#qrInput').prop('disabled', true);
    }

    function verifyQrCode(qrCode) {
        $('#qrResult').html('<span style="color: var(--soft-teal);"><i class="fas fa-spinner fa-spin mr-1"></i> Verifying QR code...</span>');

        var formData = new FormData();
        formData.append('qr_code', qrCode);
        formData.append(CSRF_NAME, csrfToken());

        fetch(BASE_URL + 'scan/verify', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                $('#qrResult').html('<span style="color: var(--soft-green); font-weight: bold;"><i class="fas fa-check-circle mr-1"></i> Auto-releasing...</span>');

                var p = res.parent, f = res.fetcher;
                var fetcherName = [p.fname, p.mname, p.lname].filter(Boolean).join(' ');
                if (f && f.type === 'Sub-Fetcher') {
                    fetcherName = [f.fname, f.mname, f.lname].filter(Boolean).join(' ');
                }

                // Update fetcher / parent profile
                if (f && f.type === 'Sub-Fetcher') {
                    $('#parentName').text([f.fname, f.mname, f.lname].filter(Boolean).join(' '));
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
                    $('#parentName').text([p.fname, p.mname, p.lname].filter(Boolean).join(' '));
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

                // Build student profiles to release.
                // 1 child  -> direct release (no confirmation), as before.
                // 2+ child -> show selectable list; operator picks who is being
                //             fetched and confirms before anything is released.
                var stuList = res.students || [];
                var isMulti = stuList.length > 1;
                var html = '';

                // Keep the scan context so the manual "Release selected" button
                // can post the same payload the auto path uses.
                window.__scanCtx = { parentId: res.parent.id, qrCode: qrCode, fetcherName: fetcherName };

                if (stuList.length > 0) {
                    stuList.forEach(function(s) {
                        var sid = s.student_id || s.id;
                        html += '<div class="d-flex align-items-center border rounded p-3 mb-2 student-item">';
                        html += '<div class="mr-3">';
                        html += '';
                        html += '</div>';
                        html += '<div class="flex-grow-1"><strong style="font-size:1.05rem; color: var(--ink);">' + [s.fname, s.mname, s.lname].filter(Boolean).join(' ') + '</strong><br><span class="badge badge-light" style="font-size:12px; padding:5px 12px;">' + (s.grade_section || 'N/A') + '</span></div>';

                        if (isMulti) {
                            html += '<div class="text-right mr-3">';
                            html += '<input type="checkbox" class="student-check" id="chk_' + sid + '" value="' + sid + '" checked style="width:22px;height:22px;cursor:pointer;">';
                            html += '<label for="chk_' + sid + '" style="display:block;font-size:11px;margin-top:4px;cursor:pointer;color:var(--muted);">Select</label>';
                            html += '</div>';
                            html += '<span class="badge badge-secondary released-badge" data-student-id="' + sid + '" data-name="' + [s.fname, s.mname, s.lname].filter(Boolean).join(' ') + '" style="background:#90a4ae;"><i class="fas fa-clock mr-1"></i>Pending</span>';
                        } else {
                            html += '<span class="badge badge-success released-badge" data-student-id="' + sid + '" data-name="' + [s.fname, s.mname, s.lname].filter(Boolean).join(' ') + '"><i class="fas fa-check-circle mr-1"></i>Released</span>';
                        }
                        html += '</div>';
                    });

                    if (isMulti) {
                        html += '<div class="alert alert-info mt-2 mb-0" style="border-radius:12px;font-size:13px;">' +
                                '<i class="fas fa-info-circle mr-1"></i>' + stuList.length +
                                ' students linked. Tick only who is being picked up, then confirm.</div>';
                        html += '<button type="button" id="releaseSelectedBtn" class="btn btn-success btn-block mt-2" style="border-radius:12px;font-weight:600;">' +
                                '<i class="fas fa-check-double mr-1"></i>Release selected</button>';
                    }

                    $('#studentCount').text(stuList.length);
                } else {
                    html = '<div class="text-center py-4 empty-state"><i class="fas fa-user-slash fa-3x mb-3 d-block"></i><p>No students linked to this parent/fetcher.</p></div>';
                    $('#studentCount').text('0');
                }
                $('#studentsList').html(html);
                $('#parentCard').show();
                $('#emptyState').hide();
                $('#scannerCol').hide();

                if (isMulti) {
                    // Multi-child: WAIT for the operator's choice + confirmation.
                    $('#releaseSelectedBtn').on('click', function () {
                        var picked = [];
                        $('.student-check:checked').each(function () {
                            var sid = $(this).val();
                            var $row = $(this).closest('.student-item');
                            var $badge = $row.find('.released-badge');
                            picked.push({ student_id: sid, name: $badge.data('name') || '' });
                        });

                        if (picked.length === 0) {
                            showAlert('Select at least one student to release.', 'warning');
                            return;
                        }

                        // No blocking confirm() here: on purpose the button fires
                        // the release straight away. The selected tick boxes are
                        // already the operator's confirmation of who is fetched.
                        var ctx = window.__scanCtx || {};
                        var onlyPicked = stuList.filter(function (s) {
                            var sid = String(s.student_id || s.id);
                            return picked.some(function (x) { return String(x.student_id) === sid; });
                        });
                        $(this).prop('disabled', true)
                               .html('<i class="fas fa-spinner fa-spin mr-1"></i>Releasing...');
                        autoReleaseAll(onlyPicked, ctx.parentId, ctx.qrCode, ctx.fetcherName);
                    });
                } else {
                    // Single child: direct release, no confirmation.
                    autoReleaseAll(stuList, res.parent.id, qrCode, fetcherName);
                }

                // Scroll to parent card on mobile
                if ($(window).width() < 768) {
                    $('html, body').animate({ scrollTop: $('#parentCard').offset().top - 20 }, 300);
                }
            } else {
                if (res.blocked_by_schedule) {
                    // Day closed / outside hours - kill the scanner and flash it.
                    stopCamera(true);
                    $('#qrResult').html('<span style="color: var(--soft-rose); font-weight: bold;"><i class="fas fa-lock mr-1"></i> Scanner is not available this time.</span>');
                    showAlert(res.message || 'Scanner is not available this time.', 'danger');
                    showClosedBanner(res.message || '');
                    return;
                }
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
        formData.append(CSRF_NAME, csrfToken());


            fetch(BASE_URL + 'scan/release', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(res => {
                if (res.blocked_by_schedule) {
                    // Day closed / outside hours - stop the whole release loop and show why.
                    $('#alertArea').show().html(
                        '<div class="alert alert-danger" style="border-radius:12px;">' +
                        '<i class="fas fa-lock mr-1"></i><strong>Blocked:</strong> ' +
                        $('<span>').text(res.message || 'System is closed.') .html() +
                        '</div>'
                    );
                    $('#gateClosedBanner').show();
                    return;
                }
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
