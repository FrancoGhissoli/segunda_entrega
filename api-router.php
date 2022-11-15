<?php
require_once './libs/Router.php';
require_once './app/controllers/games-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('games', 'GET', 'GamesApiController', 'getGames');
$router->addRoute('games/:ID', 'GET', 'GamesApiController', 'getGame');
$router->addRoute('games/:ID', 'DELETE', 'GamesApiController', 'deleteGame');
$router->addRoute('games', 'POST', 'GamesApiController', 'addGame');
$router->addRoute('games/:ID', 'PUT', 'GamesApiController', 'editGame');




// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
