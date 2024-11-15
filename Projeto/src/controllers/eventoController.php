<?php

namespace src\controllers;

use \core\Controller;
use src\models\GameJam;
use \src\models\Usuario;
use \src\models\Project;

class eventoController extends Controller{
    public function index() {

        $listaJams = GameJam::getAllJams();
        $usuariosHost = array();
        foreach($listaJams as $jam){
            $usuariosHost[] = GameJam::getHostById($jam['host_id']);
        }
        
        $context = [
            'jams' => $listaJams,
            'usuariosHost' => $usuariosHost,
        ];

        $this->render('eventos', $context);
    }
    public function createJam(){
        $hostId = $_SESSION['userLogado']['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $nomeJam = filter_input(INPUT_POST, 'nomeInput');
            $descricaoJam = filter_input(INPUT_POST, 'descricaoInput');

            if ($nomeJam && $descricaoJam) {
                GameJam::createJam($hostId, $nomeJam, $descricaoJam);
            }
            $this->redirect('/eventos');
        }
    }
}
