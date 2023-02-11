<?php
require "./Controllers/Controller.php";


$controllerName = ucfirst((strtolower($_REQUEST['controller'] ?? '')) . 'Controller');
$actionName = strtolower($_REQUEST['action'] ?? 'index');

if ($controllerName != 'Controller') {
    require "Controllers/${controllerName}.php";
}


$controllerObject = new $controllerName;
$controllerObject->$actionName();
