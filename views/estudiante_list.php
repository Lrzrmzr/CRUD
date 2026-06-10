<?php require_once 'layouthead.php'; ?>
<body>
<div class="container mt-4">

    <!-- Flash message (set in session by index.php after any action) -->
    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['flash']['type']) ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Student List</h1>
            <a class="btn btn-primary mb-3"
               data-bs-toggle="modal"
               data-bs-target="#editModal"
               href="index.php?action=create">
               New Student
            </a>

            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Career</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estudiantes as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['sexo']) ?></td>
                        <td><?= htmlspecialchars($row['edad']) ?></td>
                        <td><?= htmlspecialchars($row['carrera']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm btn-edit"
                                    data-id="<?= htmlspecialchars($row['id']) ?>"
                                    data-nombre="<?= htmlspecialchars($row['nombre']) ?>"
                                    data-edad="<?= htmlspecialchars($row['edad']) ?>"
                                    data-sexo="<?= htmlspecialchars($row['sexo']) ?>"
                                    data-carrera="<?= htmlspecialchars($row['carrera']) ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm btn-delete"
                                    data-id="<?= htmlspecialchars($row['id']) ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit / Create Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="index.php" method="post">
                    <input type="hidden" name="id"     id="edit-id">
                    <input type="hidden" name="action" id="edit-action" value="create">
                    <div class="mb-3">
                        <label for="edit-nombre" class="form-label">Name</label>
                        <input type="text"   class="form-control" id="edit-nombre"  name="nombre"  required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-edad" class="form-label">Age</label>
                        <input type="number" class="form-control" id="edit-edad"    name="edad"    required min="1" max="120">
                    </div>
                    <div class="mb-3">
                        <label for="edit-sexo" class="form-label">Gender</label>
                        <input type="text"   class="form-control" id="edit-sexo"    name="sexo"    required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-carrera" class="form-label">Career</label>
                        <input type="text"   class="form-control" id="edit-carrera" name="carrera" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this student?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="index.php" method="get">
                    <input type="hidden" name="id"     id="delete-id">
                    <input type="hidden" name="action" value="delete">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="js/table.js"></script>

</body>
<?php require_once 'layoutfoot.php'; ?>
