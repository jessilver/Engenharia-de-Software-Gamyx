<?php

namespace src\controllers;

use \core\Model;
use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;

class viewProfileController extends Controller
{

    public function index() {
        // $usuarioId = $_SESSION['userLogado']['id'];
        $usuarioId = $_SESSION['userLogado'] ?? null;

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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['search_query'])) {
                $usuarioPesquisado = $_POST['search_query'];
                // Busca o usuário no banco de dados
                $usuario = Usuario::select()->where('nomeUsuario', $usuarioPesquisado)->execute();
                if (!empty($usuario)) {
                    $projects = Project::select()
                        ->join('usuarios', 'usuarios.id', '=', 'projects.usuario_id')
                        ->where('projects.usuario_id', $usuario[0]['id'])
                        ->execute();
                    $context = [
                        'user' => $usuario[0], //O [0] é porque a pesquisa retorna um array de usuarios, queremos somente o primeiro encontrado
                        'projects' => $projects
                    ];
                    $this->render('othersProfile', $context);
                    return;
                }
            }
            //Usuário não encontrado ou busca vazia, retorna para o perfil atual
            $this->index();
        }
    }
}
