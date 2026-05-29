<aside class="main-sidebar sidebar-dark-primary elevation-4" id="mainSidebar">
    <a href="<?= base_url('dashboard') ?>" class="brand-link">
        <i class="fas fa-qrcode fa-2x ml-2" style="color:#fff;"></i>
        <span class="brand-text font-weight-bold">BCC SCAN2FETCH</span>
    </a>
    <div class="sidebar">
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'dashboard') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                    </a>
                </li>

                <!-- ========== ADMIN ========== -->
                <?php if (session('role') == 'admin'): ?>
                <li class="nav-header">MANAGEMENT</li>
                <li class="nav-item">
                    <a href="<?= base_url('parents') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'parents') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i><p>Parents</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('students') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'students') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-graduate"></i><p>Students</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('staffs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'staffs') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-check"></i><p>Staffs</p>
                    </a>
                </li>
                <li class="nav-header">OPERATIONS</li>
                <li class="nav-item">
                    <a href="<?= base_url('scan') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'scan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-qrcode"></i><p>QR Scan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('authorizations') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'authorizations') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-signature"></i><p>Authorizations</p>
                    </a>
                </li>
                <li class="nav-header">REPORTS</li>
                <li class="nav-item">
                    <a href="<?= base_url('logs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'logs') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-history"></i><p>Activity Logs</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- ========== STAFF ========== -->
                <?php if (session('role') == 'staff'): ?>
                <li class="nav-header">OPERATIONS</li>
                <li class="nav-item">
                    <a href="<?= base_url('scan') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'scan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-qrcode"></i><p>QR Scan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('authorizations') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'authorizations') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-signature"></i><p>Authorizations</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('students') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'students') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-graduate"></i><p>Students</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('parents') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'parents') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i><p>Parents</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- ========== PARENT ========== -->
                <?php if (session('role') == 'parent'): ?>
                <li class="nav-header">MY ACCOUNT</li>
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'dashboard') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('authorization') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'authorization') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-signature"></i><p>Authorization Letter</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('parents-logs') ?>" class="nav-link <?= (service('uri')->getSegment(1) == 'parents-logs') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-history"></i><p>Release History</p>
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>
</aside>