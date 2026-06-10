<?php
declare(strict_types=1);
namespace Controllers;

use Interfaces\CrudRepositoryInterface;
use Interfaces\ValidatableInterface;

// SOLID DIP: depends on interfaces, not on Estudiante or Validator directly.
// SOLID SRP: only coordinates request data → validation → repository → result.
class EstudianteController
{
    // OOP Constructor Injection: dependencies supplied from outside (index.php).
    public function __construct(
        private CrudRepositoryInterface $repository,
        private ValidatableInterface    $validator
    ) {}

    /** @return array{success: bool, errors?: array<string, string>} */
    public function create(array $data): array
    {
        if (!$this->validator->validate($data)) {
            return ['success' => false, 'errors' => $this->validator->getErrors()];
        }
        return ['success' => $this->repository->create($data)];
    }

    public function read(): array
    {
        return $this->repository->read();
    }

    public function readOne(int $id): ?object
    {
        return $this->repository->readOne($id);
    }

    /** @return array{success: bool, errors?: array<string, string>} */
    public function update(int $id, array $data): array
    {
        if (!$this->validator->validate($data)) {
            return ['success' => false, 'errors' => $this->validator->getErrors()];
        }
        return ['success' => $this->repository->update($id, $data)];
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
