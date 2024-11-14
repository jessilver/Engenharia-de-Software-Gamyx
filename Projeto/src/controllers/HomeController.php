<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Project;
use src\models\Usuario;

class HomeController extends Controller {

    public function index() {
        $projetos = Project::selectAllProjects();
        $donos = [];
        foreach($projetos as $projeto){
            $idUsuario = $projeto['usuario_id'];
            $donos[] = Usuario::selectUser($idUsuario);
        }

        $context = [
            'projetos' => $projetos,
            'usuarios' => $donos
        ];
        $this->render('home', $context);
    }

    public function sobre() {
        $this->render('sobre');
    }

    public function sobreP($args) {
        print_r($args);
    }

    public function feed(){
        $this->render('feedInicial');
    }

}