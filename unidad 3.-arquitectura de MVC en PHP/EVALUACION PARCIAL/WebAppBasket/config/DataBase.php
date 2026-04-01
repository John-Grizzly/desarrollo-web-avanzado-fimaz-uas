<?php
class DataBase {
    private $host = "localhost";
    private $db = "proyecto";
    private $user = "root";
    private $password = "";

    public function __construct()
    {
        // Constructor...
    }

    public function connect(){
        try {
            $PDO = new PDO(
                "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8mb4",
                $this->user,
                $this->password
            );
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $PDO;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>