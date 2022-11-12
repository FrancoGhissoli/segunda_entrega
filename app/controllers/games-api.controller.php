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
    private function getData()
    {
        return json_decode($this->data);
    }
    // public function getGamesByorder($params = null)
    // {
    //     if(!empty($params['?order'])){
    //         $order = $params['?order'];
    //     if($order == "DESC" || $order == "desc"){
    //         $gamesorder = $this->model->getAllGamesByOrder($order);
    //         $this->view->response($gamesorder);
    //     }else if($order == "ASC" || $order == "asc"){
    //         $gamesorder = $this->model->getAllGamesByOrder($order);
    //         $this->view->response($gamesorder);
    // }
    // }
    // }
    public function getGames($params = null)
    {
        $games = $this->model->getAllGames();
        $this->view->response($games);
    }
    public function getGame($params = null)
    {
        $id = $params[':ID'];
        $games = $this->model->getgamebyid($id);
        if ($games) {
            $this->view->response($games);
        } else {
            $this->view->response("El Juego que se quiere obtener no existe(id:$id)", 404);
        }
    }
    public function deleteGame($params = null)
    {
        $id = $params[':ID'];
        $game = $this->model->getgamebyid($id);
       
        if ($game) {
            $this->model->deleteGameById($id);
            $this->view->response("El juego se elimino correctamente", 200);
            $this->view->response($game);
           
        } else {
            $this->view->response("El juego que se quiere eliminar no existe(id:$id)", 404);
        }
    }
   
}
