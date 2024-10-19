<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/perfil', 'viewProfileController@index');
$router->post('/perfil', 'viewProfileController@other'); // Alterado para lidar com POST

$router->get('/projeto/{id}', 'viewProjectController@index');

$router->get('/sobre/{nome}', 'HomeController@sobreP');
$router->get('/sobre', 'HomeController@sobre');