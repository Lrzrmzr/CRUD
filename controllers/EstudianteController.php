<?php

namespace Controllers;

use Models\Estudiante;
use Config\Database;

class EstudianteController{
    private $estudiante;

    /**
     * The constructor initializes a database connection and creates a new Estudiante object with the
     * connection.
     */
    public function __construct(){
        $database = new Database();
        $db = $database->getConnection();
        $this->estudiante = new Estudiante($db);
    }

    /**
     * The function creates a new student record with the provided name, age, gender, and major,
     * handling empty fields and potential errors.
     * 
     * @return the result of calling the `create()` method on the `` object.
     */
    public function create($nombre, $edad, $sexo, $carrera){
        if(empty($nombre) || empty($edad) || empty($sexo) || empty($carrera)) {
            throw new \Exception("Todos los campos son obligatorios");
        } 
        
        try {
            
            $this->estudiante->nombre = $nombre;
            $this->estudiante->edad = $edad;
            $this->estudiante->sexo = $sexo;
            $this->estudiante->carrera = $carrera;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        

        return $this->estudiante->create();
    }

    /**
     * This PHP function reads data from the "estudiante" object.
     * 
     * @return The `read()` method is being called on the `estudiante` property of the current object,
     * and the result of that method call is being returned.
     */
    public function read(){
        return $this->estudiante->read();
    }

    /**
     * The function `readOne` reads a single record from the `estudiante` object based on the provided
     * ID.
     * 
     * @param id The `readOne` function takes an `` parameter as input. This parameter is used to
     * set the `id` property of the `estudiante` object before calling the `readOne` method on the
     * `estudiante` object. This method is likely used to retrieve a specific record or
     * 
     */
    public function readOne($id){
        $this->estudiante->id = $id;
        $estudiante = $this->estudiante->readOne();

        return $estudiante;

    }

    /**
     * The function `update` takes in parameters for an ID, name, age, gender, and major, validates
     * that all fields are not empty, assigns the values to an object, and then updates the
     * corresponding record in the database.
     * 
     */
    public function update($id, $nombre, $edad, $sexo, $carrera){
        if(empty($nombre) || empty($edad) || empty($sexo) || empty($carrera)) {
            throw new \Exception("Todos los campos son obligatorios");
        } 
        try{
            $this->estudiante->id = $id;
            $this->estudiante->nombre = $nombre;
            $this->estudiante->edad = $edad;
            $this->estudiante->sexo = $sexo;
            $this->estudiante->carrera = $carrera; 
        } catch(\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        

        return $this->estudiante->update();
    }

    /**
     * The function deletes a record from the database using the provided ID.
     * 
     * @param id The `delete` function is used to delete a record from the database based on the
     * provided `id`. The `id` parameter is the unique identifier of the record that you want to
     * delete.
     */
    public function delete($id){
        $this->estudiante->id = $id;
        return $this->estudiante->delete();
    }

}