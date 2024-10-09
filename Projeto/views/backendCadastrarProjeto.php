<?php 
session_start();
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diretorioDestino = '../static/img/capasProjetos/';
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Verifica conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $nomeProjeto = $_POST['nomeProjeto'];
    $descricaoProjeto = $_POST['descricaoProjeto'];
    $linkDownload = $_POST['linkDownload'];
    $sistemasOperacionais = [];

    if (isset($_POST['windows'])) $sistemasOperacionais[] = 'windows';
    if (isset($_POST['linux'])) $sistemasOperacionais[] = 'linux';
    if (isset($_POST['mac'])) $sistemasOperacionais[] = 'mac';

    if (isset($_FILES['imagemCapaProjeto']) && $_FILES['imagemCapaProjeto']['error'] == 0) {
        $imagemCapa = $_FILES['imagemCapaProjeto'];
        $nomeArquivo = basename($imagemCapa['name']) . '_' . $_SESSION['userLogado']['arroba'];
        $caminhoArquivo = $diretorioDestino . $nomeArquivo;

        if (move_uploaded_file($imagemCapa['tmp_name'], $caminhoArquivo)) {
            $emailUsuario = $_SESSION['userLogado']['email'];

            // Busca o id do usuário
            $stmt = $conn->prepare("SELECT id FROM usuario WHERE email = ?");
            $stmt->bind_param("s", $emailUsuario);
            $stmt->execute();
            $stmt->bind_result($usuarioId);
            $stmt->fetch();
            $stmt->close();

            if ($usuarioId) {
                $sistemasOperacionaisJson = json_encode($sistemasOperacionais);
                $stmt = $conn->prepare("INSERT INTO projetosUsuario (nomeProjeto, descricaoProjeto, linkDownload, sistemasOperacionaisSuportados, fotoCapa, usuario_id) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssi", $nomeProjeto, $descricaoProjeto, $linkDownload, $sistemasOperacionaisJson, $nomeArquivo, $usuarioId);

                if ($stmt->execute()) {

                    $stmt = $conn->prepare("SELECT * FROM usuario WHERE id = ?");
                    $stmt->bind_param("s", $usuarioId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $stmt2 = $conn->prepare("SELECT nomeProjeto, fotoCapa FROM projetosUsuario WHERE usuario_id = ?");
                    $stmt2->bind_param("i", $usuarioId);
                    $stmt2->execute();
                    $result = $stmt2->get_result();

                    $projectsArray = [];


                    if($result){
                        while ($project = $result->fetch_assoc()) {
                            $projectsArray[] = [
                                'nomeProjeto' => $project['nomeProjeto'],
                                'fotoCapa' => $project['fotoCapa'],
                            ];
                        }
                    }

                    $stmt2->close();

                    $user = $_SESSION['userLogado'];

                    session_unset(); 
                    $_SESSION['userLogado'] = [
                        'nome' => $user['nome'],
                        'arroba' => $user['arroba'],
                        'email' => $user['email'],
                        'projects' => $projectsArray, 
                        'friends' => [],
                        'urlPortfolio' => $user['urlPortfolio'],
                        'about' => $user['about'] ?? 'Sobre mim não disponível.'
                    ];

                    header('Location: ../templates/userProfile.php');
                    exit();
                } else {
                    echo "Erro ao inserir projeto: " . $stmt->error;
                }
            } else {
                echo "Usuário não encontrado.";
            }
        } else {
            echo "Erro ao mover o arquivo.";
        }
    } else {
        echo "Erro no upload da imagem.";
    }

    $conn->close(); // Fecha a conexão
}
?>
