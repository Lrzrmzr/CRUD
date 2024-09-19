<?php
require 'config/Database.php';
require 'models/Estudiante.php';
require 'controllers/EstudianteController.php';

use Controllers\EstudianteController;

$controller = new EstudianteController();

/* The `action` variable is used to determine which operation to perform in the application based on
the user's input. It is used to switch between different cases in the switch statement to handle
actions such as creating a new record, editing an existing record, deleting a record, or displaying
a list of records. The value of `action` is retrieved from either the POST or GET request
parameters, and the corresponding action is executed based on the value of `action`. */
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

switch($action) {
    case 'create':
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $controller->create($_POST['nombre'], $_POST['edad'],  $_POST['sexo'], $_POST['carrera']);
            header('Location: index.php');
        }else{
            include 'views/estudiante_form.php';
        }
        break;

    case 'edit':
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $controller->update($_POST['id'], $_POST['nombre'], $_POST['edad'], $_POST['sexo'], $_POST['carrera']);
            header('Location: index.php');
        } else {
            $id = $_GET['id'] ?? 0;
            $estudiante = $controller->readOne($id);
            include 'views/estudiante_form.php';
        }
        break;

    case 'delete' :
        $id = $_GET['id'] ?? 0;
        $controller->delete($id);
        header('Location: index.php');
        break;
    
    default :
        $estudiante = $controller->read()->fetchAll(PDO::FETCH_ASSOC);
        include 'views/estudiante_list.php';
        break;
}