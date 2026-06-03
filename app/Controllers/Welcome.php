<?php

namespace App\Controllers;

class Welcome extends BaseController
{
    public function index()
    {
        if (session('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('welcome');
    }
}