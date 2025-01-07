<?php

require_once '../src/Models/UserAccommodation.php';

class UserService
{
    private $userAccommodationModel;

    public function __construct()
    {
        $this->userAccommodationModel = new UserAccommodation();
    }

    public function getUserAccommodations($userId)
    {
        return $this->userAccommodationModel->getByUserId($userId);
    }

    public function addAccommodationToUser($userId, $accommodationId)
    {
        return $this->userAccommodationModel->add($userId, $accommodationId);
    }

    public function removeAccommodationFromUser($userId, $accommodationId)
    {
        return $this->userAccommodationModel->remove($userId, $accommodationId);
    }
}
