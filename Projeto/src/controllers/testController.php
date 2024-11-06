<?php
namespace src\controllers;

use core\Controller;
use src\Config;

class TestController extends Controller {
    public function index() {
        // Obtenha os dados necessários para a visão
        $user = [
            ['id' => 1, 'nomeUsuario' => 'usuario1', 'email' => 'usuario1@example.com'],
            // Adicione mais usuários conforme necessário
        ];
        $projects = [
            ['id' => 1, 'nomeProjeto' => 'Projeto 1', 'linkDownload' => 'link1'],
            // Adicione mais projetos conforme necessário
        ];

        // Renderize a visão e passe os dados
        $this->view('pages/testeG', [
            'user' => $user,
            'projects' => $projects,
            'baseDir' => Config::BASE_DIR // Passe o caminho base necessário
        ]);
    }
}