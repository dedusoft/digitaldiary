<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PageController extends BaseController
{
    public string $title = 'Welcome';

    /* display the landing page */
    public function index()
    {
        
        return view('index');
    }
    

    /* display the login page */
    public function login()
    {
        $this->title = "Login"; 
        $data = [
            'title' => $this->title
        ];
        echo view('auth/login', $data);
    }
    /* display the registration page */
    public function register()
    {
        echo view('auth/register');
    }

    /* display the forget password page */
    public function forgetPassword()
    {
        echo view('auth/forget-password');
    }

    /* display the reset password page */
    public function resetPassword()
    {
        echo view('auth/forget-password');
    }

    /* display the lock screen page */
    public function lockPage()
    {
        echo view('auth/forget-password');
    }


    /* display the dashboard landing page page */
    public function dashboard() {
         echo view('dashboard/index');
    }
}
