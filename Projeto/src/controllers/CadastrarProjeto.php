<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Project;

class CadastrarProjeto extends Controller {
    public function index(){
        $this->render('cadastrarProjeto');
    }
}