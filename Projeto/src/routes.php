<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/perfil', 'viewProfileController@index');
$router->post('/perfil', 'viewProfileController@other'); // Alterado para lidar com POST

$router->get('/login','userController@index');
$router->post('/login','userController@auth');
$router->get('/menu', 'MenuController@index');
$router->post('/deleteUsuario', 'deleteUsuarioController@delete');
$router->post('/deleteProject', 'deleteProjectController@delete');

$router->get('/projeto/{id}', 'viewProjectController@index');
$router->post('/perfil/edit/{id}', 'viewProfileController@edit');
$router->post('/perfil/logout', 'viewProfileController@logout');
$router->post('/perfil/delete/{id}', 'viewProfileController@delete');

$router->get('/sobre/{nome}', 'HomeController@sobreP');
$router->get('/sobre', 'HomeController@sobre');
$router->get('/cadastrarUsuario', 'UserController@cadastroUsuario');
$router->post('/cadastrarUsuario', 'UserController@cadastroUsuarioAction');