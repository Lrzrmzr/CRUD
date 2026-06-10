<?php
declare(strict_types=1);
namespace Helpers;

use Interfaces\ValidatableInterface;

// SOLID SRP: one job — run a set of rules against a data array and report errors.
// SOLID OCP: closed for modification, open for extension — the rules themselves
// are DATA injected via the constructor. To validate a new field (or a whole
// new entity), pass new rules from the composition root; this class never changes.
// OOP: implements ValidatableInterface — fulfills the validation contract.
class Validator implements ValidatableInterface
{
    /** @var array<string, string> */
    private array $errors = [];

    /**
     * @param array<string, array{rule: callable(mixed): bool, message: string}> $rules
     *        Format: 'field' => ['rule' => fn($value): bool, 'message' => 'Error text']
     */
    public function __construct(private array $rules) {}

    public function validate(array $data): bool
    {
        $this->errors = [];

        foreach ($this->rules as $field => $config) {
            $value = $data[$field] ?? '';
            if (!($config['rule'])($value)) {
                $this->errors[$field] = $config['message'];
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
