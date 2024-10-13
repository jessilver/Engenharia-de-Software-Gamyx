<?php
namespace src;

class Config {
    const BASE_DIR = '/Projeto/public';

    const DB_DSN = 'mysql:host=localhost;port=3306';
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
}