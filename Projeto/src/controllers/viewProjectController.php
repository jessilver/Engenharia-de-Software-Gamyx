<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;
use \src\models\Review;
use \src\Config;

class ViewProjectController extends Controller {

    public function index($id) {
        // Obtém o ID do projeto da URL
        $projetoId = $id['id']; 

        $project = Project::selectProject($projetoId);

        if (!empty($project)) {
            // Busca os comentários e avaliações do projeto
            $reviews = Review::getReviewsComments($projetoId);

            $context = [
                'project' => $project,
                'reviews' => $reviews
            ];

            $this->render('viewProject', $context);
        } else {
            $this->render('404');
        }
    }

    public function edit(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $diretorioDestino = Config::BASE_DIR.'/static/img/capasProjetos/';
            echo $diretorioDestino;
        
            $usuarioId = $_POST['userId'];
            $nomeProjeto = $_POST['nomeProjeto'];
            $descricaoProjeto = $_POST['descricaoProjeto'];
            $linkDownload = $_POST['linkDownload'];
            $sistemasOperacionais = [];
            $projectId = $_POST['projectId'];
        
            $sistemasOperacionais = [];
            if (isset($_POST['windows'])) $sistemasOperacionais[] = 'windows';
            if (isset($_POST['linux'])) $sistemasOperacionais[] = 'linux';
            if (isset($_POST['mac'])) $sistemasOperacionais[] = 'mac';

            // Busca o nome da foto atual do projeto
            $project = Project::selectProject($projectId);
            $fotoAtual = $project['fotoCapa'];

            // Inicializa $nomeArquivo como o nome da foto atual
            $nomeArquivo = $fotoAtual;

            // Verifica se uma nova imagem foi enviada
            if (isset($_FILES['CapaProjeto']) && $_FILES['CapaProjeto']['error'] == 0) {
                $imagemCapa = $_FILES['CapaProjeto'];
                $nomeArquivo = basename($imagemCapa['name']) . '_' . $_SESSION['userLogado']['id'];
                
                // Use um caminho absoluto para o diretório de destino
                $diretorioDestino = __DIR__ . '/../../public/static/img/capasProjetos/';
                $caminhoArquivo = $diretorioDestino . $nomeArquivo;

                // Verifique se o diretório de destino existe, se não, crie-o
                if (!is_dir($diretorioDestino)) {
                    mkdir($diretorioDestino, 0777, true);
                }

                if (!move_uploaded_file($imagemCapa['tmp_name'], $caminhoArquivo)) {
                    echo "Erro ao mover o arquivo.";
                    exit();
                } else {
                    echo "Arquivo movido com sucesso.";
                }
            } else {
                echo "Nenhuma nova imagem enviada, mantendo a imagem atual.";
            }

            if ($usuarioId) {
                $sistemasOperacionaisJson = json_encode($sistemasOperacionais);
                Project::updateProject($projectId, [
                    'nomeProjeto' => $nomeProjeto,
                    'descricaoProjeto' => $descricaoProjeto,
                    'linkDownload' => $linkDownload,
                    'sistemasOperacionaisSuportados' => $sistemasOperacionaisJson,
                    'fotoCapa' => $nomeArquivo
                ]);
                $this->redirect('\perfil');
                exit();
            } else {
                echo "Erro ao atualizar projeto: ";
            }
        } else {
            echo "Usuário não encontrado.";
        }
    }

    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userLogado']['id'])) {
            $userId = $_SESSION['userLogado']['id'];
            $projectId = $_POST['projectId']; // Recebe o ID do projeto a partir do formulário

            $project = Project::selectProject($projectId);

            // Verifica se o projeto foi encontrado e se pertence ao usuário logado
            if ($project && $project['usuario_id'] == $userId) {

                if (Project::deleteProject($projectId)) {
                    echo "Projeto deletado com sucesso.";
                    $this->redirect('\perfil');
                } else {
                    echo "Erro ao deletar projeto.";
                    $this->redirect('\perfil');
                }
            } else {
                // Projeto não encontrado ou usuário não tem permissão
                echo "Projeto não encontrado ou você não tem permissão para deletá-lo.";
                $this->redirect('\perfil');
            }
        } else {
            // Usuário não logado ou método inválido
            echo "Usuário não está logado ou método inválido.";
            $this->redirect('\perfil');
        }
    }
}