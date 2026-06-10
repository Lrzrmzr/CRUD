# OOP in this project

## 1. Encapsulation — `config/Database.php`

The class hides its internal state (credentials, connection handle) behind private properties. The only thing consumers can call is `getConnection()`.

```php
// config/Database.php
class Database {
    private $host     = 'localhost'; // hidden — consumers can't touch this
    private $dbname   = 'test1';
    private $username = 'root';
    private $password = '';
    private $conexion;

    public function getConnection(): PDO { ... } // the only public door
}
```

**Why it matters:** If you change the driver (e.g. MySQL → PostgreSQL) or the DSN format, no other file needs to change — only `Database.php`.

---

## 2. Interfaces & Polymorphism — `interfaces/CrudRepositoryInterface.php`

An interface declares a **contract**: a set of method signatures any implementing class must provide. `EstudianteController` depends on the interface type, not on `Estudiante` directly.

```php
// interfaces/CrudRepositoryInterface.php
interface CrudRepositoryInterface {
    public function create(array $data): bool;
    public function read(): array;
    public function readOne(int $id): ?object;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}

// models/Estudiante.php
class Estudiante implements CrudRepositoryInterface { ... }

// controllers/EstudianteController.php — type-hint is the interface, not Estudiante
public function __construct(
    private CrudRepositoryInterface $repository, // ← polymorphism
    private ValidatableInterface    $validator
) {}
```

**Why it matters:** You could swap `Estudiante` for a `ProfesorRepository` or a mock for testing — the controller never changes because it only knows the interface.
