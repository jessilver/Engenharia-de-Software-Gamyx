<?php
session_start();
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['search_query'])) {
    $searchQuery = $_POST['search_query'];
    try {
        // Conexão com o banco de dados
        $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Consulta ao banco de dados (busca por nome, arroba ou email)
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE nomeUsuario LIKE :searchQuery OR uniqueName LIKE :searchQuery OR email LIKE :searchQuery");
        $stmt->execute(['searchQuery' => "%$searchQuery%"]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            unset($_SESSION['userSearched']);

            echo "1";
         
            $_SESSION['userSearched'] = [
                'nome' => $user['nomeUsuario'],
                'arroba' => $user['uniqueName'], 
                'email' => $user['email'],
                'projects' => [], 
                'friends' => [], 
                'urlPortfolio' => $user['urlPortfolio'],
                'about' => $user['about'] ?? 'Sobre mim não disponível.'
            ];

            echo $_SESSION['userSearched']['nome'];

            header("Location: ../templates/othersProfile.php");

        } else {
            echo "<script>console.log('Nenhum usuário encontrado.')</script>";
            header("Location: ../templates/userProfile.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    header("Location: ../templates/userProfile.php");
}

?>