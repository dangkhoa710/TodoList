<?php
$controllerName = ucfirst((strtolower($_REQUEST['controller'] ?? '' )). 'Controller');
$actionName = strtolower($_REQUEST['action'] ?? 'index');

require "Controllers/${controllerName}.php";

$controllerObject = new $controllerName;
$controllerObject->$actionName();
