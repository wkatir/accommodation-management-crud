<?php

require_once '../vendor/autoload.php';

require_once '../src/Controllers/AuthController.php';
require_once '../src/Controllers/UserController.php';
require_once '../src/Controllers/AdminController.php';

session_start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        $adminController = new AdminController();
        $accommodations = $adminController->getAllAccommodations();
        include '../src/Views/landing.php';
        break;

    case '/login':
        $authController = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login($_POST);
        } else {
            include '../src/Views/auth/login.php';
        }
        break;

    case '/register':
        $authController = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->register($_POST);
        } else {
            include '../src/Views/auth/register.php';
        }
        break;

    case '/logout':
        session_destroy();
        header("Location: /");
        break;

    case '/account':
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        $userController = new UserController();
        $userController->showAccount();
        break;

    case '/add-accommodation':
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $userController = new UserController();
            $userController->addAccommodation($_GET['id']);
        }
        break;

    case '/remove-accommodation':
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $userController = new UserController();
            $userController->removeAccommodation($_GET['id']);
        }
        break;

    case '/dashboard':
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: /login");
            exit;
        }
        $adminController = new AdminController();
        $adminController->showDashboard();
        break;

    case '/create-accommodation':
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: /login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminController = new AdminController();
            $adminController->createAccommodation($_POST);
        } else {
            include '../src/Views/admin/create-accommodation.php';
        }
        break;

    default:
        http_response_code(404);
        echo "Page not found.";
        break;
}