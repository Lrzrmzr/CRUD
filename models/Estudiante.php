<?php
namespace Models;

use PDO;
use Interfaces\CrudRepositoryInterface;

// OOP: class implements CrudRepositoryInterface — fulfills the contract.
// SOLID SRP: one responsibility — persist/retrieve Estudiante data.
class Estudiante implements CrudRepositoryInterface
{
    // OOP Encapsulation: internal details hidden; only the interface is public.
    private PDO    $conexion;
    private string $table = 'estudiantes';

    // OOP Constructor injection: dependency (PDO) provided from outside.
    // SOLID DIP: receives an abstraction (PDO), not a concrete Database class.
    public function __construct(PDO $db)
    {
        $this->conexion = $db;
    }

    public function create(array $data): bool
    {
        $query = "INSERT INTO {$this->table} (nombre, edad, sexo, carrera)
                  VALUES (:nombre, :edad, :sexo, :carrera)";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':nombre',  $data['nombre']);
        $stmt->bindValue(':edad',    (int) $data['edad'], PDO::PARAM_INT);
        $stmt->bindValue(':sexo',    $data['sexo']);
        $stmt->bindValue(':carrera', $data['carrera']);

        return $stmt->execute();
    }

    public function read(): array
    {
        $stmt = $this->conexion->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne(int $id): ?object
    {
        $stmt = $this->conexion->prepare(
            "SELECT * FROM {$this->table} WHERE id = :id"
        );
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row !== false ? $row : null;
    }

    public function update(int $id, array $data): bool
    {
        $query = "UPDATE {$this->table}
                  SET nombre  = :nombre,
                      edad    = :edad,
                      sexo    = :sexo,
                      carrera = :carrera
                  WHERE id = :id";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':nombre',  $data['nombre']);
        $stmt->bindValue(':edad',    (int) $data['edad'], PDO::PARAM_INT);
        $stmt->bindValue(':sexo',    $data['sexo']);
        $stmt->bindValue(':carrera', $data['carrera']);
        $stmt->bindValue(':id',      $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->conexion->prepare(
            "DELETE FROM {$this->table} WHERE id = :id"
        );
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
