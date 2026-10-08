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
        // --- shared ---
        'dashboard'        => ['admin', 'staff', 'teacher', 'parent'],
        'logout'           => ['admin', 'staff', 'teacher', 'parent'],
        'change-password'  => ['admin', 'staff', 'teacher', 'parent'],
        'update-profile'   => ['admin', 'staff', 'teacher', 'parent'],
        'messages'         => ['admin', 'staff', 'teacher', 'parent'],

        // --- admin/staff management ---
        // 'students' also carries students-view, which Students::view() hands
        // over to /teachers-student-view for the teacher role.
        'students'         => ['admin', 'staff', 'teacher'],
        'register'         => ['admin', 'staff'],
        'subfetchers'      => ['admin', 'staff'],
        'logs'             => ['admin', 'staff'],
        'sms-logs'         => ['admin', 'staff'],
        'schedule'         => ['admin', 'staff'],
        'scan'             => ['admin', 'staff'],
        'scan-monitor'     => ['admin', 'staff'],

        // 'parents' also carries the parent self-service pages
        // (parents-releases / parents-notifications / parents-logs).
        'parents'          => ['admin', 'staff', 'parent'],

        // 'teachers' also carries the teacher self-service pages
        // (teachers-view / teachers-student-view / teachers-notifications).
        'teachers'         => ['admin', 'staff', 'teacher'],

        // admin-only modules
        'staffs'           => ['admin'],
        'admin'            => ['admin'],
    ];

    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = strtolower(trim((string) $request->getUri()->getPath(), '/'));

        // ---- 1. must be logged in ----
        if (! session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        // ---- 2. already logged in: /login and / bounce to the dashboard ----
        if ($uri === '' || $uri === 'login') {
            return redirect()->to('/dashboard');
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
            return redirect()->to('/dashboard')
                ->with('error', 'Access denied: the "' . $matched . '" module is not available to your account.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
