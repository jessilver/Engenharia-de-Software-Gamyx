<?php
require_once "config.php"; // Inclui a conexão com o banco de dados

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
                header("Location: userProfile.php");
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
