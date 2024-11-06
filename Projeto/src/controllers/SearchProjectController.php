<?php
namespace src\controllers;

use core\Controller;
use src\models\Project;
use src\models\Usuario;

class SearchProjectController extends Controller {

    public function searchProjectAction() {
        $filterUser = filter_input(INPUT_POST, "filterProject");
        $inputFilter = filter_input(INPUT_POST, "projectSearchInput");
        $usuarioId = $_SESSION['userLogado']['id'];

        $usuario = Usuario::select()->where('id', $usuarioId)->first();
        
        if (!$usuario) {
            $this->redirect('/login');
            return;
        }
        
        $friends = Usuario::select()
        ->join('friends', function($join) use ($usuario) {
            $join->on('friends.friend_1', '=', 'usuarios.id')
                 ->orOn('friends.friend_2', '=', 'usuarios.id');
        })
        ->where(function($query) use ($usuario) {
            $query->where('friends.friend_1', '=', $usuario['id'])
                  ->orWhere('friends.friend_2', '=', $usuario['id']);
        })
        ->execute();

        $projetos = [];

        $filterColumn = $filterUser === 'nomeProjeto' ? 'nomeProjeto' : 'sistemasOperacionaisSuportados';

        $projetos = Project::select()
            ->where('usuario_id', $usuarioId)
            ->where($filterColumn, 'LIKE', '%' . $inputFilter . '%')
            ->execute();

        $context = ['projects' => $projetos, 'user' => $usuario, 'friends' => $friends];
        $this->render('viewProfile', $context);
    }

    
    
}
