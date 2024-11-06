<?php
namespace src\controllers;

use core\Controller;
use src\models\Usuario;

class DeleteUsuarioController extends Controller {
    public function delete() {
        if (isset($_SESSION['userLogado'])) {
            $usuarioId = $_SESSION['userLogado']['id'];
            $result = Usuario::deleteUser($usuarioId);

            if ($result) {
                error_log("Usuário com ID: $usuarioId deletado com sucesso.");
                session_unset();
                $this->redirect('/login');
            } else {
                error_log("Erro ao deletar usuário com ID: $usuarioId");
                $_SESSION['error'] = "Erro ao deletar usuário.";
                $this->redirect('/perfil');
            }
        } else {
            error_log("Usuário não está logado.");
            $_SESSION['error'] = "Usuário não está logado.";
            $this->redirect('/login');
        }
    }
}