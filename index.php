<?php
/**
 * Front controller for DEPLOYED environments where the web root
 * (DocumentRoot / public_html) is the project root, not /public.
 *
 * Local dev (php spark serve) still uses public/index.php — this file
 * is only hit when the server serves the project root directly.
 */

date_default_timezone_set('Asia/Manila');

use CodeIgniter\Boot;
use Config\Paths;

$minPhpVersion = '8.2';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'PHP ' . $minPhpVersion . '+ required. Current: ' . PHP_VERSION;
    exit(1);
}

// Static assets (uploads, images, html5qrcode, phpqrcode, css/js) live in /public.
// FCPATH must point there so base_url('public/...') and FCPATH-based writes resolve.
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
chdir(FCPATH);

require __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Paths.php';

$paths = new Paths();

require $paths->systemDirectory . '/Boot.php';

exit(Boot::bootWeb($paths));
