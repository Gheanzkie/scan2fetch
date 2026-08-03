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
        <!-- ===== LIVE TIMER (Admin & Staff Only) ===== -->
        <?php 
        $role = session('role');
        if ($role == 'admin' || $role == 'staff'): 
        ?>
        <li class="nav-item d-none d-md-block mr-2">
            <div class="live-timer-container">
                <div class="live-dot"></div>
                <span class="live-label">LIVE</span>
                <span class="live-time" id="liveTimeDisplay">
                    <?= date('h:i:s A') ?>
                </span>
                <span class="live-date" id="liveDateDisplay">
                    <?= date('M d, Y') ?>
                </span>
            </div>
        </li>
        <?php endif; ?>
        
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

    /* ===== LIVE TIMER STYLES ===== */
    .live-timer-container {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.15);
        padding: 4px 16px 4px 12px;
        border-radius: 50px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .live-dot {
        width: 10px;
        height: 10px;
        background: #00ff88;
        border-radius: 50%;
        animation: livePulse 1.5s ease-in-out infinite;
        box-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
    }

    @keyframes livePulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(0.8); }
    }

    .live-label {
        color: #00ff88;
        font-weight: 700;
        font-size: 11px;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-shadow: 0 0 20px rgba(0, 255, 136, 0.3);
    }

    .live-time {
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
        min-width: 70px;
        text-align: center;
        text-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
    }

    .live-date {
        color: rgba(255, 255, 255, 0.7);
        font-weight: 500;
        font-size: 11px;
        border-left: 1px solid rgba(255, 255, 255, 0.15);
        padding-left: 10px;
    }

    @media (max-width: 1200px) {
        .live-date {
            display: none;
        }
        .live-timer-container {
            padding: 4px 12px 4px 10px;
        }
    }

    @media (max-width: 992px) {
        .live-timer-container {
            padding: 3px 10px 3px 8px;
        }
        .live-label {
            font-size: 9px;
        }
        .live-time {
            font-size: 12px;
            min-width: 60px;
        }
        .live-dot {
            width: 8px;
            height: 8px;
        }
    }

    @media (max-width: 768px) {
        .live-timer-container {
            display: none;
        }
    }
</style>

<!-- ===== LIVE TIMER JAVASCRIPT ===== -->
<script>
<?php 
$role = session('role');
if ($role == 'admin' || $role == 'staff'): 
?>
$(document).ready(function() {
    function updateLiveTimer() {
        var now = new Date();
        var timeString = now.toLocaleTimeString('en-US', { 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit',
            hour12: true 
        });
        var dateString = now.toLocaleDateString('en-US', { 
            month: 'short', 
            day: 'numeric', 
            year: 'numeric' 
        });
        
        $('#liveTimeDisplay').text(timeString);
        $('#liveDateDisplay').text(dateString);
    }

    // Update immediately
    updateLiveTimer();
    
    // Update every second
    setInterval(updateLiveTimer, 1000);
});
<?php endif; ?>
</script>