<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Project;

class deleteProjectController extends Controller {
    public function delete() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_SESSION['userLogado'])) {
                $projectId = $_POST['projectId'];
                $userId = $_SESSION['userLogado'];

                // Verificar se o projeto pertence ao usuário logado
                $project = Project::select()->where('id', $projectId)->where('usuario_id', $userId)->first();
                if ($project) {
                    $result = Project::delete($projectId);
                    if ($result) {
                        $_SESSION['message'] = "Projeto deletado com sucesso.";
                    } else {
                        $_SESSION['error'] = "Erro ao deletar projeto.";
                    }
                } else {
                    $_SESSION['error'] = "Projeto não encontrado ou você não tem permissão para deletá-lo.";
                }
                $this->redirect('/perfil');
            } else {
                $_SESSION['error'] = "Usuário não está logado.";
                $this->redirect('/login');
            }
        } else {
            $_SESSION['error'] = "Método de requisição inválido.";
            $this->redirect('/perfil');
        }
    }
}