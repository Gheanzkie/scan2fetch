<?php

namespace App\Controllers;

class index extends BaseController
{
    public function index()
    {
        if (session('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('index');
    }
}