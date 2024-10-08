<?php 

    require '../config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $nomeUsuario = $_POST['nomeUsuario'];
        $senha = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $linkPortfolio = $_POST['portfolioUser'];

        $uniqueName = '@' . strtolower(str_replace(' ', '', $nomeUsuario));

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $stmt = $conn->prepare("INSERT INTO usuario (email, uniqueName, nomeUsuario, senha, urlPortfolio) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $uniqueName, $nomeUsuario, $senha, $linkPortfolio);

        if ($stmt->execute()) {
            header('Location: ../templates/login.php');
            exit();
        } else {
            echo "Erro: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }

    header('Location: login.php');

?>