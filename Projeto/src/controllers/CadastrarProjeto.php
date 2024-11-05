<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Project;
use src\models\Usuario;

class CadastrarProjeto extends Controller {
    public function index(){
        $this->render('cadastrarProjeto');
    }

    public function cadastrarProjetoAction(){
        // Obtém o usuário logado diretamente do banco pelo ID (ou outro identificador, se necessário)
        $usuarioLogado = Usuario::select()->where('id', $_SESSION['userLogado']['id'])->first();

        if (!$usuarioLogado) {
            echo "Erro: usuário não encontrado.";
            exit;
        }

        $nomeProjeto = filter_input(INPUT_POST, 'nomeProjeto');
        $descricaoProjeto = filter_input(INPUT_POST, 'descricaoProjeto');
        $linkDownload = filter_input(INPUT_POST, 'linkDownload');
        $sistemasOperacionais = [];

        if (isset($_POST['windows'])) $sistemasOperacionais[] = 'windows';
        if (isset($_POST['linux'])) $sistemasOperacionais[] = 'linux';
        if (isset($_POST['mac'])) $sistemasOperacionais[] = 'mac';

        // Diretório de destino para salvar as imagens de capa dos projetos
        $diretorioDestino = '../../public/static/img/capasProjetos/';

        if (isset($_FILES['imagemCapaProjeto']) && $_FILES['imagemCapaProjeto']['error'] == 0) {
            $imagemCapa = $_FILES['imagemCapaProjeto'];
            $nomeArquivo = uniqid() . '_' . $usuarioLogado['uniqueName'] . '.' . pathinfo($imagemCapa['name'], PATHINFO_EXTENSION);
            $caminhoArquivo = $diretorioDestino . $nomeArquivo;

            // Verifica se o diretório de destino existe; caso contrário, cria o diretório
            if (!is_dir($diretorioDestino)) {
                mkdir($diretorioDestino, 0777, true);
            }

            if (move_uploaded_file($imagemCapa['tmp_name'], $caminhoArquivo)) {
                // Converte sistemas operacionais suportados para JSON
                $sistemasOperacionaisJson = json_encode($sistemasOperacionais);

                if ($nomeProjeto && $descricaoProjeto && $linkDownload) {
                    // Insere o novo projeto no banco de dados
                    Project::insert([
                        'nomeProjeto' => $nomeProjeto,
                        'descricaoProjeto' => $descricaoProjeto,
                        'linkDownload' => $linkDownload,
                        'sistemasOperacionaisSuportados' => $sistemasOperacionaisJson,
                        'fotoCapa' => $nomeArquivo,
                        'usuario_id' => $usuarioLogado['id']
                    ])->execute();

                    $this->redirect('/perfil');
                }
            } else {
                echo "Erro ao fazer upload da imagem.";
                exit;
            }
        } else {
            echo "Erro: imagem de capa do projeto não enviada ou inválida.";
            exit;
        }
    }
}
