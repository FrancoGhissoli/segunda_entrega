<?php

class GamesApiModel{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_gamestp;charset=utf8', 'root', '');
    }
    public function getAllGames(){
        $query = $this->db->prepare("SELECT games.*, gender.Nombregenero as gender FROM games JOIN gender ON games.id_genero = gender.id_genero");
        $query->execute();
        $games = $query-> fetchAll(PDO::FETCH_OBJ);
        return $games;
    }

}