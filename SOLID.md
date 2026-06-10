# SOLID in this project

## S — Single Responsibility Principle
> A class should have only one reason to change.

| Class | Responsibility |
|---|---|
| `Database` | Opens and returns a PDO connection. Nothing else. |
| `Estudiante` | Persists/retrieves students in the DB. |
| `Validator` | Validates an array of student data. |
| `EstudianteController` | Reads HTTP input, delegates to validator + repository, returns a result. |

Each class changes only if its own job changes (e.g. `Estudiante` changes if the table schema changes; `Validator` changes only if the rule-running *mechanism* changes — adding new validation rules does **not** touch it, see OCP below).

---

## O — Open/Closed Principle
> Open for extension, closed for modification.

`Validator` is a generic rule-runner. The actual validation rules are **data** (closures) injected through its constructor — `helpers/Validator.php` never needs to be edited again.

```php
// helpers/Validator.php — closed for modification
public function __construct(private array $rules) {}

public function validate(array $data): bool {
    foreach ($this->rules as $field => $config) {
        $value = $data[$field] ?? '';
        if (!($config['rule'])($value)) {
            $this->errors[$field] = $config['message'];
        }
    }
    return empty($this->errors);
}
```

```php
// index.php — open for extension: add a field by adding a rule, no class edited
$validator = new Validator([
    'nombre' => ['rule' => fn($v) => strlen(trim($v)) >= 2, 'message' => '...'],
    'email'  => [ // ← brand new field, zero changes to Validator.php
        'rule'    => fn($v) => filter_var($v, FILTER_VALIDATE_EMAIL) !== false,
        'message' => 'Invalid email address.',
    ],
]);
```

`EstudianteController` is also OCP: swapping `$repository` or `$validator` for a different implementation never requires editing the controller.

---

## L — Liskov Substitution Principle
> A subtype must be usable wherever its parent type is expected.

Any class that implements `CrudRepositoryInterface` can replace `Estudiante` in `EstudianteController` without breaking anything, because it guarantees the same method signatures and return types.

```php
// This would work without changing EstudianteController at all:
$repository = new ProfesorRepository($db); // also implements CrudRepositoryInterface
$controller = new EstudianteController($repository, $validator);
```

---

## I — Interface Segregation Principle
> Clients should not be forced to implement methods they don't use.

Two small, focused interfaces instead of one fat one:

- `CrudRepositoryInterface` → for models that persist data.
- `ValidatableInterface` → for classes that validate data.

`Validator` only implements `validate()` and `getErrors()`. It is never forced to implement `create()` or `delete()`.

---

## D — Dependency Inversion Principle
> High-level modules should depend on abstractions, not on concrete classes.

`EstudianteController` (high-level) depends on `CrudRepositoryInterface` and `ValidatableInterface` (abstractions), not on `Estudiante` or `Validator` (concretes).

The concrete classes are instantiated only in `index.php` — the **Composition Root** — the one place in the application where everything is wired together:

```php
// index.php — the only place that mentions concrete class names
$db         = (new Database())->getConnection();
$repository = new Estudiante($db);
$validator  = new Validator([/* rules — see OCP section */]);
$controller = new EstudianteController($repository, $validator);
```
