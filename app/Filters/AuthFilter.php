<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Single gate for the whole app.
 *
 *  1. Not logged in  -> /login
 *  2. Already logged in and hitting /login (or /) -> /dashboard
 *     (otherwise editing the URL to /login leaves a live session sitting on
 *      the login screen, which looks like a half-logout.)
 *  3. Role ACL, DENY BY DEFAULT: a URI that is not listed below is refused
 *     for every role, so a hand-edited URL into another module can never work.
 */
class AuthFilter implements FilterInterface
{
    /** URI prefix => roles allowed. Matched on the first path segment. */
    private const ACL = [
        // --- shared account routes ---
        'logout'           => ['admin', 'staff', 'teacher', 'parent'],
        'change-password'  => ['admin', 'staff', 'teacher', 'parent'],
        'update-profile'   => ['admin', 'staff', 'teacher', 'parent'],

        // --- admin operations ---
        'dashboard'        => ['admin', 'teacher', 'parent'],
        'messages'         => ['admin', 'teacher', 'parent'],

        // 'students' also carries students-view, which Students::view() hands
        // over to /teachers-student-view for the teacher role.
        'students'         => ['admin', 'teacher'],
        'register'         => ['admin'],
        'subfetchers'      => ['admin'],
        'logs'             => ['admin'],
        'sms-logs'         => ['admin'],
        'schedule'         => ['admin'],

        // --- staff-only modules (QR scanner + student monitoring) ---
        // No dashboard for staff: login and deny-redirects send them to /scan.
        // Scanner is staff-only now (admin removed per operator request).
        'scan'             => ['staff'],
        'scan-monitor'     => ['admin', 'staff'],

        // 'parents' also carries the parent self-service pages
        // (parents-releases / parents-notifications / parents-logs).
        'parents'          => ['admin', 'parent'],

        // 'teachers' also carries the teacher self-service pages
        // (teachers-view / teachers-student-view / teachers-notifications).
        'teachers'         => ['admin', 'teacher'],

        // admin-only modules
        'staffs'           => ['admin'],
        'admin'            => ['admin'],
    ];

    public function before(RequestInterface $request, $arguments = null)
    {
        // getPath() returns the ROUTER-relative path (subfolder already
        // stripped, e.g. "dashboard"). getUri()->getPath() returns the raw
        // request path ("/scan2fetch/dashboard"), whose first segment is the
        // install folder, so every ACL lookup missed and all pages bounced
        // to /this-does-not-exist.
        $rawPath = method_exists($request, 'getPath') ? $request->getPath() : (string) $request->getUri()->getPath();

        // Belt-and-braces: strip the baseURL subfolder manually in case a
        // future CI version hands us the raw path again.
        $basePath = rtrim(parse_url((string) config('App')->baseURL, PHP_URL_PATH) ?? '', '/');
        if ($basePath !== '' && strpos($rawPath, $basePath) === 0) {
            $rawPath = substr($rawPath, strlen($basePath));
        }

        $uri = strtolower(trim($rawPath, '/'));

        // ---- 1. must be logged in ----
        if (! session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        // ---- 2. already logged in: /login and / bounce to the role home ----
        if ($uri === '' || $uri === 'login') {
            return redirect()->to($this->home());
        }

        // ---- 3. role ACL (deny by default) ----
        $role    = (string) session('role');
        $segment = explode('/', $uri)[0];

        // Route names are hyphenated (parents-releases, teachers-view,
        // students-edit, scan-monitor, subfetchers-save). Match the longest
        // ACL key that is either the segment itself or one of its prefixes,
        // so 'parents-releases' resolves to the 'parents' rule instead of
        // falling through to "unknown module" and 404ing a valid page.
        $matched = null;
        foreach (array_keys(self::ACL) as $prefix) {
            if ($segment === $prefix || str_starts_with($segment, $prefix . '-')) {
                if ($matched === null || strlen($prefix) > strlen($matched)) {
                    $matched = $prefix;
                }
            }
        }

        if ($matched === null) {
            // Unknown module / typo'd URL -> 404, same as any unrouted path.
            return redirect()->to('/this-does-not-exist');
        }

        if (! in_array($role, self::ACL[$matched], true)) {
            return redirect()->to($this->home())
                ->with('error', 'Access denied: the "' . $matched . '" module is not available to your account.');
        }
    }

    /** Role-aware landing page. Staff = QR scanner only. */
    private function home(): string
    {
        return session('role') === 'staff' ? '/scan' : '/dashboard';
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
