<?php
require_once './app/models/task.model.php';
require_once './app/views/task.view.php';

class TaskController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new TaskModel();
        $this->view = new TaskView();
    }

    public function showTasks($req, $res) {
        if(!isset($req->user)) {
            $res->redirect('/login');
            return;
        }
        $tareas = $this->model->getAllTasks();
        $this->view->showTasks($tareas);
    }

    
    function addTask($req, $res) {
        if(!isset($req->user)) {
            $res->redirect('/login');
            return;
        }
        // TODO: validar entrada de datos

        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];

        $id = $this->model->insertTask($title, $description, $priority);

        header("Location: " . BASE_URL); 
    }
   
    function deleteTask($req, $res) {
        $id = $req->params[0];
        $this->model->deleteTaskById($id);
        header("Location: " . BASE_URL);
    }

    function finalizeTask($req, $res) {
        $id = $req->params[0];
        $this->model->finalize($id);
        header("Location: " . BASE_URL); 
    }


}
