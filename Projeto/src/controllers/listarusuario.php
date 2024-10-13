<?php
require '../config.php';

// Conectar ao banco de dados
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificação
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta SQL para selecionar os dados dos usuários
$sql = "SELECT id, nomeUsuario, email, urlPortfolio FROM usuario";
$result = $conn->query($sql);

$conn->close(); 
?>