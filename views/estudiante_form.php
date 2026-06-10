<?php
// Reached only when JavaScript is disabled (modal can't open).
// $estudiante is set by index.php when editing; null/absent when creating.
$isEditing = isset($estudiante) && $estudiante !== null;
require_once 'layouthead.php';
?>
<body>
<div class="container mt-4" style="max-width: 500px;">
    <h2><?= $isEditing ? 'Edit Student' : 'New Student' ?></h2>

    <form action="index.php" method="post">
        <input type="hidden" name="id"     value="<?= $isEditing ? htmlspecialchars($estudiante->id) : '' ?>">
        <input type="hidden" name="action" value="<?= $isEditing ? 'edit' : 'create' ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Name</label>
            <input type="text"   class="form-control" id="nombre"  name="nombre"
                   value="<?= $isEditing ? htmlspecialchars($estudiante->nombre) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="edad" class="form-label">Age</label>
            <input type="number" class="form-control" id="edad"    name="edad"
                   value="<?= $isEditing ? htmlspecialchars($estudiante->edad) : '' ?>"
                   required min="1" max="120">
        </div>
        <div class="mb-3">
            <label for="sexo" class="form-label">Gender</label>
            <input type="text"   class="form-control" id="sexo"    name="sexo"
                   value="<?= $isEditing ? htmlspecialchars($estudiante->sexo) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="carrera" class="form-label">Career</label>
            <input type="text"   class="form-control" id="carrera" name="carrera"
                   value="<?= $isEditing ? htmlspecialchars($estudiante->carrera) : '' ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <?= $isEditing ? 'Update' : 'Create' ?>
        </button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
<?php require_once 'layoutfoot.php'; ?>
