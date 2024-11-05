<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/perfil', 'ViewProfileController@index');
$router->post('/perfil', 'ViewProfileController@other'); // Alterado para lidar com POST

$router->get('/login','UserController@index');
$router->post('/login','UserController@auth');
$router->post('/logout', 'UserController@logout');
$router->get('/menu', 'MenuController@index');
$router->post('/deleteUsuario', 'UserController@delete');
$router->post('/deleteProject', 'ViewProjectController@delete');
$router->get('/projeto/{id}', 'ViewProjectController@index');
$router->post('/perfil/edit/{id}', 'ViewProfileController@edit');
$router->post('/perfil/logout', 'ViewProfileController@logout');
$router->post('/perfil/delete/{id}', 'ViewProfileController@delete');

$router->get('/perfil/{id}', 'ViewProfileController@other');
$router->get('/login','UserController@login');
$router->get('/sobre/{nome}', 'HomeController@sobreP');
$router->get('/sobre', 'HomeController@sobre');
$router->get('/cadastrarUsuario', 'UserController@cadastroUsuario');
$router->post('/cadastrarUsuario', 'UserController@cadastroUsuarioAction');
$router->post('/projeto/review', 'ReviewsController@review');


$router->post('/editProject', 'ViewProjectController@edit');