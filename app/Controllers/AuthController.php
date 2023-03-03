<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    public string $remember = '';
    public int $error = 0;

    use ResponseTrait;
    public function login()
    {
        $emailTest = 'duclairdeugoue@gmail.com';
        $passwordTest = '12345678';

        $this->email = $this->request->getVar('email');
        $this->password = $this->request->getVar('password');

        $data = [
            "email" => $this->request->getVar('email'),
            "password" => $this->request->getVar('password')
        ];

        return $this->respond($data, 200);
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
