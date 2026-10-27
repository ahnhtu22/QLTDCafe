<?php
class DbConnection {
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $conn;

    public function __construct() {
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->dbname = DB_NAME;
        
        try {
            
            $sqlStr = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4";
            
            $this->conn = new PDO($sqlStr, $this->user, $this->pass);
            
           
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $e) {
            $this->conn = null;
            
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>