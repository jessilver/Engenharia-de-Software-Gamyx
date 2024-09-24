<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_username = $_POST['email'];
 
    $password = $_POST['password'];

    // Conectar ao banco de dados
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    //Consulta SQL para verificar os dados
    
    $senhaBanco = $conn->prepare("SELECT senha FROM usuario WHERE (email = ? OR nomeUsuario = ?)");
    $senhaBanco->bind_param("ss", $email_or_username, $email_or_username);
    $senhaBanco->execute();
    $senhaBanco->bind_result($hashSenha);
    $senhaBanco->fetch();
    $senhaBanco->close();

    // 

    if(password_verify($password, $hashSenha)) {
        $stmt = $conn->prepare("SELECT id, nomeUsuario, email FROM usuario WHERE (email = ? OR nomeUsuario = ?)");

        $stmt->bind_param("ss", $email_or_username, $email_or_username);
    

        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        echo "Senha incorretos.";
    }

    if ($result->num_rows > 0) {
        // Usuário encontrado, salvar dados na sessão
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nomeUsuario'];
        $_SESSION['user_email'] = $user['email'];

        // Redirecionar para a página de perfil
        header("Location: userProfile.php");
        exit();
    } else {
   
        echo "Usuário ou senha inválidos!";
    }

    $stmt->close();
    $conn->close(); // Fechar a conexão
}
?>
