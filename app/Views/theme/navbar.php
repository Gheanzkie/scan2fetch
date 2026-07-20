<nav class="main-header navbar navbar-expand navbar-dark shadow-sm"
     style="background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); 
            border-bottom: 3px solid rgba(255,255,255,0.2);
            box-shadow: 0 4px 20px rgba(102,126,234,0.3);"
     id="mainNavbar">

    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link text-white px-3" data-widget="pushmenu" href="#" role="button" 
               style="transition: all 0.3s ease; border-radius: 12px;">
                <i class="fas fa-bars fa-lg"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('dashboard') ?>" class="nav-link text-white px-3 font-weight-bold"
               style="transition: all 0.3s ease; border-radius: 12px; font-size: 15px;">
                <i class="fas fa-tachometer-alt mr-1"></i> 🏠 Dashboard
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <span class="nav-link text-white px-3" style="opacity: 0.5; font-size: 12px;">
                <i class="fas fa-child mr-1"></i> 🎒
            </span>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">
        <!-- Sparkle Decor -->
        <li class="nav-item d-none d-md-block">
            <span style="font-size: 20px; animation: sparkle 2s ease-in-out infinite; display: inline-block;">
                ✨
            </span>
        </li>
        
        <li class="nav-item dropdown">
            <a class="nav-link text-white px-3" data-toggle="dropdown" href="#" role="button"
               style="transition: all 0.3s ease; border-radius: 12px; background: rgba(255,255,255,0.1);">
                <i class="far fa-user-circle fa-lg mr-1"></i>
                <span class="d-none d-md-inline font-weight-bold"><?= session('fname') ?> <?= session('lname') ?></span>
                <span class="badge px-3 py-1 ml-1" 
                     style="background: rgba(255,255,255,0.2); color: #fff; border-radius: 50px; font-size: 11px;">
                    <?php 
                        $role = session('role');
                        if ($role == 'admin') echo '👨‍🏫 Admin';
                        elseif ($role == 'staff') echo '🧑‍🏫 Staff';
                        elseif ($role == 'parent') echo '👨‍👩 Parent';
                    ?>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" 
                 style="border: none; border-radius: 20px; box-shadow: 0 8px 30px rgba(0,0,0,0.12); padding: 8px;">
                <div class="dropdown-header" style="padding: 12px 20px; border-bottom: 1px solid #f0f0f0;">
                    <strong style="color: #2d2d4a;"><?= session('fname') ?> <?= session('lname') ?></strong>
                    <br>
                    <small style="color: #8888aa;">
                        <?php 
                            if ($role == 'admin') echo '👨‍🏫 Administrator';
                            elseif ($role == 'staff') echo '🧑‍🏫 Staff';
                            elseif ($role == 'parent') echo '👨‍👩 Parent / Guardian';
                        ?>
                    </small>
                </div>
                <div class="dropdown-divider" style="margin: 4px 0;"></div>
                <a href="<?= base_url('dashboard') ?>" class="dropdown-item" style="border-radius: 12px; padding: 10px 20px;">
                    <i class="fas fa-tachometer-alt mr-2" style="color: #667eea;"></i> 🏠 Dashboard
                </a>
                <div class="dropdown-divider" style="margin: 4px 0;"></div>
                <a href="<?= base_url('logout') ?>" class="dropdown-item text-danger" 
                   style="border-radius: 12px; padding: 10px 20px; transition: all 0.3s ease;">
                    <i class="fas fa-sign-out-alt mr-2"></i> 🚪 Logout
                </a>
            </div>
        </li>
        
        <!-- Sparkle Decor -->
        <li class="nav-item d-none d-md-block">
            <span style="font-size: 20px; animation: sparkle 2s ease-in-out infinite 0.5s; display: inline-block;">
                🌟
            </span>
        </li>
    </ul>
</nav>

<style>
    /* ===== NAVBAR CHILD-FRIENDLY ===== */
    #mainNavbar .nav-link {
        transition: all 0.3s ease;
        border-radius: 12px;
        margin: 0 2px;
        padding: 8px 16px !important;
    }
    
    #mainNavbar .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
    }
    
    .dropdown-menu {
        border: none;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        animation: slideDown 0.3s ease;
    }
    
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .dropdown-header {
        padding: 12px 20px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .dropdown-item {
        padding: 10px 20px;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    
    .dropdown-item:hover {
        background: #f5f0ff;
        padding-left: 25px;
    }
    
    .dropdown-item.text-danger:hover {
        background: #fff0f0;
    }
    
    @keyframes sparkle {
        0%, 100% { transform: scale(1) rotate(0deg); }
        50% { transform: scale(1.2) rotate(10deg); }
    }
    
    @media (max-width: 768px) {
        .navbar-nav .nav-link {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
        .navbar .badge {
            font-size: 9px !important;
            padding: 3px 10px !important;
        }
    }
</style>