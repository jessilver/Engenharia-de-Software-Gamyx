<?php
namespace src\controllers;

use \core\Controller;

class HomeController extends Controller {

    public function index() {


        $_SESSION['userLogado'] = [
            'id' => 1,
        ];
        $this->redirect('/login');
    }

    public function sobre() {
        $this->render('sobre');
    }

    public function sobreP($args) {
        print_r($args);
    }

}