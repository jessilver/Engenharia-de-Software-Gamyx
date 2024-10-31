<?php
namespace src\controllers; // Certifique-se de que o namespace está correto

use core\Controller;
use src\models\Usuario;

class DeleteUsuarioController extends Controller {
    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_SESSION['userLogado']['id'])) {
                $id = $_SESSION['userLogado']['id'];
                error_log("Tentando deletar usuário com ID: $id");

                $usuarioModel = new Usuario();
                $result = $usuarioModel->deleteById($id);

                if ($result) {
                    error_log("Usuário com ID: $id deletado com sucesso.");
                    session_unset(); // Limpa a sessão após a exclusão
                    $_SESSION['message'] = "Usuário deletado com sucesso.";
                    $this->redirect('/login');
                } else {
                    error_log("Erro ao deletar usuário com ID: $id");
                    $_SESSION['error'] = "Erro ao deletar usuário.";
                    $this->redirect('/perfil');
                }
            } else {
                error_log("Usuário não está logado.");
                $_SESSION['error'] = "Usuário não está logado.";
                $this->redirect('/login');
            }
        } else {
            error_log("Método de requisição inválido.");
            $_SESSION['error'] = "Método de requisição inválido.";
            $this->redirect('/perfil');
        }
    }
}