<?php
session_start(); // Certifique-se de que a sessão está iniciada
require_once "../config.php"; // Inclui a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectId = $_POST['projectId']; // Obtém o ID do projeto do formulário

    try {
        // Verifica se o ID foi fornecido
        if (!empty($projectId)) {
            // Prepara a declaração SQL para excluir o projeto
            $sql = "DELETE FROM projetosUsuario WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            // Liga o valor do ID do projeto ao parâmetro da consulta SQL
            $stmt->bindParam(':id', $projectId, PDO::PARAM_INT);

            // Executa a consulta
            if ($stmt->execute()) {
                echo "Projeto excluído com sucesso!";

                // Obtém o ID do usuário logado da sessão
                $usuarioId = $_SESSION['userLogado']['id'];

                // Busca os projetos atualizados do usuário
                $stmt2 = $pdo->prepare("SELECT nomeProjeto, fotoCapa, id FROM projetosUsuario WHERE usuario_id = ?");
                $stmt2->bindParam(1, $usuarioId, PDO::PARAM_INT);
                $stmt2->execute();

                $projectsArray = [];
                while ($project = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $projectsArray[] = [
                        'id' => $project['id'],
                        'nomeProjeto' => $project['nomeProjeto'],
                        'fotoCapa' => $project['fotoCapa'],
                    ];
                }

                $stmt2->closeCursor();

                // Atualiza os dados do usuário na sessão
                $_SESSION['userLogado']['projects'] = $projectsArray;

                header("Location: ../templates/userProfile.php");
                exit(); // Para garantir que o script não continue executando
            } else {
                echo "Erro ao excluir o projeto.";
            }
        } else {
            echo "ID do projeto não fornecido.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
