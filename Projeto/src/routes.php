<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/perfil', 'viewProfileController@index');
$router->get('/perfil/{id}', 'viewProfileController@other');
$router->get('/login','userController@index');
$router->post('/login','userController@auth');
$router->get('/menu', 'MenuController@index');

$router->get('/sobre/{nome}', 'HomeController@sobreP');
$router->get('/sobre', 'HomeController@sobre');