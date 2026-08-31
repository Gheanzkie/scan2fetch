<nav class="main-header navbar navbar-expand navbar-dark"
     style="background: #221c4a !important;
            border-bottom: 1px solid #32298a;"
     id="mainNavbar">

 <ul class="navbar-nav align-items-center">
 <li class="nav-item">
 <a class="nav-link text-white px-2" data-widget="pushmenu" href="#" role="button">
 <i class="fas fa-bars fa-lg"></i>
 </a>
 </li>
 <li class="nav-item d-none d-sm-inline-block">
 <a href="<?= base_url('dashboard') ?>" class="nav-link text-white px-2 font-weight-semibold"
               style="font-size: 15px;">
 <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
 </a>
 </li>
 </ul>

 <ul class="navbar-nav ml-auto align-items-center">
 <!-- ===== THEME SWITCHER (Light / Dark) ===== -->
 <li class="nav-item mr-2">
 <div class="theme-switcher" id="themeSwitcher" role="group" aria-label="Theme selector">
 <button type="button" class="theme-opt" data-theme="light" title="Light Mode">
 <i class="fas fa-sun"></i>
 </button>
 <button type="button" class="theme-opt" data-theme="dark" title="Dark Mode">
 <i class="fas fa-moon"></i>
 </button>
 </div>
 </li>
 <!-- ===== LIVE TIMER (Admin & Staff Only) ===== -->
 <?php
        $role = session('role');
        if ($role == 'admin' || $role == 'staff'):
        ?>
 <li class="nav-item d-none d-md-block mr-2">
 <div class="live-timer-container">
 <div class="live-dot"></div>
 <span class="live-time" id="liveTimeDisplay">
 <?= date('h:i:s A') ?>
 </span>
 <span class="live-date" id="liveDateDisplay">
 <?= date('M d, Y') ?>
 </span>
 </div>
 </li>
 <?php endif; ?>

 <li class="nav-item dropdown">
 <a class="nav-link text-white px-2" data-toggle="dropdown" href="#" role="button">
 <i class="far fa-user-circle fa-lg mr-1"></i>
 <span class="d-none d-md-inline font-weight-semibold"><?= session('fname') ?> <?= session('lname') ?></span>
 </a>
 <div class="dropdown-menu dropdown-menu-right">
 <div class="dropdown-header">
 <strong><?= session('fname') ?> <?= session('lname') ?></strong>
 <br>
 <small>
 <?php
                            if ($role == 'admin') echo 'Administrator';
                            elseif ($role == 'staff') echo 'Staff';
                            elseif ($role == 'teacher') echo 'Teacher';
                            elseif ($role == 'parent') echo 'Parent / Guardian';
                        ?>
 </small>
 </div>
 <div class="dropdown-divider"></div>
 <a href="<?= base_url('dashboard') ?>" class="dropdown-item">
 <i class="fas fa-tachometer-alt mr-2" style="color: #64748b;"></i> Dashboard
 </a>
 <a href="<?= base_url('messages') ?>" class="dropdown-item <?= $role == 'teacher' ? 'd-none' : '' ?>">
 <i class="fas fa-comments mr-2" style="color: #64748b;"></i> Messages
 <span class="badge badge-danger msg-badge" style="display:none;">0</span>
 </a>
 <div class="dropdown-divider"></div>
 <a href="#" class="dropdown-item" data-toggle="modal" data-target="#changePasswordModal">
 <i class="fas fa-key mr-2" style="color: #64748b;"></i> Change Password
 </a>
 <div class="dropdown-divider"></div>
 <a href="<?= base_url('logout') ?>" class="dropdown-item text-danger">
 <i class="fas fa-sign-out-alt mr-2"></i> Logout
 </a>
 </div>
 </li>
 </ul>
</nav>

<style>
    #mainNavbar .nav-link {
        border-radius: 6px;
        margin: 0 2px;
        padding: 8px 12px !important;
    }

    #mainNavbar .nav-link:hover {
        background: rgba(148, 163, 184, .14);
    }

    .nav-item.dropdown .nav-link:hover { background: rgba(148, 163, 184, .14) !important; }

    /* ===== THEME SWITCHER ===== */
    .theme-switcher {
        display: flex;
        align-items: center;
        gap: 4px;
        background: #2d2757;
        padding: 3px;
        border-radius: 8px;
        border: 1px solid #3b3480;
    }

    .theme-opt {
        width: 30px;
        height: 30px;
        border-radius: 6px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9a90d9;
        background: transparent;
        cursor: pointer;
        font-size: 13px;
        transition: background .2s ease, color .2s ease;
    }

    .theme-opt:hover { background: rgba(165, 180, 252, .15); color: #f5f3ff; }

    .theme-opt.active { background: #4c4090; color: #ffffff; }

    @media (max-width: 480px) {
        .theme-opt { width: 28px; height: 28px; font-size: 12px; }
    }

    /* ===== LIVE TIMER ===== */
    .live-timer-container {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #2d2757;
        padding: 4px 14px 4px 10px;
        border-radius: 8px;
        border: 1px solid #3b3480;
    }

    .live-dot {
        width: 8px;
        height: 8px;
        background: #7cf2b4;
        border-radius: 50%;
        animation: livePulse 1.4s ease-in-out infinite;
    }

    @keyframes livePulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .35; }
    }

    .live-time {
        color: #f5f3ff;
        font-weight: 600;
        font-size: 13px;
        font-family: 'Courier New', monospace;
        letter-spacing: .5px;
        min-width: 66px;
        text-align: center;
    }

    .live-date {
        color: #b3a9e6;
        font-weight: 500;
        font-size: 12px;
        border-left: 1px solid #3b3480;
        padding-left: 10px;
    }

    @media (max-width: 1200px) { .live-date { display: none; } }
    @media (max-width: 768px) { .live-timer-container { display: none; } }

    .dropdown-header {
        padding: 12px 16px;
        border-bottom: 1px solid #e2e8f0;
    }
</style>

<!-- ===== LIVE TIMER JAVASCRIPT (no jQuery dependency - ticks on every page) ===== -->
<script>
(function() {
    function pad(n) { return (n < 10 ? '0' : '') + n; }

    function updateTimer() {
        var now = new Date();
        var h = now.getHours();
        var ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12; if (h === 0) { h = 12; }
        var time = pad(h) + ':' + pad(now.getMinutes()) + ':' + pad(now.getSeconds()) + ' ' + ampm;
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var date = months[now.getMonth()] + ' ' + now.getDate() + ', ' + now.getFullYear();

        var tEl = document.getElementById('liveTimeDisplay');
        var dEl = document.getElementById('liveDateDisplay');
        if (tEl) { tEl.textContent = time; }
        if (dEl) { dEl.textContent = date; }
    }

    updateTimer();
    setInterval(updateTimer, 1000);
})();
</script>

<!-- ===== CHANGE PASSWORD MODAL (shared by admin / staff / parent) ===== -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered">
 <div class="modal-content">
 <div class="modal-header">
 <h5 class="modal-title">
 <i class="fas fa-key mr-2" style="color: #4361ee;"></i> Change Password
 </h5>
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>
 <form id="changePasswordForm">
 <div class="modal-body">
 <div class="form-group">
 <label>Current Password</label>
 <input type="password" class="form-control" id="cpCurrent" required>
 </div>
 <div class="form-group">
 <label>New Password</label>
 <input type="password" class="form-control" id="cpNew" minlength="6" required>
 <small class="text-muted">Minimum 6 characters.</small>
 </div>
 <div class="form-group mb-0">
 <label>Confirm New Password</label>
 <input type="password" class="form-control" id="cpConfirm" minlength="6" required>
 </div>
 <div id="cpStatus" class="small mt-2" style="color: #64748b;"></div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
 <button type="submit" class="btn btn-primary btn-sm px-4">
 <i class="fas fa-check mr-1"></i> Update Password
 </button>
 </div>
 </form>
 </div>
 </div>
</div>

<script>
(function() {
    var form = document.getElementById('changePasswordForm');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var status = document.getElementById('cpStatus');
        var current = document.getElementById('cpCurrent').value;
        var np = document.getElementById('cpNew').value;
        var conf = document.getElementById('cpConfirm').value;

        status.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';

        var body = new URLSearchParams();
        body.append('current_password', current);
        body.append('new_password', np);
        body.append('confirm_password', conf);

        fetch('/change-password', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: body
        }).then(function(r) { return r.json(); }).then(function(d) {
            if (d.success) {
                status.innerHTML = '<span style="color:#15803d;">' + d.message + '</span>';
                document.getElementById('cpCurrent').value = '';
                document.getElementById('cpNew').value = '';
                document.getElementById('cpConfirm').value = '';
                if (window.toastr) {
                    toastr.success(d.message);
                    $('#changePasswordModal').modal('hide');
                } else {
                    setTimeout(function() { $('#changePasswordModal').modal('hide'); }, 1200);
                }
            } else {
                status.innerHTML = '<span style="color:#dc2626;">' + d.message + '</span>';
            }
        }).catch(function() {
            status.innerHTML = '<span style="color:#dc2626;">Could not reach the server.</span>';
        });
    });
})();
</script>