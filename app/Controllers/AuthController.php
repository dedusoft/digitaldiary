<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    public string $email = '';
    public string $password = '';
    public string $remember = '';

    public string $errorEmail = '';
    public string $confirmPassword = '';
    public string $errorPassword = '';
    public int $errors = 0;

    use ResponseTrait;
    public function login()
    {
        $userModel = new UserModel();

        $emailTest = 'duclairdeugoue@gmail.com';
        $passwordTest = '12345678';

        $emailInput = $this->request->getVar('email');
        $passwordInput = $this->request->getVar('password');

        if (empty($emailInput)) {
            $this->errorEmail = 'Email is required';
            $this->errors++;
        } else {
            $this->email = $emailInput;
        }

        if (empty($passwordInput)) {
            $this->errorPassword = 'Password is required';
            $this->errors++;
        } else {
            $this->password = $passwordInput;
        }

        if ($this->errors == 0) {
            if ($this->email !== $emailTest) {
                $this->errorPassword = 'Wrong Email or Password';
                $this->errors++;
            }
            if ($this->password !== $passwordTest) {
                $this->errorPassword = 'Wrong Email or Password';
                $this->errors++;
            }
        }

        if ($this->errors != 0) {
            $output = array(
                'error'   => true,
                'errorEmail' => $this->errorEmail,
                'errorPassword'  => $this->errorPassword
            );

            return $this->respond($output, 200);
        }

        if($this->errors == 0) {
            $output = array(
                'success'   => true,
                'message'   => 'Login successfully'
            );

            return $this->respond($output, 200);
        }
        
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
