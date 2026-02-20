<?php
class Database {
    private $host = "localhost";
    private $db_name = "tourist_spot_db";
    private $username = "root";
    private $password = "IT@1994";
    public $conn;

    public function connect() {
        if($this->conn) return $this->conn;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username, $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e){
            echo json_encode(['error'=>$e->getMessage()]);
            exit;
        }
    }
}