<?php
namespace src\controllers;
use core\Controller;
use src\Config;
use src\models\Usuario;

class DeleteUsuarioController extends Controller {
    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = htmlspecialchars(filter_input(INPUT_POST, 'deleteUserId', FILTER_VALIDATE_INT));
            
            if ($id) {
                $usuarioModel = new Usuario();
                $result = $usuarioModel->deleteById($id);

                if ($result) {
                    $_SESSION['message'] = "Usuário deletado com sucesso.";
                    $this->redirect('/login');
                } else {
                    $_SESSION['error'] = "Erro ao deletar usuário.";
                    $this->redirect('/perfil');
                }
            } else {
                $_SESSION['error'] = "ID do usuário não fornecido ou inválido.";
                $this->redirect('/perfil');
            }
        } else {
            $_SESSION['error'] = "Método de requisição inválido.";
            $this->redirect('/perfil');
        }
    }
}