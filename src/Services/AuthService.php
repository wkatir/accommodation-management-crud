<?php

require_once '../src/Models/User.php';

class AuthService
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function register($data)
    {
        return $this->userModel->create($data['username'], $data['email'], $data['password']);
    }

    public function login($email, $password)
    {
        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
            return true;
        }

        return false;
    }
}
