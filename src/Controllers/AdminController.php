<?php

require_once '../src/Services/AdminService.php';

class AdminController
{
    private $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService();
    }

    public function createAccommodation($data)
    {
        $adminId = $_SESSION['user']['id'];
        $this->adminService->createAccommodation($data, $adminId);
        header("Location: /dashboard");
    }

    public function showDashboard()
    {
        $accommodations = $this->adminService->getAllAccommodations();
        include '../src/Views/admin/dashboard.php';
    }

    public function getAllAccommodations()
    {
        return $this->adminService->getAllAccommodations();
    }
}
