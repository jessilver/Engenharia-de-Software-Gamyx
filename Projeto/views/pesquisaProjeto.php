<?php
    $emailUsuario = $_SESSION['userLogado']['email']; // Pegando o email do usuário logado

    $stmt = $pdo->prepare("SELECT p.id, p.nomeProjeto, p.fotoCapa FROM projetosUsuario p 
                            INNER JOIN usuario u ON p.usuario_id = u.id 
                            WHERE u.email = :email");

    $stmt->bindParam(':email', $emailUsuario);
    $stmt->execute();

    $projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>