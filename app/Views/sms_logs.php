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

            <!-- Stats Cards -->
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
                        <span class="info-box-icon bg-danger text-white"><i class="fas fa-times-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Failed</span>
                            <span class="info-box-number"><?= $failedCount ?? 0 ?></span>
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
                            <h5 class="mb-0"><i class="fas fa-list mr-2"></i>SMS History</h5>
                        </div>
                        <div class="card-body pt-2">
                            
                            <!-- Filters -->
                            <div class="row mb-3">
                                <div class="col-md-3 mb-2">
                                    <input type="text" id="searchFilter" class="form-control form-control-sm" placeholder="Search phone or message...">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select id="statusFilter" class="form-control form-control-sm">
                                        <option value="">All Status</option>
                                        <option value="sent">Sent</option>
                                        <option value="failed">Failed</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="date" id="dateFilter" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button class="btn btn-outline-secondary btn-sm" id="resetFilterBtn"><i class="fas fa-times"></i> Reset</button>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary">
                                            <th>#</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Date/Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($smsLogs)): ?>
                                            <?php $i = 1; foreach ($smsLogs as $sms): ?>
                                            <tr class="sms-row" 
                                                data-search="<?= esc(strtolower($sms['parent_phone'] . ' ' . $sms['message'])) ?>"
                                                data-status="<?= $sms['status'] ?? '' ?>"
                                                data-date="<?= date('Y-m-d', strtotime($sms['sent_at'])) ?>">
                                                <td><?= $i++ ?></td>
                                                <td><?= esc($sms['parent_phone']) ?></td>
                                                <td><small><?= esc($sms['message']) ?></small></td>
                                                <td>
                                                    <span class="badge badge-<?= ($sms['status'] ?? '') == 'sent' ? 'success' : 'danger' ?>">
                                                        <?= ucfirst($sms['status'] ?? '—') ?>
                                                    </span>
                                                </td>
                                                <td class="small"><?= date('M d, Y h:i A', strtotime($sms['sent_at'])) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="5" class="text-center text-muted py-5">No SMS sent yet</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
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
.table tbody tr { border-bottom: 1px solid #f3f4f6; }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function() {
    function filterTable() {
        var searchVal = $('#searchFilter').val().toLowerCase();
        var statusVal = $('#statusFilter').val();
        var dateVal = $('#dateFilter').val();

        $('.sms-row').each(function() {
            var search = $(this).data('search');
            var status = $(this).data('status');
            var date = $(this).data('date');

            var matchSearch = searchVal === '' || search.indexOf(searchVal) > -1;
            var matchStatus = statusVal === '' || status === statusVal;
            var matchDate = dateVal === '' || date === dateVal;

            if (matchSearch && matchStatus && matchDate) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    $('#searchFilter').on('keyup', filterTable);
    $('#statusFilter').on('change', filterTable);
    $('#dateFilter').on('change', filterTable);
    $('#resetFilterBtn').click(function() {
        $('#searchFilter').val('');
        $('#statusFilter').val('');
        $('#dateFilter').val('');
        $('.sms-row').show();
    });
});
</script>
<?= $this->endSection() ?>