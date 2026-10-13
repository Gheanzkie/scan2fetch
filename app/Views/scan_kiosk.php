<?php
/**
 * Fullscreen kiosk scanner — standalone page, no template/sidebar/nav.
 * Opens in a new tab. Exit = close the browser tab (browser's own X / Alt+F4).
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 76 76'%3E%3Crect width='76' height='76' rx='16' fill='%234361ee'/%3E%3Cg fill='%23fff'%3E%3Crect x='14' y='14' width='20' height='20' rx='3'/%3E%3Crect x='42' y='14' width='20' height='20' rx='3'/%3E%3Crect x='14' y='42' width='20' height='20' rx='3'/%3E%3Crect x='44' y='44' width='6' height='6'/%3E%3Crect x='52' y='52' width='6' height='6'/%3E%3Crect x='44' y='56' width='6' height='6'/%3E%3Crect x='56' y='44' width='6' height='6'/%3E%3C/g%3E%3C/svg%3E">
<link rel="icon" type="image/png" sizes="76x76" href="<?= base_url('public/image/qr-code-76.png') ?>">
<link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
<title>Scanner - Scan2Fetch</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
html, body { width:100%; height:100%; overflow:hidden; background:#050510; font-family:system-ui,-apple-system,'Segoe UI',Roboto,sans-serif; }
/* Camera sits centered, NOT full-bleed: contain (no crop/zoom) keeps native
   resolution so QR edges stay sharp instead of the blurry cover-crop. */
body { display:flex; align-items:center; justify-content:center; }
#reader {
  width:min(94vw, 960px);
  height:min(86vh, 640px);
  background:#000;
  border:2px solid rgba(80,255,140,0.25);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 18px 60px rgba(0,0,0,0.6);
}
#reader video {
  width:100% !important;
  height:100% !important;
  object-fit:contain !important;   /* full frame visible — no crop, no stretch */
  border-radius:18px !important;
  background:#000;
}
#reader__dashboard { display:none !important; }

/* Top status bar */
#topBar {
  position:fixed; top:0; left:0; right:0; z-index:10;
  display:flex; align-items:center; justify-content:space-between;
  padding:10px 16px; background:linear-gradient(180deg, rgba(0,0,0,0.75), transparent);
  color:#fff; font-size:14px; font-weight:600;
}
#topBar .pill { background:rgba(255,255,255,0.15); border-radius:999px; padding:4px 14px; font-size:12.5px; backdrop-filter:blur(6px); }
#topBar .pill.open { background:rgba(46,204,113,0.35); color:#aaffc3; }
#topBar .pill.closed { background:rgba(231,76,60,0.4); color:#ffc9c3; }

/* Status toast (bottom) */
#status {
  position:fixed; bottom:28px; left:50%; transform:translateX(-50%);
  z-index:10; max-width:92vw; padding:12px 22px; border-radius:14px;
  background:rgba(20,20,40,0.88); color:#fff; font-size:15px; font-weight:600;
  backdrop-filter:blur(8px); box-shadow:0 8px 30px rgba(0,0,0,0.45);
  transition:opacity .25s; text-align:center; display:none;
}
#status.show { display:block; }
#status.ok   { background:rgba(27,120,60,0.92); }
#status.err  { background:rgba(170,40,40,0.92); }
#status.warn { background:rgba(170,120,20,0.92); }

/* Result sheet (multi-child picker) */
#sheet {
  position:fixed; left:0; right:0; bottom:0; z-index:20;
  background:#fff; border-radius:22px 22px 0 0; padding:20px 18px 26px;
  max-height:75vh; overflow-y:auto; box-shadow:0 -12px 50px rgba(0,0,0,0.45);
  transform:translateY(110%); transition:transform .3s ease;
}
#sheet.show { transform:translateY(0); }
#sheet h3 { font-size:17px; color:#1a1a2e; margin-bottom:4px; }
#sheet .sub { font-size:13px; color:#777; margin-bottom:14px; }
.srow {
  display:flex; align-items:center; gap:12px; padding:12px 14px; margin-bottom:10px;
  border:2px solid #e8e8f2; border-radius:14px; cursor:pointer; user-select:none;
}
.srow.picked { border-color:#2ecc71; background:#f0faf3; }
.srow input { width:20px; height:20px; accent-color:#2ecc71; }
.srow .nm { font-weight:700; color:#1a1a2e; font-size:15px; }
.srow .gr { font-size:12px; color:#888; }
.srow .st { margin-left:auto; font-size:12px; font-weight:700; color:#2ecc71; }
.srow .st.pending { color:#999; }
.srow .st.done { color:#27ae60; }
#releaseBtn {
  width:100%; margin-top:8px; padding:15px; border:none; border-radius:14px;
  background:linear-gradient(135deg,#2ecc71,#27ae60); color:#fff;
  font-size:16px; font-weight:800; cursor:pointer;
}
#releaseBtn:disabled { opacity:.6; cursor:wait; }

/* Verified flash overlay */
#flash {
  position:fixed; inset:0; z-index:15; display:none;
  align-items:center; justify-content:center; flex-direction:column;
  background:rgba(20,120,60,0.88); color:#fff;
}
#flash.show { display:flex; }
#flash.already { background:rgba(190,120,20,0.92); }
#flash .big { font-size:64px; margin-bottom:12px; }
#flash .nm  { font-size:24px; font-weight:800; }
#flash .sub { font-size:14px; opacity:.85; margin-top:6px; }
</style>
<script src="<?= base_url('html5qrcode/html5-qrcode.min.js') ?>"></script>
</head>
<body>

<div id="reader"></div>

<div id="topBar">
  <span class="pill" id="sessPill"><?= strtoupper($currentSession ?? 'MORNING') ?></span>
  <span class="pill <?= !empty($gateAllowed) ? 'open' : 'closed' ?>" id="gatePill">
    <?= !empty($gateAllowed) ? '● OPEN' : '● CLOSED' ?>
  </span>
</div>

<div id="status">Starting camera…</div>

<div id="flash">
  <div class="big">✓</div>
  <div class="nm" id="flashName"></div>
  <div class="sub" id="flashSub"></div>
</div>

<div id="sheet">
  <h3 id="sheetTitle">Students to release</h3>
  <div class="sub" id="sheetSub"></div>
  <div id="sheetList"></div>
  <button id="releaseBtn">Release selected</button>
</div>

<script>
var BASE_URL  = '<?= rtrim(base_url(), '/') ?>/';
var CSRF_NAME = '<?= csrf_token() ?>';
var CSRF_HASH = '<?= csrf_hash() ?>';
var GATE_OK   = <?= empty($gateAllowed) ? 'false' : 'true' ?>;

var scanner = null, scanning = false, lockout = false;

function say(msg, cls) {
  var el = document.getElementById('status');
  el.textContent = msg;
  el.className = 'show' + (cls ? ' ' + cls : '');
}
function hideSay() { document.getElementById('status').className = ''; }

/* ===== FAST SCANNER =====
 * BUGFIX: start() was called as start(cfg, cfg) — the FIRST arg must be the
 * CAMERA identifier ({facingMode} or deviceId), the SECOND is the scan config.
 * Passing the config object (which contains a qrbox FUNCTION) as the camera
 * arg makes getUserMedia reject garbage constraints → never decodes.
 * Also: NO qrbox — the decoder scans the FULL frame, so the QR can be any
 * size / anywhere in view (no crop, no fake zoom). Native BarcodeDetector
 * (useBarCodeDetectorIfSupported) handles blur/low-light on Chrome/Edge/Android;
 * jsQR is the fallback. */
function buildScanner() {
  if (scanner) { try { scanner.clear(); } catch(e){} }
  // NO formatsToSupport filter — this library build numbers QR_CODE as 11,
  // not 0 (0 = AZTEC). The old "[0]" filter made it decode AZTEC only, so it
  // could NEVER read a QR code. Unfiltered = scans QR + everything else.
  scanner = new Html5Qrcode('reader', { verbose: false });
}

function start() {
  if (scanning) return;
  if (!GATE_OK) { say('Scanner is closed right now.', 'err'); return; }
  scanning = true; lockout = false;
  say('Starting camera…');
  buildScanner();

  var camera    = { facingMode: 'environment' };
  var scanCfg   = {
    fps: 30,
    disableFlip: false,
    rememberLastUsedCamera: false
  };

  var settled = false;
  var watchdog = setTimeout(function() {
    if (settled) return;
    settled = true;
    try { scanner.stop().catch(function(){}); } catch(e){}
    scanning = false;
    say('Camera slow — retrying with lower resolution…', 'warn');
    setTimeout(startLowRes, 600);
  }, 8000);

  scanner.start(
    camera,
    scanCfg,
    function(text) {
      if (!text || lockout) return;
      settled = true; clearTimeout(watchdog);
      lockout = true; scanning = false;
      say('QR found ✓');
      try { scanner.stop().catch(function(){}); } catch(e){}
      verify(text);
    },
    function() {}
  ).then(function() {
    if (settled) return;
    settled = true; clearTimeout(watchdog);
    say('Point at the QR code — full frame, any size');
  }).catch(function(err) {
    if (settled) return;
    settled = true; clearTimeout(watchdog);
    scanning = false;
    var m = (err && err.message) ? err.message : String(err || 'Camera error');
    say('Camera error: ' + m, 'err');
    setTimeout(startLowRes, 2500);
  });
}

/* Fallback: tiny 640x480 stream — easiest for potato cameras to decode. */
function startLowRes() {
  if (scanning) return;
  scanning = true; lockout = false;
  say('Starting camera (low-res mode)…');
  buildScanner();

  var camera  = { facingMode: 'environment' };
  var scanCfg = {
    fps: 15,
    disableFlip: false,
    rememberLastUsedCamera: false,
    videoConstraints: {
      width: { ideal: 640 },
      height: { ideal: 480 },
      facingMode: { ideal: 'environment' }
    }
  };

  scanner.start(camera, scanCfg, function(text) {
    if (!text || lockout) return;
    lockout = true; scanning = false;
    say('QR found ✓');
    try { scanner.stop().catch(function(){}); } catch(e){}
    verify(text);
  }, function(){}).then(function() {
    say('Point at the QR code (low-res mode)');
  }).catch(function(err) {
    scanning = false;
    say('Camera failed: ' + ((err&&err.message)||err) + ' — close this tab and reopen from the Scanner page.', 'err');
  });
}

function resume() {
  lockout = false;
  setTimeout(start, 400);
}

/* ===== VERIFY + AUTO-RELEASE ===== */
function verify(qr) {
  say('Verifying…');
  var fd = new FormData();
  fd.append('qr_code', qr);
  fd.append(CSRF_NAME, CSRF_HASH);
  fetch(BASE_URL + 'scan/verify', { method:'POST', body: fd })
  .then(function(r){ return r.json(); })
  .then(function(res) {
    if (!res.success) {
      say(res.message || 'Invalid QR code', 'err');
      setTimeout(resume, 1800);
      return;
    }
    var p = res.parent, f = res.fetcher;
    var who = (f && f.type === 'Sub-Fetcher') ? (f.fname+' '+f.lname) : (p.fname+' '+p.lname);
    var list = res.students || [];
    var sessName = (res.session || '').toUpperCase();

    if (list.length === 0) {
      say(who + ' — no students linked', 'warn');
      setTimeout(resume, 2500);
      return;
    }
    if (list.length === 1) {
      if (list[0].already_released) {
        flash(who, list[0].fname + ' ' + list[0].lname + ' — ALREADY RELEASED this ' + sessName + ' session.', true);
        say('Already released — ' + list[0].fname + ' ' + list[0].lname, 'warn');
        setTimeout(resume, 2600);
        return;
      }
      flash(who, list[0].fname + ' ' + list[0].lname);
      releaseAll(list, p.id, qr, who);
      return;
    }
    openSheet(who, list, p.id, qr, sessName);
  })
  .catch(function() {
    say('Connection error', 'err');
    setTimeout(resume, 2000);
  });
}

function flash(main, sub, already) {
  document.getElementById('flashName').textContent = main;
  document.getElementById('flashSub').textContent = sub || '';
  var el = document.getElementById('flash');
  el.classList.toggle('already', !!already);
  el.classList.add('show');
  setTimeout(function(){ el.classList.remove('show'); }, already ? 2800 : 2200);
}

function openSheet(who, list, pid, qr, sessName) {
  var alreadyN = list.filter(function(s){ return s.already_released; }).length;
  document.getElementById('sheetTitle').textContent = who;
  document.getElementById('sheetSub').textContent =
    list.length + ' students' +
    (alreadyN ? ' · ' + alreadyN + ' already released this ' + (sessName||'') + ' session' : '') +
    ' — tick who is being picked up.';
  var box = document.getElementById('sheetList');
  box.innerHTML = '';
  list.forEach(function(s) {
    var sid = s.student_id || s.id;
    var isAlready = !!s.already_released;
    var d = document.createElement('div');
    d.className = 'srow' + (isAlready ? '' : ' picked');
    d.innerHTML = '<input type="checkbox" ' + (isAlready ? '' : 'checked') + ' value="'+sid+'">' +
                  '<div><div class="nm">'+s.fname+' '+s.lname+'</div>' +
                  '<div class="gr">'+(s.grade_section||'')+'</div></div>' +
                  '<div class="st '+(isAlready?'done':'pending')+'" data-sid="'+sid+'">'+
                  (isAlready ? 'Already released' : 'Pending')+'</div>';
    if (isAlready) { d.style.borderColor = '#f0c48a'; d.style.background = '#fff8ef'; }
    d.addEventListener('click', function(e) {
      var cb = d.querySelector('input');
      if (e.target !== cb) cb.checked = !cb.checked;
      d.classList.toggle('picked', cb.checked);
    });
    box.appendChild(d);
  });
  var btn = document.getElementById('releaseBtn');
  btn.disabled = false;
  btn.textContent = 'Release selected';
  btn.onclick = function() {
    var picked = [];
    box.querySelectorAll('input:checked').forEach(function(cb) {
      var sid = cb.value;
      var s = list.find(function(x){ return String(x.student_id||x.id) === String(sid); });
      if (s) picked.push(s);
    });
    if (!picked.length) { say('Select at least one student.', 'warn'); return; }
    btn.disabled = true;
    btn.textContent = 'Releasing…';
    releaseAll(picked, pid, qr, who);
  };
  document.getElementById('sheet').classList.add('show');
}

function releaseAll(students, pid, qr, who) {
  var i = 0, ok = 0, already = 0;
  function next() {
    if (i >= students.length) {
      document.getElementById('sheet').classList.remove('show');
      if (already && !ok) {
        flash(who, 'All selected students were ALREADY RELEASED this session.', true);
        say('Already released — nothing new.', 'warn');
      } else if (already) {
        say(who + ' — Released ' + ok + ', already released ' + already + '.', 'ok');
      } else {
        flash(who, 'Released ' + ok + ' student(s).');
        say(who + ' — Released ' + ok + ' student(s).', 'ok');
      }
      setTimeout(resume, already && !ok ? 2800 : 2200);
      return;
    }
    var s = students[i++];
    var fd = new FormData();
    fd.append('student_id', s.student_id || s.id);
    fd.append('parent_id', pid);
    fd.append('qr_code', qr);
    fd.append(CSRF_NAME, CSRF_HASH);
    fetch(BASE_URL + 'scan/release', { method:'POST', body: fd })
    .then(function(r){ return r.json(); })
    .then(function(res) {
      if (res.blocked_by_schedule) {
        say(res.message || 'System closed.', 'err');
        GATE_OK = false;
        document.getElementById('gatePill').className = 'pill closed';
        document.getElementById('gatePill').textContent = '● CLOSED';
        return;
      }
      if (res.already_released) {
        already++;
        // Live-mark the row if the sheet is open
        var badge = document.querySelector('.st[data-sid="' + (s.student_id || s.id) + '"]');
        if (badge) { badge.className = 'st done'; badge.textContent = 'Already released'; }
      }
      else if (res.success) ok++;
      next();
    })
    .catch(next);
  }
  next();
}

/* ===== LIVE SESSION / GATE POLL =====
 * Date Management changes (open/closed, session switch) show up here within
 * ~10s without reloading the kiosk tab. */
function pollStatus() {
  fetch(BASE_URL + 'schedule/status')
  .then(function(r){ return r.json(); })
  .then(function(st) {
    GATE_OK = !!st.allowed;
    var gp = document.getElementById('gatePill');
    gp.className = 'pill ' + (st.allowed ? 'open' : 'closed');
    gp.textContent = st.allowed ? '● OPEN' : '● CLOSED';
    var sp = document.getElementById('sessPill');
    var label = (st.session || '').toUpperCase();
    if (st.override) label += ' · MANUAL';
    sp.textContent = label;
    if (!st.allowed && scanning) {
      try { scanner.stop().catch(function(){}); } catch(e){}
      scanning = false;
      say(st.message || 'Scanner closed.', 'err');
    }
  })
  .catch(function(){});
}
setInterval(pollStatus, 10000);
pollStatus();

/* boot */
if (!GATE_OK) {
  say('Scanner is closed right now.', 'err');
} else {
  setTimeout(start, 250);
}
</script>
</body>
</html>
