<?php
require 'config.php';

session_start(); // Inicia a sessão

// Simulação de um login bem-sucedido
$_SESSION['user'] = [
    'id' => 1,
    'nome' => 'João',
    'arroba' => '@joaoGMplays',
    'email' => 'joao@example.com',
    'projects' => ['Stardiu','Free Faire','Class Royale'],
    'friends' => ['Mario','Dani','Gi'],
    'about' => 'Olá, eu sou o joão, sou um fanático por jogos e amente da programação, meu sonho é criar um jogo onde todos possam se divertir'
];

$pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

insertUser($pdo, 'Maria', '@mariaGamer', 'maria@example.com', '1995-03-25', 'Eu sou a Maria e adoro jogos de aventura.');
insertUser($pdo, 'Carlos', '@carlosDev', 'carlos@example.com', '1990-12-14', 'Carlos, desenvolvedor e amante de programação.');

?>