<?php

namespace src\controllers;

use \core\Controller;
use src\models\Event;
use \src\models\Usuario;
use \src\models\Project;

class eventoController extends Controller{
    public function index() {

        $listaJams = Event::buscar(); 

        $context = [
            'jams' => $listaJams,
        ];
        $this->render('eventos', $context);
    }
    public function createJam(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Olá bolo\n";
            $nomeJam = filter_input(INPUT_POST, 'nomeInput');
            $descricaoJam = filter_input(INPUT_POST, 'descricaoInput');
            echo $nomeJam . $descricaoJam;

            if ($nomeJam && $descricaoJam) {
                Event::insertEvent();
            }
            // $this->redirect('/eventos');
        }
    }
}
