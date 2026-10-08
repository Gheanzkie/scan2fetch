<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        // This route sits OUTSIDE the 'auth' filter group (Routes.php:8), so
        // AuthFilter never sees it. Without this check a live session that
        // navigates or edits the URL to /login stays parked on the login
        // screen while still holding its session - a half-logout.
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('login');
    }
}