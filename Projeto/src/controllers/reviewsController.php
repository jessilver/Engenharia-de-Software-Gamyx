<?php
namespace src\controllers;

use \core\Controller;
use src\models\Review;
use src\models\Usuario;

class ReviewsController extends Controller {
    public function review() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuarioId = $_SESSION['userLogado']['id'];
            $projectId = $_POST['projectId'];
            $nota = $_POST['nota'];
            $comentario = $_POST['comentario']; // Coleta o comentário do formulário
    
            if ($nota >= 1 && $nota <= 5) {
                // Busca o uniqueName do usuário
                $user = Usuario::getUserById($usuarioId);
                $uniqueName = $user['uniqueName'] ?? null;
                
                if ($uniqueName) {
                    $avaliacaoExistente = Review::getReviewsUsuario($usuarioId, $projectId);
        
                    if ($avaliacaoExistente) {
                        // Atualiza a avaliação existente
                        Review::updateReview($usuarioId, $projectId, $nota, $comentario);
                        $_SESSION['message'] = "Avaliação e comentário atualizados com sucesso.";
                    } else {
                        // Adiciona uma nova avaliação com uniqueName e comentário
                        Review::addReviews($usuarioId, $projectId, $nota, $uniqueName, $comentario);
                        $_SESSION['message'] = "Avaliação e comentário registrados com sucesso.";
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

    public function getReviewsApi($args) {
        $projetoId = (int)$args['id']; // Extraia o ID do projeto da URL e converta para inteiro
        $reviews = Review::getReviewsWithUniqueName($projetoId);
        header('Content-Type: application/json');
        echo json_encode($reviews);
    }

    public function getAllProjectsReviews() {
        $reviews = Review::getAllProjectsReviews();
        header('Content-Type: application/json');
        echo json_encode($reviews);
    }

    public function viewProject($args) {
        $projetoId = (int)$args['id']; // Pega o ID do projeto da URL
        $reviews = Review::getReviewsComments($projetoId); // Busca os reviews com comentários

        $this->render('viewProject', [
            'reviews' => $reviews // Envia os reviews para a view
        ]);
    }
}

