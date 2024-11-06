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

        $diretorioDestino = '../public/static/img/capasProjetos/';

        if (isset($_FILES['imagemCapaProjeto']) && $_FILES['imagemCapaProjeto']['error'] == 0) {
            $imagemCapa = $_FILES['imagemCapaProjeto'];
            $nomeArquivo = uniqid() . '_' . $usuarioLogado['uniqueName'] . '.' . pathinfo($imagemCapa['name'], PATHINFO_EXTENSION);
            $caminhoArquivo = $diretorioDestino . $nomeArquivo;

            if (!is_dir($diretorioDestino)) {
                mkdir($diretorioDestino, 0777, true);
            }

            if (move_uploaded_file($imagemCapa['tmp_name'], $caminhoArquivo)) {
                $sistemasOperacionaisJson = json_encode($sistemasOperacionais);

                if ($nomeProjeto && $descricaoProjeto && $linkDownload) {
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
