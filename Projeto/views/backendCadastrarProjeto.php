<?php 
    session_start();

    require '../config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $diretorioDestino = '../static/img/capasProjetos';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $nomeProjeto = $_POST['nomeProjeto'];
        $descricaoProjeto = $_POST['descricaoProjeto'];
        $linkDownload = $_POST['linkDownload'];
        $sistemasOperacionais = array();
        if (isset($_POST['windows'])) {
            $sistemasOperacionais[] = 'windows';
        }
        if (isset($_POST['linux'])) {
            $sistemasOperacionais[] = 'linux';
        }
        if (isset($_POST['mac'])) {
            $sistemasOperacionais[] = 'mac';
        }

        if (isset($_FILES['imagemCapaProjeto']) && $_FILES['imagemCapaProjeto']['error'] == 0) {
            $imagemCapa = $_FILES['imagemCapaProjeto'];
            $nomeArquivo = basename($_FILES['imagemCapaProjeto']['name'] . $_SESSION['userLogado']['uniqueName']);
            $caminhoArquivo = $diretorioDestino . $nomeArquivo;
        }

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

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

        if (move_uploaded_file($_FILES['imagemCapaProjeto']['tmp_name'], $caminhoArquivo)) {
            $stmt = $conn->prepare("INSERT INTO projetosUsuario (nomeProjeto, descricaoProjeto, linkDownload, sistemasOperacionaisSuportados, fotoCapa, usuario_id) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $nomeProjeto, $descricaoProjeto, $linkDownload, $sistemasOperacionais, $caminhoArquivo, $usuarioId);

            if ($stmt->execute()) {
                header('Location: ../templates/userProfile.php');

                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                $projects = [];
                while ($row = $result->fetch_assoc()) {
                    $projects[] = $row['nomeProjeto'];
                }
                $_SESSION['userLogado']['projects'] = $projects;
                
                exit();
            } else {
                echo "Erro: " . $stmt->error;
            }
            $stmt->close();
            $conn->close();
        }
    } 
?>