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

    public function getGames($params = null)
    {
        if (!empty($_GET['orderby'])) {
            $this->getByOrder();
        } else {
            $games = $this->model->getAllGames();
            $this->view->response($games);
        }
    }
    public function getByOrder()
    {
        if (!empty($_GET['orderby'])) {
            if ($_GET['orderby'] == "asc" || $_GET['orderby'] == "ASC") {
                $games =  $this->model->getAllGamesByOrder();
                return $this->view->response($games);
            } else if ($_GET['orderby'] == "desc" || $_GET['orderby'] == "DESC") {
                $games =  $this->model->getAllGamesByOrderDesc();
                return $this->view->response($games);
            }
            return $this->view->response("Vuelva a escribir el orderby(verifique la documentacion)", 400);
        }
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
        $games = $this->model->getgamebyid($id);

        if ($games) {
            $this->model->deleteGameById($id);
            $this->view->response("El juego se elimino correctamente", 200);
            $this->view->response($games);
        } else {
            $this->view->response("El juego que se quiere eliminar no existe(id:$id)", 404);
        }
    }
    public function addGame($params = null)
    {
        $games = $this->getData();

        if (empty($games->Nombre) || empty($games->Descripcion) || empty($games->Anio) || empty($games->id_genero)) {
            $this->view->response("Complete todos los datos (Campos) y vuelva a intentarlo", 400);
        } else {
            $id = $this->model->addNewGame($games->Nombre, $games->Descripcion, $games->Anio, $games->id_genero);
            $games = $this->model->getgamebyid($id);
            $this->view->response("Se agrego la informacion del Juego corectamente", 201);
        }
    }
    public function editGame($params = null)
    {
        $id = $params[':ID'];
        $games = $this->model->getgamebyid($id);
        $gameedit= $this->getData();

        if($games){
            $this->model->editGameById($gameedit->Nombre, $gameedit->Descripcion, $gameedit->Anio, $gameedit->id_genero, $id); 
            $this->view->response("La Informacion del Juego se edito correctamente", 200);
            
        }
        else {
            $this->view->response("La informacion no es correcta o no se encontro el producto con el id", 404);
        }

    }
}
