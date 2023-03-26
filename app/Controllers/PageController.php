<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class PageController extends BaseController
{
    public string $title = 'Welcome';

    /*
    * --------------------------------------------------------------------
    * Controller Definitions Of Landing page
    * --------------------------------------------------------------------
    */
    /* display the landing page */
    public function index()
    {

        return view('index');
    }


    /*
    * --------------------------------------------------------------------
    * Controller Definitions Of Authentication Pages
    * --------------------------------------------------------------------
    */
    /* display the login page */
    public function login()
    {
        $this->title = "Login";
        $data = [
            'title' => $this->title
        ];
        echo view('auth/login', $data);
    }
    /* display the user registration page */
    public function register()
    {
        $this->title = "Sign Up";
        $data = [
            'title' => $this->title
        ];
        echo view('auth/register', $data);
    }

    /* display the forget password page */
    public function forgotPassword()
    {
        $this->title = "Forget password";
        $data = [
            'title' => $this->title
        ];
        echo view('auth/forgot-password', $data);
    }

    /* display the reset password page */
    public function resetPassword()
    {
        $this->title = "Reset password";
        $data = [
            'title' => $this->title
        ];
        echo view('auth/reset-password', $data);
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
    public function logout()
    {
        if (session()->has('logUserId')) {
            session()->remove('logUserId');
            return redirect()->to(base_url());
        }
        return redirect()->to(base_url());
    }


    /*
    * --------------------------------------------------------------------
    * Controller Definitions Of Dary pages
    * --------------------------------------------------------------------
    */
    /* display the dashboard landing page page */
    public function dashboard()
    {
        $userModel = new UserModel();
        $logUserId = session()->get('logUserId');

        $userData = $userModel->find($logUserId);

        $data = [
            'user'  => $userData
        ];
        echo view('dashboard', $data);
    }


    /*
    * --------------------------------------------------------------------
    * Controller Definitions Of Error pages
    * --------------------------------------------------------------------
    */
    public function error404()
    {
        echo view('errors/html/error_404');
    }
}
