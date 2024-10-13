<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/perfil', 'viewProfileController@index');
$router->get('/perfil/{id}', 'viewProfileController@other');

$router->get('/sobre/{nome}', 'HomeController@sobreP');
$router->get('/sobre', 'HomeController@sobre');