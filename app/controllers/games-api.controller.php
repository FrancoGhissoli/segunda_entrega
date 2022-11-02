<?php
require_once './app/models/games.model.php';
require_once './app/views/games.view.php';

class GamesApiController
{
    private $model;
    private $view;
    private $data;

    public function __construct()
    {
        $this->model = new GamesApiModel();
        $this->view = new GamesApiview();
       
        $this->data = file_get_contents("php://input");
    }
    private function getData(){
        return json_decode($this->data);
    }
    public function getGames($params = null)
    {
        $games = $this->model->getAllGames();
        $this->view->response($games);
    }
    public function getGame($params = null)
    {
        $id = $params[':ID'];
        $games = $this->model->getgamebyid($id);

        if ($games)
            $this->view->response($games);
        else
            $this->view->response("La tarea con el id=$id no existe", 404);
    }
}
