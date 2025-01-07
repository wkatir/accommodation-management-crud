<?php

require_once '../src/Models/Accommodation.php';

class AdminService
{
    private $accommodationModel;

    public function __construct()
    {
        $this->accommodationModel = new Accommodation();
    }

    public function createAccommodation($data, $adminId)
    {
        return $this->accommodationModel->create(
            $data['name'],
            $data['description'],
            $data['image_url'],
            $adminId
        );
    }

    public function getAllAccommodations()
    {
        return $this->accommodationModel->getAll();
    }
}
