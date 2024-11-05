<?php
namespace src\controllers;

use \core\Controller;
use src\models\Review;

class reviewsController extends Controller {
    public function review() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuarioId = $_SESSION['userLogado']['id'];
            $projectId = $_POST['projectId'];
            $nota = $_POST['nota'];
    
            if ($nota >= 1 && $nota <= 5) {
                $avaliacaoExistente = Review::getReviewsUsuario($usuarioId, $projectId);
    
                if ($avaliacaoExistente) {
                    // Atualiza a avaliação existente
                    Review::updateNota($usuarioId, $projectId, $nota);
                    $_SESSION['message'] = "Avaliação atualizada com sucesso.";
                } else {
                    // Adiciona uma nova avaliação
                    Review::addReviews($usuarioId, $projectId, $nota);
                    $_SESSION['message'] = "Avaliação registrada com sucesso.";
                }
    
                // Armazena a nota na sessão para uso posterior
                $_SESSION['nota'] = $nota; // Armazena a nota na sessão
                $this->redirect("/projeto/$projectId");
            } else {
                $_SESSION['error'] = "Nota inválida.";
                $this->redirect("/projeto/$projectId");
            }
        }
    }
}
