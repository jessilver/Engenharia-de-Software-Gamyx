<?php
use core\Router;

$router = new Router();

//Home
$router->get('/', 'HomeController@index');
//Perfil do usuários e de outros usuários
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

$router->post('/add-friend', 'friendController@addFriend');
$router->post('/deleteFriend', 'friendController@deleteFriend');

$router->get('/novoProjeto', 'CadastrarProjeto@index');
$router->post('/novoProjeto', 'CadastrarProjeto@cadastrarProjetoAction');
$router->post('/search', 'SearchProjectController@searchProjectAction');

// Rota API's
$router->get('/api/busca-usuario/{id}', 'apiBuscaUsuarioController@index');
$router->get('/api/friends/{id}', 'friendController@api');
$router->get('/user/{id}/projetos', 'ProjectController@getAllProjects');
$router->get('/api/reviews/{id}', 'reviewsController@getReviewsApi');
$router->get('/api/all-projects-reviews', 'reviewsController@getAllProjectsReviews');
//Game jams
$router->get('/eventos', 'eventoController@index');
$router->get('/eventos/{id}', 'eventoController@deleteJam');
$router->get('/eventos/{id}/{userId}', 'eventoController@joinJam');
$router->post('/eventos', 'eventoController@createJam');