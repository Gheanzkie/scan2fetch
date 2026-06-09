<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary"><i class="fas fa-sms mr-2"></i>SMS Logs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">SMS Logs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- Quick Stats -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-primary text-white"><i class="fas fa-sms"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total SMS</span>
                            <span class="info-box-number"><?= $totalSms ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-success text-white"><i class="fas fa-check-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sent</span>
                            <span class="info-box-number"><?= $sentCount ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-warning text-white"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pending</span>
                            <span class="info-box-number"><?= $pendingCount ?? 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-white shadow-sm border-0">
                        <span class="info-box-icon bg-info text-white"><i class="fas fa-calendar-day"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Today</span>
                            <span class="info-box-number"><?= $todayCount ?? 0 ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h5 class="mb-0">
                                    <i class="fas fa-list mr-2"></i>SMS History 
                                    <span class="badge badge-light ml-1" id="visibleCount"><?= count($smsLogs ?? []) ?></span>
                                </h5>
                                <div class="btn-group btn-group-sm mt-1 mt-md-0">
                                    <button class="btn btn-outline-primary active" id="btnToday">Today</button>
                                    <button class="btn btn-outline-primary" id="btnYesterday">Yesterday</button>
                                    <button class="btn btn-outline-primary" id="btnWeek">This Week</button>
                                    <button class="btn btn-outline-primary" id="btnAll">All</button>
                                    <button class="btn btn-outline-secondary" id="btnRefresh" title="Refresh page">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-2">
                            
                            <!-- Filters -->
                            <div class="row mb-3">
                                <div class="col-md-4 mb-2">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                                        </div>
                                        <input type="text" id="searchFilter" class="form-control" placeholder="Search phone number or message...">
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select id="statusFilter" class="form-control form-control-sm">
                                        <option value="">All Status</option>
                                        <option value="sent">✅ Sent</option>
                                        <option value="pending">🕐 Pending</option>
                                        <option value="failed">❌ Failed</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="date" id="dateFilter" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button class="btn btn-outline-secondary btn-sm btn-block" id="resetFilterBtn">
                                        <i class="fas fa-times"></i> Clear Filters
                                    </button>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary">
                                            <th style="width:40px;">#</th>
                                            <th style="width:130px;">Phone</th>
                                            <th>Message</th>
                                            <th style="width:100px;">Status</th>
                                            <th style="width:150px;">Date/Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($smsLogs)): ?>
                                            <?php $i = 1; foreach ($smsLogs as $sms): ?>
                                            <tr class="sms-row" 
                                                data-search="<?= esc(strtolower($sms['parent_phone'] . ' ' . $sms['message'])) ?>"
                                                data-status="<?= $sms['status'] ?? 'sent' ?>"
                                                data-date="<?= date('Y-m-d', strtotime($sms['sent_at'])) ?>">
                                                <td><?= $i++ ?></td>
                                                <td><code><?= esc($sms['parent_phone']) ?></code></td>
                                                <td><small class="text-muted"><?= esc($sms['message']) ?></small></td>
                                                <td>
                                                    <?php $status = $sms['status'] ?? 'sent'; ?>
                                                    <span class="badge badge-<?= $status == 'sent' ? 'success' : ($status == 'pending' ? 'warning' : 'danger') ?>">
                                                        <?= $status == 'sent' ? '✅' : ($status == 'pending' ? '🕐' : '❌') ?>
                                                        <?= ucfirst($status) ?>
                                                    </span>
                                                </td>
                                                <td class="small text-nowrap"><?= date('M d, Y h:i A', strtotime($sms['sent_at'])) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-5">
                                                    <i class="fas fa-sms fa-3x mb-3 d-block"></i>
                                                    <h5>No SMS records found</h5>
                                                    <p class="small">SMS notifications will appear here when students are released.</p>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-muted small mt-2">
                                Showing <span id="showingCount"><?= count($smsLogs ?? []) ?></span> of <?= $totalSms ?? 0 ?> records
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<style>
.info-box { border-radius: 10px; transition: all 0.2s; }
.info-box:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
.info-box-icon { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
.card { border-radius: 10px; }
.table td, .table th { vertical-align: middle; border-top: none; }
.table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background 0.2s; }
.table tbody tr:hover { background: #f8f9fa; }
.btn-group .btn.active { background: #667eea; color: #fff; border-color: #667eea; }
</style>

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
    var refreshInterval = 30000; // 30 seconds
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