<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
</head>
<body>
<h1>Lista de Estudiantes</h1>
    <a href="index.php?action=create">Crear Nuevo Estudiante</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Sexo</th>
            <th>Edad</th>
            <th>Carrera</th>
        </tr>
        <?php foreach ($estudiante as $estudianteList): ?>
        <tr>
            <td><?php echo htmlspecialchars($estudianteList['id']); ?></td>
            <td><?php echo htmlspecialchars($estudianteList['nombre']); ?></td>
            <td><?php echo htmlspecialchars($estudianteList['edad']); ?></td>
            <td><?php echo htmlspecialchars($estudianteList['sexo']); ?></td>
            <td><?php echo htmlspecialchars($estudianteList['carrera']); ?></td>
            <td>
                <a href="index.php?action=edit&id=<?php echo htmlspecialchars($estudianteList['id']); ?>">Editar</a>
                <a href="index.php?action=delete&id=<?php echo htmlspecialchars($estudianteList['id']); ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>