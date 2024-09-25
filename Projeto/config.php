<?php

const DB_DSN = 'mysql:host=localhost;port=3306';
const DB_HOST = 'localhost';
const DB_NAME = 'gamyx';
const DB_USER = 'root';
const DB_PASS = '';

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

createDatabase(DB_NAME);
createTable(DB_NAME,"usuario",$colunasUsuario);


?>
