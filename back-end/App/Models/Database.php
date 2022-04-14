<?php 

namespace App\Models;

use PDO;
use PDOException;

class Database{
  
    // credencias de conexão
    private $host = DB_HOST;
    private $db_name = DB_DATABASE_NAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    public $conn;

    // Conecta com o banco de dados
    public function __construct(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

   
}