<?php 

    require 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $nomeUsuario = $_POST['nomeUsuario'];
        $senha = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $linkPortfolio = $_POST['portfolioUser'];

        $uniqueName = '@' . strtolower(str_replace(' ', '', $nomeUsuario));

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $stmt = $conn->prepare("INSERT INTO usuario (email, uniqueName, nomeUsuario, senha, urlPortfolio) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $uniqueName, $nomeUsuario, $senha, $linkPortfolio);

        // if ($stmt->execute()) {
        //     // echo "Novo registro criado com sucesso!";
        // } else {
        //     echo "Erro: " . $stmt->error;
        // }

        if ($stmt->execute()) {
            // header('Location: userProfile.php');
            exit();
        } else {
            echo "Erro: " . $stmt->error;
        }

        $result = $conn->query("SELECT * FROM usuario"); 

        if ($result) {
                $row = $result->fetch_assoc();
                $nomeUsuario = $row['nomeUsuario'];
                
                session_start();

                $_SESSION['userLogado'] = [
                    'nome' => $row['nomeUsuario'],
                    'arroba' => $row['uniqueName'], 
                    'email' => $row['email'],
                    'projects' => [], 
                    'friends' => [], 
                    'urlPortfolio' => $row['urlPortfolio'],
                    'about' => $row['about'] ?? 'Sobre mim não disponível.'
                ];
        } else {
            echo "Erro na consulta: " . $conn->error;
        }

        header('Location: userProfile.php');
        
        
        // Fechar a consulta e a conexão
        $stmt->close();
        $conn->close();
        // header('login.php');
        // header('Location: userProfile.php');
        // exit();
    }

?>