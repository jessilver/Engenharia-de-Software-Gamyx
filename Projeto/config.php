<?php

const DB_DSN = 'mysql:host=localhost;port=3306';
const DB_HOST = 'localhost';
const DB_NAME = 'gamyx';
const DB_USER = 'root';
const DB_PASS = '';

function createDatabase($dbName){
    try {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
    
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $pdo->exec("CREATE DATABASE IF NOT EXISTS ".$dbName);
    
    } catch (PDOException $e) {
        // echo "Erro: " . $e->getMessage();
    }
}
function createTable($dbName,$tableName,$tableCollums){

    try{
        $pdo = new PDO('mysql:dbname='.$dbName.';host=',DB_USER,DB_PASS);
    
        $pdo->exec("USE $dbName");
    
        $sql = "CREATE TABLE IF NOT EXISTS ".$tableName." (".$tableCollums.")";
    
        $pdo->exec($sql);
    }catch (PDOException $e) {
    }
}
function insertUser($pdo, $nome, $arroba, $email, $dataNascimento, $about) {
    try {
        $sql = "INSERT INTO usuario (nome, arroba, email, data_nascimento, about) 
                VALUES (:nome, :arroba, :email, :data_nascimento, :about)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':arroba', $arroba);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':data_nascimento', $dataNascimento);
        $stmt->bindParam(':about', $about);
        $stmt->execute();

        echo "Usuário $nome foi inserido com sucesso.";
    } catch (PDOException $e) {
        // echo "Erro ao inserir usuário: " . $e->getMessage();
    }
}


$tableCollums = "
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    arroba VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    data_nascimento DATE,
    about TEXT
";

createDatabase(DB_NAME);
createTable(DB_NAME,"usuario",$tableCollums);

?>