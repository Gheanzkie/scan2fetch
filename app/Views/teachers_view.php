<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #a8c0ff;
    --soft-purple: #3f2b96;
    --soft-pink: #f093fb;
    --soft-rose: #f5576c;
    --soft-teal: #4facfe;
    --soft-green: #81c784;
    --soft-orange: #ffb74d;
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

.card-header h5, .card-header h6 {
    color: var(--ink) !important;
    font-weight: 700 !important;
}

.card-body { padding: 1.5rem !important; }

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 700 !important;
    padding: 8px 20px !important;
    font-size: 13px !important;
}

.btn-outline-secondary, .btn-outline-info, .btn-outline-danger {
    color: #6a6a8a !important;
    border: 2px solid rgba(108,140,255,0.15) !important;
    background: rgba(255,255,255,0.3) !important;
}

.btn-outline-secondary:hover, .btn-outline-info:hover {
    background: rgba(108,140,255,0.08) !important;
    border-color: var(--soft-blue) !important;
    color: var(--soft-purple) !important;
}

.btn-outline-danger:hover, .btn-outline-danger {
    border-color: rgba(245,87,108,0.2) !important;
    color: #c2185b !important;
}

.btn-outline-danger:hover {
    background: rgba(245,87,108,0.08) !important;
    border-color: var(--soft-rose) !important;
    color: var(--soft-rose) !important;
}

.btn-warning {
    background: linear-gradient(135deg, var(--soft-orange), #f57c00) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(255,183,77,0.3) !important;
}

.btn-warning:hover { box-shadow: 0 8px 25px rgba(255,183,77,0.4) !important; color: #fff !important; }

.btn-kid-success {
    background: linear-gradient(135deg, var(--soft-green), #43a047) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(76,175,80,0.2) !important;
}

.btn-kid-success:hover { box-shadow: 0 8px 25px rgba(76,175,80,0.3) !important; color: #fff !important; }

.btn-primary {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    border: none !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(108,140,255,0.3) !important;
}

.btn-primary:hover { box-shadow: 0 8px 25px rgba(108,140,255,0.4) !important; color: #fff !important; }

.btn-xs { padding: 4px 12px !important; font-size: 11px !important; border-radius: 50px !important; }

/* ===== BADGES ===== */
.badge {
    font-weight: 700 !important;
    padding: 6px 16px !important;
    border-radius: 50px !important;
    font-size: 12px !important;
}

.badge-grade {
    background: linear-gradient(135deg, rgba(240,147,251,0.2), rgba(168,192,255,0.2)) !important;
    color: #5a5280 !important;
}

.badge-parent {
    background: rgba(79,172,254,0.15) !important;
    color: #2f6fd0 !important;
    font-size: 11px !important;
}

.badge-count {
    background: rgba(168,192,255,0.15) !important;
    color: #5a5280 !important;
}

.badge-released {
    background: rgba(129,199,132,0.20) !important;
    color: #1b5e20 !important;
}

.badge-pending {
    background: rgba(255,183,77,0.22) !important;
    color: #b36b00 !important;
}

/* ===== ALERTS ===== */
.alert {
    border-radius: 20px !important;
    padding: 14px 22px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
}

.alert-success {
    background: rgba(129,199,132,0.12) !important;
    border-color: rgba(129,199,132,0.2) !important;
    color: #1b5e20 !important;
}

.alert-danger {
    background: rgba(245,87,108,0.10) !important;
    border-color: rgba(245,87,108,0.2) !important;
    color: #a83748 !important;
}

/* ===== BREADCRUMB ===== */
.breadcrumb { background: transparent !important; padding: 0 !important; }

.breadcrumb-item a {
    color: var(--muted) !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    text-decoration: none !important;
}

.breadcrumb-item a:hover { color: var(--soft-purple) !important; }

.breadcrumb-item.active { color: var(--ink) !important; font-weight: 700 !important; font-size: 13px !important; }
.breadcrumb-item + .breadcrumb-item::before { color: var(--faint) !important; content: "›" !important; }

/* ===== STUDENT ROW ===== */
.student-row {
    background: rgba(255,255,255,0.55);
    border: 1px solid rgba(63,43,150,0.05);
    border-radius: 14px;
    transition: background 0.25s ease, box-shadow 0.25s ease;
}

.student-row:hover {
    background: rgba(168,192,255,0.08);
    box-shadow: 0 4px 14px rgba(63,43,150,0.06);
}

 /* ===== DATE PICKER & SEARCH ===== */
 .input-group-text { border: none !important; background: transparent !important; }
 .form-control:focus { box-shadow: none !important; outline: none !important; }
 input[type="date"]::-webkit-calendar-picker-indicator { cursor: pointer; opacity: 0.6; }
 input[type="date"]::-webkit-calendar-picker-indicator:hover { opacity: 1; }

 @media (max-width: 768px) {
     .content-header h1 { font-size: 1.35rem !important; }
     .btn { font-size: 12px !important; padding: 6px 14px !important; }
 }
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1>
 <i class="fas fa-chalkboard-teacher mr-2"></i>
 <?= session('role') == 'teacher' ? 'My Students' : 'Teacher Details' ?>
 </h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <?php if (session('role') == 'teacher'): ?>
 <li class="breadcrumb-item active">My Students</li>
 <?php else: ?>
 <li class="breadcrumb-item"><a href="<?= base_url('teachers') ?>">Teachers</a></li>
 <li class="breadcrumb-item active">Details</li>
 <?php endif; ?>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">
 <?php if(session()->getFlashdata('msg')): ?>
 <div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i><?= session()->getFlashdata('msg') ?></div>
 <?php endif; ?>
 <?php if(session()->getFlashdata('error')): ?>
 <div class="alert alert-danger"><i class="fas fa-exclamation-circle mr-2"></i><?= session()->getFlashdata('error') ?></div>
 <?php endif; ?>

 <div class="row">
 <!-- ===== LEFT: Teacher Profile ===== -->
 <div class="col-md-4">
 <div class="card">
 <div class="card-body text-center">
 <?php if (!empty($teacher['picture'])): ?>
 <img src="<?= base_url('uploads/teachers/' . $teacher['picture']) ?>" alt="Teacher Photo"
            style="width:110px;height:110px;margin:0 auto;border-radius:50%;object-fit:cover;border:4px solid #e2e8f0;box-shadow:0 1px 4px rgba(15,23,42,.12);background:#f1f5f9;">
 <?php else: ?>
 <div style="width:110px;height:110px;margin:0 auto;border-radius:50%;overflow:hidden;border:4px solid #e2e8f0;box-shadow:0 1px 4px rgba(15,23,42,.12);background:#f1f5f9;display:flex;align-items:center;justify-content:center;">
 <i class="fas fa-chalkboard-teacher" style="font-size:42px;color:#94a3b8;"></i>
 </div>
 <?php endif; ?>

 <h3 class="mt-3 mb-0" style="color: #0f172a;"><?= esc($teacher['fname']) ?> <?= esc($teacher['lname']) ?></h3>
 <?php if(!empty($teacher['mname'])): ?>
 <p class="mb-0" style="color: var(--muted);"><?= esc($teacher['mname']) ?></p>
 <?php endif; ?>
 <p class="mb-2" style="color: var(--muted);">
 <i class="fas fa-phone mr-1"></i> <?= esc($teacher['phone']) ?>
 </p>
 <span class="badge badge-grade">
 <i class="fas fa-book mr-1"></i><?= esc($teacher['grade_section']) ?>
 </span>

 <?php if (session('role') == 'teacher'): ?>
 <div class="mt-4">
 <a href="<?= base_url('teachers-notifications') ?>" class="btn btn-kid-success btn-sm px-4">
 <i class="fas fa-sms mr-1"></i> SMS Notifications
 </a>
 </div>
 <?php else: ?>
 <div class="mt-4">
 <a href="<?= base_url('teachers') ?>" class="btn btn-primary btn-sm px-4">
 <i class="fas fa-arrow-left mr-1"></i> Back to Teachers
 </a>
 </div>
 <?php endif; ?>
 </div>
 </div>

 <div class="card mt-3">
 <div class="card-header">
 <h6 class="mb-0">
 <i class="fas fa-users mr-2" style="color: var(--soft-blue);"></i>
                                Students (<?= count($rows) ?>)
 <small style="color: var(--faint); font-size: 12px;">&nbsp;<?= esc($teacher['grade_section']) ?></small>
 </h6>
 </div>
 <div class="card-body py-3" style="color: var(--muted); font-size: 13px;">
 <div class="d-flex align-items-center justify-content-between mb-2 p-3" style="border-radius: 16px; background: rgba(129,199,132,0.08);">
 <span><i class="fas fa-home mr-2" style="color: #43a047;"></i> Picked up on <?= date('M d, Y', strtotime($selectedDate)) ?></span>
 <span class="badge badge-released"><?= isset($releasedToday) ? (int)$releasedToday : 0 ?></span>
 </div>
 <div class="d-flex align-items-center justify-content-between p-3" style="border-radius: 16px; background: rgba(255,183,77,0.10);">
 <span><i class="fas fa-school mr-2" style="color: #f57c00;"></i> Still waiting</span>
 <span class="badge badge-pending"><?= isset($pendingToday) ? (int)$pendingToday : 0 ?></span>
 </div>
 <div class="mt-3" style="color: var(--faint); font-size: 12px; text-align: center;">
 <i class="fas fa-user-graduate mr-1" style="color: rgba(79,172,254,0.3);"></i>
                                Every parent of these students receives SMS reminders together with this teacher.
 </div>
 </div>
 </div>
 </div>

 <!-- ===== RIGHT: Linked Students (grade section match) ===== -->
 <div class="col-md-8">
 <div class="card">
 <div class="card-header">
 <div class="d-flex justify-content-between align-items-center flex-wrap">
 <h6 class="mb-0">
 <i class="fas fa-users mr-2" style="color: var(--soft-blue);"></i>
                                    Class Roster (<?= count($rows) ?>)
 <small style="color: var(--faint); font-size: 12px;">&nbsp;<?= esc($teacher['grade_section']) ?></small>
 </h6>
 </div>
 <div class="mt-3">
 <form method="GET" action="<?= base_url('teachers-view/' . $teacher['id']) ?>" id="filterForm">
 <div class="row no-gutters align-items-center">
 <div class="col-auto pr-2">
 <div class="input-group input-group-sm" style="border-radius:50px;overflow:hidden;border:2px solid rgba(108,140,255,0.12);background:rgba(255,255,255,0.7);">
 <div class="input-group-prepend">
 <span class="input-group-text" style="background:transparent;border:none;padding:6px 12px;"><i class="fas fa-calendar-alt" style="color:var(--soft-purple);font-size:13px;"></i></span>
 </div>
 <input type="date" name="date" value="<?= esc($selectedDate) ?>" class="form-control border-0" style="background:transparent;font-size:13px;font-weight:600;color:var(--ink);padding:6px 8px;max-width:170px;" onchange="document.getElementById('filterForm').submit()">
 </div>
 </div>
 <div class="col pr-2">
 <div class="input-group input-group-sm" style="border-radius:50px;overflow:hidden;border:2px solid rgba(108,140,255,0.12);background:rgba(255,255,255,0.7);">

  <input type="text" name="q" value="<?= esc($search) ?>" class="form-control border-0" placeholder="Search student..." style="background:transparent;font-size:13px;padding:6px 12px;">
 <div class="input-group-append">
 <button type="submit" class="btn btn-sm" style="background:linear-gradient(135deg,var(--soft-blue),var(--soft-purple));color:#fff;border:none;border-radius:0 50px 50px 0;padding:6px 14px;font-size:12px;font-weight:700;">Search</button>
 </div>
 </div>
 </div>
 <div class="col-auto">

 </div>
 </div>
 </form>
 </div>
 </div>
 <div class="card-body pt-2">
 <?php if(!empty($rows)): foreach($rows as $r): ?>
 <?php $s = $r['student']; ?>
 <div class="student-row mb-3 p-3">
 <div class="d-flex align-items-center justify-content-between mb-2">
 <div class="d-flex align-items-center">
 <i class="fas fa-child mr-3" style="color: #b0b0c8; font-size: 16px;"></i>
 <div>
 <strong style="color: var(--ink); font-size: 14px;"><?= esc($s['fname']) ?> <?= esc(($s['mname']??'')) ?> <?= esc($s['lname']) ?></strong>
 <span class="badge badge-count ml-2"><?= esc($s['grade_section']) ?></span>
 </div>
 </div>
 <div class="d-flex align-items-center">
 <?php if (!empty($s['released'])): ?>
 <span class="badge badge-released">
 <i class="fas fa-check-circle mr-1"></i> Picked up <?= date('M d, Y h:i A', strtotime($s['released_time'])) ?>
 </span>
 <?php else: ?>
 <span class="badge badge-pending">
 <i class="fas fa-times-circle mr-1"></i> Not Fetched
 </span>
 <?php endif; ?>
 </div>
 </div>
 </div>
 <?php endforeach; else: ?>
 <div class="text-center py-5" style="color: var(--faint);">
 <i class="fas fa-user-graduate fa-3x mb-3 d-block" style="color: rgba(168,192,255,0.35);"></i>
 <h5 style="color: var(--muted);">No students under this grade/section yet</h5>
 <p style="font-size: 13px;">Students will appear here when their grade/section matches this teacher.</p>
 </div>
 <?php endif; ?>
 </div>
 </div>
 </div>
 </div>
 </div>
 </section>
</div>

<?= $this->endSection() ?>