<nav class="main-header navbar navbar-expand navbar-dark shadow-sm"
     style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border-bottom: 2px solid #667eea;"
     id="mainNavbar">

    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link text-white px-3" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars fa-lg"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('dashboard') ?>" class="nav-link text-white px-3 font-weight-bold">
                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item dropdown">
            <a class="nav-link text-white px-3" data-toggle="dropdown" href="#" role="button">
                <i class="far fa-user-circle fa-lg mr-1"></i>
                <span class="d-none d-md-inline"><?= session('fname') ?> <?= session('lname') ?></span>
                <span class="badge badge-light ml-1"><?= ucfirst(session('role')) ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <strong><?= session('fname') ?> <?= session('lname') ?></strong><br>
                    <small class="text-muted"><?= ucfirst(session('role')) ?></small>
                </div>
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
        transition: all 0.2s ease;
        border-radius: 6px;
        margin: 0 2px;
    }
    #mainNavbar .nav-link:hover {
        background: rgba(102, 126, 234, 0.2);
        color: #ffffff !important;
    }
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
    }
    .dropdown-header {
        padding: 10px 15px;
        border-bottom: 1px solid #e9ecef;
    }
    .dropdown-item {
        padding: 8px 15px;
        transition: all 0.15s ease;
    }
    .dropdown-item:hover {
        background: #f8f9fa;
        padding-left: 20px;
    }
    .dropdown-item.text-danger:hover {
        background: #fee;
    }
    @media (max-width: 768px) {
        .navbar-nav .nav-link {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
    }
</style>