<?php

namespace Models;

use PDO;
use PDOException;

class Estudiante {
    private $conexion;
    private $table = 'estudiantes';

    public $id;
    public $nombre;
    public $edad;
    public $sexo;
    public $carrera;

    public function __construct($db){
        $this->conexion = $db;

    }

    public function create(){
        try{
            $query = "INSERT INTO " . $this->table . " 
            (nombre, edad, sexo, carrera) 
            VALUES 
            (:nombre, :edad, :sexo, :carrera)";

            $stmt = $this->conexion->prepare($query);

            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":edad", $this->edad);
            $stmt->bindParam(":sexo", $this->sexo);
            $stmt->bindParam(":carrera", $this->carrera);

            if($stmt->execute()){
                return "Registro creado exitosamente";
            }
        } catch (PDOException $e) {
            echo "Error al crear el registro: " . $e->getMessage();
        }
        
        return false;
    }

    public function read(){
        try{
            $query = "SELECT * FROM ".$this->table;

            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e){
            echo "Error al leer los registros: " . $e->getMessage();
        }
        

        
    }

    public function readOne(){
        try{
            $query = "SELECT * FROM " . $this->table . " WHERE id = :id";

            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_OBJ);

            if($row){
                return $row;
            }else {
                throw new \Exception("Registro no encontrado");
            }
        } catch (PDOException $e) {
            echo "Error al leer el registro: " . $e->getMessage();
        }
        
    }

    public function update(){
        try{
            $query = "UPDATE " . $this->table . " 
            SET nombre = :nombre, 
                edad = :edad, 
                sexo = :sexo, 
                carrera = :carrera 
            WHERE id = :id";

            $stmt = $this->conexion->prepare($query);

            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(":edad", $this->edad);
            $stmt->bindParam(":sexo", $this->sexo);
            $stmt->bindParam(":carrera", $this->carrera);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar el registro: ".$e->getMessage();
        }
        
    }

    public function delete(){
        try{
            $query = "DELETE FROM ".$this->table." WHERE id = :id";

            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
                return true;
            }
        } catch (PDOException $e){
            echo "Error al eliminar el registro: ".$e->getMessage();
        }
        
        return false;
    }
}