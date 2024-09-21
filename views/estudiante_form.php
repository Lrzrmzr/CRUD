<?php
require_once('layouthead.php')
?>
<body>
<h1>Formulario de Estudiante</h1>
    <form action="index.php" method="post">
        <input type="hidden" name="id" value="<?php echo $estudiante->id ?? ''; ?>">
        <label for="nombre">Nombre del Estudiante:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $estudiante->nombre ?? ''; ?>" required><br>

        <label for="email">Edad:</label>
        <input type="number" id="edad" name="edad" value="<?php echo $estudiante->edad ?? ''; ?>" required><br>

        <label for="email">Sexo:</label>
        <input type="text" id="sexo" name="sexo" value="<?php echo $estudiante->sexo ?? ''; ?>" required><br>

        <label for="email">Carrera:</label>
        <input type="text" id="carrera" name="carrera" value="<?php echo $estudiante->carrera ?? ''; ?>" required><br>

        <input type="hidden" name="action" value="<?php echo isset($estudiante) ? 'edit' : 'create'; ?>">
        <input type="submit" value="<?php echo isset($estudiante) ? 'Actualizar' : 'Crear'; ?>">
        
    </form>

        
    <a href="index.php">Volver a la lista</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
<?php
require_once('layoutfoot.php');
?>