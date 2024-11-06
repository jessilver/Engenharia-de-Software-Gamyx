<?php
namespace src;

class Config {
    const BASE_DIR = '/Engenharia-de-Software-Gamyx/Projeto/public';
    const ENCRYPT_KEY = "IA}V?%'&yQ0C8CcnZD,8^zS?$9pnxP;PhIL?3-C#M(nGDjRre*";

    const DB_DSN = 'mysql:host=localhost;port=3306;dbname=gamyx';
    const DB_DRIVER = 'mysql';
    const DB_HOST = 'localhost';
    const DB_DATABASE = 'gamyx';
    CONST DB_USER = 'root';
    const DB_PASS = '';

    const ERROR_CONTROLLER = 'ErrorController';
    const DEFAULT_ACTION = 'index';

    const TB_USER =[
        'name' => 'Usuarios',
        'culloms' => "
            id INT AUTO_INCREMENT PRIMARY KEY,
            uniqueName VARCHAR(100) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            nomeUsuario VARCHAR(100) NOT NULL,
            senha VARCHAR(100) NOT NULL,
            about VARCHAR(500),
            urlPortfolio VARCHAR(100) NOT NULL
        "
    ];
    const TB_PROJECT = [
        'name' => 'Projects',
        'culloms' => "
            id INT AUTO_INCREMENT PRIMARY KEY,
            nomeProjeto VARCHAR(100) NOT NULL,
            descricaoProjeto VARCHAR(500),
            linkDownload VARCHAR(100) NOT NULL,
            sistemasOperacionaisSuportados VARCHAR(100) NOT NULL,
            fotoCapa VARCHAR(500) NOT NULL,
            usuario_id INT NOT NULL,
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
        "
    ];
    const TB_FRIENDS = [
        'name' => 'Friends',
        'culloms' => "
            id INT AUTO_INCREMENT PRIMARY KEY,
            friend_1 INT NOT NULL,
            friend_2 INT NOT NULL,
            FOREIGN KEY (friend_1) REFERENCES usuarios(id) ON DELETE CASCADE,
            FOREIGN KEY (friend_2) REFERENCES usuarios(id) ON DELETE CASCADE
        "
    ];
    const TB_REVIEWS = [
        'name' => 'Reviews',
        'culloms' => "
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT NOT NULL,
            projeto_id INT NOT NULL,
            uniqueName VARCHAR(100) NOT NULL,
            nota TINYINT NOT NULL CHECK (nota BETWEEN 1 AND 5),
            FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE,
            FOREIGN KEY (projeto_id) REFERENCES Projects(id) ON DELETE CASCADE,
            UNIQUE (usuario_id, projeto_id) -- Impede que um usuário avalie o mesmo projeto mais de uma vez
        "
    ];
}