<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;

class viewProfileController extends Controller {

    public function index() {
        $usuario = Usuario::select()->where('id', 1)->execute();
    
        // var_dump($usuario);
    
        $context = [
            'user' => $usuario,
        ];
    
        $this->render('viewProfile', $context);
    }
    
}
