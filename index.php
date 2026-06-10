<?php
// Session must start before any output.
session_start();

// Manual requires (no Composer). Load order: interfaces → config → model → helper → controller.
require_once 'interfaces/CrudRepositoryInterface.php';
require_once 'interfaces/ValidatableInterface.php';
require_once 'config/Database.php';
require_once 'models/Estudiante.php';
require_once 'helpers/Validator.php';
require_once 'controllers/EstudianteController.php';

use Config\Database;
use Models\Estudiante;
use Helpers\Validator;
use Controllers\EstudianteController;

// =============================================================================
// Composition Root — the ONLY place where concrete classes are instantiated.
// SOLID DIP: EstudianteController receives interfaces, not concrete classes.
// =============================================================================
$db         = (new Database())->getConnection();
$repository = new Estudiante($db);
$validator  = new Validator();
$controller = new EstudianteController($repository, $validator);

// Single entry point: read action from POST first, then GET.
$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    switch ($action) {

        case 'create':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = $controller->create($_POST);
                $_SESSION['flash'] = $result['success']
                    ? ['type' => 'success', 'msg' => 'Student created successfully.']
                    : ['type' => 'danger',  'msg' => implode(' ', $result['errors'])];
                header('Location: index.php');
                exit;
            }
            include 'views/estudiante_form.php';
            break;

        case 'edit':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id     = (int) ($_POST['id'] ?? 0);
                $result = $controller->update($id, $_POST);
                $_SESSION['flash'] = $result['success']
                    ? ['type' => 'success', 'msg' => 'Student updated successfully.']
                    : ['type' => 'danger',  'msg' => implode(' ', $result['errors'])];
                header('Location: index.php');
                exit;
            }
            $id         = (int) ($_GET['id'] ?? 0);
            $estudiante = $controller->readOne($id);
            include 'views/estudiante_form.php';
            break;

        case 'delete':
            $id = (int) ($_GET['id'] ?? 0);
            $controller->delete($id);
            $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Student deleted successfully.'];
            header('Location: index.php');
            exit;

        default:
            $estudiantes = $controller->read();
            include 'views/estudiante_list.php';
            break;
    }
} catch (\Throwable $e) {
    // In production: log $e instead of displaying it.
    $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Unexpected error: ' . $e->getMessage()];
    header('Location: index.php');
    exit;
}
