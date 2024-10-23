<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;

class viewProjectController extends Controller {

    public function index($id) {
        // Obtém o ID do projeto da URL
        $projetoId = $id['id']; // O ID virá da URL

        // Busca o projeto pelo ID utilizando o novo método selectProject
        $project = Project::selectProject($projetoId);

        // Verifica se o projeto foi encontrado
        if (!empty($project)) {
            // Busca as informações do criador do projeto
            $usuarioId = $project['usuario_id'];
            
            // Busca o usuário pelo ID utilizando o novo método selectUser
            $usuario = Usuario::selectUser($usuarioId);

            // Prepara os dados para a view
            $context = [
                'project' => $project,
                'usuario' => !empty($usuario) ? $usuario : null // Verifica se o usuário foi encontrado
            ];

            // Renderiza a view com os dados
            $this->render('viewProject', $context);
        } else {
            // Renderiza a página 404 se o projeto não for encontrado
            $this->render('404');
        }
    }
}
