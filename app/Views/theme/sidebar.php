<aside class="main-sidebar sidebar-dark-primary elevation-4" 
       id="mainSidebar"
       style="background: linear-gradient(180deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%) !important;
              border-right: 2px solid rgba(102,126,234,0.1);">
    
    <!-- ===== BRAND ===== -->
    <a href="<?= base_url('dashboard') ?>" class="brand-link d-flex align-items-center" 
       style="border-bottom: 2px solid rgba(102,126,234,0.15); padding: 15px 20px;">
        <div style="width:45px;height:45px;
                    display:flex;align-items:center;justify-content:center;">
            <img src="<?= base_url('image/qr-code-76.png') ?>" alt="SCAN2FETCH Logo" style="width:100%;height:100%;border-radius:50%;">
        </div>
        <span class="brand-text font-weight-bold ml-3" 
              style="font-size:18px;background:linear-gradient(135deg, #a8c0ff, #f093fb);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
            SCAN2FETCH
        </span>
    </a>
    
    <div class="sidebar" style="padding: 10px 8px;">
        <!-- ===== USER GREETING ===== -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center" 
             style="border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 15px;">
            <div class="image">
                <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg, #667eea, #f093fb);
                            display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(102,126,234,0.2);">
                    <i class="fas fa-user" style="color:#fff;font-size:18px;"></i>
                </div>
            </div>
            <div class="info ml-3">
                <a href="#" class="d-block text-white font-weight-bold" style="font-size:14px;">
                    <?= session('fname') ?> <?= session('lname') ?>
                </a>
                <small style="color: rgba(255,255,255,0.5); font-size:11px;">
                    <?php 
                        $role = session('role');
                        if ($role == 'admin') echo '👨‍🏫 Administrator';
                        elseif ($role == 'staff') echo '🧑‍🏫 Staff';
                        elseif ($role == 'parent') echo '👨‍👩 Parent';
                    ?>
                </small>
            </div>
        </div>

        <!-- ===== NAVIGATION ===== -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'dashboard') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>🏠 Dashboard</p>
                    </a>
                </li>

                <?php if (session('role') == 'admin'): ?>
                <!-- ===== MANAGEMENT ===== -->
                <li class="nav-header" style="color: rgba(255,255,255,0.3); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; padding: 10px 10px 5px;">
                    📋 MANAGEMENT
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('register') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'students-add') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-user-plus" style="color: #81c784;"></i>
                        <p>➕ Register Student</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('parents') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'parents') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-users" style="color: #4fc3f7;"></i>
                        <p>👨‍👩 Parents</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('students') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'students') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-user-graduate" style="color: #ffb74d;"></i>
                        <p>🎓 Students</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('staffs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'staffs') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-user-check" style="color: #a8c0ff;"></i>
                        <p>🧑‍🏫 Staffs</p>
                    </a>
                </li>

                <!-- ===== OPERATIONS ===== -->
                <li class="nav-header" style="color: rgba(255,255,255,0.3); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; padding: 15px 10px 5px;">
                    ⚡ OPERATIONS
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('scan') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'scan') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-qrcode" style="color: #f093fb;"></i>
                        <p>📱 QR Scan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('scan-monitor') ?>" class="nav-link"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-desktop" style="color: #4fc3f7;"></i>
                        <p>🖥️ Students Status</p>
                    </a>
                </li>

                <!-- ===== REPORTS ===== -->
                <li class="nav-header" style="color: rgba(255,255,255,0.3); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; padding: 15px 10px 5px;">
                    📊 REPORTS
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('logs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'logs') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-history" style="color: #ffb74d;"></i>
                        <p>📋 Activity Logs</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('sms-logs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'sms-logs') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-sms" style="color: #81c784;"></i>
                        <p>💬 SMS Logs</p>
                    </a>
                </li>
                <?php endif; ?>


                <?php if (session('role') == 'staff'): ?>
                <!-- ===== OPERATIONS ===== -->
                <li class="nav-header" style="color: rgba(255,255,255,0.3); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; padding: 10px 10px 5px;">
                    ⚡ OPERATIONS
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('register') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'students-add') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-user-plus" style="color: #81c784;"></i>
                        <p>➕ Register Student</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('scan') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'scan') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-qrcode" style="color: #f093fb;"></i>
                        <p>📱 QR Scan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('scan-monitor') ?>" class="nav-link"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-desktop" style="color: #4fc3f7;"></i>
                        <p>🖥️ Students Status</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('students') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'students') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-user-graduate" style="color: #ffb74d;"></i>
                        <p>🎓 Students</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('parents') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'parents') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-users" style="color: #4fc3f7;"></i>
                        <p>👨‍👩 Parents</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('sms-logs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'sms-logs') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-sms" style="color: #81c784;"></i>
                        <p>💬 SMS Logs</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('logs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'logs') ? 'active' : '' ?>"
                       style="border-radius: 14px; margin: 2px 0; transition: all 0.3s ease;">
                        <i class="nav-icon fas fa-history" style="color: #ffb74d;"></i>
                        <p>📋 Activity Logs</p>
                    </a>
                </li>
                <?php endif; ?>


                <?php if (session('role') == 'parent'): ?>
                <!-- ===== MY ACCOUNT ===== -->
                <li class="nav-header" style="color: rgba(255,255,255,0.3); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; padding: 10px 10px 5px;">
                    👤 MY ACCOUNT
                </li>

                <li class="nav-item">
            <a href="<?= base_url('parents-releases') ?>" class="nav-link">
                <i class="fas fa-history nav-icon"></i>
                <p>📋 Release History</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('parents-notifications') ?>" class="nav-link">
                <i class="fas fa-sms nav-icon"></i>
                <p>📱 SMS Notifications</p>
            </a>
        </li>
                </li>
                <?php endif; ?>

                <!-- ===== DECORATIVE FOOTER ===== -->
                <li class="nav-item" style="margin-top: 20px;">
                    <div style="text-align: center; padding: 15px 0; border-top: 1px solid rgba(255,255,255,0.05);">
                        <span style="font-size: 12px; color: rgba(255,255,255,0.2);">
                            🌈 <span class="kid-emoji">⭐</span> 🎒
                        </span>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    /* ===== SIDEBAR CHILD-FRIENDLY ===== */
    .nav-sidebar .nav-link {
        border-radius: 14px !important;
        margin: 2px 4px !important;
        transition: all 0.3s ease !important;
        padding: 10px 16px !important;
    }
    
    .nav-sidebar .nav-link:hover {
        background: rgba(102, 126, 234, 0.15) !important;
        transform: translateX(5px);
    }
    
    .nav-sidebar .nav-link.active {
        background: linear-gradient(135deg, rgba(102,126,234,0.25), rgba(240,147,251,0.15)) !important;
        border-left: 3px solid #a8c0ff !important;
        box-shadow: 0 4px 15px rgba(102,126,234,0.1) !important;
    }
    
    .nav-sidebar .nav-link.active i {
        color: #a8c0ff !important;
    }
    
    .nav-sidebar .nav-link i {
        transition: all 0.3s ease;
    }
    
    .nav-sidebar .nav-link:hover i {
        transform: scale(1.1);
    }
    
    .nav-sidebar .nav-header {
        font-weight: 700 !important;
        letter-spacing: 1px !important;
    }
    
    .kid-emoji {
        display: inline-block;
        animation: sparkle 2s ease-in-out infinite;
    }
    
    @keyframes sparkle {
        0%, 100% { transform: scale(1) rotate(0deg); }
        50% { transform: scale(1.2) rotate(10deg); }
    }
    
    .brand-link:hover {
        background: rgba(255,255,255,0.02) !important;
    }
    
    .user-panel .info a {
        transition: all 0.3s ease;
    }
    
    .user-panel .info a:hover {
        color: #a8c0ff !important;
    }
    
    @media (max-width: 768px) {
        .nav-sidebar .nav-link {
            padding: 8px 12px !important;
            font-size: 13px !important;
        }
        .brand-text {
            font-size: 15px !important;
        }
    }
</style>