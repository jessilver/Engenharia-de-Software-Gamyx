<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Project;

class HomeController extends Controller {

    public function index() {
        $projetos = Project::selectAllProjects();

        $context = [
            'projetos' => $projetos
        ];
        $this->render('home', $context);
    }

    public function sobre() {
        $this->render('sobre');
    }

    public function sobreP($args) {
        print_r($args);
    }

}