<?php
session_start();
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_username = $_POST['email'];
    $password = $_POST['password'];

    // Conectar ao banco de dados
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verificar os dados
    $senhaBanco = $conn->prepare("SELECT senha FROM usuario WHERE (email = ? OR nomeUsuario = ?)");
    $senhaBanco->bind_param("ss", $email_or_username, $email_or_username);
    $senhaBanco->execute();
    $senhaBanco->bind_result($hashSenha);
    $senhaBanco->fetch();
    $senhaBanco->close();

    // Comparação da senha criptografada com a senha passada pelo usuario
    if (password_verify($password, $hashSenha)) {
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE (email = ? OR nomeUsuario = ?)");
        $stmt->bind_param("ss", $email_or_username, $email_or_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            session_unset(); 
    
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
            $stmt2 = $conn->prepare("SELECT nomeProjeto, fotoCapa, id FROM projetosUsuario WHERE usuario_id = ?");
            $stmt2->bind_param("i", $user['id']);
            $stmt2->execute();
            $result = $stmt2->get_result();
    
            $projectsArray = [];
    
    
            if($result){
                while ($project = $result->fetch_assoc()) {
                    $projectsArray[] = [
                        'id' => $project['id'],
                        'nomeProjeto' => $project['nomeProjeto'],
                        'fotoCapa' => $project['fotoCapa'],
                    ];
                }
            }
    
            $stmt2->close();
            
            $_SESSION['userLogado'] = [
                'id' => $user['id'],
                'nome' => $user['nomeUsuario'],
                'arroba' => $user['uniqueName'],
                'email' => $user['email'],
                'projects' => $projectsArray, 
                'friends' => [],
                'urlPortfolio' => $user['urlPortfolio'],
                'about' => $user['about'] ?? 'Sobre mim não disponível.'
            ];
            header("Location: ../templates/userProfile.php");
            exit();
        } else {
            header("Location: ../templates/login.php?error=1");
            exit();
        }
    } else {
        echo "Senha incorretos.";
    }

    $stmt->close();
    $conn->close();
}
?>