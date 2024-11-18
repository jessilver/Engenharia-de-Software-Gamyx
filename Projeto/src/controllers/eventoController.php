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
    public function deleteJam() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jamId = filter_input(INPUT_POST, 'jam_id', FILTER_VALIDATE_INT);
            if (!$jamId) {
                $_SESSION['error'] = "ID da Game Jam inválido.";
                $this->redirect('/eventos');
                return;
            }
            $jam = GameJam::getJamById($jamId);
            if ($jam != null) {
                GameJam::deleteJamById($jamId);
                $_SESSION['success'] = "Game Jam deletada com sucesso!";
                $this->redirect('/eventos');
            } else {
                $_SESSION['error'] = "A Game Jam não foi encontrada ou você não tem permissão para deletá-la.";
                $this->redirect('/eventos');
            }
        } else {
            $_SESSION['error'] = "Método não permitido.";
            $this->redirect('/eventos');
        }
    }
    
    public function joinJam() {
        // Recupera o ID do usuário logado e o ID da Game Jam do formulário
        $userId = $_SESSION['userLogado']['id'] ?? null;
        $jamId = filter_input(INPUT_POST, 'jam_id', FILTER_VALIDATE_INT);
    
        // Verifica se o usuário está logado e o ID da Game Jam é válido
        if (!$userId) {
            $this->redirect('/login');
            return;
        }
    
        if (!$jamId) {
            $_SESSION['error'] = 'Game Jam inválida.';
            $this->redirect('/eventos');
            return;
        }
    
        try {
            // Adiciona o usuário na Game Jam
            ParticipantesJam::joinJam($jamId, $userId);
            $_SESSION['success'] = 'Você entrou na Game Jam com sucesso!';
        } catch (\Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    
        // Redireciona para a página de eventos
        $this->redirect('/eventos');
    }
      
}
