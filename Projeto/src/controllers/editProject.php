<?php 
session_start();
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diretorioDestino = '../static/img/capasProjetos/';
   // $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Verifica conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $usuarioId = $_POST['userId'];
    $nomeProjeto = $_POST['nomeProjeto'];
    $descricaoProjeto = $_POST['descricaoProjeto'];
    $linkDownload = $_POST['linkDownload'];
    $sistemasOperacionais = [];
    $projectId = $_POST['projectId'];

    if (isset($_POST['windows'])) $sistemasOperacionais[] = 'windows';
    if (isset($_POST['linux'])) $sistemasOperacionais[] = 'linux';
    if (isset($_POST['mac'])) $sistemasOperacionais[] = 'mac';

    // Busca o nome da foto atual do projeto
    $stmt = $conn->prepare("SELECT fotoCapa FROM projetosUsuario WHERE id = ?");
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $stmt->bind_result($fotoAtual);
    $stmt->fetch();
    $stmt->close();

    // Inicializa $nomeArquivo como o nome da foto atual
    $nomeArquivo = $fotoAtual;
    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['CapaProjeto']) && $_FILES['CapaProjeto']['error'] == 0) {
        $imagemCapa = $_FILES['CapaProjeto'];
        $nomeArquivo = basename($imagemCapa['name']) . '_' . $_SESSION['userLogado']['arroba'];
        $caminhoArquivo = $diretorioDestino . $nomeArquivo;

        print('img');

        if (!move_uploaded_file($imagemCapa['tmp_name'], $caminhoArquivo)) {
            echo "Erro ao mover o arquivo.";
            exit();
        }
    } else {
        echo "Nenhuma nova imagem enviada, mantendo a imagem atual.";
    }

    if ($usuarioId) {
        $sistemasOperacionaisJson = json_encode($sistemasOperacionais);
        $stmt = $conn->prepare("UPDATE projetosUsuario SET nomeProjeto = ?, descricaoProjeto = ?, linkDownload = ?, sistemasOperacionaisSuportados = ?, fotoCapa = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $nomeProjeto, $descricaoProjeto, $linkDownload, $sistemasOperacionaisJson, $nomeArquivo, $projectId);

        if ($stmt->execute()) {

            $stmt = $conn->prepare("SELECT * FROM usuario WHERE id = ?");
            $stmt->bind_param("i", $usuarioId);
            $stmt->execute();
            $result = $stmt->get_result();

            $stmt2 = $conn->prepare("SELECT nomeProjeto, fotoCapa, id FROM projetosUsuario WHERE usuario_id = ?");
            $stmt2->bind_param("i", $usuarioId);
            $stmt2->execute();
            $result = $stmt2->get_result();

            $projectsArray = [];


            if($result){
                while ($project = $result->fetch_assoc()) {
                    $projectsArray[] = [
                        'id' => $project['id'],
                        'nomeProjeto' => $project['nomeProjeto'],
                        'fotoCapa' => $project['fotoCapa'],
                    ];
                }
            }

            $stmt2->close();

            $user = $_SESSION['userLogado'];

            session_unset(); 
            $_SESSION['userLogado'] = [
                'id' => $user['id'],
                'nome' => $user['nome'],
                'arroba' => $user['arroba'],
                'email' => $user['email'],
                'projects' => $projectsArray, 
                'friends' => [],
                'urlPortfolio' => $user['urlPortfolio'],
                'about' => $user['about'] ?? 'Sobre mim não disponível.'
            ];

            header("Location: ../templates/viewProject.php?id=$projectId");
            exit();
        } else {
            echo "Erro ao atualizar projeto: " . $stmt->error;
        }
    } else {
        echo "Usuário não encontrado.";
    }
    
    $conn->close(); // Fecha a conexão
}

?>
