<?php

define('ROOT' , dirname(__FILE__) . "/");
require ROOT . 'app/App.php';
App::load();

if (isset($_GET['p']))
{
    $page = $_GET['p'];
}
else
{
    $page = 'index.home';
}

$page = explode('.',$page);

if(isset($page[0]))
{
    $controller = '\App\Controller\\' .ucfirst($page[0]) . 'Controller';
    $action = $page[1];
}

$controller = new $controller();
$controller->$action();