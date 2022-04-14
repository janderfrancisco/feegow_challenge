<?php 

namespace App\Models;

use PDO;
use App\Models\Database;

class Schedule extends Database
{
  



    /**
     * get all schedules From database
     *
     * @return object
     */
    public function getAll()
    {
        $query = "SELECT * FROM schedules ORDER BY id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    
        
    /**
     * getRow
     *
     * @param  int $id
     * @return object
     */
    public function getRow(Int $id = null)
    {
        $query = "SELECT * FROM schedules WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    
    /**
     * save schedule
     *
     * @param  Array $data
     * @return Int
     */
    public function save(Array $data)
    {
        $query = "INSERT INTO schedules (specialty_id, professional_id, name, cpf, source_id, birthdate, date_time) 
                VALUES
                (:specialty_id, :professional_id, :name, :cpf, :source_id, :birthdate, :date_time)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':specialty_id', $data['specialty_id']);
        $stmt->bindParam(':professional_id', $data['professional_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':cpf', $data['cpf']);
        $stmt->bindParam(':source_id', $data['source_id']);
        $stmt->bindParam(':birthdate', $data['birthdate']);
        $stmt->bindParam(':date_time', date('Y-m-d H:i:s'));
        $stmt->execute();
        return $this->conn->lastInsertId();
    }  
}