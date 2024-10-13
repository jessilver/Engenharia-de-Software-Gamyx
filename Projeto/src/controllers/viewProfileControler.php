<?php
namespace src\controllers;

use \core\Controller;

class viewProfileControler extends Controller {

    public function index() {
        $this->render('viewProfile');
    }

}