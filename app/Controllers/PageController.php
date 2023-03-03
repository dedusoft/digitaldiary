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
        $this->title = "Sign Up"; 
        $data = [
            'title' => $this->title
        ];
        echo view('auth/register', $data);
    }

    /* display the forget password page */
    public function forgetPassword()
    {
        $this->title = "Forget password"; 
        $data = [
            'title' => $this->title
        ];
        echo view('auth/forget-password', $data);
    }

    /* display the reset password page */
    public function resetPassword()
    {
        $this->title = "Forget password"; 
        $data = [
            'title' => $this->title
        ];
        echo view('auth/forget-password', $data);
    }

    /* display the lock screen page */
    public function lockPage()
    {
        $this->title = "Lock Page"; 
        $data = [
            'title' => $this->title
        ];
        echo view('auth/lock-page', $data);
    }


    /* display the dashboard landing page page */
    public function dashboard() {
         echo view('dashboard');
    }
}
