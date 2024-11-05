<?php
namespace src\controllers;

use \core\Controller;
use src\models\Review;
use src\models\Usuario; // Adicione o uso da classe User para buscar o uniqueName

class ReviewsController extends Controller {
    public function review() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuarioId = $_SESSION['userLogado']['id'];
            $projectId = $_POST['projectId'];
            $nota = $_POST['nota'];
    
            if ($nota >= 1 && $nota <= 5) {
                // Buscar o uniqueName do usuário
                $user = Usuario::getUserById($usuarioId); // Novo método para obter o uniqueName
                $uniqueName = $user['uniqueName'] ?? null;
                
                if ($uniqueName) {
                    $avaliacaoExistente = Review::getReviewsUsuario($usuarioId, $projectId);
        
                    if ($avaliacaoExistente) {
                        // Atualiza a avaliação existente
                        Review::updateNota($usuarioId, $projectId, $nota);
                        $_SESSION['message'] = "Avaliação atualizada com sucesso.";
                    } else {
                        // Adiciona uma nova avaliação com uniqueName
                        Review::addReviews($usuarioId, $projectId, $nota, $uniqueName);
                        $_SESSION['message'] = "Avaliação registrada com sucesso.";
                    }
        
                    // Armazena a nota na sessão para uso posterior
                    $_SESSION['nota'] = $nota;
                    $this->redirect("/projeto/$projectId");
                } else {
                    $_SESSION['error'] = "Usuário não encontrado.";
                    $this->redirect("/projeto/$projectId");
                }
            } else {
                $_SESSION['error'] = "Nota inválida.";
                $this->redirect("/projeto/$projectId");
            }
        }
    }
}
