<?php
namespace Helpers;

use Interfaces\ValidatableInterface;

// SOLID SRP: one job — validate a data array and report errors.
// OOP: implements ValidatableInterface — fulfills the validation contract.
class Validator implements ValidatableInterface
{
    /** @var array<string, string> */
    private array $errors = [];

    public function validate(array $data): bool
    {
        $this->errors = [];

        $nombre = trim($data['nombre'] ?? '');
        if ($nombre === '' || strlen($nombre) < 2) {
            $this->errors['nombre'] = 'Name is required (min 2 characters).';
        }

        $edad = $data['edad'] ?? '';
        if (!is_numeric($edad) || (int) $edad < 1 || (int) $edad > 120) {
            $this->errors['edad'] = 'Age must be a number between 1 and 120.';
        }

        if (empty(trim($data['sexo'] ?? ''))) {
            $this->errors['sexo'] = 'Gender is required.';
        }

        $carrera = trim($data['carrera'] ?? '');
        if ($carrera === '' || strlen($carrera) < 2) {
            $this->errors['carrera'] = 'Career is required (min 2 characters).';
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
