<?php
use core\Router;

$router = new Router();

//Rota para a página inicial
$router->get('/', 'HomeController@index');

//Rotas para a página de perfil
$router->get('/perfil', 'ViewProfileController@index');
$router->post('/perfil', 'ViewProfileController@other'); // Alterado para lidar com POST

//Rotas para a página de login e sing in
$router->get('/login','UserController@index');
$router->get('/login','UserController@login');
$router->post('/login','UserController@auth');
$router->post('/logout', 'UserController@logout');
$router->get('/cadastrarUsuario', 'UserController@cadastroUsuario');
$router->post('/cadastrarUsuario', 'UserController@cadastroUsuarioAction');

//Rota para o menu
$router->get('/menu', 'MenuController@index');

//Rotas para o usuario
$router->post('/perfil/edit/{id}', 'ViewProfileController@edit');
$router->post('/perfil/logout', 'ViewProfileController@logout');
$router->post('/perfil/delete/{id}', 'ViewProfileController@delete');
$router->post('/deleteUsuario', 'UserController@delete');
$router->get('/perfil/{id}', 'ViewProfileController@other');
$router->get('/sobre/{nome}', 'HomeController@sobreP');
$router->get('/sobre', 'HomeController@sobre');

//Rotas para a página de projeto
$router->get('/projeto/{id}', 'ViewProjectController@index');
$router->get('/novoProjeto', 'CadastrarProjeto@index');
$router->post('/novoProjeto', 'CadastrarProjeto@cadastrarProjetoAction');
$router->post('/editProject', 'ViewProjectController@edit');
$router->post('/deleteProject', 'ViewProjectController@delete');
$router->post('/projeto/review', 'ReviewsController@review');
$router->post('/search', 'SearchProjectController@searchProjectAction');

//Rotas para amigos
$router->post('/add-friend', 'friendController@addFriend');
$router->post('/deleteFriend', 'friendController@deleteFriend');

// Rota API para busca de usuários
$router->get('/api/busca-usuario/{id}', 'apiBuscaUsuarioController@index');
$router->get('/api/friends/{id}', 'friendController@api');

// Rota API para reviews
$router->get('/api/reviews/{id}', 'reviewsController@getReviewsApi');
$router->get('/api/all-projects-reviews', 'reviewsController@getAllProjectsReviews');
$router->get('/user/{id}/projetos', 'ProjectController@getAllProjects');

// Api para busca de projetos
$router->get('/api/busca-projeto/{id}', 'FavoritesController@get_all_Favorites_api');
$router->get('/api/busca-projeto/add/{project}/{user}', 'FavoritesController@add_favorite_api');
$router->get('/api/busca-projeto/delete/{project}/{user}', 'FavoritesController@remove_favorite_api');
$router->get('/api/busca-projeto/check/{project}/{user}', 'FavoritesController@check_favorite_api');
