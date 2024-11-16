<?php

namespace src\controllers;

use \core\Controller;
use src\models\GameJam;

class eventoController extends Controller{
    public function index(){

        $listaJams = GameJam::getAllJams();
        $usuariosHost = array();
        foreach ($listaJams as $jam) {
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
        if ($hostId != null) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $nomeJam = filter_input(INPUT_POST, 'nomeInput');
                $descricaoJam = filter_input(INPUT_POST, 'descricaoInput');

                if ($nomeJam && $descricaoJam) {
                    GameJam::createJam($hostId, $nomeJam, $descricaoJam);
                }
                $this->redirect('/eventos');
            }
        }else
            $this->redirect('/login');
    }
    public function deleteJam($id){
        $jamId = $id['id'];
        $jam = GameJam::getJamById($jamId);

        if($jam != null){
            GameJam::deleteJamById($jamId);
            $this->redirect('/eventos');
            echo "sucesso";
        }else {
            // Jam não encontrada ou usuário não tem permissão
            $_SESSION['error'] = "A game jam não foi encontrada ou você não tem permissão para deletá-la.";
            echo "A game jam não foi encontrada ou você não tem permissão para deletá-la.";
            $this->redirect('/eventos');
        }
    }
}
