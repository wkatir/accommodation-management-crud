<?php

require_once '../src/Models/BaseModel.php';

class UserAccommodation extends BaseModel
{
    public function add($user_id, $accommodation_id)
    {
        $query = "INSERT INTO user_accommodations (user_id, accommodation_id) VALUES (:user_id, :accommodation_id)";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':user_id' => $user_id,
            ':accommodation_id' => $accommodation_id,
        ]);
    }

    public function remove($user_id, $accommodation_id)
    {
        $query = "DELETE FROM user_accommodations WHERE user_id = :user_id AND accommodation_id = :accommodation_id";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':user_id' => $user_id,
            ':accommodation_id' => $accommodation_id,
        ]);
    }

    public function getByUserId($user_id)
    {
        $query = "SELECT accommodations.* 
                  FROM accommodations 
                  JOIN user_accommodations ON accommodations.id = user_accommodations.accommodation_id 
                  WHERE user_accommodations.user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
