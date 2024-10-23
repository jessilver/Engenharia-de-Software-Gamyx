<?php
namespace src\controllers;

use \core\Model;
use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;

class viewProfileController extends Controller {

    public function index() {
        // $usuarioId = $_SESSION['userLogado']['id'];
        $usuarioId = $_SESSION['userLogado']['id'] ?? 1;

        $usuario = Usuario::selectUser($usuarioId);
        $projects = Project::selectProjectByUserId($usuarioId);
    
        $context = [
            'user' => $usuario,
            'HashUserId' => Model::encryptData($usuarioId),
            'projects' => $projects
        ];
    
        $this->render('viewProfile', $context);
    }
    
    public function edit($id){
        $usuarioId = Model::decryptData($id['id']);
        
        $about = $_POST['about'];
        $linkPortfolio = $_POST['linkPortfolio'];

        $fields = [
            'about' => $about,
            'urlPortfolio' => $linkPortfolio
        ];
        Usuario::updateUser($usuarioId , $fields);
        $this->redirect('/perfil');
    }

    public function logout(){
        session_destroy();
        $this->redirect('/');
    }

    public function delete($id){
        $usuarioId = Model::decryptData($id['id']);
        Usuario::deleteUser($usuarioId);
        // $this->redirect('/');
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
