<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
:root {
    --soft-blue: #a8c0ff;
    --soft-green: #81c784;
    --soft-rose: #f5576c;
    --soft-orange: #ffb74d;
}

body {
    background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%) !important;
    color: #3d3d5c !important;
}

.content-wrapper {
    background: transparent !important;
}

.card {
    border-radius: 20px !important;
    border: 1px solid rgba(255,255,255,0.6) !important;
    background: rgba(255,255,255,0.7) !important;
    backdrop-filter: blur(15px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.04) !important;
    overflow: hidden !important;
    margin-bottom: 16px;
}

.card-header {
    background: rgba(255,255,255,0.5) !important;
    border-bottom: 1px solid rgba(255,255,255,0.3) !important;
    padding: 0.8rem 1.2rem !important;
}

.card-header h5 {
    color: #4a4a6a !important;
    font-weight: 700 !important;
    font-size: 1rem !important;
    margin: 0;
}

.info-box {
    border-radius: 16px !important;
    border: 1px solid rgba(255,255,255,0.5) !important;
    background: rgba(255,255,255,0.6) !important;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.03) !important;
    padding: 12px 16px !important;
    cursor: pointer;
}

.info-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.08) !important;
}

.info-box .info-box-number {
    font-size: 28px !important;
    font-weight: 700 !important;
    color: #3d3d5c !important;
}

.info-box .info-box-text {
    color: #7a7a9a !important;
    font-size: 13px !important;
    font-weight: 500 !important;
}

.info-box-icon {
    width: 48px !important;
    height: 48px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1.2rem !important;
    border-radius: 12px !important;
    color: #fff !important;
}

.info-box.active {
    border: 2px solid var(--soft-blue) !important;
    box-shadow: 0 4px 20px rgba(168,192,255,0.3) !important;
}

.table {
    color: #3d3d5c !important;
    font-size: 13px !important;
    margin-bottom: 0;
}

.table thead {
    background: linear-gradient(135deg, #a8c0ff, #f093fb) !important;
}

.table thead th {
    color: #fff !important;
    font-weight: 600 !important;
    border-bottom: none !important;
    padding: 10px 12px !important;
    font-size: 12px !important;
    white-space: nowrap;
}

.table tbody tr {
    border-bottom: 1px solid rgba(160,160,180,0.06) !important;
    transition: all 0.2s ease !important;
}

.table tbody tr:hover {
    background: rgba(168,192,255,0.05) !important;
}

.table tbody td {
    color: #4a4a6a !important;
    vertical-align: middle !important;
    padding: 8px 12px !important;
    font-size: 12px !important;
}

.badge {
    font-weight: 500 !important;
    padding: 4px 12px !important;
    border-radius: 50px !important;
    font-size: 11px !important;
}

.badge-success { background: #81c784 !important; color: #fff !important; }
.badge-danger { background: #f5576c !important; color: #fff !important; }
.badge-warning { background: #ffb74d !important; color: #fff !important; }
.badge-info { background: #4facfe !important; color: #fff !important; }
.badge-primary { background: #a8c0ff !important; color: #fff !important; }
.badge-light { background: rgba(160,160,180,0.1) !important; color: #7a7a9a !important; }

.date-selector {
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 12px 18px;
    margin-bottom: 16px;
    border: 1px solid rgba(168,192,255,0.2);
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
}

.date-selector .form-control {
    border-radius: 50px;
    border: 1px solid rgba(168,192,255,0.3);
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    color: #3d3d5c;
    background: white;
    width: auto;
    min-width: 160px;
}

.date-selector .form-control:focus {
    border-color: var(--soft-blue);
    box-shadow: 0 0 0 3px rgba(168,192,255,0.2);
}

.tab-filters {
    background: rgba(255,255,255,0.3);
    border-radius: 12px;
    padding: 10px 16px;
    margin: 12px 16px;
    border: 1px solid rgba(255,255,255,0.3);
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
}

.tab-filters .form-control {
    border-radius: 50px;
    border: 1px solid rgba(168,192,255,0.3);
    padding: 6px 14px;
    font-size: 12px;
    color: #3d3d5c;
    background: white;
    min-width: 150px;
}

.tab-filters .form-control:focus {
    border-color: var(--soft-blue);
    box-shadow: 0 0 0 3px rgba(168,192,255,0.2);
}

.tab-filters .btn {
    border-radius: 50px !important;
    padding: 6px 16px !important;
    font-size: 12px !important;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.breadcrumb {
    background: transparent !important;
    padding: 0 !important;
}

.breadcrumb-item a {
    color: #7a7a9a !important;
    text-decoration: none !important;
    font-size: 13px !important;
    font-weight: 500 !important;
}

.breadcrumb-item a:hover {
    color: #3f2b96 !important;
}

.breadcrumb-item.active {
    color: #4a4a6a !important;
    font-weight: 600 !important;
    font-size: 13px !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: #c0c0d8 !important;
    content: "›" !important;
}

.content-header h1 {
    color: #3d3d5c !important;
    font-weight: 700 !important;
    font-size: 1.6rem !important;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.3; }
}

.live-pulse {
    display: inline-block;
    animation: pulse 2s infinite;
    color: #f5576c;
    font-size: 12px;
}

.sms-btn-container {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    padding: 10px 16px;
    background: rgba(255,183,77,0.08);
    border-radius: 12px;
    margin: 0 16px 12px 16px;
    border: 1px solid rgba(255,183,77,0.2);
}

.sms-btn-container .btn {
    border-radius: 50px !important;
    padding: 8px 20px !important;
    font-size: 13px !important;
}

@media (max-width: 768px) {
    .content-header h1 { font-size: 1.2rem !important; }
    .table td, .table th { padding: 4px 6px !important; font-size: 10px !important; }
    .info-box .info-box-number { font-size: 20px !important; }
    .date-selector { flex-direction: column; align-items: stretch; }
    .date-selector .form-control { width: 100% !important; }
    .tab-filters { flex-direction: column; align-items: stretch; }
    .tab-filters .form-control { width: 100% !important; }
    .sms-btn-container { flex-direction: column; align-items: stretch; text-align: center; }
}

@media (max-width: 480px) {
    .card { border-radius: 14px !important; }
    .table td, .table th { font-size: 9px !important; padding: 3px 4px !important; }
    .badge { font-size: 9px !important; padding: 2px 8px !important; }
}
</style>

<div class="content-wrapper" style="background: transparent;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-qrcode mr-2"></i>
                        Scan Monitor
                        <?php if($isToday ?? false): ?>
                            <span class="live-pulse">● LIVE</span>
                        <?php endif; ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item active">📊 Scan Monitor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- ===== DATE SELECTOR ===== -->
            <div class="date-selector">
                <div class="d-flex align-items-center" style="gap:10px;flex-wrap:wrap;">
                    <i class="far fa-calendar-alt" style="color:#a8c0ff;font-size:18px;"></i>
                    <span style="font-weight:600;color:#3d3d5c;font-size:14px;">Select Date:</span>
                    <form method="GET" action="<?= base_url('scan-monitor') ?>" style="display:inline-block;">
                        <input type="date" 
                               name="date" 
                               class="form-control" 
                               value="<?= $selectedDate ?? date('Y-m-d') ?>"
                               onchange="this.form.submit()"
                               style="min-width:180px;display:inline-block;">
                    </form>
                    <span style="color:#7a7a9a;font-size:13px;font-weight:500;">
                        <?= date('F d, Y', strtotime($selectedDate ?? date('Y-m-d'))) ?>
                    </span>
                    <?php if($isToday ?? false): ?>
                        <span class="badge badge-success">Today</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ===== ACTIVITY LOGS ===== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>
                                <i class="fas fa-history" style="color:#a8c0ff;"></i>
                                Activity Logs
                                <span class="badge badge-light ml-2"><?= count($scanLogs ?? []) ?></span>
                            </h5>
                            <small style="color:#7a7a9a;font-size:11px;">
                                <?= ($isToday ?? false) ? '🟢 Live updates' : '📅 Historical data' ?>
                            </small>
                        </div>
                        <div class="card-body p-0" style="max-height:400px;overflow-y:auto;">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Time</th>
                                            <th>Student</th>
                                            <th>Grade</th>
                                            <th>Fetcher</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($scanLogs)): $i = 1; ?>
                                        <?php foreach($scanLogs as $log): ?>
                                        <tr>
                                            <td style="color:#b0b0c8;"><?= $i++ ?></td>
                                            <td style="color:#7a7a9a;font-size:11px;">
                                                <?= date('h:i A', strtotime($log['created_at'] ?? $log['time_released'] ?? '')) ?>
                                            </td>
                                            <td>
                                                <strong style="color:#3d3d5c;">
                                                    <?php if(($log['action'] ?? '') == 'decline'): ?>
                                                        <?= esc($log['student_fname'] ?? $log['student_name'] ?? 'Unknown') ?>
                                                    <?php else: ?>
                                                        <?= esc($log['student_fname'] ?? $log['fname'] ?? '') ?>
                                                        <?= esc($log['student_lname'] ?? $log['lname'] ?? '') ?>
                                                    <?php endif; ?>
                                                </strong>
                                            </td>
                                            <td><span class="badge badge-light"><?= esc($log['grade_section'] ?? '—') ?></span></td>
                                            <td style="color:#4a4a6a;font-size:12px;">
                                                <?php if(($log['action'] ?? '') == 'decline'): ?>
                                                    <?= esc($log['fetcher_display'] ?? $log['user_name'] ?? '—') ?>
                                                <?php else: ?>
                                                    <?= esc($log['fetcher_display'] ?? $log['fetcher_fname'] ?? '—') ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(($log['action'] ?? '') == 'decline'): ?>
                                                    <span class="badge badge-danger">❌ Declined</span>
                                                <?php else: ?>
                                                    <span class="badge badge-success">✅ Released</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-4" style="color:#b0b0c8;">
                                                <i class="fas fa-inbox fa-2x mb-2 d-block" style="color:rgba(160,160,180,0.15);"></i>
                                                No activity for this date
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== STATS WITH CLICKABLE TABS ===== -->
            <div class="row mt-3">
                <div class="col-lg-4 col-6 mb-2">
                    <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=released') ?>" style="text-decoration:none;color:inherit;">
                        <div class="info-box d-flex align-items-center <?= ($activeTab ?? 'released') == 'released' ? 'active' : '' ?>">
                            <span class="info-box-icon mr-2" style="background:linear-gradient(135deg,#81c784,#43a047);">
                                <i class="fas fa-check-circle"></i>
                            </span>
                            <div>
                                <div class="info-box-text">✅ Released</div>
                                <div class="info-box-number"><?= $releasedToday ?? 0 ?></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-6 mb-2">
                    <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=declined') ?>" style="text-decoration:none;color:inherit;">
                        <div class="info-box d-flex align-items-center <?= ($activeTab ?? 'released') == 'declined' ? 'active' : '' ?>">
                            <span class="info-box-icon mr-2" style="background:linear-gradient(135deg,#f5576c,#d32f2f);">
                                <i class="fas fa-times-circle"></i>
                            </span>
                            <div>
                                <div class="info-box-text">❌ Declined</div>
                                <div class="info-box-number"><?= $declinedToday ?? 0 ?></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-6 mb-2">
                    <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=pending') ?>" style="text-decoration:none;color:inherit;">
                        <div class="info-box d-flex align-items-center <?= ($activeTab ?? 'released') == 'pending' ? 'active' : '' ?>">
                            <span class="info-box-icon mr-2" style="background:linear-gradient(135deg,#ffb74d,#f57c00);">
                                <i class="fas fa-clock"></i>
                            </span>
                            <div>
                                <div class="info-box-text">🕐 Pending</div>
                                <div class="info-box-number"><?= $pendingCount ?? 0 ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- ===== TAB CONTENT ===== -->
            <div class="row">
                <div class="col-12">

                    <!-- ===== RELEASED TAB ===== -->
                    <div class="tab-content <?= ($activeTab ?? 'released') == 'released' ? 'active' : '' ?>" id="tab-released">
                        <div class="card">
                            <div class="card-header" style="border-bottom: 3px solid #81c784;">
                                <h5>
                                    <i class="fas fa-check-circle" style="color:#81c784;"></i>
                                    Released Students
                                    <span class="badge badge-success ml-2"><?= count($releasedStudents ?? []) ?></span>
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="tab-filters">
                                    <form method="GET" action="<?= base_url('scan-monitor') ?>" class="d-flex flex-wrap align-items-center" style="gap:8px;width:100%;">
                                        <input type="hidden" name="date" value="<?= $selectedDate ?? date('Y-m-d') ?>">
                                        <input type="hidden" name="tab" value="released">
                                        
                                        <div style="flex:1;min-width:150px;">
                                            <input type="text" 
                                                   name="search" 
                                                   class="form-control" 
                                                   placeholder="🔍 Search student or fetcher..." 
                                                   value="<?= $search ?? '' ?>">
                                        </div>
                                        
                                        <div style="min-width:130px;">
                                            <select name="grade" class="form-control" onchange="this.form.submit()">
                                                <option value="">All Grades</option>
                                                <?php foreach($grades ?? [] as $g): ?>
                                                    <option value="<?= esc($g['grade_section']) ?>" <?= ($selectedGrade ?? '') == $g['grade_section'] ? 'selected' : '' ?>>
                                                        <?= esc($g['grade_section']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-outline-secondary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        
                                        <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=released') ?>" 
                                           class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </form>
                                </div>
                                
                                <div style="max-height:500px;overflow-y:auto;">
                                    <?php if(!empty($releasedStudents)): ?>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student</th>
                                                <th>Grade</th>
                                                <th>Fetcher</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; foreach($releasedStudents as $r): ?>
                                            <tr>
                                                <td style="color:#b0b0c8;"><?= $i++ ?></td>
                                                <td>
                                                    <strong style="color:#3d3d5c;">
                                                        <?= esc($r['student_fname']) ?> <?= esc($r['student_lname']) ?>
                                                    </strong>
                                                </td>
                                                <td><span class="badge badge-light"><?= esc($r['grade_section']) ?></span></td>
                                                <td style="font-size:12px;color:#4a4a6a;">
                                                    <?= esc($r['fetcher_fname']) ?> <?= esc($r['fetcher_lname']) ?>
                                                    <br><small style="color:#7a7a9a;"><?= esc($r['fetcher_relation'] ?? 'Parent') ?></small>
                                                </td>
                                                <td style="font-size:11px;color:#7a7a9a;">
                                                    <?= date('h:i A', strtotime($r['time_released'])) ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php else: ?>
                                    <div class="text-center py-4" style="color:#b0b0c8;">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block" style="color:rgba(160,160,180,0.15);"></i>
                                        No releases found
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ===== DECLINED TAB ===== -->
                    <div class="tab-content <?= ($activeTab ?? 'released') == 'declined' ? 'active' : '' ?>" id="tab-declined">
                        <div class="card">
                            <div class="card-header" style="border-bottom: 3px solid #f5576c;">
                                <h5>
                                    <i class="fas fa-times-circle" style="color:#f5576c;"></i>
                                    Declined Students
                                    <span class="badge badge-danger ml-2"><?= count($declinedStudents ?? []) ?></span>
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="tab-filters">
                                    <form method="GET" action="<?= base_url('scan-monitor') ?>" class="d-flex flex-wrap align-items-center" style="gap:8px;width:100%;">
                                        <input type="hidden" name="date" value="<?= $selectedDate ?? date('Y-m-d') ?>">
                                        <input type="hidden" name="tab" value="declined">
                                        
                                        <div style="flex:1;min-width:150px;">
                                            <input type="text" 
                                                   name="search" 
                                                   class="form-control" 
                                                   placeholder="🔍 Search declined records..." 
                                                   value="<?= $search ?? '' ?>">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-outline-secondary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        
                                        <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=declined') ?>" 
                                           class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </form>
                                </div>
                                
                                <div style="max-height:500px;overflow-y:auto;">
                                    <?php if(!empty($declinedStudents)): ?>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Time</th>
                                                <th>Student</th>
                                                <th>Grade</th>
                                                <th>Fetcher</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; foreach($declinedStudents as $d): ?>
                                            <tr>
                                                <td style="color:#b0b0c8;"><?= $i++ ?></td>
                                                <td style="font-size:11px;color:#7a7a9a;">
                                                    <?= date('h:i A', strtotime($d['created_at'])) ?>
                                                </td>
                                                <td>
                                                    <strong style="color:#3d3d5c;">
                                                        <?= esc($d['student_name'] ?? 'Unknown') ?>
                                                    </strong>
                                                </td>
                                                <td><span class="badge badge-light"><?= esc($d['grade_section'] ?? '—') ?></span></td>
                                                <td style="color:#4a4a6a;font-size:12px;">
                                                    <?= esc($d['fetcher_display'] ?? $d['user_name'] ?? '—') ?>
                                                    <br><small style="color:#7a7a9a;"><?= esc($d['role'] ?? '') ?></small>
                                                </td>
                                                <td style="font-size:11px;color:#7a7a9a;"><?= esc($d['description'] ?? '—') ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php else: ?>
                                    <div class="text-center py-4" style="color:#b0b0c8;">
                                        <i class="fas fa-check-circle fa-2x mb-2 d-block" style="color:rgba(129,199,132,0.3);"></i>
                                        No declined attempts today
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ===== PENDING TAB with SMS Button ===== -->
                    <div class="tab-content <?= ($activeTab ?? 'released') == 'pending' ? 'active' : '' ?>" id="tab-pending">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center" style="border-bottom: 3px solid #ffb74d;">
                                <h5>
                                    <i class="fas fa-clock" style="color:#ffb74d;"></i>
                                    Pending Students
                                    <span class="badge badge-warning ml-2"><?= count($pendingStudents ?? []) ?></span>
                                </h5>
                                <?php if($isToday ?? false): ?>
                                    <small style="color:#7a7a9a;font-size:11px;">🟡 Waiting for pickup</small>
                                <?php endif; ?>
                            </div>
                            <div class="card-body p-0">
                                <?php if($isToday ?? false && ($pendingCount ?? 0) > 0): ?>
                                <div class="sms-btn-container">
                                    <div style="flex:1;font-size:13px;color:#7a7a9a;">
                                        <i class="fas fa-info-circle" style="color:var(--soft-orange);"></i>
                                        <strong><?= $pendingCount ?? 0 ?></strong> student(s) still waiting for pickup
                                    </div>
                                    <button class="btn btn-warning" id="sendSmsBtn">
                                        <i class="fas fa-sms mr-1"></i> 📱 Notify Pending Parents
                                    </button>
                                    <small style="color:#b0b0c8;font-size:11px;">
                                        Send SMS reminder to parents
                                    </small>
                                </div>
                                <?php endif; ?>
                                
                                <div class="tab-filters">
                                    <form method="GET" action="<?= base_url('scan-monitor') ?>" class="d-flex flex-wrap align-items-center" style="gap:8px;width:100%;">
                                        <input type="hidden" name="date" value="<?= $selectedDate ?? date('Y-m-d') ?>">
                                        <input type="hidden" name="tab" value="pending">
                                        
                                        <div style="flex:1;min-width:150px;">
                                            <input type="text" 
                                                   name="search" 
                                                   class="form-control" 
                                                   placeholder="🔍 Search student or grade..." 
                                                   value="<?= $search ?? '' ?>">
                                        </div>
                                        
                                        <div style="min-width:130px;">
                                            <select name="grade" class="form-control" onchange="this.form.submit()">
                                                <option value="">All Grades</option>
                                                <?php foreach($grades ?? [] as $g): ?>
                                                    <option value="<?= esc($g['grade_section']) ?>" <?= ($selectedGrade ?? '') == $g['grade_section'] ? 'selected' : '' ?>>
                                                        <?= esc($g['grade_section']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-outline-secondary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        
                                        <a href="<?= base_url('scan-monitor?date='.($selectedDate ?? date('Y-m-d')).'&tab=pending') ?>" 
                                           class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </form>
                                </div>
                                
                                <div style="max-height:500px;overflow-y:auto;">
                                    <?php if(!empty($pendingStudents)): ?>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student</th>
                                                <th>Grade</th>
                                                <th>Parent/Guardian</th>
                                                <th>Contact</th>
                                                <?php if($isToday ?? false): ?>
                                                <th>Last Notified</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; foreach($pendingStudents as $s): ?>
                                            <tr>
                                                <td style="color:#b0b0c8;"><?= $i++ ?></td>
                                                <td>
                                                    <strong style="color:#3d3d5c;">
                                                        <?= esc($s['fname']) ?> <?= esc($s['lname']) ?>
                                                    </strong>
                                                </td>
                                                <td><span class="badge badge-light"><?= esc($s['grade_section']) ?></span></td>
                                                <td style="font-size:12px;color:#4a4a6a;">
                                                    <?php if(!empty($s['parent_names']) && $s['parent_names'] !== null): ?>
                                                        <?= esc($s['parent_names']) ?>
                                                    <?php else: ?>
                                                        <span style="color:#b0b0c8;">No parent assigned</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="font-size:12px;color:#7a7a9a;">
                                                    <?php if(!empty($s['parent_phones']) && $s['parent_phones'] !== null): ?>
                                                        📞 <?= esc($s['parent_phones']) ?>
                                                    <?php else: ?>
                                                        <span style="color:#b0b0c8;">—</span>
                                                    <?php endif; ?>
                                                </td>
                                                <?php if($isToday ?? false): ?>
                                                <td style="font-size:11px;color:#7a7a9a;">
                                                    <?php if(!empty($s['last_sms_notification'])): ?>
                                                        <?= date('h:i A', strtotime($s['last_sms_notification'])) ?>
                                                    <?php else: ?>
                                                        <span style="color:#b0b0c8;">Not yet</span>
                                                    <?php endif; ?>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php else: ?>
                                    <div class="text-center py-4" style="color:#b0b0c8;">
                                        <i class="fas fa-check-circle fa-2x mb-2 d-block" style="color:rgba(129,199,132,0.3);"></i>
                                        All students have been released! 🎉
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>

<!-- ===== SMS CONFIRMATION MODAL ===== -->
<div class="modal fade" id="smsConfirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 3px solid var(--soft-orange);">
                <h5><i class="fas fa-sms mr-2" style="color: var(--soft-orange);"></i>Send SMS Notifications 📱</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #4a4a6a;">&times;</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle mr-1"></i>
                    You are about to send SMS reminders to <strong id="smsTotalCount">0</strong> parent(s) of students who have not been picked up yet.
                </div>
                
                <div id="smsStudentList" style="max-height: 300px; overflow-y: auto;">
                    <!-- List will be populated by JS -->
                </div>
                
                <div class="mt-3">
                    <div class="form-group">
                        <label><i class="fas fa-pen mr-1"></i> Custom Message (Optional)</label>
                        <textarea id="smsCustomMessage" class="form-control" rows="2" 
                            placeholder="Add additional message or leave blank for default..."></textarea>
                        <small class="text-muted">The default message will be sent along with your custom message.</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel ❌</button>
                <button type="button" class="btn btn-warning btn-sm px-4" id="sendSmsConfirm">
                    <i class="fas fa-paper-plane mr-1"></i> Send SMS Now 📱
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ===== SMS RESULT MODAL ===== -->
<div class="modal fade" id="smsResultModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 3px solid var(--soft-green);">
                <h5><i class="fas fa-check-circle mr-2" style="color: var(--soft-green);"></i>SMS Sent ✅</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #4a4a6a;">&times;</button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-check-circle fa-4x mb-3" style="color: var(--soft-green);"></i>
                <h4 style="color: #3d3d5c;">SMS Notifications Sent!</h4>
                <p id="smsResultMessage" style="color: #7a7a9a;"></p>
                <div id="smsResultDetails" style="max-height: 200px; overflow-y: auto; text-align: left; font-size: 13px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close ❌</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
<?php if($isToday ?? false): ?>
var refreshTimer = setInterval(function() {
    if (!document.querySelector(':focus')) {
        location.reload();
    }
}, 30000);

$(document).on('focus', 'input, select', function() {
    clearInterval(refreshTimer);
}).on('blur', 'input, select', function() {
    refreshTimer = setInterval(function() {
        if (!document.querySelector(':focus')) {
            location.reload();
        }
    }, 30000);
});
<?php endif; ?>

function showAlert(message, type) {
    var alertClass = type === 'success' ? 'success' : (type === 'danger' ? 'danger' : 'warning');
    var icon = type === 'success' ? 'check-circle' : (type === 'danger' ? 'times-circle' : 'exclamation-triangle');
    var alertHtml = '<div class="alert alert-' + alertClass + ' alert-dismissible fade show">' +
        '<i class="fas fa-' + icon + ' mr-1"></i> ' + message +
        '<button type="button" class="close" data-dismiss="alert" style="color: #4a4a6a;">&times;</button>' +
        '</div>';
    $('#alertArea').html(alertHtml).show();
    setTimeout(function() {
        $('#alertArea').fadeOut();
    }, 5000);
}

// ===== FIXED SMS BUTTON =====
$(document).ready(function() {
    $('#sendSmsBtn').off('click').on('click', function() {
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Loading...');
        
        $.ajax({
            url: '<?= base_url('scan-monitor/get-pending-list') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success && response.students.length > 0) {
                    var html = '<ul class="list-group">';
                    response.students.forEach(function(s) {
                        html += '<li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgba(160,160,180,0.08);">';
                        html += '<div><strong>' + s.fname + ' ' + s.lname + '</strong><br><small style="color: #7a7a9a;">' + s.grade_section + '</small></div>';
                        html += '<div style="text-align:right;"><span class="badge badge-info">' + s.parent_fname + ' ' + s.parent_lname + '</span><br><small style="color: #7a7a9a;">📞 ' + s.parent_phone + '</small></div>';
                        html += '</li>';
                    });
                    html += '</ul>';
                    $('#smsStudentList').html(html);
                    $('#smsTotalCount').text(response.students.length);
                    $('#smsConfirmModal').modal('show');
                } else {
                    showAlert('No pending students to notify.', 'warning');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                showAlert('Error fetching pending students. Please refresh.', 'danger');
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fas fa-sms mr-1"></i> 📱 Notify Pending Parents');
            }
        });
    });
});

$('#sendSmsConfirm').click(function() {
    var customMessage = $('#smsCustomMessage').val();
    var btn = $(this);
    
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Sending...');
    
    var formData = new FormData();
    formData.append('custom_message', customMessage);
    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
    
    $.ajax({
        url: '<?= base_url('scan-monitor/send-notifications') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            $('#smsConfirmModal').modal('hide');
            
            if (response.success) {
                var resultHtml = '<p><strong>Sent:</strong> ' + response.sent + ' SMS</p>';
                if (response.failed > 0) {
                    resultHtml += '<p class="text-danger"><strong>Failed:</strong> ' + response.failed + ' SMS</p>';
                }
                resultHtml += '<hr><div style="max-height:150px;overflow-y:auto;">';
                response.messages.forEach(function(msg) {
                    resultHtml += '<div class="small border-bottom py-1">';
                    resultHtml += '📱 ' + msg.parent + ' → ' + msg.student;
                    resultHtml += '<br><small style="color: #7a7a9a;">' + msg.phone + '</small>';
                    resultHtml += '</div>';
                });
                resultHtml += '</div>';
                
                $('#smsResultMessage').text('Successfully sent ' + response.sent + ' SMS notification(s).');
                $('#smsResultDetails').html(resultHtml);
                $('#smsResultModal').modal('show');
                
                setTimeout(function() {
                    location.reload();
                }, 3000);
            } else {
                showAlert(response.message || 'Error sending SMS.', 'danger');
                btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i> Send SMS Now 📱');
            }
        },
        error: function() {
            showAlert('Error sending SMS notifications.', 'danger');
            btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i> Send SMS Now 📱');
        }
    });
});

$('#smsConfirmModal').on('hidden.bs.modal', function() {
    $('#smsCustomMessage').val('');
});
</script>
<?= $this->endSection() ?>