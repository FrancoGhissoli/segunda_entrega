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


    public function getgamebyid($id)
    {
        $query = $this->db->prepare("SELECT * FROM games WHERE id = ?");
        $query->execute([$id]);
        $games = $query->fetch(PDO::FETCH_OBJ);
        return $games;
    }
    public function deleteGameById($id)
    {
        $query = $this->db->prepare('DELETE FROM games WHERE id = ?');
        $query->execute([$id]);
    }
    public function addNewGame($Nombre, $Descripcion, $Anio, $id_genero)
    {
        $query = $this->db->prepare("INSERT INTO games (Nombre, Descripcion, Anio, id_genero) VALUES (?,?,?,?)");
        $query->execute([$Nombre, $Descripcion, $Anio, $id_genero]);
        return $this->db->lastInsertId();
    }
    
    
    
    
    
    public function getAllGamesByOrder()
    {
        $query = $this->db->prepare("SELECT * FROM `games` ORDER BY Nombre ASC");
        $query->execute();
        $games = $query->fetchAll(PDO::FETCH_OBJ);
        return $games;
    }
    public function getAllGamesByOrderDesc()
    {
        $query = $this->db->prepare("SELECT * FROM `games` ORDER BY Nombre DESC");
        $query->execute();
        $games = $query->fetchAll(PDO::FETCH_OBJ);
        return $games;
    }
    public function editGameById($Nombre,$Descripcion,$Anio,$id_genero,$id){
        $query = $this->db->prepare("UPDATE `games` SET Nombre = ? , Descripcion = ? , Anio = ? , id_genero = ?, WHERE id = ?");
        $query->execute([$Nombre,$Descripcion,$Anio,$id_genero,$id]);
    }
    
}
