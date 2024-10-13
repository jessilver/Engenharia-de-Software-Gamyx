<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uniqueName = $_POST['uniqueName'];

    echo $uniqueName;

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    //Deletar o usuário pelo uniqueName
    $stmt = $conn->prepare("DELETE FROM usuario WHERE uniqueName = ?");
    $stmt->bind_param("s", $uniqueName);

    if ($stmt->execute()) {
        echo "Usuário deletado com sucesso!";
        header('Location: ../templates/login.php');
    } else {
        echo "Erro ao deletar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
