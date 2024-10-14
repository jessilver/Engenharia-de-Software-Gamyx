<?php

require 'Gamyx/config/config.php';

try {
    $db = new PDO($dsn, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
    CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        uniqueName VARCHAR(100) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        nomeUsuario VARCHAR(100) NOT NULL,
        senha VARCHAR(100) NOT NULL,
        about VARCHAR(500),
        urlPortfolio VARCHAR(100) NOT NULL
    )";

    $db->exec($sql);

    $sql = "
    CREATE TABLE IF NOT EXISTS projetosUsuario (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nomeProjeto VARCHAR(100) NOT NULL,
        descricaoProjeto VARCHAR(500),
        linkDownload VARCHAR(100) NOT NULL,
        sistemasOperacionaisSuportados VARCHAR(100) NOT NULL,
        fotoCapa VARCHAR(500) NOT NULL,
        usuario_id INT NOT NULL,
        FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
    )";

    $db->exec($sql);
} catch (PDOException $e) {
    echo "Erro ao criar a tabela: " . $e->getMessage();
}
