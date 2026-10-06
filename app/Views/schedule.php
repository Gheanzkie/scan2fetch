<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
body { background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%) !important; }
.content-wrapper { background: transparent !important; }

.sched-card { border-radius: 20px; border: 1px solid rgba(255,255,255,.6); background: rgba(255,255,255,.75); box-shadow: 0 8px 30px rgba(0,0,0,.05); }
.sched-card .card-header { background: rgba(255,255,255,.55); border-bottom: 1px solid rgba(0,0,0,.05); font-weight: 700; color: #3d3d5c; }

/* ===== CALENDAR ===== */
.cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px; }
.cal-head { text-align: center; font-size: 11px; font-weight: 700; text-transform: uppercase; color: #7a7a9a; padding: 6px 0; }
.cal-day {
    position: relative; min-height: 74px; border-radius: 12px; background: #fff;
    border: 1px solid #e8e8f2; padding: 6px 8px; cursor: pointer; transition: all .15s ease;
    display: flex; flex-direction: column; align-items: flex-start; gap: 3px;
}
.cal-day:hover { border-color: #4361ee; box-shadow: 0 4px 14px rgba(67,97,238,.18); transform: translateY(-1px); }
.cal-day.empty { background: transparent; border: none; cursor: default; }
.cal-day.empty:hover { transform: none; box-shadow: none; }
.cal-day.today { border: 2px solid #4361ee; background: #eef4ff; }
.cal-day.selected { outline: 2px solid #7c3aed; outline-offset: -2px; }
.cal-day .dnum { font-size: 14px; font-weight: 700; color: #2d2d4a; }
.cal-day .dstatus { font-size: 10px; font-weight: 700; padding: 1px 6px; border-radius: 20px; }
.st-normal { background: #eef2ff; color: #4338ca; }
.st-open   { background: #dcfce7; color: #15803d; }
.st-closed { background: #fee2e2; color: #b91c1c; }
.st-holiday{ background: #fef3c7; color: #b45309; }
.cal-day .dhours { font-size: 10px; color: #94a3b8; }
.cal-day .ddot { position: absolute; top: 8px; right: 8px; width: 8px; height: 8px; border-radius: 50%; background: #f472b6; }

/* ===== STATUS PILLS ===== */
.pill { display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 30px; font-size: 13px; font-weight: 700; }
.pill-open { background: #dcfce7; color: #15803d; }
.pill-closed { background: #fee2e2; color: #b91c1c; }
.pill-normal { background: #eef2ff; color: #4338ca; }
.pill-holiday { background: #fef3c7; color: #b45309; }

/* ===== TIMELINE ===== */
.tl-item { position: relative; padding: 0 0 14px 26px; border-left: 2px solid #e2e8f0; margin-left: 8px; }
.tl-item:last-child { border-left-color: transparent; }
.tl-item::before { content: ''; position: absolute; left: -7px; top: 3px; width: 12px; height: 12px; border-radius: 50%; background: #4361ee; border: 2px solid #fff; box-shadow: 0 0 0 2px #c7d2fe; }
.tl-item.t-close::before { background: #dc2626; box-shadow: 0 0 0 2px #fecaca; }
.tl-item.t-holiday::before { background: #d97706; box-shadow: 0 0 0 2px #fde68a; }
.tl-item.t-note::before { background: #7c3aed; box-shadow: 0 0 0 2px #ddd6fe; }
.tl-time { font-size: 12px; font-weight: 700; color: #4361ee; }
.tl-text { font-size: 13px; color: #3d3d5c; }

/* ===== HOVER EDIT ON EACH DATE/NUMBER ===== */
.cal-day .cal-edit {
    position: absolute; bottom: 6px; right: 6px;
    width: 24px; height: 24px; border: none; border-radius: 50%;
    background: #4361ee; color: #fff; font-size: 11px;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transform: scale(.7); transition: all .15s ease;
    box-shadow: 0 3px 8px rgba(67,97,238,.35); cursor: pointer; z-index: 3;
}
.cal-day:hover .cal-edit { opacity: 1; transform: scale(1); }
.cal-day .cal-edit:hover { background: #7c3aed; }
.cal-day .dhours.blank { color: #cbd5e1; font-style: italic; letter-spacing: .3px; }

/* ===== HOUR CHOICE BUTTONS (preset 7:30–5:00 vs manual) ===== */
.hour-choice {
    border: 2px solid #e8e8f2; background: #fff; color: #3d3d5c;
    font-size: 12px; font-weight: 700; border-radius: 12px; padding: 7px 12px;
    transition: all .15s ease;
}
.hour-choice:hover { border-color: #a5b4fc; background: #f8faff; }
.hour-choice.active { border-color: #4361ee; background: #eef4ff; color: #2338b8; box-shadow: 0 3px 10px rgba(67,97,238,.18); }
.hour-choice i { margin-right: 5px; }

/* ===== 2-WAY SCAN SESSION TOGGLE (left = morning, right = afternoon) ===== */
.session2way {
    position: relative;
    display: inline-flex;
    align-items: center;
    width: 240px;
    height: 40px;
    border-radius: 50px;
    background: #fff;
    border: 1.5px solid #e8e8f2;
    box-shadow: inset 0 2px 6px rgba(15,23,42,.06);
    cursor: pointer;
    user-select: none;
    overflow: hidden;
    flex: 0 0 auto;
}
.session2way .session2way-label {
    position: relative;
    z-index: 2;
    flex: 1 1 50%;
    text-align: center;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .4px;
    text-transform: uppercase;
    color: #7a7a9a;
    transition: color .25s ease;
    padding: 0 6px;
    pointer-events: none;
}
.session2way .session2way-knob {
    position: absolute;
    z-index: 1;
    top: 3px;
    left: 3px;
    width: calc(50% - 3px);
    height: calc(100% - 6px);
    border-radius: 50px;
    background: linear-gradient(135deg, #4361ee, #7c3aed);
    box-shadow: 0 4px 12px rgba(67,97,238,.30);
    transition: transform .30s cubic-bezier(.4, 0, .2, 1);
}
.session2way[data-session="afternoon"] .session2way-knob { transform: translateX(100%); }
.session2way[data-session="morning"] .lbl-left,
.session2way[data-session="afternoon"] .lbl-right {
    color: #fff;
    text-shadow: 0 1px 3px rgba(0,0,0,.25);
}
.session2way:active .session2way-knob { filter: brightness(1.05); }
.session2way.is-busy { pointer-events: none; opacity: .7; }
@media (max-width: 480px) {
    .session2way { width: 200px; height: 36px; }
    .session2way .session2way-label { font-size: 11px; }
}

/* ===== SMOOTH ANIMATIONS ===== */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(16px) scale(.98); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes fadeOutSoft {
    from { opacity: 1; transform: translateY(0); }
    to   { opacity: 0; transform: translateY(-8px); }
}
@keyframes cellPulse {
    0%   { box-shadow: 0 0 0 0 rgba(67,97,238,.5); }
    100% { box-shadow: 0 0 0 14px rgba(67,97,238,0); }
}
@keyframes savedPop {
    0%   { opacity: 0; transform: translateY(8px) scale(.85); }
    45%  { opacity: 1; transform: translateY(0) scale(1.06); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes hourFlip {
    0%   { transform: rotateX(0); }
    50%  { transform: rotateX(90deg); opacity: .4; }
    100% { transform: rotateX(0); }
}
@keyframes gentleBob {
    0%, 100% { transform: translateY(0); }
    50%      { transform: translateY(-6px); }
}
.anim-in { animation: fadeInUp .35s cubic-bezier(.22, 1, .36, 1) both; }
.cal-day.pulse { animation: cellPulse .65s ease-out; }
.dhours.flip { animation: hourFlip .35s ease-in-out; }
.saved-flag {
    display: none; align-items: center; gap: 6px;
    background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;
    font-size: 12px; font-weight: 700; padding: 5px 12px; border-radius: 30px;
}
.saved-flag.show { display: inline-flex; animation: savedPop .35s cubic-bezier(.22,1,.36,1) both; }
.edit-placeholder { text-align: center; padding: 34px 18px; color: #94a3b8; }.edit-placeholder i { font-size: 2.4rem; color: rgba(67,97,238,.35); animation: gentleBob 2.2s ease-in-out infinite; }
.edit-placeholder p { font-size: 13px; margin: 14px 0 0; }
.card.hidden-panel { display: none; }

/* ===== SYSTEM DEFAULT BOX (header, katabi ng <> buttons) ===== */
.def-box {
    position: absolute; top: 100%; right: 12px; z-index: 40;
    margin-top: 6px; padding: 12px 14px; min-width: 270px;
    background: #fff; border: 1px solid #e8e8f2; border-radius: 14px;
    box-shadow: 0 12px 34px rgba(15,23,42,.16);
    animation: fadeInUp .22s cubic-bezier(.22,1,.36,1) both;
}
.def-box-title { font-size: 12px; font-weight: 700; color: #3d3d5c; margin-bottom: 8px; }

@media (max-width: 768px) {
    .cal-day { min-height: 54px; padding: 4px; }
    .cal-day .dhours { display: none; }
    .cal-day .cal-edit { opacity: 1; transform: scale(1); width: 20px; height: 20px; font-size: 9px; }
}
</style>

<!-- NOTE: no z-index here on purpose — a stacking context on .content-wrapper would trap
     .modal (z-index 1050) BELOW the body-level .modal-backdrop (z-index 1040), so the dark
     backdrop painted over the dialog, blocked every click/ESC handler and froze the page. -->
<div class="content-wrapper" style="position: relative;">
 <div class="content-header">
  <div class="container-fluid">
   <div class="row mb-2">
    <div class="col-sm-6">
     <h1><i class="fas fa-calendar-alt mr-2"></i>Date Management</h1>
    </div>
    <div class="col-sm-6">
     <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
      <li class="breadcrumb-item active">Date Management</li>
     </ol>
    </div>
   </div>
  </div>
 </div>

 <section class="content">
  <div class="container-fluid">

   <div class="row">
    <!-- ===== CALENDAR ===== -->
    <div class="col-lg-7">
     <div class="card sched-card mb-3">
      <div class="card-header d-flex justify-content-between align-items-center position-relative">
       <h5 class="mb-0"><i class="fas fa-calendar mr-2"></i><?= date('F Y', strtotime($month . '-01')) ?></h5>
       <div class="d-flex align-items-center gap-1">
        <?php if (session('role') == 'admin'): ?>
        <!-- System default hours — OUTSIDE the edit modal, beside the <> nav buttons -->
        <button type="button" class="btn btn-sm btn-outline-secondary" id="btnDefToggle"
                title="System default hours" style="border-radius:10px;">
         <i class="fas fa-cog"></i>
        </button>
        <?php endif; ?>
        <a href="?m=<?= date('Y-m', strtotime($month . '-01 -1 month')) ?>" class="btn btn-sm btn-outline-secondary"><i class="fas fa-chevron-left"></i></a>
        <a href="?m=<?= date('Y-m') ?>" class="btn btn-sm btn-outline-secondary">Today</a>
        <a href="?m=<?= date('Y-m', strtotime($month . '-01 +1 month')) ?>" class="btn btn-sm btn-outline-secondary"><i class="fas fa-chevron-right"></i></a>
       </div>
       <?php if (session('role') == 'admin'): ?>
       <!-- Small floating box, katabi ng <> buttons -->
       <div id="defBox" class="def-box" style="display:none;">
        <div class="def-box-title"><i class="fas fa-cog mr-1"></i>System default (unset dates)</div>
        <div class="d-flex align-items-center gap-2">
         <input type="time" id="defOpen" class="form-control form-control-sm" value="<?= $defaultOpen ?>">
         <span style="font-weight:700;color:#7a7a9a;">—</span>
         <input type="time" id="defClose" class="form-control form-control-sm" value="<?= $defaultClose ?>">
        </div>
        <small class="d-block mt-2" style="color:#94a3b8;font-size:11px;">
         Auto-saved. Applies only to dates with no hours set.
         <span class="saved-flag ml-1" id="defFlag"><i class="fas fa-check-circle"></i> Saved</span>
        </small>
       </div>
       <?php endif; ?>
      </div>
      <div class="card-body">
       <div class="cal-grid mb-1">
        <?php foreach (['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $d): ?>
         <div class="cal-head"><?= $d ?></div>
        <?php endforeach; ?>
       </div>
       <div class="cal-grid" id="calGrid">
        <?php
        $firstDow  = (int) date('w', strtotime($month . '-01'));
        $daysInMo  = (int) date('t', strtotime($month . '-01'));
        for ($i = 0; $i < $firstDow; $i++) {
            echo '<div class="cal-day empty"></div>';
        }
        for ($day = 1; $day <= $daysInMo; $day++) {
            $ds = sprintf('%s-%02d', $month, $day);
            $row = $monthMap[$ds] ?? null;
            $status = $row['status'] ?? 'normal';
            $isToday = ($ds === $today);
            // BLANK until set — no automatic default hours on the calendar.
            $openS  = ($row && $row['open_time'])  ? substr($row['open_time'], 0, 5)  : '';
            $closeS = ($row && $row['close_time']) ? substr($row['close_time'], 0, 5) : '';
            $hasHours = ($openS !== '' && $closeS !== '');
            $hoursTxt = $hasHours ? ($openS . '–' . $closeS) : '';
            echo '<div class="cal-day' . ($isToday ? ' today' : '') . '"'
                . ' data-date="' . $ds . '"'
                . ' data-status="' . htmlspecialchars($status, ENT_QUOTES) . '"'
                . ' data-open="' . htmlspecialchars($openS, ENT_QUOTES) . '"'
                . ' data-close="' . htmlspecialchars($closeS, ENT_QUOTES) . '"'
                . ' data-notes="' . htmlspecialchars((string) ($row['notes'] ?? ''), ENT_QUOTES) . '">';
            echo '<span class="dnum">' . $day . '</span>';
            echo '<span class="dstatus st-' . $status . '">' . strtoupper($status) . '</span>';
            echo '<span class="dhours' . ($hasHours ? '' : ' blank') . '">'
                . ($hasHours ? $hoursTxt : 'not set') . '</span>';
            if ($row && !empty($row['notes'])) echo '<span class="ddot" title="Has notes"></span>';
            echo '<button type="button" class="cal-edit" title="Edit this date"><i class="fas fa-pen"></i></button>';
            echo '</div>';
        }
        ?>
       </div>
        <div class="mt-3" style="font-size:12px;color:#7a7a9a;">
         <span class="dstatus st-normal" style="font-size:10px;padding:1px 6px;border-radius:20px;">NORMAL</span> follows the hours set on the date &nbsp;
         <span class="dstatus st-open" style="font-size:10px;padding:1px 6px;border-radius:20px;">OPEN</span> manually started &nbsp;
         <span class="dstatus st-closed" style="font-size:10px;padding:1px 6px;border-radius:20px;">CLOSED</span> day ended &nbsp;
         <span class="dstatus st-holiday" style="font-size:10px;padding:1px 6px;border-radius:20px;">HOLIDAY</span> no class
        </div>
      </div>
     </div>
    </div>

    <!-- ===== RIGHT: EDIT SELECTED DATE + DAY HISTORY ===== -->
    <div class="col-lg-5">

     <!-- Placeholder — edit section HIDDEN until a date/number is clicked -->
     <div class="card sched-card mb-3" id="editPlaceholder">
      <div class="edit-placeholder">
       <i class="fas fa-hand-pointer"></i>
       <p>Click a date / number on the calendar<br>to set its <strong>start</strong> or <strong>closed</strong> time.</p>
      </div>
     </div>

     <!-- Edit form — appears only after picking a date (smooth anim) -->
     <div class="card sched-card mb-3 hidden-panel" id="editPanel">
      <div class="card-header d-flex justify-content-between align-items-center">
       <h5 class="mb-0"><i class="fas fa-edit mr-2"></i>Edit Date — <span id="editDateLabel"><?= $today ?></span></h5>
       <div class="d-flex align-items-center gap-2">
        <span class="saved-flag" id="savedFlag"><i class="fas fa-check-circle"></i> Saved</span>
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="btnCloseEdit" title="Close edit section">
         <i class="fas fa-times mr-1"></i> Close
        </button>
       </div>
      </div>
      <div class="card-body">
       <input type="hidden" id="editDate" value="">

       <div class="form-group">
        <label>Status</label>
        <select id="editStatus" class="form-control">
         <option value="">Not set (defaults to Normal)</option>
         <option value="normal">Normal (auto — follows the hours set below)</option>
         <option value="open">Open (day started)</option>
         <option value="closed">Closed (day ended)</option>
         <option value="holiday">Holiday / No class</option>
        </select>
       </div>

       <?php if (session('role') == 'admin'): ?>
       <!-- ===== SCAN SESSION — 2-WAY SWITCH (left = morning, right = afternoon) ===== -->
       <div class="form-group">
        <label>Scan Session</label>
        <div class="d-flex align-items-center flex-wrap gap-2">
         <div class="session2way" id="scanSessionToggle"
              role="switch"
              tabindex="0"
              aria-checked="<?= ($scanSession ?? 'morning') === 'afternoon' ? 'true' : 'false' ?>"
              aria-label="Scan session: left morning, right afternoon"
              data-session="<?= esc($scanSession ?? 'morning') ?>">
          <span class="session2way-label lbl-left">Morning</span>
          <span class="session2way-label lbl-right">Afternoon</span>
          <span class="session2way-knob" aria-hidden="true"></span>
         </div>
         <span class="badge" id="scanSessionState"
               style="background:#eef2ff;color:#4338ca;font-weight:700;">—</span>
        </div>
       </div>
       <?php endif; ?>

        <label>Hours</label>
       <div class="d-flex gap-2 flex-wrap mb-2">
        <button type="button" class="hour-choice" data-choice="default">
         <i class="fas fa-bolt"></i> Use Default Time
        </button>
        <button type="button" class="hour-choice" data-choice="manual">
         <i class="fas fa-keyboard"></i> Set Manual Time
        </button>
       </div>
       <div class="form-row">
        <div class="form-group col-md-6">
         <label>Start Time</label>
         <input type="time" id="editOpen" class="form-control" value="" placeholder="Not set">
        </div>
        <div class="form-group col-md-6">
         <label>End Time</label>
         <input type="time" id="editClose" class="form-control" value="" placeholder="Not set">
        </div>
       </div>
       <small class="text-muted d-block mb-2" id="editHoursHint">Blank = not yet set. Pick a choice or type your own times.</small>
       <div class="form-group">
        <label>Notes / Reason (e.g. "Early dismissal", "No classes")</label>
        <input type="text" id="editNotes" class="form-control" maxlength="255" placeholder="Optional">
       </div>

        <!-- No Save button — everything below auto-saves (see AUTO-SAVE TRIGGERS). -->
       </div>
     </div>

      <!-- Date action buttons — replaces the history list below the Edit section -->
      <div class="card sched-card mb-3 hidden-panel" id="dateActionsCard">
       <div class="card-body d-flex gap-2 flex-wrap py-3">
        <button type="button" class="btn btn-sm btn-outline-secondary" id="btnSeeHistory">
         <i class="fas fa-stream mr-1"></i> See History
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary" id="btnSeeInfo">
         <i class="fas fa-info-circle mr-1"></i> See Information
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary" id="btnSeeStudents">
         <i class="fas fa-child mr-1"></i> View Student Status
        </button>
       </div>
      </div>

      <!-- ===== SEE HISTORY MODAL (existing day history, opened on demand) ===== -->
      <div class="modal fade" id="histModal" tabindex="-1">
       <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius:16px;">
         <div class="modal-header">
          <h5 class="mb-0"><i class="fas fa-stream mr-2"></i>History — <span id="histDateLabel"><?= $today ?></span></h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
         </div>
         <div class="modal-body" id="histModalBody">
          <div class="text-center py-3"><i class="fas fa-spinner fa-spin fa-2x text-muted"></i></div>
         </div>
        </div>
       </div>
      </div>

      <!-- ===== SEE INFORMATION MODAL (schedule / times / status of the date) ===== -->
      <div class="modal fade" id="infoModal" tabindex="-1">
       <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;">
         <div class="modal-header">
          <h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Information — <span id="infoDateLabel"><?= $today ?></span></h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
         </div>
         <div class="modal-body" id="infoModalBody">
          <div class="text-center py-3"><i class="fas fa-spinner fa-spin fa-2x text-muted"></i></div>
         </div>
        </div>
       </div>
      </div>

    </div>
   </div>

  </div>
 </section>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
var CSRF_NAME  = '<?= csrf_token() ?>';
var CSRF_HASH  = '<?= csrf_hash() ?>';
var DEF_OPEN   = '<?= $defaultOpen ?>';
var DEF_CLOSE  = '<?= $defaultClose ?>';
var TODAY      = '<?= $today ?>';
var SCAN_SESSION      = <?= json_encode($scanSession ?? 'morning') ?>;
var SCAN_SESSION_OVR  = <?= json_encode($scanOverride ?? null) ?>;
/* Saved hours of the date currently open in the Edit section (snapshot on load).
   Used to block clearing a configured date back to "not set". */
var origOpen = '', origClose = '';

function toast(msg, ok) {
    if (window.toastr) {
        ok ? toastr.success(msg) : toastr.error(msg);
    } else {
        alert(msg);
    }
}

/* ---- Hour choice buttons: Use Default Time vs Set Manual Time, per date ---- */
function syncChoiceState() {
    var o = $('#editOpen').val(), c = $('#editClose').val();
    $('.hour-choice').removeClass('active');
    if (o && c) {
        if (o === DEF_OPEN && c === DEF_CLOSE) {
            $('.hour-choice[data-choice="default"]').addClass('active');
            $('#editHoursHint').text('Using default time ' + DEF_OPEN + ' – ' + DEF_CLOSE + '.');
        } else {
            $('.hour-choice[data-choice="manual"]').addClass('active');
            $('#editHoursHint').text('Manual time: ' + o + ' – ' + c);
        }
    } else {
        $('#editHoursHint').text('No time set for this date yet. Pick "Use Default Time" or "Set Manual Time".');
    }
}

/* A configured date can never be blanked back to "not set" — its history stays. */
function hoursConfigured() {
    return !!(origOpen && origClose);
}

function guardNotBlank() {
    if (!hoursConfigured()) return true;
    var o = $('#editOpen').val(), c = $('#editClose').val();
    if (!o || !c) {
        $('#editOpen').val(origOpen);
        $('#editClose').val(origClose);
        syncChoiceState();
        toast('This date is already configured. You can change its times, but it cannot be reset to "Not Set".', false);
        return false;
    }
    return true;
}

/* Refresh a calendar cell after save (blank kept blank) + smooth pulse */
function refreshCell(date, status, open, close, animate) {
    var cell = $('.cal-day[data-date="' + date + '"]');
    if (!cell.length) return;
    cell.attr('data-status', status);
    cell.attr('data-open', open || '');
    cell.attr('data-close', close || '');
    var st = cell.find('.dstatus');
    st.attr('class', 'dstatus st-' + status).text(String(status).toUpperCase());
    var h = cell.find('.dhours');
    if (open && close) {
        h.removeClass('blank').text(open + '–' + close);
    } else {
        h.addClass('blank').text('not set');
    }
    if (animate !== false) {
        cell.removeClass('pulse');
        h.removeClass('flip');
        void cell[0].offsetWidth; /* reflow to restart animation */
        cell.addClass('pulse');
        h.addClass('flip');
        cell.one('animationend', function () { cell.removeClass('pulse'); });
        h.one('animationend', function () { h.removeClass('flip'); });
    }
}

/* ===== SHOW/HIDE EDIT SECTION (hidden until a date is pressed) ===== */
var editShown = false;
function showEditPanel() {
    var p = $('#editPanel'), a = $('#dateActionsCard');
    if (!editShown) {
        editShown = true;
        $('#editPlaceholder').fadeOut(180, function () {
            p.removeClass('hidden-panel').addClass('anim-in');
            a.stop(true, true).hide().removeClass('hidden-panel').fadeIn(250);
            p.one('animationend', function () { p.removeClass('anim-in'); });
        });
    } else if (!a.is(':visible')) {
        a.stop(true, true).hide().removeClass('hidden-panel').fadeIn(250);
    }
}
function hideEditPanel() {
    if (!editShown) return;
    editShown = false;
    $('#editPanel').addClass('hidden-panel');
    $('#dateActionsCard').stop(true, true).fadeOut(200, function () { $(this).addClass('hidden-panel'); });
    $('#editPlaceholder').stop(true, true).hide().fadeIn(220);
}

/* ===== AUTO-SAVE (debounced — walang save button, bawat change = save) ===== */
var autoSaveTimer = null;
var savingNow = false;
var pendingSave = false;

function flashSaved() {
    var f = $('#savedFlag');
    f.removeClass('show');
    void f[0].offsetWidth;
    f.addClass('show');
    clearTimeout(f.data('hideTimer'));
    f.data('hideTimer', setTimeout(function () { f.removeClass('show'); }, 1800));
}

function flashOnOff() {
    var f = $('#onOffFlag');
    if (!f.length) return;
    f.removeClass('show');
    void f[0].offsetWidth;
    f.addClass('show');
    clearTimeout(f.data('hideTimer'));
    f.data('hideTimer', setTimeout(function () { f.removeClass('show'); }, 1800));
}

/* Flush a pending debounced save instantly, quietly (used before closing the edit section) */
function commitSaveQuiet() {
    clearTimeout(autoSaveTimer);
    if ($('#editDate').val() && $('#editPanel').is(':visible')) {
        commitSave();
    }
}

function buildPayload() {
    var payload = {
        date: $('#editDate').val(),
        status: $('#editStatus').val() || 'normal',
        open_time: $('#editOpen').val() || '',
        close_time: $('#editClose').val() || '',
        notes: $('#editNotes').val() || '',
        [CSRF_NAME]: CSRF_HASH
    };
    return payload;
}

function commitSave() {
    if (savingNow) { pendingSave = true; return; }
    var date = $('#editDate').val();
    if (!date) return;
    if (!guardNotBlank()) return;
    savingNow = true;
    var payload = buildPayload();

    $.post('schedule/save', payload, function (d) {
        savingNow = false;
        if (d.success) {
            flashSaved();
            var cell = $('.cal-day[data-date="' + payload.date + '"]');
            if (cell.length) cell.attr('data-notes', payload.notes || '');
            refreshCell(payload.date, payload.status, payload.open_time, payload.close_time, true);
            /* Configured stays configured — snapshot for the not-set guard */
            origOpen  = payload.open_time  || origOpen;
            origClose = payload.close_time || origClose;
            if (infoModalOpen) renderInfo(d.row, payload.date);
            if (pendingSave) { pendingSave = false; commitSave(); }
        } else {
            toast(d.message || 'Save failed', false);
        }
    }, 'json').fail(function (xhr) {
        savingNow = false;
        /* Surface the real server error (403 CSRF / 500 / …) instead of a generic hint */
        var msg = (xhr && xhr.responseJSON && xhr.responseJSON.message)
            ? xhr.responseJSON.message
            : (xhr && xhr.status ? 'Save request failed (HTTP ' + xhr.status + ')' : 'Save request failed');
        toast(msg, false);
    });
}

function autoSave(delay) {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(commitSave, delay === undefined ? 450 : delay);
}

function loadDay(date) {
    showEditPanel();
    $('#editDate').val(date);
    $('#editDateLabel').text(date);
    $('#histDateLabel').text(date);
    $('#infoDateLabel').text(date);

    // Pull what's saved on the cell — blank stays blank (no default auto-fill)
    origOpen = ''; origClose = '';
    var cell = $('.cal-day[data-date="' + date + '"]');
    if (cell.length) {
        $('#editStatus').val(cell.attr('data-status') || 'normal');
        $('#editOpen').val(cell.attr('data-open') || '');
        $('#editClose').val(cell.attr('data-close') || '');
        $('#editNotes').val(cell.attr('data-notes') || '');
        origOpen  = cell.attr('data-open')  || '';
        origClose = cell.attr('data-close') || '';
        syncChoiceState();
    }

    $.getJSON('schedule/day?date=' + encodeURIComponent(date), function (d) {
        if (!d.success) { toast(d.message || 'Failed to load date.', false); return; }

        $('#editStatus').val(d.status);
        $('#editOpen').val(d.row && d.row.open_time ? d.row.open_time.substring(0, 5) : '');
        $('#editClose').val(d.row && d.row.close_time ? d.row.close_time.substring(0, 5) : '');
        $('#editNotes').val(d.row && d.row.notes ? d.row.notes : '');
        origOpen  = d.row && d.row.open_time  ? d.row.open_time.substring(0, 5)  : '';
        origClose = d.row && d.row.close_time ? d.row.close_time.substring(0, 5) : '';
        syncChoiceState();

        // Session switches for this date (NULL/default = ON)
        $('#swMorningEdit').prop('checked', !(d.row && d.row.morning_status === 'closed'));
        $('#swAfternoonEdit').prop('checked', !(d.row && d.row.afternoon_status === 'closed'));

        if (infoModalOpen) renderInfo(d.row, date);
    }).fail(function () {
        toast('Failed to load date information.', false);
    });
}

/* ===== SEE INFORMATION — schedule, time settings, current status of the date ===== */
var infoModalOpen = false;
function renderInfo(row, date) {
    row = row || null;
    var status = row ? row.status : 'normal';
    var open  = row && row.open_time  ? String(row.open_time).substring(0, 5)  : '';
    var close = row && row.close_time ? String(row.close_time).substring(0, 5) : '';
    var statusPill = {
        'normal':  '<span class="pill pill-normal"><i class="fas fa-circle mr-1" style="font-size:8px;"></i>NORMAL — follows system default</span>',
        'open':    '<span class="pill pill-open"><i class="fas fa-circle mr-1" style="font-size:8px;"></i>OPEN — day started</span>',
        'closed':  '<span class="pill pill-closed"><i class="fas fa-circle mr-1" style="font-size:8px;"></i>CLOSED — day ended</span>',
        'holiday': '<span class="pill pill-holiday"><i class="fas fa-circle mr-1" style="font-size:8px;"></i>HOLIDAY — no class</span>'
    };
    var html = '';
    html += '<div class="mb-3">' + (statusPill[status] || statusPill['normal']) + '</div>';
    html += '<div class="d-flex gap-2 flex-wrap mb-3">';
    html += '<span class="pill pill-normal"><i class="fas fa-door-open mr-1"></i>Start: ' + (open || 'not set') + '</span>';
    html += '<span class="pill pill-closed"><i class="fas fa-door-closed mr-1"></i>End: ' + (close || 'not set') + '</span>';
    html += '</div>';
    html += '<table class="table table-sm" style="font-size:13px;">';
    html += '<tr><th style="width:40%;color:#7a7a9a;">Date</th><td>' + date + '</td></tr>';
    html += '<tr><th style="color:#7a7a9a;">Start time</th><td>' + (open || 'Not set (uses system default ' + DEF_OPEN + ')') + '</td></tr>';
    html += '<tr><th style="color:#7a7a9a;">End time</th><td>' + (close || 'Not set (uses system default ' + DEF_CLOSE + ')') + '</td></tr>';
    html += '<tr><th style="color:#7a7a9a;">Status</th><td>' + String(status).toUpperCase() + '</td></tr>';
    if (row && row.opened_at) {
        html += '<tr><th style="color:#7a7a9a;">Opened</th><td>' + row.opened_at + (row.opened_by ? ' <small class="text-muted">by ' + $('<span>').text(row.opened_by).html() + '</small>' : '') + '</td></tr>';
    }
    if (row && row.closed_at) {
        html += '<tr><th style="color:#7a7a9a;">Closed</th><td>' + row.closed_at + (row.closed_by ? ' <small class="text-muted">by ' + $('<span>').text(row.closed_by).html() + '</small>' : '') + '</td></tr>';
    }
    if (row && row.notes) {
        html += '<tr><th style="color:#7a7a9a;">Notes</th><td>' + $('<span>').text(row.notes).html() + '</td></tr>';
    }
    html += '</table>';
    $('#infoModalBody').html(html);
}

/* ===== MODAL HYGIENE — one modal at a time, no leftover backdrop/body lock =====
   Bootstrap 4 appends .modal-backdrop to <body> and adds body.modal-open.
   If a modal is opened while another is mid-transition (or a previous close was
   interrupted), a second backdrop / a stale modal-open lock can survive and the
   page stays dark and unclickable. These guards make open/close idempotent. */
function purgeModalResidue() {
    /* No modal fully shown => any leftover backdrop and body-lock are stale. */
    if ($('.modal.show').length === 0) {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css({ 'padding-right': '', 'overflow': '' });
    }
}
function showModalSafely($m) {
    purgeModalResidue();
    var $open = $('.modal.show');
    if ($open.length) {
        /* Another modal is still open/animating — close it first, then show. */
        $open.one('hidden.bs.modal', function () {
            purgeModalResidue();
            $m.modal('show');
        });
        $open.modal('hide');
        return;
    }
    $m.modal('show');
}

function openInfo(date) {
    $('#infoDateLabel').text(date);
    $('#infoModalBody').html('<div class="text-center py-3"><i class="fas fa-spinner fa-spin fa-2x text-muted"></i></div>');
    infoModalOpen = true;
    showModalSafely($('#infoModal'));
    $.getJSON('schedule/day?date=' + encodeURIComponent(date), function (d) {
        if (!d.success) { $('#infoModalBody').html('<div class="alert alert-danger">' + d.message + '</div>'); return; }
        renderInfo(d.row, date);
    }).fail(function () {
        $('#infoModalBody').html('<div class="alert alert-danger">Failed to load date information.</div>');
    });
}

/* ===== SEE HISTORY — the existing day history, opened on demand ===== */
function openHistory(date) {
    $('#histDateLabel').text(date);
    $('#histModalBody').html('<div class="text-center py-3"><i class="fas fa-spinner fa-spin fa-2x text-muted"></i></div>');
    showModalSafely($('#histModal'));

    $.getJSON('schedule/day?date=' + encodeURIComponent(date), function (d) {
        if (!d.success) { $('#histModalBody').html('<div class="alert alert-danger">' + d.message + '</div>'); return; }

        var html = '';

        // Summary chips — show only what's saved on this date (blank = not set)
        var rowOpen  = (d.row && d.row.open_time)  ? d.row.open_time.substring(0, 5)  : '';
        var rowClose = (d.row && d.row.close_time) ? d.row.close_time.substring(0, 5) : '';
        html += '<div class="d-flex gap-2 flex-wrap mb-3 hist-chips">';
        html += '<span class="pill pill-normal chip-open"><i class="fas fa-door-open mr-1"></i>' + (rowOpen || 'not set') + '</span>';
        html += '<span class="pill ' + (d.status === 'closed' ? 'pill-closed' : (d.status === 'holiday' ? 'pill-holiday' : 'pill-open')) + ' chip-close"><i class="fas fa-door-closed mr-1"></i>' + (rowClose || 'not set') + '</span>';
        html += '<span class="pill" style="background:#e0f2fe;color:#0369a1;"><i class="fas fa-child mr-1"></i>' + d.counts.releases + ' released</span>';
        if (d.counts.pending > 0) {
            html += '<span class="pill pill-holiday"><i class="fas fa-hourglass-half mr-1"></i>' + d.counts.pending + ' pending</span>';
        }
        html += '</div>';

        // Timeline of day events (schedule only — NO activity logs, NO SMS per client)
        if (d.events.length) {
            html += '<h6 style="font-weight:700;color:#3d3d5c;"><i class="fas fa-bolt mr-1" style="color:#4361ee;"></i>Day Events</h6>';
            d.events.forEach(function (e) {
                var cls = e.type === 'close' ? 't-close' : (e.type === 'holiday' ? 't-holiday' : (e.type === 'note' ? 't-note' : ''));
                html += '<div class="tl-item ' + cls + '"><div class="tl-time">' + e.time + '</div><div class="tl-text">' + $('<span>').text(e.text).html() + '</div></div>';
            });
            html += '<hr>';
        }

        // Releases
        html += '<h6 style="font-weight:700;color:#3d3d5c;"><i class="fas fa-hand-holding-heart mr-1" style="color:#16a34a;"></i>Releases (' + d.releases.length + ')</h6>';
        if (d.releases.length) {
            html += '<div class="table-responsive"><table class="table table-sm" style="font-size:13px;"><thead><tr><th>Time</th><th>Student</th><th>Fetcher</th></tr></thead><tbody>';
            d.releases.forEach(function (r) {
                var student = (r.student_fname || '') + ' ' + (r.student_lname || '');
                var fetcher = (r.fetcher_fname || '') + ' ' + (r.fetcher_lname || '') + ' (' + (r.fetcher_relation || 'Parent') + ')';
                html += '<tr><td>' + r.time_released.substring(11, 16) + '</td><td>' + $('<span>').text(student.trim()).html() + (r.grade_section ? ' <small class="text-muted">· ' + $('<span>').text(r.grade_section).html() + '</small>' : '') + '</td><td>' + $('<span>').text(fetcher).html() + '</td></tr>';
            });
            html += '</tbody></table></div>';
        } else {
            html += '<p style="color:#94a3b8;font-size:13px;">No releases recorded on this date.</p>';
        }

        $('#histModalBody').html(html);
    }).fail(function () {
        $('#histModalBody').html('<div class="alert alert-danger">Failed to load day history.</div>');
    });
}

$(function () {
    // Calendar click — select the date, edit panel animates in
    $(document).on('click', '.cal-day:not(.empty)', function (e) {
        if ($(e.target).closest('.cal-edit').length) return; // pen handles itself
        $('.cal-day').removeClass('selected');
        $(this).addClass('selected').addClass('pulse').one('animationend', function () { $(this).removeClass('pulse'); });
        loadDay($(this).data('date'));
    });

    // HOVER pencil — edit THIS specific date/number, panel pops in smoothly
    $(document).on('click', '.cal-edit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var cell = $(this).closest('.cal-day');
        $('.cal-day').removeClass('selected');
        cell.addClass('selected');
        loadDay(cell.data('date'));
        setTimeout(function () {
            var panel = $('#editPanel');
            if (panel.is(':visible')) {
                $('html, body').animate({ scrollTop: panel.offset().top - 80 }, 300);
                $('#editOpen').trigger('focus');
            }
        }, 380); /* wait for the panel animation */
    });

    /* ===== AUTO-SAVE TRIGGERS — walang save button, bawat change = save ===== */

    // Status dropdown changes instantly
    $(document).on('change', '#editStatus', function () {
        if ($(this).val() === '') {
            /* "Not set" — the date must actually BECOME not set:
               clear Start/End time too, and lift the not-blank guard
               (this is an explicit choice, not an accidental clear). */
            origOpen = ''; origClose = '';
            $('#editOpen').val('');
            $('#editClose').val('');
        }
        syncChoiceState();
        autoSave(0);
    });

    // Hour choice buttons (Use Default Time / Set Manual Time) — pick = save agad
    $(document).on('click', '.hour-choice', function () {
        if (!editShown) return;
        var mode = $(this).data('choice');
        if (mode === 'default') {
            $('#editOpen').val(DEF_OPEN);
            $('#editClose').val(DEF_CLOSE);
        } else {
            // Set Manual Time — focus the start field WITHOUT erasing existing times.
            $('#editOpen').trigger('focus');
        }
        syncChoiceState();
        /* ANY button press = auto-save (default applies times, manual keeps current) */
        autoSave(0);
    });

    // Typing times manually — debounce 600ms then save.
    // Configured dates may be changed but never blanked back to "not set".
    $(document).on('change', '#editOpen, #editClose', function () {
        if (!guardNotBlank()) return;
        syncChoiceState();
        autoSave(600);
    });

    // Notes — debounce 800ms then save
    $(document).on('change', '#editNotes', function () {
        autoSave(800);
    });

    /* ===== SCAN SESSION — 2-WAY TOGGLE (left = morning, right = afternoon) =====
       Admin picks which session the SCANNER logs releases to.
       Saves via /scan/set-session (stored in the admin's own PHP session). */
    function renderScanSessionBadge() {
        var $badge = $('#scanSessionState');
        if (!$badge.length) return;
        if (SCAN_SESSION_OVR) {
            $badge.css({ background: '#fef3c7', color: '#b45309' })
                  .text(SCAN_SESSION_OVR.toUpperCase() + ' (manual)');
        } else {
            $badge.css({ background: '#eef2ff', color: '#4338ca' })
                  .text('CLOCK \u2014 ' + SCAN_SESSION.toUpperCase());
        }
    }

    function switchScanSession(picked) {
        var $tg = $('#scanSessionToggle');
        if (!$tg.length || $tg.hasClass('is-busy')) return;
        if (picked !== 'morning' && picked !== 'afternoon') return;
        if (picked === SCAN_SESSION && (SCAN_SESSION_OVR || null) === picked) return; // already there

        $tg.addClass('is-busy');
        $.post('scan/set-session', { session: picked, [CSRF_NAME]: CSRF_HASH }, function (d) {
            $tg.removeClass('is-busy');
            if (d && d.success) {
                SCAN_SESSION = d.session;
                SCAN_SESSION_OVR = d.override || null;
                $tg.attr('data-session', SCAN_SESSION)
                   .attr('aria-checked', SCAN_SESSION === 'afternoon' ? 'true' : 'false');
                renderScanSessionBadge();
                toast(d.message, true);
            } else {
                toast((d && d.message) || 'Could not switch session.', false);
            }
        }, 'json').fail(function (xhr) {
            $tg.removeClass('is-busy');
            var msg = (xhr && xhr.responseJSON && xhr.responseJSON.message)
                ? xhr.responseJSON.message
                : 'Session switch failed.';
            toast(msg, false);
        });
    }

    /* Tap LEFT half = morning, tap RIGHT half = afternoon */
    $(document).on('click', '#scanSessionToggle', function (e) {
        var rect = this.getBoundingClientRect();
        var picked = (e.clientX - rect.left) < rect.width / 2 ? 'morning' : 'afternoon';
        switchScanSession(picked);
    });
    /* Keyboard: arrows pick a side */
    $(document).on('keydown', '#scanSessionToggle', function (e) {
        if (e.key === 'ArrowLeft')  { e.preventDefault(); switchScanSession('morning'); }
        if (e.key === 'ArrowRight') { e.preventDefault(); switchScanSession('afternoon'); }
    });

    /* ===== SESSION SWITCHES (morning / afternoon) — Date Management =====
       Top-bar switches target TODAY; edit-panel switches target the selected
       date. Saves via /schedule/save-sessions (touches only the 2 columns). */
    $(document).on('change', '.session-switch', function () {
        var $sw = $(this);
        var session = String($sw.data('session'));      // morning | afternoon
        var checked = $sw.prop('checked');
        var cap = session.charAt(0).toUpperCase() + session.slice(1);
        var date = ($sw.data('date') === 'today') ? TODAY : $('#editDate').val();

        if (!date) {
            $sw.prop('checked', !checked);
            toast('Pick a date on the calendar first.', false);
            return;
        }

        var payload = { date: date };
        payload[session + '_status'] = checked ? 'open' : 'closed';
        payload[CSRF_NAME] = CSRF_HASH;

        $sw.prop('disabled', true);
        $.post('schedule/save-sessions', payload, function (d) {
            $sw.prop('disabled', false);
            if (d.success) {
                toast(cap + ' session ' + (checked ? 'OPENED' : 'CLOSED') + ' for ' + date + '.', true);
                if (date === TODAY) { $('#sw' + cap + 'Today').prop('checked', checked); }
                if (date === $('#editDate').val()) { $('#sw' + cap + 'Edit').prop('checked', checked); }
            } else {
                $sw.prop('checked', !checked);
                toast(d.message || 'Failed to save session switch.', false);
            }
        }, 'json').fail(function (xhr) {
            $sw.prop('disabled', false);
            $sw.prop('checked', !checked);
            var msg = (xhr && xhr.responseJSON && xhr.responseJSON.message)
                ? xhr.responseJSON.message
                : 'Session switch save failed.';
            toast(msg, false);
        });
    });

    // Admin system-wide defaults (header box) — debounced defaults-ONLY save
    var defTimer = null;
    $(document).on('change', '#defOpen, #defClose', function () {
        clearTimeout(defTimer);
        defTimer = setTimeout(function () {
            $.post('schedule/save', {
                defaults_only: 1,
                default_open: $('#defOpen').val() || '',
                default_close: $('#defClose').val() || '',
                [CSRF_NAME]: CSRF_HASH
            }, function (d) {
                if (d.success) {
                    var f = $('#defFlag');
                    if (f.length) {
                        f.removeClass('show');
                        void f[0].offsetWidth;
                        f.addClass('show');
                        clearTimeout(f.data('hideTimer'));
                        f.data('hideTimer', setTimeout(function () { f.removeClass('show'); }, 1800));
                    }
                } else { toast(d.message || 'Failed', false); }
            }, 'json').fail(function () { toast('Save request failed', false); });
        }, 600);
    });

    // Toggle ng system-default box (gilid ng <> buttons)
    $(document).on('click', '#btnDefToggle', function (e) {
        e.stopPropagation();
        $('#defBox').slideToggle(180);
    });
    $(document).on('click', '#defBox', function (e) { e.stopPropagation(); });
    $(document).on('click', function () { $('#defBox').slideUp(180); });

    // CLOSE button sa edit section — flush pending save then hide with smooth anim
    $('#btnCloseEdit').on('click', function () {
        commitSaveQuiet();
        $('.cal-day').removeClass('selected');
        hideEditPanel();
    });

    // ===== SEE HISTORY — opens the existing day history for the selected date =====
    $('#btnSeeHistory').on('click', function () {
        var date = $('#editDate').val();
        if (!date) { toast('Pick a date on the calendar first.', false); return; }
        commitSaveQuiet();
        openHistory(date);
    });

    // ===== SEE INFORMATION — schedule, times, current status of the selected date =====
    $('#btnSeeInfo').on('click', function () {
        var date = $('#editDate').val();
        if (!date) { toast('Pick a date on the calendar first.', false); return; }
        commitSaveQuiet();
        openInfo(date);
    });

    // ===== VIEW STUDENT STATUS — existing student status page, date preselected =====
    $('#btnSeeStudents').on('click', function () {
        var date = $('#editDate').val();
        if (!date) { toast('Pick a date on the calendar first.', false); return; }
        commitSaveQuiet();
        window.location.href = '<?= base_url('scan-monitor') ?>?date=' + encodeURIComponent(date);
    });

    // Modal cleanup — after ANY modal fully closes: drop orphan backdrops,
    // release body scroll-lock if no modal remains, stop info live-refresh.
    $('#histModal, #infoModal').on('hidden.bs.modal', function () {
        infoModalOpen = false;
        purgeModalResidue();
    });

    /* Initial state: edit section HIDDEN — lalabas lang pag may pinindot */
    hideEditPanel();
    renderScanSessionBadge();
});
</script>
<?= $this->endSection() ?>
