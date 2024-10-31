<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Project;

class deleteProjectController extends Controller {
    public function delete() {

if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_SESSION['userLogado']['id'] ?? null;
            $projectId = $_POST['projetoId'] ?? null;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userId = $_SESSION['userLogado']['id'] ?? null;
                $projectId = $_POST['projetoId'] ?? null;
    
                if ($userId && $projectId) {
                    // Verifique se o projeto pertence ao usuário logado
                    $projects = Project::selectProjectByUserId($userId, ['id']);
                    
                    // Checa se o projeto existe para o usuário logado
                    $projectExists = array_filter($projects, fn($project) => $project['id'] == $projectId);
    
                    if (!empty($projectExists)) {
                        // Tente deletar o projeto usando deleteProject
                        if (Project::deleteProject($projectId)) {
                            $_SESSION['message'] = "Projeto deletado com sucesso.";
                            echo "Projeto deletado com sucesso.";
                        } else {
                            $_SESSION['error'] = "Erro ao deletar projeto.";
                            echo "Erro ao deletar projeto.";
                        }
                    } else {
                        $_SESSION['error'] = "Projeto não encontrado ou você não tem permissão para deletá-lo.";
                        echo "Projeto não encontrado ou você não tem permissão para deletá-lo.";
                    }
                } else {
                    $_SESSION['error'] = "ID do projeto ou ID do usuário não fornecido.";
                    echo "ID do projeto ou ID do usuário não fornecido.";
                }
            } else {
                $_SESSION['error'] = "Método de requisição inválido.";
                echo "Método de requisição inválido.";
            }
        }
    }
}