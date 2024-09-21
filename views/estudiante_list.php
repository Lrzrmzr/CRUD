<?php
require_once('layouthead.php')
?>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Lista de Estudiantes</h1>
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" href="index.php?action=create">Crear Nuevo Estudiante</a>
                <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th>Edad</th>
                        <th>Carrera</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estudiante as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['sexo']); ?></td>
                        <td><?php echo htmlspecialchars($row['edad']); ?></td>
                        <td><?php echo htmlspecialchars($row['carrera']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-edit" 
                                    data-id="<?php echo htmlspecialchars($row['id']); ?>" 
                                    data-nombre="<?php echo htmlspecialchars($row['nombre']); ?>" 
                                    data-edad="<?php echo htmlspecialchars($row['edad']); ?>" 
                                    data-sexo="<?php echo htmlspecialchars($row['sexo']); ?>" 
                                    data-carrera="<?php echo htmlspecialchars($row['carrera']); ?>" 
                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                    Editar
                            </button>

                            <button class="btn btn-danger btn-delete" 
                                    data-id="<?php echo htmlspecialchars($row['id']); ?>" 
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    Eliminar
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Modal for Edit-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Agregar/Editar Estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="index.php" method="post">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit-nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-edad" class="form-label">Edad</label>
                        <input type="number" class="form-control" id="edit-edad" name="edad" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-sexo" class="form-label">Sexo</label>
                        <input type="text" class="form-control" id="edit-sexo" name="sexo" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-carrera" class="form-label">Carrera</label>
                        <input type="text" class="form-control" id="edit-carrera" name="carrera" required>
                    </div>
                    <input type="hidden" name="action" value="edit">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Eliminar Estudiante</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ¿Estás seguro que deseas eliminar este estudiante?
        </div>
        <div class="modal-footer">
            <form id="deleteForm" action="index.php" method="get">
            <input type="hidden" name="id" id="delete-id">
            <input type="hidden" name="action" value="delete">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (solo si usas Bootstrap 4 o DataTables con jQuery) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script src="js/table.js"></script>
    
</body>
<?php
require_once('layoutfoot.php');
?>