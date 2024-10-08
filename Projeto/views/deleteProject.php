<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectToDelete = $_POST['project_name'];

    if (isset($_SESSION['userLogado']['projects'])) {
        // Procura o projeto na lista de projetos do usuário e remove-o
        $key = array_search($projectToDelete, $_SESSION['userLogado']['projects']);
        if ($key !== false) {
            unset($_SESSION['userLogado']['projects'][$key]);
            // Redirecionar para o perfil do usuário após a exclusão
            header("Location: userProfile.php");
            exit();
        } else {
            echo "Projeto não encontrado.";
        }
    } else {
        echo "Você não tem nenhum projeto cadastrado.";
    }
} else {
    header("Location: userProfile.php");
    exit();
}
