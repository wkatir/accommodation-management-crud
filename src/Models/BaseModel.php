<?php

require_once '../src/Config/Database.php';

class BaseModel
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }
}
