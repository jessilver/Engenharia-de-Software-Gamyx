<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;

class viewProfileController extends Controller {

    public function index() {
        $usuarioId = $_SESSION['userLogado']['id'];

        $usuario = Usuario::select()->where('id', $usuarioId)->execute();

        $projects = Project::select()
            ->join('usuarios', 'usuarios.id', '=', 'projects.usuario_id')
            ->where('projects.usuario_id', $usuarioId)
            ->execute();
    
        // var_dump($usuario);
    
        $context = [
            'user' => $usuario,
            'projects' => $projects
        ];
    
        $this->render('viewProfile', $context);
    }
    
    public function other($id) {
        $usuarioId = $id['id'];

        $usuario = Usuario::select()->where('id', $usuarioId)->execute();

        $projects = Project::select()
            ->join('usuarios', 'usuarios.id', '=', 'projects.usuario_id')
            ->where('projects.usuario_id', $usuarioId)
            ->execute();
    
        // var_dump($usuario);
    
        $context = [
            'user' => $usuario,
            'projects' => $projects
        ];
    
        $this->render('test', $context);
    }
}
