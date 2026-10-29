<?php
/**
 * Fullscreen kiosk scanner - standalone page, no template/sidebar/nav.
 * Opens in a new tab. Exit = close the browser tab (browser's own X / Alt+F4).
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 76 76'%3E%3Crect width='76' height='76' rx='16' fill='%234361ee'/%3E%3Cg fill='%23fff'%3E%3Crect x='14' y='14' width='20' height='20' rx='3'/%3E%3Crect x='42' y='14' width='20' height='20' rx='3'/%3E%3Crect x='14' y='42' width='20' height='20' rx='3'/%3E%3Crect x='44' y='44' width='6' height='6'/%3E%3Crect x='52' y='52' width='6' height='6'/%3E%3Crect x='44' y='56' width='6' height='6'/%3E%3Crect x='56' y='44' width='6' height='6'/%3E%3C/g%3E%3C/svg%3E">
<link rel="icon" type="image/png" sizes="76x76" href="<?= base_url('image/qr-code-76.png') ?>">
<link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
<!-- Icon font used by the photo placeholders (<i class="fas fa-user">) -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
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
  object-fit:contain !important;   /* full frame visible - no crop, no stretch */
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
#flash .big { font-size:64px; margin-bottom:12px; font-family:'Segoe UI Symbol','Segoe UI Emoji',system-ui,sans-serif; line-height:1; }
#flash .nm  { font-size:36px; font-weight:800; letter-spacing:.3px; }
#flash .sub { font-size:14px; opacity:.85; margin-top:6px; }

/* ===== PICKUP CONFIRMATION PANEL (5s freeze) ===== */
#pickupPanel{position:fixed;inset:0;z-index:60;display:none;align-items:center;justify-content:center;
 gap:6vw;background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%);padding:4vw;}
#pickupPanel.show{display:flex;}
.pp-side{text-align:center;flex:1;max-width:38vw;}
.pp-photo{width:min(30vw,320px);height:min(30vw,320px);margin:0 auto;border-radius:50%;overflow:hidden;
 background:#1e293b;border:6px solid rgba(255,255,255,.35);display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:clamp(28px,6vw,64px);}
.pp-photo img{width:100%;height:100%;object-fit:cover;}
/* Right-hand side: one card per child picked up (1..N) */
.pp-students{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;align-items:flex-start;max-height:64vh;overflow-y:auto;}
.pp-kid{text-align:center;flex:0 0 auto;}
.pp-kid .pp-photo{width:min(12vw,150px);height:min(12vw,150px);margin:0 auto;border-width:5px;}
.pp-kid .pp-photo i{font-size:clamp(20px,3.4vw,38px);}
.pp-kid .pp-name{margin-top:8px;font-size:clamp(11px,1.3vw,17px);}
.pp-kid .pp-meta{margin-top:2px;font-size:clamp(10px,1.05vw,13px);}
/* children side may need more room than the fetcher side when 3+ kids are picked up */
#pickupPanel .pp-side:last-child{max-width:50vw;}
.pp-name{margin-top:18px;color:#fff;font-weight:800;font-size:clamp(18px,2.6vw,34px);line-height:1.2;}
.pp-meta{margin-top:6px;color:#94a3b8;font-size:clamp(13px,1.6vw,20px);text-transform:uppercase;letter-spacing:.08em;}
.pp-mid{text-align:center;color:#4ade80;}
.pp-check{font-size:clamp(40px,8vw,96px);line-height:1;}
.pp-released{font-weight:900;letter-spacing:.14em;font-size:clamp(14px,1.8vw,24px);}
.pp-timer{margin-top:14px;color:#64748b;font-size:clamp(12px,1.4vw,18px);}
.ck{display:inline-block;width:.9em;height:.45em;border-left:.16em solid currentColor;border-bottom:.16em solid currentColor;transform:rotate(-45deg);vertical-align:middle;}
#topBar .pill::before{content:"";display:inline-block;width:8px;height:8px;border-radius:50%;margin-right:6px;background:currentColor;vertical-align:middle;}
</style>
<script src="<?= base_url('html5qrcode/html5-qrcode.min.js') ?>"></script>
</head>
<body>

<!-- Camera viewport: Html5Qrcode('reader') injects the <video> here.
     This element MUST exist or the constructor throws synchronously and the
     kiosk stays frozen on "Starting camera...". -->
<div id="reader"></div>

<div id="topBar">
  <span class="pill" id="sessPill"><?= strtoupper($currentSession ?? 'MORNING') ?></span>
  <span class="pill <?= !empty($gateAllowed) ? 'open' : 'closed' ?>" id="gatePill">
    <?= !empty($gateAllowed) ? 'OPEN' : 'CLOSED' ?>
  </span>
</div>

<div id="status">Starting camera...</div>

<div id="flash">
  <div class="big"></div>
  <div class="nm" id="flashName"></div>
  <div class="sub" id="flashSub"></div>
</div>

<div id="pickupPanel">
  <div class="pp-side">
   <div class="pp-photo" id="ppFetcherPhoto"><i class="fas fa-user"></i></div>
   <div class="pp-name" id="ppFetcherName"></div>
   <div class="pp-meta" id="ppFetcherRel"></div>
  </div>
  <div class="pp-mid">
   <div class="pp-check"></div>
   <div class="pp-released">RELEASED</div>
   <div class="pp-timer"><span id="ppCount">10</span>s</div>
  </div>
  <div class="pp-side">
   <div class="pp-students" id="ppStudents"></div>
  </div>
</div>

<div id="sheet">
  <h3 id="sheetTitle">Students to release</h3>
  <div id="sheetList"></div>
  <div class="sub" id="sheetSub"></div>
  <button id="releaseBtn">Release selected</button>
</div>


<script>
var BASE_URL  = '<?= rtrim(base_url(), '/') ?>/';
var CSRF_NAME = '<?= csrf_token() ?>';
var CSRF_HASH = '<?= csrf_hash() ?>';
/* With csrfProtection='cookie' the live token is the csrf_cookie_name cookie,
   and it is re-issued whenever the session regenerates. A kiosk tab sits open
   for hours, so the value printed at page load goes stale and every POST then
   dies with "The action you requested is not allowed." Always send the
   current cookie value instead. */
function csrfToken() {
  var m = document.cookie.match(/(?:^|;\s*)csrf_cookie_name=([^;]+)/);
  return m ? decodeURIComponent(m[1]) : CSRF_HASH;
}
var GATE_OK   = <?= empty($gateAllowed) ? 'false' : 'true' ?>;

var scanner = null, scanning = false, lockout = false;

function say(msg, cls) {
  var el = document.getElementById('status');
  el.textContent = msg;
  el.className = 'show' + (cls ? ' ' + cls : '');
}
function hideSay() { document.getElementById('status').className = ''; }

/* ===== FAST SCANNER =====
 * BUGFIX: start() was called as start(cfg, cfg) - the FIRST arg must be the
 * CAMERA identifier ({facingMode} or deviceId), the SECOND is the scan config.
 * Passing the config object (which contains a qrbox FUNCTION) as the camera
 * arg makes getUserMedia reject garbage constraints -> never decodes.
 * Also: NO qrbox - the decoder scans the FULL frame, so the QR can be any
 * size / anywhere in view (no crop, no fake zoom). Native BarcodeDetector
 * (useBarCodeDetectorIfSupported) handles blur/low-light on Chrome/Edge/Android;
 * jsQR is the fallback. */
function buildScanner() {
  if (scanner) { try { scanner.clear(); } catch(e){} }
  // Fail loudly instead of throwing an opaque error later: without the host
  // element Html5Qrcode throws and the caller used to hang on
  // "Starting camera..." with scanning stuck at true.
  if (!document.getElementById('reader')) {
    throw new Error('scanner container #reader is missing from the page');
  }
  // NO formatsToSupport filter - this library build numbers QR_CODE as 11,
  // not 0 (0 = AZTEC). The old "[0]" filter made it decode AZTEC only, so it
  // could NEVER read a QR code. Unfiltered = scans QR + everything else.
  scanner = new Html5Qrcode('reader', { verbose: false });
}

function start() {
  if (scanning) return;
  if (!GATE_OK) { say('Scanner is closed right now.', 'err'); return; }
  scanning = true; lockout = false;
  say('Starting camera...');
  try {
    buildScanner();
  } catch (e) {
    scanning = false;
    say('Camera init failed: ' + ((e && e.message) || e), 'err');
    return;
  }

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
    say('Camera slow - retrying with lower resolution...', 'warn');
    setTimeout(startLowRes, 600);
  }, 8000);

  scanner.start(
    camera,
    scanCfg,
    function(text) {
      if (!text || lockout) return;
      settled = true; clearTimeout(watchdog);
      lockout = true; scanning = false;
      say('QR found');
      try { scanner.stop().catch(function(){}); } catch(e){}
      verify(text);
    },
    function() {}
  ).then(function() {
    if (settled) return;
    settled = true; clearTimeout(watchdog);
    say('Point at the QR code - full frame, any size');
  }).catch(function(err) {
    if (settled) return;
    settled = true; clearTimeout(watchdog);
    scanning = false;
    var m = (err && err.message) ? err.message : String(err || 'Camera error');
    say('Camera error: ' + m, 'err');
    setTimeout(startLowRes, 2500);
  });
}

/* Fallback: tiny 640x480 stream - easiest for potato cameras to decode. */
function startLowRes() {
  if (scanning) return;
  scanning = true; lockout = false;
  say('Starting camera (low-res mode)...');
  try {
    buildScanner();
  } catch (e) {
    scanning = false;
    say('Camera init failed: ' + ((e && e.message) || e), 'err');
    return;
  }

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
    say('QR found');
    try { scanner.stop().catch(function(){}); } catch(e){}
    verify(text);
  }, function(){}).then(function() {
    say('Point at the QR code (low-res mode)');
  }).catch(function(err) {
    scanning = false;
    say('Camera failed: ' + ((err&&err.message)||err) + ' - close this tab and reopen from the Scanner page.', 'err');
  });
}

function resume() {
  lockout = false;
  // The 10s success screen + 2s ready gap are already sequenced by showPickup,
  // so restart the camera straight away.
  setTimeout(start, 0);
}

/* ===== VERIFY + AUTO-RELEASE ===== */
/* ===== TIMINGS (edit these to balance the overlays) ===== */
var PICKUP_MS  = 10;    // seconds the success screen (fetchar + child photos) stays up
var READY_GAP_MS = 2000; // ms of "ready for next scan" pause after the success screen
var FLASH_MS   = 10000; // ms the green check flash stays up (normal)
var FLASH_ALREADY_MS = 2000; // ms the flash stays up (already released)

function verify(qr) {
  say('Verifying...');
  var fd = new FormData();
  fd.append('qr_code', qr);
  fd.append(CSRF_NAME, csrfToken());
  fetch(BASE_URL + 'scan/verify', { method:'POST', body: fd })
  .then(function(r){ return r.json(); })
  .then(function(res) {
    if (!res.success) {
      say(res.message || 'Invalid QR code', 'err');
      setTimeout(resume, 1800);
      return;
    }
    var p = res.parent, f = res.fetcher;
    window.lastFetcher = {
      name: (f && f.type === 'Sub-Fetcher') ? ([f.fname, f.mname, f.lname].filter(Boolean).join(' ')) : ([p.fname, p.mname, p.lname].filter(Boolean).join(' ')),
      photo: (f && f.photo) || '',
      relation: (f && f.relation) || (f && f.type) || 'Parent'
    };
    var who = (f && f.type === 'Sub-Fetcher') ? (f.fname+' '+f.lname) : (p.fname+' '+p.lname);
    var list = res.students || [];
    var sessName = (res.session || '').toUpperCase();

    if (list.length === 0) {
      say(who + ' - no students linked', 'warn');
      setTimeout(resume, 2500);
      return;
    }
    // No confirmation sheet any more: one scan releases EVERY child linked to
    // this fetcher (parent / guardian / sub-fetcher). The success screen then
    // shows one photo per child.
    var pending = list.filter(function (s) { return !s.already_released; });
    if (!pending.length) {
      flash(who, 'All ' + list.length + ' child(ren) were ALREADY RELEASED this ' + sessName + ' session.', true);
      say('Already released - ' + who, 'warn');
      setTimeout(resume, FLASH_ALREADY_MS + 2000);
      return;
    }
    releaseAll(list, p.id, qr, who);
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
  setTimeout(function(){ el.classList.remove('show'); }, already ? FLASH_ALREADY_MS : FLASH_MS);
}

function openSheet(who, list, pid, qr, sessName) {
  var alreadyN = list.filter(function(s){ return s.already_released; }).length;
  document.getElementById('sheetTitle').textContent = who;
  document.getElementById('sheetSub').textContent =
    list.length + ' students' +
    (alreadyN ? ' - ' + alreadyN + ' already released this ' + (sessName||'') + ' session' : '') +
    ' - tick who is being picked up.';
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
    btn.textContent = 'Releasing...';
    releaseAll(picked, pid, qr, who);
  };
  document.getElementById('sheet').classList.add('show');
}

var __ppTimer = null, __ppTick = null;
function showPickup(fetcher, relation, kids, seconds) {
  function paint(box, url) {
    box.innerHTML = '';
    if (url) {
      var img = document.createElement('img');
      img.src = url; img.alt = '';
      box.appendChild(img);
    } else {
      var ic = document.createElement('i');
      ic.className = 'fas fa-user';
      box.appendChild(ic);
    }
  }
  document.getElementById('ppFetcherName').textContent = fetcher.name || '';
  document.getElementById('ppFetcherRel').textContent = relation || '';
  paint(document.getElementById('ppFetcherPhoto'), fetcher.photo);

  // One card per child being picked up: 1 child = 1 photo, 2 = 2 photos, ...
  var wrap = document.getElementById('ppStudents');
  wrap.innerHTML = '';
  (kids || []).forEach(function (k) {
    var card = document.createElement('div');
    card.className = 'pp-kid';
    var ph = document.createElement('div');
    ph.className = 'pp-photo';
    paint(ph, k.photo);
    var nm = document.createElement('div');
    nm.className = 'pp-name';
    nm.textContent = k.name || '';
    var gr = document.createElement('div');
    gr.className = 'pp-meta';
    gr.textContent = k.grade || '';
    card.appendChild(ph); card.appendChild(nm); card.appendChild(gr);
    wrap.appendChild(card);
  });

  var panel = document.getElementById('pickupPanel');
  panel.classList.add('show');
  var left = seconds;
  document.getElementById('ppCount').textContent = left;
  var tick = setInterval(function () {
    left--; if (left < 0) { left = 0; }
    document.getElementById('ppCount').textContent = left;
    if (left <= 0) { clearInterval(tick); if (__ppTick === tick) { __ppTick = null; } }
  }, 1000);
  __ppTick = tick;
  __ppTimer = setTimeout(function () {
    if (__ppTick) { clearInterval(__ppTick); __ppTick = null; }
    __ppTimer = null;
    panel.classList.remove('show');
    // "Ready for next scan" gap before the camera comes back
    setTimeout(resume, READY_GAP_MS);
  }, seconds * 1000);
}

function releaseAll(students, pid, qr, who) {
  var i = 0, ok = 0, already = 0;
  var names = students.map(function(s){ return [s.fname, s.mname, s.lname].filter(Boolean).join(' '); }).join(', ');
  function next() {
    if (i >= students.length) {
      document.getElementById('sheet').classList.remove('show');
      if (ok > 0) {
        var released = students.filter(function (x) { return !x.already_released; });
        if (!released.length) { released = students.slice(); }
        showPickup(
          { name: (window.lastFetcher && window.lastFetcher.name) || who, photo: (window.lastFetcher && window.lastFetcher.photo) || '' },
          (window.lastFetcher && window.lastFetcher.relation) || '',
          released.map(function (s) {
            return {
              name: [s.fname, s.mname, s.lname].filter(Boolean).join(' '),
              grade: s.grade_section || '',
              photo: s.photo || ''
            };
          }),
          PICKUP_MS
        );
        say(who + ' - Released ' + ok + ' student(s).', 'ok');
        return;
      }
      if (already && !ok) {
        flash(names, 'All were ALREADY RELEASED this session - picked up by ' + who, true);
        say('Already released - nothing new.', 'warn');
      } else if (already) {
        say(who + ' - Released ' + ok + ', already released ' + already + '.', 'ok');
        flash(names, 'Picked up by ' + who + ' - Released ' + ok + ', already ' + already + '.');
      } else {
        flash(names, 'Picked up by ' + who + ' - Released ' + ok + ' student(s).');
        say(who + ' - Released ' + ok + ' student(s).', 'ok');
      }
      setTimeout(resume, (already && !ok ? FLASH_ALREADY_MS : FLASH_MS) + 200);
      return;
    }
    var s = students[i++];
    var fd = new FormData();
    fd.append('student_id', s.student_id || s.id);
    fd.append('parent_id', pid);
    fd.append('qr_code', qr);
    fd.append(CSRF_NAME, csrfToken());
    fetch(BASE_URL + 'scan/release', { method:'POST', body: fd })
    .then(function(r){ return r.json(); })
    .then(function(res) {
      if (res.blocked_by_schedule) {
        say(res.message || 'System closed.', 'err');
        GATE_OK = false;
        document.getElementById('gatePill').className = 'pill closed';
        document.getElementById('gatePill').textContent = 'CLOSED';
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
 * ~2s without reloading the kiosk tab. */
function pollStatus() {
  fetch(BASE_URL + 'schedule/status')
  .then(function(r){ return r.json(); })
  .then(function(st) {
    GATE_OK = !!st.allowed;
    var gp = document.getElementById('gatePill');
    gp.className = 'pill ' + (st.allowed ? 'open' : 'closed');
    gp.textContent = st.allowed ? 'OPEN' : 'CLOSED';
    var sp = document.getElementById('sessPill');
    var label = (st.session || '').toUpperCase();
    if (st.override) label += ' (MANUAL)';
    sp.textContent = label;
    if (!st.allowed && scanning) {
      try { scanner.stop().catch(function(){}); } catch(e){}
      scanning = false;
      say(st.message || 'Scanner closed.', 'err');
    } else if (st.allowed && !scanning && !lockout) {
      // Date Management reopened/changed the day -> resume without manual reload.
      say('Scanner open - scanning resumed.', 'ok');
      setTimeout(start, 300);
    }
  })
  .catch(function(){});
}
setInterval(pollStatus, 2000); // instant refresh: Date Management changes show within ~2s
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