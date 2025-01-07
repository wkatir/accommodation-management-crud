<?php

require_once '../src/Services/UserService.php';

class UserController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function showAccount()
    {
        $userId = $_SESSION['user']['id'];
        $accommodations = $this->userService->getUserAccommodations($userId);
        include '../src/Views/user/account.php';
    }

    public function addAccommodation($accommodationId)
    {
        $userId = $_SESSION['user']['id'];
        $this->userService->addAccommodationToUser($userId, $accommodationId);
        header("Location: /account");
    }

    public function removeAccommodation($accommodationId)
    {
        $userId = $_SESSION['user']['id'];
        $this->userService->removeAccommodationFromUser($userId, $accommodationId);
        header("Location: /account");
    }
}
