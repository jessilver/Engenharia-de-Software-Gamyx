<?php

const DB_NAME = 'test';
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';

// Conectando ao banco de dados test
$pdo = new PDO('mysql:dbname='.DB_NAME.';host=',DB_USER,DB_PASS);

// usuarios é o nome de uma tabela do banco test
$sql = $pdo->query('SELECT * FROM usuarios')

?>