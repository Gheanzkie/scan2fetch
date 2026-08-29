<aside class="main-sidebar sidebar-dark-primary elevation-4"
       id="mainSidebar"
       style="background: #111827 !important;
              border-right: 1px solid #1f2937;">

 <!-- ===== BRAND ===== -->
 <a href="<?= base_url('dashboard') ?>" class="brand-link d-flex align-items-center"
       style="border-bottom: 1px solid #1f2937; padding: 14px 18px;">
 <div style="width:36px;height:36px;
                    display:flex;align-items:center;justify-content:center;
                    background:#1f2937;border-radius:8px;">
 <i class="fas fa-qrcode" style="color:#60a5fa;font-size:18px;"></i>
 </div>
 <span class="brand-text font-weight-bold ml-3" style="font-size:17px;color:#f8fafc;letter-spacing:.5px;">
            SCAN2FETCH
 </span>
 </a>

 <div class="sidebar" style="padding: 10px 12px;">
 <!-- ===== USER GREETING ===== -->
 <div class="user-panel mt-2 pb-3 mb-3 d-flex align-items-center"
             style="border-bottom: 1px solid #1f2937; padding-bottom: 14px;">
 <div class="image">
 <div style="width:38px;height:38px;border-radius:8px;background:#1f2937;
                            display:flex;align-items:center;justify-content:center;">
 <i class="fas fa-user" style="color:#94a3b8;font-size:15px;"></i>
 </div>
 </div>
 <div class="info ml-3" style="line-height:1.3;">
 <a href="#" class="d-block text-white font-weight-semibold" style="font-size:14px;color:#f8fafc !important;">
 <?= session('fname') ?> <?= session('lname') ?>
 </a>
 <small style="color: #64748b; font-size: 11px; text-transform: uppercase; letter-spacing: .5px;">
 <?php
                        $role = session('role');
                        if ($role == 'admin') echo 'Administrator';
                        elseif ($role == 'staff') echo 'Staff';
                        elseif ($role == 'teacher') echo 'Teacher';
                        elseif ($role == 'parent') echo 'Parent';
                    ?>
 </small>
 </div>
 </div>

 <!-- ===== NAVIGATION ===== -->
 <nav class="mt-2">
 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

 <!-- Dashboard -->
 <li class="nav-item">
 <a href="<?= base_url('dashboard') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'dashboard') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-tachometer-alt"></i>
 <p>Dashboard</p>
 </a>
 </li>

 <?php if (session('role') == 'admin'): ?>
 <!-- ===== MANAGEMENT ===== -->
 <li class="nav-header">MANAGEMENT</li>

 <li class="nav-item">
 <a href="<?= base_url('register') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'students-add') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-user-plus" style="color: #4ade80;"></i>
 <p>Register</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('parents') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'parents') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-users" style="color: #38bdf8;"></i>
 <p>Parents</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('students') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'students') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-user-graduate" style="color: #fbbf24;"></i>
 <p>Students</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('staffs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'staffs') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-user-check" style="color: #a5b4fc;"></i>
 <p>Staffs</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('teachers') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'teachers-view') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-chalkboard-teacher" style="color: #f472b6;"></i>
 <p>Teachers</p>
 </a>
 </li>

 <!-- ===== OPERATIONS ===== -->
 <li class="nav-header">OPERATIONS</li>

 <li class="nav-item">
 <a href="<?= base_url('scan') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'scan') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-qrcode" style="color: #f472b6;"></i>
 <p>QR Scan</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('scan-monitor') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'scan-monitor') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-desktop" style="color: #38bdf8;"></i>
 <p>Students Status</p>
 </a>
 </li>

 <!-- ===== REPORTS ===== -->
 <li class="nav-header">REPORTS</li>

 <li class="nav-item">
 <a href="<?= base_url('logs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'logs') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-history" style="color: #fbbf24;"></i>
 <p>Activity Logs</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('sms-logs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'sms-logs') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-sms" style="color: #4ade80;"></i>
 <p>SMS Logs</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('messages') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'messages') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-comments" style="color: #f472b6;"></i>
 <p>Messages</p>
 <span class="right badge badge-danger msg-badge" style="display:none;">0</span>
 </a>
 </li>
 <?php endif; ?>


 <?php if (session('role') == 'staff'): ?>
 <!-- ===== OPERATIONS ===== -->
 <li class="nav-header">OPERATIONS</li>

 <li class="nav-item">
 <a href="<?= base_url('register') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'students-add') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-user-plus" style="color: #4ade80;"></i>
 <p>Register Student</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('scan') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'scan') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-qrcode" style="color: #f472b6;"></i>
 <p>QR Scan</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('scan-monitor') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'scan-monitor') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-desktop" style="color: #38bdf8;"></i>
 <p>Students Status</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('students') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'students') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-user-graduate" style="color: #fbbf24;"></i>
 <p>Students</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('parents') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'parents') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-users" style="color: #38bdf8;"></i>
 <p>Parents</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('teachers') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'teachers-view') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-chalkboard-teacher" style="color: #f472b6;"></i>
 <p>Teachers</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('sms-logs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'sms-logs') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-sms" style="color: #4ade80;"></i>
 <p>SMS Logs</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('logs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'logs') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-history" style="color: #fbbf24;"></i>
 <p>Activity Logs</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('messages') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'messages') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-comments" style="color: #f472b6;"></i>
 <p>Messages</p>
 <span class="right badge badge-danger msg-badge" style="display:none;">0</span>
 </a>
 </li>
 <?php endif; ?>


 <?php if (session('role') == 'teacher'): ?>
 <!-- ===== MY CLASS ===== -->
 <li class="nav-header">MY CLASS</li>

 <li class="nav-item">
 <a href="<?= base_url('teachers-view/' . session('user_id')) ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'teachers-view') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-user-graduate" style="color: #4ade80;"></i>
 <p>My Students</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('teachers-notifications') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'teachers-notifications') ? 'active' : '' ?>">
 <i class="nav-icon fas fa-sms" style="color: #fbbf24;"></i>
 <p>SMS Notifications</p>
 </a>
 </li>
 <?php endif; ?>


 <?php if (session('role') == 'parent'): ?>
 <!-- ===== MY ACCOUNT ===== -->
 <li class="nav-header">MY ACCOUNT</li>

 <li class="nav-item">
 <a href="<?= base_url('parents-releases') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'parents-releases') ? 'active' : '' ?>">
 <i class="fas fa-history nav-icon"></i>
 <p>Release History</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('parents-notifications') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'parents-notifications') ? 'active' : '' ?>">
 <i class="fas fa-sms nav-icon"></i>
 <p>SMS Notifications</p>
 </a>
 </li>

 <li class="nav-item">
 <a href="<?= base_url('messages') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'messages') ? 'active' : '' ?>">
 <i class="fas fa-comments nav-icon"></i>
 <p>Messages</p>
 <span class="right badge badge-danger msg-badge" style="display:none;">0</span>
 </a>
 </li>
 <?php endif; ?>

 </ul>
 </nav>
 </div>
</aside>

<style>
    /* ===== SIDEBAR ===== */
    .nav-sidebar .nav-link {
        border-radius: 6px !important;
        margin: 2px 2px !important;
        padding: 9px 14px !important;
        font-size: 14px !important;
        color: #cbd5e1 !important;
        transition: all .15s ease !important;
    }

    .nav-sidebar .nav-link:hover {
        background: rgba(148, 163, 184, .1) !important;
        color: #f8fafc !important;
    }

    .nav-sidebar .nav-link.active {
        background: #1f2937 !important;
        border-left: 3px solid #60a5fa !important;
        color: #f8fafc !important;
    }

    .nav-sidebar .nav-link.active i {
        color: #60a5fa !important;
    }

    .nav-sidebar .nav-header {
        font-size: 11px !important;
        font-weight: 700 !important;
        letter-spacing: 1px !important;
        text-transform: uppercase !important;
        color: #64748b !important;
        padding: 14px 14px 6px !important;
    }

    .brand-link {
        background: transparent !important;
    }

    .brand-link .brand-text { white-space: normal !important; }

    @media (max-width: 768px) {
        .nav-sidebar .nav-link {
            padding: 8px 12px !important;
            font-size: 13px !important;
        }
    }
</style>