<?php
namespace Interfaces;

// =============================================================================
// OOP CONCEPT: Interface Segregation (second small interface)
// =============================================================================
// SOLID ISP says: prefer many small, focused interfaces over one large one.
// A "fat" interface would force models to implement validate() even if they
// don't need it, or force validators to implement CRUD methods they don't use.
//
// This interface is meant for objects that know how to validate a data array.
// In a real project, a FormRequest or DTO class would implement this.
//
// NOTE: This interface is included here as an educational example of ISP.
// It is not implemented by any class in this project directly, but shows
// how you would design a second, separate contract.
// =============================================================================

interface ValidatableInterface
{
    // Returns true if all validation rules pass.
    public function validate(array $data): bool;

    // Returns an associative array: ['fieldName' => 'Error message here']
    public function getErrors(): array;
}