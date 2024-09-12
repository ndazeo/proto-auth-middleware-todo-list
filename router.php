<?php
require_once './libs/request.php';
require_once './libs/response.php';

require_once './app/middlewares/auth.middleware.php';
require_once './app/controllers/task.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$req = new Request();
$res = new Response();

$action = 'list'; // acción por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion Ej: dev/juan --> ['dev', juan]
$params = explode('/', $action);
$req->params = shift($params);

authMiddleware($req, $res);

// tabla de ruteo
switch ($params[0]) {
    case 'login':
        $authController = new AuthController();
        $authController->showFormLogin($req, $res);
        break;
    case 'validate':
        $authController = new AuthController();
        $authController->validateUser($req,  $res);
        break;
    case 'logout':
        $authController = new AuthController();
        $authController->logout($req,$res);
        break;
    case 'list':
        $taskController = new TaskController();
        $taskController->showTasks($req, $res);
        break;
    case 'add':
        $taskController = new TaskController();
        $taskController->addTask($req, $res);
        break;
    case 'delete':
        $taskController = new TaskController();
        $taskController->deleteTask($req,$res);
        break;
    case "finalize":  // finalize/:ID
        $taskController = new TaskController();
        $taskController->finalizeTask($req,  $res);
        break;
    default:
        echo('404 Page not found');
        break;
}
