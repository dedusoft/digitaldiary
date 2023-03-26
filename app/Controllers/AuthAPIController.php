<?php

namespace App\Controllers;

use App\Libraries\AuthAPILibrary;
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
    public string $errorEmailOrPasswordMsg = '';
    public string $userIsLoginMsg = '';

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
        'userIsLogin'               => '',
        'errorUserEmailExist'       => '',
        'errorEmailOrPassword'      => '',
    ];

    public function __construct()
    {
        helper(['url']);
    }

    use ResponseTrait;
    public function login()
    {
        // $userModel = new UserModel();

        $emailTest = 'duclairdeugoue@gmail.com';
        $passwordTest = '12345678';

        $emailInput = $this->request->getVar('email');
        $passwordInput = $this->request->getVar('password');
        $rememberInput = $this->request->getVar('remember');

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
        // all fields are filled
        if ($this->errors == 0) {

            try {
                $userModel = new UserModel();
                $userData = $userModel->where('user_email', $this->email)->first();
                if (!$userData) {
                    $this->errorEmailOrPasswordMsg = 'Wrong Email or Password';
                    $this->errors++;
                    $this->status = false;
                    $this->data['errorEmailOrPassword'] = [
                        'status'    => true,
                        'message'   => $this->errorEmailOrPasswordMsg
                    ];
                } else {
                    $checkUserPasswordMatch = AuthAPILibrary::checkPassword($this->password, $userData['user_password']);

                    if (!$checkUserPasswordMatch) {
                        $this->status = false;
                        $this->errorEmailOrPasswordMsg = 'Wrong Email or Password';
                        $this->errors++;
                        $this->data['errorEmailOrPassword'] = [
                            'status'    => true,
                            'message'   => $this->errorEmailOrPasswordMsg
                        ];
                    } else {
                         // set session variable if user check remeber me
                         if($rememberInput === 'true') {
                            $userId = $userData['id'];
                            session()->set('logUserId',$userId);
                         } else {
                            $userId = $userData['id'];
                            session()->set('logUserId',$userId);
                         }     

                        $this->userIsLoginMsg = "Login successfully";
                        $this->status = true;
                        $this->data['userIsLogin'] = [
                            'status'    => true,
                            'message'   => $this->userIsLoginMsg,
                            'redirectToDashboardUrl'   => base_url("dashboard")
                        ];
                    }
                }
            } catch (\Throwable $th) {
                $this->status = false;
                $this->errorEmailOrPasswordMsg = 'Something went wrong';
                $this->errors++;
                $this->data['errorEmailOrPassword'] = [
                    'status'    => true,
                    'message'   => $this->errorEmailOrPasswordMsg
                ];
            }
        }

        $output = array(
            'status'    => $this->status,
            'data'      => [
                'errorEmail'                 => $this->data['errorEmail'],
                'errorPassword'              => $this->data['errorPassword'],
                'errorEmailOrPassword'       => $this->data['errorEmailOrPassword'],
                'userIsLogin'                => $this->data['userIsLogin'],
            ],
        );


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
            if ($this->errors === 0) {

                $userData = [
                    'user_email'    => $this->email,
                    'user_password' => AuthAPILibrary::hashPassword($this->password),
                    'user_role'     =>  $this->userRole
                ];
                try {
                    $userModel = new UserModel();
                    // check if email exist
                    $userEmailExist = $userModel->where('user_email', $this->email)->first();
                    if ($userEmailExist) {
                        $this->status = false;
                        $this->data['errorUserEmailExist'] = [
                            'status'    => true,
                            'message'   => 'Email already exist '
                        ];
                    } else {
                        $query = $userModel->insert($userData);
                        if (!$query) {
                            $this->status = false;
                            $this->data['userInserted'] = [
                                'status'    => false,
                                'message'   => 'Something went wrong '
                            ];
                        } else {
                           
                            $this->status = true;
                            $this->data['userInserted'] = [
                                'status'    => true,
                                'message'   => 'Account successfully created',
                                'redirectToLoginUrl'   => base_url('auth/login')
                            ];
                        }
                    }
                } catch (\Throwable $th) {
                    $this->status = false;
                    $this->data['userInserted'] = [
                        'status'    => false,
                        'message'   => "Error: Something went wrong"
                    ];
                }
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
                'errorUserEmailExist'       => $this->data['errorUserEmailExist'],
            ]
        ];

        return $this->respond($output, 200);
    }

    // TODO: Need professional google gmail account to send mail,
    // now mail function can't work
    use ResponseTrait;
    public function forgetPassword()
    {
        echo view('auth/forget-password');
    }

    // TODO: depends on forgetPassword functionality
    public function resetPassword()
    {
        echo view('auth/forget-password');
    }

    use ResponseTrait;
    public function lockPage()
    {
        echo view('auth/forget-password');
    }

    public function setSession($userData)
    {

    }
}
