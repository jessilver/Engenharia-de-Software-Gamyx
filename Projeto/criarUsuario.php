<?php 

    require 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $nomeUsuario = $_POST['nomeUsuario'];
        $senha = $_POST['password'];
        $senha = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $linkPortfolio = $_POST['portfolioUser'];

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $stmt = $conn->prepare("INSERT INTO usuario (email, nomeUsuario, senha, urlPortfolio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $nomeUsuario, $senha, $linkPortfolio);

        // if ($stmt->execute()) {
        //     // echo "Novo registro criado com sucesso!";
        // } else {
        //     echo "Erro: " . $stmt->error;
        // }

        if ($stmt->execute()) {
            header('Location: userProfile.php');
            exit();
        } else {
            echo "Erro: " . $stmt->error;
        }
        
        
        // Fechar a consulta e a conexão
        $stmt->close();
        $conn->close();
        // header('login.php');
        // header('Location: userProfile.php');
        // exit();
    }

?>