<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            $email = $data['email'];
            $name = $data['name'];
            $password = $data['password'];
            $confirm_password = $data['confirm_password'];
            $data['email_error'] = $this->verifyEmail($email);
            $data['name_error'] = $this->verifyName($name);
            $data['password_error'] = $this->verifyPassword($password);
            $data['confirm_password_error'] = $this->verifyConfirmPassword($password, $confirm_password);

            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                if ($this->userModel->register($data, $hashed_password)) {
                    flash('register_success', 'You are now registered. Please login to continue');
                    redirect('users/login');
                } else {
                    die('Something went wrong.');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];

            $email = $data['email'];
            $password = $data['password'];
            $data['email_error'] = $this->verifyLoginEmail($email);
            $data['password_error'] = $this->verifyPassword($password);

            if (empty($data['email_error']) && empty($data['password_error'])) {
                $loggedInUser = $this->userModel->login($email, $password);
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_error'] = 'Incorrect Password';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];

            $this->view('users/login', $data);
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }

    public function verifyLoginEmail($email)
    {
        if (empty($email)) {
            return 'Please enter email';
        } else {
            if ($this->userModel->findUserbyEmail($email)) {
            } else {
                return 'User not found';
            }
        }
    }

    public function verifyEmail($email)
    {
        if (empty($email)) {
            return 'Please enter email';
        } else {
            if ($this->userModel->findUserbyEmail($email)) {
                return 'Email is already taken.';
            }
        }
    }

    public function verifyName($name)
    {
        if (empty($name)) {
            return 'Please enter name';
        }
    }

    public function verifyPassword($password)
    {
        if (empty($password)) {
            return 'Please enter password';
        }
    }

    public function verifyConfirmPassword($password, $confirm_password)
    {
        if (empty($confirm_password)) {
            return 'Please confirm password';
        } else {
            if ($password != $confirm_password) {
                return 'Passwords do not match';
            }
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('notes');
    }
}
