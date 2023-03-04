<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class AuthAPIController extends ResourceController
{
    public string $email = '';
    public string $password = '';
    public string $userRole = 'customer';
    public bool $remember = false;
    public string $passwordConfirm = '';
    public string $termsAndConditions = '';

    public string $errorEmail = '';
    public string $errorPassword = '';
    public string $errorPasswordConfirm = '';
    public string $errorPasswordMatch = '';
    public string $errorTermsAndConditions = '';
    public int $errors = 0;

    use ResponseTrait;
    public function login()
    {
        // $userModel = new UserModel();

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

        if ($this->errors > 0) {
            $output = array(
                'error'   => true,
                'errorEmail' => $this->errorEmail,
                'errorPassword'  => $this->errorPassword
            );

        }

        if($this->errors == 0) {
            $output = array(
                'success'   => true,
                'message'   => 'Login successfully'
            );

        }
        return $this->respond($output, 200);

    }

    use ResponseTrait;
    public function register()
    {
        $emailInput = $this->request->getVar('email');
        $passwordInput = $this->request->getVar('password');
        $passwordConfirmInput = $this->request->getVar('passwordConfirm');
        $termsAndConditionsInput = $this->request->getVar('termsAndConditions');

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

        if (empty($passwordConfirmInput)) {
            $this->errorPasswordConfirm = 'Confirm Password is required';
            $this->errors++;
        } else {
            $this->passwordConfirm = $passwordInput;
        }

        if ($termsAndConditionsInput === 'false') {
            $this->errorTermsAndConditions = 'Terms and Conditions  is required';
            $this->errors++;
        } else {
            $this->termsAndConditions = $termsAndConditionsInput;
        }

        if($this->errors != 0) {
            $output = array(
                'error'   => true,
                'message'   => 'All fields are required',
                'errorEmail' => $this->errorEmail,
                'errorPassword'  => $this->errorPassword,
                'errorPasswordConfirm'  => $this->errorPasswordConfirm,
                'errorTermsAndConditions'  => $this->errorTermsAndConditions,
                'termAndCondition' => $this->termsAndConditions
            );
        }

        if($this->errors == 0) {
            $output = array(
                'success'   => true,
                'message'   => "All validation are successful"
            );
            
        }
        
        return $this->respond($output, 200);
    }

    use ResponseTrait;
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
