<?php
namespace src\controllers;

use core\Controller;
use src\models\Project;
use src\models\Usuario;

class SearchProjectController extends Controller {

    public function searchProjectAction(){
        $filterUser = filter_input(INPUT_POST, "filterProject");
        $inputFilter = filter_input(INPUT_POST, "projectSearchInput");
        $usuarioId = $_SESSION['userLogado']['id'] ?? null;
        $usuario = Usuario::selectUser($usuarioId);

        $filterUser == 'nomeProjeto' ? $filter = 'name' : $filter =  'SO';

        if($filter == 'name'){
            $projetos = Project::select()->where('nomeProjeto', $inputFilter)->execute();
        } else {
            $projetos = Project::select()->where('sistemasOperacionaisSuportados', 'LIKE', '%' . $inputFilter . '%')->execute();
        }

        count($projetos) == 0 ? $projetos = [] : $projetos = $projetos;

        $this->render('viewProfile', ['projects' => $projetos, 'user' => $usuario]);

    }
    
    
}
