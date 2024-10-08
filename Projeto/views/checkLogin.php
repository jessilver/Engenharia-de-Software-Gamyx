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
            // Definir os dados de sessão
            $_SESSION['userLogado'] = [
                'nome' => $user['nomeUsuario'],
                'arroba' => $user['uniqueName'],
                'email' => $user['email'],
                'projects' => [], // A lista de projetos pode ser preenchida mais tarde
                'friends' => [],
                'urlPortfolio' => $user['urlPortfolio'],
                'about' => $user['about'] ?? 'Sobre mim não disponível.'
            ];

            // Redirecionar para a página de perfil
            header("Location: ../templates/userProfile.php");
            exit();
        }
    }

    // Se o login falhar (usuário ou senha incorretos), redirecionar para o login com erro
    header("Location: ../templates/login.php");
    exit();

    $stmt->close();
    $conn->close();
}
?>
