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
     * Send an SMS and record it in sms_logs.
     *
     * SMS_SIMULATION = true  -> local log only (no gateway call), status 'sent'.
     * SMS_SIMULATION = false -> calls TextBee (SMS_GATEWAY = textbee) and logs
     *                           status 'sent' or 'failed' based on the API reply.
     * Admin SMS Logs remain the monitoring surface either way.
     *
     * @return array{status: string, success: bool, message: string, phone: string}
     */
    protected function sendLocalSms(string $phone, ?string $logMessage = null): array
    {
        $message  = $logMessage ?? 'Notification recorded locally (no SMS gateway).';
        $simulate = (bool) env('SMS_SIMULATION', true);
        $gateway  = strtolower((string) env('SMS_GATEWAY', 'textbee'));
        $status   = 'sent';
        $detail   = 'Recorded locally.';

        if (! $simulate && $gateway === 'textbee') {
            $result   = $this->sendTextBee($phone, $message);
            $status   = $result['success'] ? 'sent' : 'failed';
            $detail   = $result['message'];
        }

        $db = \Config\Database::connect();
        $db->table('sms_logs')->insert([
            'parent_phone' => $phone,
            'message'      => $message,
            'status'       => $status,
            'sent_at'      => date('Y-m-d H:i:s'),
        ]);

        return [
            'status'  => $status,
            'success' => $status === 'sent',
            'message' => $detail,
            'phone'   => $phone,
        ];
    }

    /**
     * Deliver one SMS through TextBee (Android phone gateway).
     *
     * POST https://api.textbee.dev/api/v1/gateway/send-sms
     * header x-api-key, body {recipients:[E.164], message[, deviceId]}
     *
     * @return array{success: bool, message: string}
     */
    private function sendTextBee(string $phone, string $message): array
    {
        $apiKey = trim((string) env('SMS_TEXTBEE_API_KEY', ''));
        if ($apiKey === '') {
            return ['success' => false, 'message' => 'TextBee API key not set in .env.'];
        }

        $payload = [
            'recipients' => [$this->toE164($phone)],
            'message'    => $message,
        ];

        $deviceId = trim((string) env('SMS_TEXTBEE_DEVICE_ID', ''));
        if ($deviceId !== '') {
            $payload['deviceId'] = $deviceId;
        }

        $ch = curl_init('https://api.textbee.dev/api/v1/gateway/send-sms');
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_HTTPHEADER     => [
                'x-api-key: ' . $apiKey,
                'Content-Type: application/json',
            ],
            CURLOPT_POSTFIELDS     => json_encode($payload),
        ]);

        $body = curl_exec($ch);
        $err  = curl_error($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($body === false) {
            return ['success' => false, 'message' => 'cURL error: ' . $err];
        }

        if ($code === 200) {
            return ['success' => true, 'message' => 'TextBee accepted (HTTP 200).'];
        }

        $snippet = trim(preg_replace('/\s+/', ' ', (string) $body));
        if (strlen($snippet) > 180) {
            $snippet = substr($snippet, 0, 180) . '...';
        }

        return ['success' => false, 'message' => "TextBee HTTP {$code}: {$snippet}"];
    }

    /**
     * Normalize a Philippine local number (09XXXXXXXXX) to E.164 (+639XXXXXXXXX).
     * Non-PH numbers that already start with '+' pass through untouched.
     */
    private function toE164(string $phone): string
    {
        $phone = trim($phone);
        if ($phone === '') {
            return $phone;
        }
        if ($phone[0] === '+') {
            return $phone;
        }
        if (strncmp($phone, '0', 1) === 0 && strlen($phone) === 11) {
            return '+63' . substr($phone, 1);
        }

        return '+' . preg_replace('/\D+/', '', $phone);
    }

    /**
     * Generate a QR PNG for $qrValue and return its URL path.
     *
     * Everything is resolved from FCPATH (the public folder) instead of the
     * process CWD, because the old code used include_once('phpqrcode/...') and
     * 'uploads/qr/...' which only resolve when index.php has already chdir()'d
     * into /public - any other entry point fataled with "Class QRcode not
     * found" and killed the whole registration / Excel import.
     *
     * Never throws: QR art is cosmetic, the QR *value* is what matters, so a
     * missing library / directory / GD simply skips the PNG.
     *
     * @return string public URL path to the PNG, or '' when not generated
     */
    protected function generateQrFile(string $qrValue, int $textHeight = 40): string
    {
        $qrDir = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'qr';

        if (! is_dir($qrDir)) {
            @mkdir($qrDir, 0775, true);
        }
        if (! is_dir($qrDir)) {
            log_message('error', 'QR: cannot create ' . $qrDir);
            return '';
        }

        $lib = FCPATH . 'phpqrcode' . DIRECTORY_SEPARATOR . 'qrlib.php';
        if (! is_file($lib)) {
            $lib = ROOTPATH . 'public' . DIRECTORY_SEPARATOR . 'phpqrcode' . DIRECTORY_SEPARATOR . 'qrlib.php';
        }
        if (is_file($lib)) {
            require_once $lib;
        }
        if (! class_exists('QRcode')) {
            log_message('error', 'QR: phpqrcode library not found (looked in ' . FCPATH . 'phpqrcode)');
            return '';
        }
        if (! function_exists('imagecreatetruecolor')) {
            log_message('error', 'QR: GD extension not loaded, skipping QR image');
            return '';
        }

        $tmpPng   = $qrDir . DIRECTORY_SEPARATOR . $qrValue . '_tmp.png';
        $finalPng = $qrDir . DIRECTORY_SEPARATOR . $qrValue . '.png';

        try {
            \QRcode::png($qrValue, $tmpPng, QR_ECLEVEL_H, 8, 2);

            $qrImage = @imagecreatefrompng($tmpPng);
            if ($qrImage === false) {
                // Keep the plain QR at least - better than nothing.
                @rename($tmpPng, $finalPng);
                return 'uploads/qr/' . $qrValue . '.png';
            }

            $qrWidth  = imagesx($qrImage);
            $qrHeight = imagesy($qrImage);
            $totalH   = $qrHeight + $textHeight;
            $totalW   = $qrWidth;

            $combined = imagecreatetruecolor($totalW, $totalH);
            $white    = imagecolorallocate($combined, 255, 255, 255);
            imagefill($combined, 0, 0, $white);
            imagecopy($combined, $qrImage, 0, 0, 0, 0, $qrWidth, $qrHeight);

            $black   = imagecolorallocate($combined, 0, 0, 0);
            $fontSize = 5;
            $textW   = imagefontwidth($fontSize) * strlen($qrValue);
            $textX   = (int) max(0, ($totalW - $textW) / 2);
            $textY   = $qrHeight + 8;

            imageline($combined, 0, $qrHeight, $totalW, $qrHeight, $black);
            imagestring($combined, $fontSize, $textX, $textY, $qrValue, $black);

            imagepng($combined, $finalPng);

            imagedestroy($qrImage);
            imagedestroy($combined);
        } catch (\Throwable $e) {
            log_message('error', 'QR generation failed for ' . $qrValue . ': ' . $e->getMessage());
        } finally {
            if (is_file($tmpPng)) {
                @unlink($tmpPng);
            }
        }

        return is_file($finalPng) ? 'uploads/qr/' . $qrValue . '.png' : '';
    }

    /**
     * Empty a table without violating foreign keys.
     *
     * Neither of the obvious options works here:
     *  - emptyTable()/truncate()  -> MySQL refuses to TRUNCATE a table that is
     *                                referenced by a FK (fk_fetchlogs_parent...);
     *  - $db->table($t)->delete() -> CodeIgniter throws DataException
     *                                "Deletes are not allowed unless they
     *                                contain a where or like clause".
     * A bare DELETE FROM honours ON DELETE CASCADE / SET NULL and has neither
     * problem, so this is the only safe way to wipe these tables.
     */
    protected function wipeTable(string $table): void
    {
        $db = \Config\Database::connect();
        $db->query('DELETE FROM `' . $table . '`');
    }

    /**
     * Allow only admin and staff roles (used by protected management actions).
     * Returns true when access is granted, otherwise sends a redirect and
     * STOPS. The old code did `redirect()->send(); return false;` and callers
     * did `if (!...) return;` — execution then fell through to CI4's own
     * response, emitting 200 + a stray Location header instead of a 302.
     * The guard itself always ran (no state change), but the browser got a
     * broken deny page. exit here guarantees a single, clean 302.
     */
    protected function requireAdminStaff(): bool
    {
        if (session('role') !== 'admin' && session('role') !== 'staff') {
            redirect()->to('/dashboard')->with('error', 'Access denied.')->send();
            exit;
        }
        return true;
    }

    /**
     * Generate a fresh password for a record, store its hash, mark it as sent,
     * and record the SMS locally. Shared by single "Send Password" and bulk
     * "Send All Passwords" flows across parents / teachers / staff.
     *
     * @return array{password: string, name: string} the delivered plaintext + display name
     */
    protected function deliverPassword(\CodeIgniter\Model $model, array $record, string $roleLabel): array
    {
        $password = $this->generatePassword();

        $model->update($record['id'], [
            'password'      => password_hash($password, PASSWORD_DEFAULT),
            'password_sent' => 1,
        ]);

        $this->sendLocalSms(
            $record['phone'],
            "Your new $roleLabel account password is: $password (recorded in SMS logs)."
        );

        return [
            'password' => $password,
            'name'     => trim(($record['fname'] ?? '') . ' ' . ($record['lname'] ?? '')),
        ];
    }
}
