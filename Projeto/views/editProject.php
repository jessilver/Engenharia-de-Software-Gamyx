<?php 
    session_start();

    require '../config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $diretorioDestino = '../static/img/capasProjetos';

        $oldNomeProjeto = $_POST['oldNomeProjeto'];
        $nomeProjeto = $_POST['nomeProjeto'];
        $descricaoProjeto = $_POST['descricaoProjeto'];
        $linkDownload = $_POST['linkDownload'];
        $sistemasOperacionais = $_POST['switches[]'];

        if (isset($_FILES['imagemCapaProjeto']) && $_FILES['imagemCapaProjeto']['error'] == 0) {
            $imagemCapa = $_FILES['imagemCapaProjeto'];
            $nomeArquivo = basename($_FILES['imagemCapaProjeto']['name'] . $_SESSION['userLogado']['uniqueName']);
            $caminhoArquivo = $diretorioDestino . $nomeArquivo;
        }

        $emailUsuario = $_SESSION['userLogado']['email']; 

        $stmt = $pdo->prepare("SELECT id FROM usuario WHERE email = :email");
        $stmt->bindParam(':email', $emailUsuario);
        
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $usuarioId = $result['id'];
        } else {
            echo "Usuário não encontrado.";
        }

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if (move_uploaded_file($_FILES['imagemCapaProjeto']['tmp_name'], $caminhoArquivo)) {
            $stmt = $conn->prepare("UPDATE projetosUsuario SET nomeProjeto = ?, descricaoProjeto = ?, linkDownload = ?, sistemasOperacionaisSuportados = ?, fotoCapa = ? WHERE nomeProjeto = ? AND usuario_id = ?");
            $stmt->bind_param("ssssssi",$nomeProjeto, $descricaoProjeto, $linkDownload, $sistemasOperacionais, $caminhoArquivo,$oldNomeProjeto, $usuarioId);

            if ($stmt->execute()) {
                header('Location: ../templates/userProfile.php');
                exit();
            } else {
                echo "Erro: " . $stmt->error;
            }
            $stmt->close();
            $conn->close();
        }
    } 
?>