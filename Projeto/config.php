<?php

const DB_DSN = 'mysql:host=localhost;port=3306';
const DB_HOST = 'localhost';
const DB_NAME = 'gamyx';
const DB_USER = 'root';
const DB_PASS = '';

$conn = new PDO(DB_DSN, DB_USER, DB_PASS);

function createDatabase($dbName){
    try {
        $conn = new PDO(DB_DSN, DB_USER, DB_PASS);
    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $conn->exec("CREATE DATABASE IF NOT EXISTS ".$dbName);
    
    } catch (PDOException $e) {
        // echo "Erro: " . $e->getMessage();
    }
}

function createTable($dbName,$tableName,$tableCollums){

    try{
        // $pdo = new PDO('mysql:dbname='.$dbName.';host=',DB_USER,DB_PASS);

        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . $dbName, DB_USER, DB_PASS);

    
        $pdo->exec("USE $dbName");
    
        // $sql = "CREATE TABLE IF NOT EXISTS ".$tableName." (".$tableCollums.")";
        $sql = "CREATE TABLE IF NOT EXISTS ".$tableName." (".$tableCollums.") CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

    
        $pdo->exec($sql);
    }catch (PDOException $e) {
        echo "Erro ao criar tabela: " . $e->getMessage();
    }
    

}

$colunasUsuario = "
    id INT AUTO_INCREMENT PRIMARY KEY,
    uniqueName VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    nomeUsuario VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    about VARCHAR(500),
    urlPortfolio VARCHAR(100) NOT NULL
";

$colunasProjetoUsuario = "
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomeProjeto VARCHAR(100) NOT NULL,
    descricaoProjeto VARCHAR(500),
    linkDownload VARCHAR(100) NOT NULL,
    sistemasOperacionaisSuportados VARCHAR(100) NOT NULL,
    fotoCapa VARCHAR(500) NOT NULL,
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
";

createDatabase(DB_NAME);
createTable(DB_NAME,"usuario",$colunasUsuario);
createTable(DB_NAME,"projetosUsuario",$colunasProjetoUsuario);

function insertUser($pdo, $uniqueName, $email, $nomeUsuario, $senha, $about, $urlPortfolio) {
    try {
        $sql = "INSERT INTO usuario (uniqueName, email, nomeUsuario, senha, about, urlPortfolio) 
                VALUES (:uniqueName, :email, :nomeUsuario, :senha, :about, :urlPortfolio)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':uniqueName', $uniqueName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':about', $about);
        $stmt->bindParam(':urlPortfolio', $urlPortfolio);
        
        $stmt->execute();
    } catch (PDOException $e) {
        // echo "<script>console.log('Usuario já inserido')</script>";
    }
}

// Adicionando novos usuários
$pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

insertUser($pdo, 'mariaGamer', 'maria@example.com', 'Maria', 'senhaSegura123', 'Eu sou a Maria e adoro jogos de aventura.', 'https://portfolio.maria.com');
insertUser($pdo, 'carlosDev', 'carlos@example.com', 'Carlos', 'senhaSegura456',  'Carlos, desenvolvedor e amante de programação.', 'https://portfolio.carlos.com');

?>
