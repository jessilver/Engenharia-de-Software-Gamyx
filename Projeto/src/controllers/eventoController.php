<?php

namespace src\controllers;

use \core\Controller;
use src\models\GameJam;
use src\models\ParticipantesJam;

class eventoController extends Controller{
    public function index(){

        $listaJams = GameJam::getAllJams();
        $usuariosHost = array();
        $participantes = array();
        foreach ($listaJams as $jam) {
            $usuariosHost[] = GameJam::getHostById($jam['host_id']);
            $participantes[] = ParticipantesJam::getParticipantsByJamId($jam['id']);
        }

        $context = [
            'jams' => $listaJams,
            'usuariosHost' => $usuariosHost,
            'participantes' => $participantes
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
    public function joinJam($id, $userId){
        var_dump($id, $userId); // Verifica os valores recebidos
        // Verifica se o ID do usuário está presente
        if ($userId == null) {
            $this->redirect('/login');
            return;
        }
        try { 
            // Chama o método para adicionar o usuário na Game Jam
            ParticipantesJam::joinJam($id, $userId);
            $this->redirect('/eventos');
    
        } catch (\Exception $e) {
            // Em caso de erro, redireciona com a mensagem de erro
            $_SESSION['error'] = 'Erro ao entrar na Game Jam: ' . $e->getMessage();
            $this->redirect('/eventos');
        }
    }
      
}
