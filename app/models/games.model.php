<?php

class GamesApiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_gamestp;charset=utf8', 'root', '');
    }
    public function getAllGames()
    {
        $query = $this->db->prepare("SELECT games.*, gender.Nombregenero as gender FROM games JOIN gender ON games.id_genero = gender.id_genero");
        $query->execute();
        $games = $query->fetchAll(PDO::FETCH_OBJ);
        return $games;
    }
    // public function getAllGamesByOrder($order = null)
    // {
    //     if (!empty($order)) {
    //         if ($order == "DESC" || $order == "desc") {
    //             $query = $this->db->prepare("SELECT * FROM `games` ORDER BY Nombre DESC");
    //             $query->execute();
    //             $gamesorder = $query->fetchAll(PDO::FETCH_OBJ);
    //             return $gamesorder;
    //         } else if ($order == "ASC" || $order == "asc") {
    //             $query = $this->db->prepare("SELECT * FROM `games` ORDER BY Nombre ASC");
    //             $query->execute();
    //             $gamesorder = $query->fetchAll(PDO::FETCH_OBJ);
    //             return $gamesorder;
    //         }
    //     }
    //     }
            public function getgamebyid($id){
                $query = $this->db->prepare("SELECT * FROM games WHERE id = ?");
                $query->execute([$id]);
                $games = $query-> fetch(PDO::FETCH_OBJ);
                return $games;
            }
            public function deleteGameById($id){
                $query = $this->db->prepare('DELETE FROM games WHERE id = ?');
                $query-> execute([$id]);
            }
    }
