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

$tableCollums = "
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    data_nascimento DATE
";

createDatabase(DB_NAME);
createTable(DB_NAME,"usuario",$tableCollums)


?>