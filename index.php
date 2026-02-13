<?php  
define('ROOT_PATH', __DIR__);
define('ROOT_URL', 'http://localhost:8888/orphee/POO/TP-CRUD');

require_once 'Core/Autoload.php';

$router = new Core\Router;

$router->route();