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
    public string $remember = '';
    public string $passwordConfirm = '';
    public string $termsAndConditions = '';

    public string $errorEmailMsg = '';
    public string $errorPasswordMsg = '';
    public string $errorPasswordConfirmMsg = '';
    public string $errorPasswordMatchMsg = '';
    public string $errorTermsAndConditionsMsg = '';

    public int $errors = 0;
    public bool $status;
    public array $data = [
        'errorEmail'                => '',
        'errorPassword'             => '',
        'errorPasswordConfirm'      => '',
        'errorTermsAndConditions'   => '',
        'allFieldsValidated'        => '',
        'errorPasswordMatch'        => '',
        'userInserted'              => '',
    ];

    use ResponseTrait;
    public function login()
    {
        // $userModel = new UserModel();

        $emailTest = 'duclairdeugoue@gmail.com';
        $passwordTest = '12345678';

        $emailInput = $this->request->getVar('email');
        $passwordInput = $this->request->getVar('password');

        if (empty($emailInput)) {
            $this->errorEmailMsg = 'Email is required';
            $this->errors++;
        } else {
            $this->email = $emailInput;
        }

        if (empty($passwordInput)) {
            $this->errorPasswordMsg = 'Password is required';
            $this->errors++;
        } else {
            $this->password = $passwordInput;
        }

        if ($this->errors == 0) {
            if ($this->email !== $emailTest) {
                $this->errorPasswordMsg = 'Wrong Email or Password';
                $this->errors++;
            }
            if ($this->password !== $passwordTest) {
                $this->errorPasswordMsg = 'Wrong Email or Password';
                $this->errors++;
            }
        }

        if ($this->errors > 0) {
            $output = array(
                'error'   => true,
                'errorEmail' => $this->errorEmailMsg,
                'errorPassword'  => $this->errorPasswordMsg
            );
        }

        if ($this->errors == 0) {
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
            $this->errorEmailMsg = 'Email is required';
            $this->errors++;
            $this->status = false;
            $this->data['errorEmail'] = [
                'status'   => true,
                'message'  => $this->errorEmailMsg
            ];
        } else {
            $this->email = $emailInput;
        }

        if (empty($passwordInput)) {
            $this->errorPasswordMsg = 'Password is required';
            $this->errors++;
            $this->status = false;
            $this->data['errorPassword'] = [
                'status'   => true,
                'message'   => $this->errorPasswordMsg
            ];
        } else {
            $this->password = $passwordInput;
        }

        if (empty($passwordConfirmInput)) {
            $this->errorPasswordConfirmMsg = 'Confirm Password is required';
            $this->errors++;
            $this->status = false;
            $this->data['errorPasswordConfirm'] = [
                'status'   => true,
                'message'   => $this->errorPasswordConfirmMsg
            ];
        } else {
            $this->passwordConfirm = $passwordInput;
        }

        if ($termsAndConditionsInput === 'false') {
            $this->errorTermsAndConditionsMsg = 'Terms and Conditions  is required';
            $this->errors++;
            $this->status = false;
            $this->data['errorTermsAndConditions'] = [
                'status'   => true,
                'message'  => $this->errorTermsAndConditionsMsg
            ];
        } else {
            $this->termsAndConditions = $termsAndConditionsInput;
        }

        // all fields are empty
        if ($this->errors === 4) {

            $this->status = false;
            $this->data['allFieldsValidated']  = [
                'status'    => false,
                'message'   => 'All fields are required'
            ];
        }

        // all fields are filled
        if ($this->errors === 0) {
            // check password === passwordConfirm
            if ($passwordInput !== $passwordConfirmInput) {
                $this->errorPasswordMatchMsg = 'Password does not match';
                $this->errors++;
                $this->status = false;
                $this->data['errorPasswordMatch'] = [
                    'status'   => true,
                    'message'   => $this->errorPasswordMatchMsg
                ];
            }
            if($this->errors === 0) {

                // Test the insertion
                $userData = [
                    'user_email'    => $this->email,
                    'user_password' => password_hash($this->password, PASSWORD_DEFAULT),
                    'user_role'     =>  $this->userRole
                ];
                try {
                    $userModel = new UserModel();
                    $userModel->insert($userData);

                    $this->status = true;
                    $this->data['userInserted'] = [
                        'status'    => true,
                        'message'   => 'Account created successfully'
                    ];

                } catch (\Throwable $th) {
                    $this->status = false;
                    $this->data['userInserted'] = [
                        'status'    => false,
                        'message'   => 'An error occured during registration: ' . $th 
                    ];
                }

                // $this->status = true;
                // $this->data['allFieldsValidated'] = [
                //     'status'    => true,
                //     'message'  => 'All validation are successful'
    
                // ];
            }
           
        }

        $output = [
            'status' => $this->status,
            'data'  => [
                'errorEmail'                => $this->data['errorEmail'],
                'errorPassword'             => $this->data['errorPassword'],
                'errorPasswordConfirm'      => $this->data['errorPasswordConfirm'],
                'errorTermsAndConditions'   => $this->data['errorTermsAndConditions'],
                'allFieldsValidated'        => $this->data['allFieldsValidated'],
                'errorPasswordMatch'        => $this->data['errorPasswordMatch'],
                'userInserted'              => $this->data['userInserted'],
            ]
        ];

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
