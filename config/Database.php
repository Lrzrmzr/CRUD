<?php
namespace Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $dbname ='test1';
    private $username = 'root';
    private $password = '';
    private $conexion;

    public function getDbName() {
        return $this->dbname;
    }

    public function getConnection(){
        $this->conexion =null;

        try{
            $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }

        return $this->conexion;
    }

}
