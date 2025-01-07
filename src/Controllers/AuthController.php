<?php

require_once '../src/Services/AuthService.php';

class AuthController
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function register($data)
    {
        if ($this->authService->register($data)) {
            header("Location: /login");
        } else {
            echo "Error during registration.";
        }
    }

    public function login($data)
    {
        if ($this->authService->login($data['email'], $data['password'])) {
            header("Location: /account");
        } else {
            echo "Invalid credentials.";
        }
    }
}
