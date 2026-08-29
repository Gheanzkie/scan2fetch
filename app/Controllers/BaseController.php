<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }

    /**
     * Generate a random plain-text password (local only - no SMS gateway).
     */
    protected function generatePassword(int $length = 8): string
    {
        $chars  = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $max    = strlen($chars) - 1;
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[random_int(0, $max)];
        }
        return $result;
    }

    /**
     * Generate a short, easy-to-type QR code value (default: QR-XXXXX).
     * Uses an unambiguous character set (no 0/O, 1/I/L).
     */
    protected function generateQrValue(int $length = 5): string
    {
        $chars = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';
        $max   = strlen($chars) - 1;
        $code  = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[random_int(0, $max)];
        }
        return 'QR-' . $code;
    }

    /**
     * Upload the submitted "picture" file into public/uploads/{$dir}.
     * Returns the stored filename or null when no file was sent.
     */
    protected function saveUploadedPicture(string $dir): ?string
    {
        $file = $this->request->getFile('picture');
        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }
        $name = $file->getRandomName();
        $file->move('uploads/' . $dir, $name);
        return $name;
    }

    /**
     * Remove an uploaded picture file (when a profile is deleted).
     */
    protected function deleteUploadedPicture(?string $dir, ?string $filename): void
    {
        if ($dir && $filename && is_file(FCPATH . 'uploads/' . $dir . '/' . $filename)) {
            @unlink(FCPATH . 'uploads/' . $dir . '/' . $filename);
        }
    }

    /**
     * Record a locally "sent" SMS in sms_logs without calling any gateway/API.
     *
     * @return array{status: string, success: bool, message: string, phone: string}
     */
    protected function sendLocalSms(string $phone, ?string $logMessage = null): array
    {
        $db = \Config\Database::connect();
        $db->table('sms_logs')->insert([
            'parent_phone' => $phone,
            'message'      => $logMessage ?? 'Notification recorded locally (no SMS gateway).',
            'status'       => 'sent',
            'sent_at'      => date('Y-m-d H:i:s'),
        ]);

        return [
            'status'  => 'sent',
            'success' => true,
            'message' => 'Recorded locally.',
            'phone'   => $phone,
        ];
    }
}
