<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PageController extends BaseController
{
    // display the landing page
    public function index()
    {
        return view('index');
    }

    // display the login page
    public function login() {
        return view('auth/login');
    }

    public function dashboard() {
         echo view('dashboard/index');
    }
}
