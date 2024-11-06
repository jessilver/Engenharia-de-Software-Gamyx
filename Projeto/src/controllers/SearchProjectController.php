<?php
namespace src\controllers;

use core\Controller;
use src\models\Project;
use src\models\Usuario;

class SearchProjectController extends Controller {

    public function searchProjectAction() {
        $filterUser = filter_input(INPUT_POST, "filterProject");
        $inputFilter = filter_input(INPUT_POST, "projectSearchInput");
        $usuarioId = $_SESSION['userLogado']['id'] ?? null;

        $usuario = Usuario::select()->where('id', $usuarioId)->execute();
        
        if (!$usuarioId) {
            $this->redirect('/login');
            return;
        }

        $filterColumn = $filterUser === 'nomeProjeto' ? 'nomeProjeto' : 'sistemasOperacionaisSuportados';

        $projetos = Project::select()
            ->where('usuario_id', $usuarioId)
            ->where($filterColumn, 'LIKE', '%' . $inputFilter . '%')
            ->execute();

        $context = ['projects' => $projetos, 'user' => $usuario];
        $this->render('viewProfile', $context);
    }

    
    
}
