# SOLID in this project

## S — Single Responsibility Principle
> A class should have only one reason to change.

| Class | Responsibility |
|---|---|
| `Database` | Opens and returns a PDO connection. Nothing else. |
| `Estudiante` | Persists/retrieves students in the DB. |
| `Validator` | Validates an array of student data. |
| `EstudianteController` | Reads HTTP input, delegates to validator + repository, returns a result. |

Each class changes only if its own job changes (e.g. `Validator` changes when validation rules change, not when the DB schema changes).

---

## O — Open/Closed Principle
> Open for extension, closed for modification.

`EstudianteController` is closed — you never edit it to add a new validation rule or switch databases. You extend behaviour by swapping the injected `$validator` or `$repository` with a different implementation.

```php
// index.php — swap Validator for a stricter one without touching the controller
$validator  = new StrictValidator();   // new class, same interface
$controller = new EstudianteController($repository, $validator);
```

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
$validator  = new Validator();
$controller = new EstudianteController($repository, $validator);
```
