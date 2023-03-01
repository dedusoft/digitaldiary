<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        echo view('auth/login');
    }

    public function register()
    {
        echo view('auth/register');
    }

    public function forgetPassword()
    {
        echo view('auth/forget-password');
    }

    public function resetPassword()
    {
        echo view('auth/forget-password');
    }

    public function lockPage()
    {
        echo view('auth/forget-password');
    }
}
