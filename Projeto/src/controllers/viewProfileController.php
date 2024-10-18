<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;

class viewProfileController extends Controller {

    public function index() {

        if(!empty($_SESSION['userLogado']['id'])){
            $usuarioId = $_SESSION['userLogado']['id'];
    
            $usuario = Usuario::select()->where('id', $usuarioId)->execute();
    
            $projects = Project::select()
                ->join('usuarios', 'usuarios.id', '=', 'projects.usuario_id')
                  ->where('projects.usuario_id', $usuarioId)
                ->execute();
        
            // var_dump($usuario);
        
            $context = [
                'user' => $usuario,
                'projects' => $projects,
            ];
        
            $this->render('viewProfile', $context);
        }
        $this->render('/login');
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
