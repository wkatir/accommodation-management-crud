<?php

require_once '../src/Models/BaseModel.php';

class Accommodation extends BaseModel
{
    public function create($name, $description, $image_url, $created_by)
    {
        $query = "INSERT INTO accommodations (name, description, image_url, created_by) 
                  VALUES (:name, :description, :image_url, :created_by)";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':image_url' => $image_url,
            ':created_by' => $created_by,
        ]);
    }

    public function getAll()
    {
        $query = "SELECT * FROM accommodations";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
