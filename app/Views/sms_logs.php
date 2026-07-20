<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
/* ===== SOFT PASTEL CHILD-FRIENDLY THEME - SMS LOGS ===== */
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

/* ===== INFO BOX ===== */
.info-box {
    border-radius: 20px !important;
    border: 1px solid rgba(255,255,255,0.5) !important;
    background: rgba(255,255,255,0.6) !important;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
}

.info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.06) !important;
}

.info-box .info-box-content {
    color: #3d3d5c !important;
}

.info-box .info-box-text {
    color: #7a7a9a !important;
    font-size: 14px !important;
    font-weight: 500 !important;
}

.info-box .info-box-number {
    color: #3d3d5c !important;
    font-size: 24px !important;
    font-weight: 700 !important;
}

.info-box-icon {
    width: 60px !important;
    height: 60px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1.5rem !important;
    border-radius: 15px !important;
    color: #fff !important;
}

/* ===== TABLE ===== */
.table {
    color: #3d3d5c !important;
}

.table thead.bg-light {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-pink)) !important;
}

.table thead th {
    color: #fff !important;
    font-weight: 600 !important;
    border-bottom: none !important;
    padding: 14px 10px !important;
    font-size: 13px !important;
}

.table tbody tr {
    border-bottom: 1px solid rgba(160,160,180,0.06) !important;
    transition: all 0.3s ease !important;
}

.table tbody tr:hover {
    background: rgba(168,192,255,0.06) !important;
    transform: scale(1.01);
}

.table tbody td {
    color: #4a4a6a !important;
    vertical-align: middle !important;
    border-top: none !important;
    padding: 12px 10px !important;
    font-size: 13px !important;
}

.table .text-muted {
    color: #7a7a9a !important;
}

.table .small {
    color: #7a7a9a !important;
    font-size: 12px !important;
}

.table code {
    background: rgba(160,160,180,0.08) !important;
    color: #4a4a6a !important;
    padding: 2px 8px !important;
    border-radius: 6px !important;
    font-size: 13px !important;
}

/* ===== BADGES ===== */
.badge {
    font-weight: 500 !important;
    padding: 6px 16px !important;
    border-radius: 50px !important;
    font-size: 12px !important;
}

.badge-success { background: var(--soft-green) !important; color: #fff !important; }
.badge-warning { background: var(--soft-orange) !important; color: #fff !important; }
.badge-danger { background: var(--soft-rose) !important; color: #fff !important; }
.badge-light { background: rgba(160,160,180,0.08) !important; color: #7a7a9a !important; }

/* ===== BUTTONS ===== */
.btn {
    border-radius: 50px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    padding: 8px 20px !important;
    font-size: 13px !important;
}

.btn:hover {
    transform: translateY(-3px) scale(1.03);
}

.btn-group .btn {
    border-radius: 50px !important;
    border: 1px solid rgba(160,160,180,0.15) !important;
    background: rgba(255,255,255,0.5) !important;
    color: #7a7a9a !important;
    transition: all 0.3s ease !important;
    font-weight: 500 !important;
    padding: 6px 16px !important;
    font-size: 12px !important;
}

.btn-group .btn:hover {
    background: rgba(168,192,255,0.1) !important;
    color: var(--soft-purple) !important;
}

.btn-group .btn.active {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    color: #fff !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 4px 15px rgba(63,43,150,0.2) !important;
}

.btn-outline-primary {
    border-color: rgba(168,192,255,0.3) !important;
    color: #5a5a8a !important;
}

.btn-outline-primary.active {
    background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple)) !important;
    color: #fff !important;
    border-color: var(--soft-blue) !important;
}

.btn-outline-secondary {
    border-color: rgba(160,160,180,0.15) !important;
    color: #7a7a9a !important;
    background: rgba(255,255,255,0.3) !important;
}

.btn-outline-secondary:hover {
    background: rgba(168,192,255,0.08) !important;
    color: var(--soft-purple) !important;
}

.btn-block {
    display: block !important;
    width: 100% !important;
}

/* ===== FORM CONTROLS ===== */
.form-control {
    background: rgba(255,255,255,0.6) !important;
    border: 2px solid rgba(160,160,180,0.12) !important;
    color: #3d3d5c !important;
    border-radius: 12px !important;
    padding: 10px 16px !important;
    transition: all 0.3s ease !important;
    font-size: 14px !important;
    height: 42px !important;
}

.form-control:focus {
    background: rgba(255,255,255,0.9) !important;
    border-color: var(--soft-blue) !important;
    box-shadow: 0 0 0 4px rgba(168,192,255,0.12) !important;
    color: #3d3d5c !important;
}

.form-control::placeholder {
    color: #b0b0c8 !important;
}

.form-control-sm {
    border-radius: 10px !important;
    padding: 8px 14px !important;
    font-size: 13px !important;
    height: 36px !important;
}

select.form-control {
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b6b8d' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 36px !important;
    cursor: pointer;
}

select.form-control option {
    background: #ffffff !important;
    color: #3d3d5c !important;
    padding: 8px !important;
}

.input-group-text {
    background: rgba(255,255,255,0.4) !important;
    border: 2px solid rgba(160,160,180,0.12) !important;
    border-right: none !important;
    color: #7a7a9a !important;
    border-radius: 12px 0 0 12px !important;
    font-size: 14px !important;
}

.input-group .form-control {
    border-radius: 0 12px 12px 0 !important;
    border-left: none !important;
}

.input-group .form-control:focus {
    border-left: none !important;
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
.text-center.py-5 {
    color: #b0b0c8 !important;
}

.text-center.py-5 h5 {
    color: #7a7a9a !important;
}

.text-center.py-5 i {
    color: rgba(160,160,180,0.15) !important;
}

.text-center.py-5 p {
    color: #b0b0c8 !important;
}

/* ===== FILTER SECTION ===== */
.filter-section {
    background: rgba(255,255,255,0.5);
    border-radius: 18px;
    padding: 18px 20px 12px 20px;
    margin-bottom: 20px;
    border: 1px solid rgba(255,255,255,0.4);
}

.filter-section .filter-label {
    font-size: 13px;
    font-weight: 600;
    color: #5a5a7a;
    margin-bottom: 6px;
    display: block;
}

.filter-section .filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: flex-end;
}

.filter-section .filter-item {
    flex: 1;
    min-width: 160px;
}

.filter-section .filter-item-sm {
    flex: 0 0 auto;
    min-width: 100px;
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
@media (max-width: 992px) {
    .filter-section .filter-item {
        min-width: 140px;
    }
}

@media (max-width: 768px) {
    .card-body {
        padding: 1rem !important;
    }
    .content-header h1 {
        font-size: 1.5rem !important;
    }
    .table td, .table th {
        padding: 8px 4px !important;
        font-size: 11px !important;
    }
    .info-box .info-box-number {
        font-size: 18px !important;
    }
    .btn-group .btn {
        font-size: 10px !important;
        padding: 4px 10px !important;
    }
    .filter-section {
        padding: 12px 15px 8px 15px !important;
    }
    .filter-section .filter-item {
        min-width: 100% !important;
        flex: 1 1 100% !important;
    }
    .filter-section .filter-item-sm {
        min-width: 100% !important;
        flex: 1 1 100% !important;
    }
    .btn-block {
        width: 100% !important;
    }
}

@media (max-width: 480px) {
    .card {
        border-radius: 18px !important;
    }
    .table td, .table th {
        font-size: 9px !important;
        padding: 4px 2px !important;
    }
    .badge {
        font-size: 9px !important;
        padding: 3px 8px !important;
    }
    .btn {
        font-size: 10px !important;
        padding: 4px 10px !important;
    }
}
</style>

<div class="content-wrapper" style="background: transparent;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-sms mr-2"></i>
                        SMS Logs 💬
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">🏠 Home</a></li>
                        <li class="breadcrumb-item active">💬 SMS Logs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- ===== QUICK STATS ===== -->
            <div class="row">
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-blue), var(--soft-purple));">
                            <i class="fas fa-sms"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">📊 Total SMS</span>
                            <span class="info-box-number"><?= $totalSms ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-green), #43a047);">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">✅ Sent</span>
                            <span class="info-box-number"><?= $sentCount ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-orange), #f57c00);">
                            <i class="fas fa-clock"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">🕐 Pending</span>
                            <span class="info-box-number"><?= $pendingCount ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon" style="background: linear-gradient(135deg, var(--soft-teal), #00897b);">
                            <i class="fas fa-calendar-day"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">📅 Today</span>
                            <span class="info-box-number"><?= $todayCount ?? 0 ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== MAIN CARD ===== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h5 class="mb-0">
                                    <i class="fas fa-list mr-2" style="color: var(--soft-blue);"></i>
                                    SMS History 📋
                                    <span class="badge" style="background: rgba(160,160,180,0.1); color: #7a7a9a; margin-left: 8px; font-weight: 600; font-size: 12px; padding: 6px 14px;">
                                        <?= count($smsLogs ?? []) ?>
                                    </span>
                                </h5>
                                <div class="btn-group btn-group-sm mt-1 mt-md-0" style="flex-wrap: wrap; gap: 4px;">
                                    <button class="btn btn-outline-primary active" id="btnToday">📅 Today</button>
                                    <button class="btn btn-outline-primary" id="btnYesterday">📆 Yesterday</button>
                                    <button class="btn btn-outline-primary" id="btnWeek">📊 Week</button>
                                    <button class="btn btn-outline-primary" id="btnAll">📋 All</button>
                                    <button class="btn btn-outline-secondary" id="btnRefresh" title="Refresh page">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            
                            <!-- ===== FILTERS ===== -->
                            <div class="filter-section">
                                <div class="filter-row">
                                    <!-- Search -->
                                    <div class="filter-item">
                                        <label class="filter-label">🔍 Search</label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input type="text" id="searchFilter" class="form-control form-control-sm" placeholder="Search phone or message...">
                                        </div>
                                    </div>
                                    
                                    <!-- Status -->
                                    <div class="filter-item">
                                        <label class="filter-label">📌 Status</label>
                                        <select id="statusFilter" class="form-control form-control-sm">
                                            <option value="">All Status</option>
                                            <option value="sent">✅ Sent</option>
                                            <option value="pending">🕐 Pending</option>
                                            <option value="failed">❌ Failed</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Date -->
                                    <div class="filter-item">
                                        <label class="filter-label">📅 Date</label>
                                        <input type="date" id="dateFilter" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                                    </div>
                                    
                                    <!-- Reset -->
                                    <div class="filter-item-sm">
                                        <label class="filter-label">&nbsp;</label>
                                        <button class="btn btn-outline-secondary btn-sm btn-block" id="resetFilterBtn">
                                            <i class="fas fa-times"></i> Clear Filters
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- ===== TABLE ===== -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th style="width:140px;">📱 Phone</th>
                                            <th>💬 Message</th>
                                            <th style="width:110px;">📌 Status</th>
                                            <th style="width:160px;">⏰ Date/Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($smsLogs)): ?>
                                            <?php $i = 1; foreach ($smsLogs as $sms): ?>
                                            <tr class="sms-row" 
                                                data-search="<?= esc(strtolower($sms['parent_phone'] . ' ' . $sms['message'])) ?>"
                                                data-status="<?= $sms['status'] ?? 'sent' ?>"
                                                data-date="<?= date('Y-m-d', strtotime($sms['sent_at'])) ?>">
                                                <td style="color: #b0b0c8; font-size: 12px;"><?= $i++ ?></td>
                                                <td><code><?= esc($sms['parent_phone']) ?></code></td>
                                                <td style="color: #5a5a7a; font-size: 13px;"><?= esc($sms['message']) ?></td>
                                                <td>
                                                    <?php $status = $sms['status'] ?? 'sent'; ?>
                                                    <span class="badge badge-<?= $status == 'sent' ? 'success' : ($status == 'pending' ? 'warning' : 'danger') ?>">
                                                        <?= $status == 'sent' ? '✅' : ($status == 'pending' ? '🕐' : '❌') ?>
                                                        <?= ucfirst($status) ?>
                                                    </span>
                                                </td>
                                                <td style="color: #7a7a9a; font-size: 12px;"><?= date('M d, Y h:i A', strtotime($sms['sent_at'])) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center py-5">
                                                    <i class="fas fa-sms fa-3x mb-3 d-block" style="color: rgba(160,160,180,0.15);"></i>
                                                    <h5 style="color: #7a7a9a;">No SMS records found</h5>
                                                    <p style="color: #b0b0c8; font-size: 14px;">SMS notifications will appear here when students are released. ✨</p>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- ===== FOOTER COUNT ===== -->
                            <div class="text-muted small mt-2" style="color: #b0b0c8 !important;">
                                Showing <span id="showingCount"><?= count($smsLogs ?? []) ?></span> of <?= $totalSms ?? 0 ?> records
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
$(function() {
    // Set today's date as default
    var today = new Date().toISOString().split('T')[0];
    if (!$('#dateFilter').val()) {
        $('#dateFilter').val(today);
    }

    // Filter function
    function filterTable() {
        var searchVal = $('#searchFilter').val().toLowerCase();
        var statusVal = $('#statusFilter').val();
        var dateVal = $('#dateFilter').val();
        var visibleCount = 0;

        $('.sms-row').each(function() {
            var search = $(this).data('search');
            var status = $(this).data('status');
            var date = $(this).data('date');

            var matchSearch = searchVal === '' || search.indexOf(searchVal) > -1;
            var matchStatus = statusVal === '' || status === statusVal;
            var matchDate = dateVal === '' || date === dateVal;

            if (matchSearch && matchStatus && matchDate) {
                $(this).show();
                visibleCount++;
            } else {
                $(this).hide();
            }
        });

        // Update counts
        $('#visibleCount').text(visibleCount);
        $('#showingCount').text(visibleCount);
    }

    // Quick filter buttons
    $('#btnToday').click(function() {
        $(this).addClass('active').siblings().removeClass('active');
        $('#dateFilter').val(today);
        filterTable();
    });

    $('#btnYesterday').click(function() {
        $(this).addClass('active').siblings().removeClass('active');
        var yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);
        $('#dateFilter').val(yesterday.toISOString().split('T')[0]);
        filterTable();
    });

    $('#btnWeek').click(function() {
        $(this).addClass('active').siblings().removeClass('active');
        $('#dateFilter').val('');
        // Show last 7 days
        var weekAgo = new Date();
        weekAgo.setDate(weekAgo.getDate() - 7);
        var weekAgoStr = weekAgo.toISOString().split('T')[0];
        $('.sms-row').each(function() {
            var date = $(this).data('date');
            if (date >= weekAgoStr) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        updateCounts();
    });

    $('#btnAll').click(function() {
        $(this).addClass('active').siblings().removeClass('active');
        $('#dateFilter').val('');
        $('#statusFilter').val('');
        $('#searchFilter').val('');
        $('.sms-row').show();
        updateCounts();
    });

    $('#btnRefresh').click(function() {
        $(this).find('i').addClass('fa-spin');
        location.reload();
    });

    function updateCounts() {
        var count = $('.sms-row:visible').length;
        $('#visibleCount').text(count);
        $('#showingCount').text(count);
    }

    // Event listeners
    $('#searchFilter').on('keyup', filterTable);
    $('#statusFilter').on('change', function() {
        $('.btn-group .btn').removeClass('active');
        filterTable();
    });
    $('#dateFilter').on('change', function() {
        $('.btn-group .btn').removeClass('active');
        filterTable();
    });

    $('#resetFilterBtn').click(function() {
        $('#searchFilter').val('');
        $('#statusFilter').val('');
        $('#dateFilter').val(today);
        $('.btn-group .btn').removeClass('active');
        $('#btnToday').addClass('active');
        $('.sms-row').show();
        updateCounts();
        filterTable();
    });

    // Auto-refresh every 30 seconds (only if page is idle)
    var refreshInterval = 30000;
    var idleTime = 0;
    
    var autoRefresh = setInterval(function() {
        idleTime += 1000;
        if (idleTime >= refreshInterval && !document.querySelector(':focus')) {
            location.reload();
        }
    }, 1000);

    // Reset idle time on user activity
    $(document).on('mousemove keypress click scroll', function() {
        idleTime = 0;
    });

    // Initial filter (show today by default)
    filterTable();
});
</script>
<?= $this->endSection() ?>