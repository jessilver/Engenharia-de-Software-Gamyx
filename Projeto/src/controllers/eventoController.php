<?php

namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;

class eventoController extends Controller{
    public function index() {
        $this->render('eventos');
    }

}
