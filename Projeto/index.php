<!-- <?php
require 'config.php';

// Adicionando novos usuários
$pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

insertUser($pdo, 'Maria', '@mariaGamer', 'maria@example.com', '1995-03-25', 'Eu sou a Maria e adoro jogos de aventura.');
insertUser($pdo, 'Carlos', '@carlosDev', 'carlos@example.com', '1990-12-14', 'Carlos, desenvolvedor e amante de programação.');

?>