<?php
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/config/Db.php';


// Configuración de la base de datos
$dbConfig = [
    'host' => 'localhost',
    'dbname' => 'gestion_equipos',
    'username' => 'root',
    'password' => ''
];

$database = new Database($dbConfig);

// Configurar rutas
$router = new Router();


$router->addRoute('GET', '/', 'EquipoController@index');
$router->addRoute('GET', '/index.php/equipos/add', 'EquipoController@add');
$router->addRoute('POST', '/index.php/equipos', 'EquipoController@validations');
$router->addRoute('GET', '/index.php/equipos/(\d+)', 'EquipoController@info');


$router->dispatch();