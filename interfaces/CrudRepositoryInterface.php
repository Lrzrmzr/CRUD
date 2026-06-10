<?php
namespace Interfaces;

// =============================================================================
// OOP: Interface — defines a CONTRACT that every repository must fulfill.
// SOLID ISP: small, focused — only CRUD operations, nothing else.
// SOLID DIP: controllers depend on THIS interface, not on concrete classes.
// =============================================================================
interface CrudRepositoryInterface
{
    // Data is passed through parameters so the interface is truly enforceable.
    public function create(array $data): bool;
    public function read(): array;
    public function readOne(int $id): ?object;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
