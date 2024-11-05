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
        $nomeProjeto = filter_input(INPUT_POST,'nomeProjeto');
        $descricaoProjeto = filter_input(INPUT_POST,'descricaoProjeto');
        $linkDownload = filter_input(INPUT_POST,'linkDownload');
        $sistemasOperacionais = [];

        if (isset($_POST['windows'])) $sistemasOperacionais[] = 'windows';
        if (isset($_POST['linux'])) $sistemasOperacionais[] = 'linux';
        if (isset($_POST['mac'])) $sistemasOperacionais[] = 'mac';

        $diretorioDestino = '../../public/static/img/capasProjetos/';

        if (isset($_FILES['imagemCapaProjeto']) && $_FILES['imagemCapaProjeto']['error'] == 0) {
            $imagemCapa = $_FILES['imagemCapaProjeto'];
            $nomeArquivo = basename($imagemCapa['name']) . '_' . $_SESSION['userLogado']['arroba'];
            $caminhoArquivo = $diretorioDestino . $nomeArquivo;
    
            if (move_uploaded_file($imagemCapa['tmp_name'], $caminhoArquivo)) {
                $emailUsuario = $_SESSION['userLogado']['email'];

                $usuarioLogado = Usuario::select()->where('email', $emailUsuario)->execute();
    
                
    
                if ($usuarioLogado['id']) {
                    $sistemasOperacionaisJson = json_encode($sistemasOperacionais);

                    if($nomeProjeto && $descricaoProjeto && $linkDownload){

                        Project::insert([
                            'nomeProjeto' => $nomeProjeto,
                            'descricaoProjeto' => $descricaoProjeto,
                            'linkDownload' => $linkDownload,
                            'sistemasOperacionaisSuportados' => $sistemasOperacionaisJson,
                            'fotoCapa' => $nomeArquivo,
                            'usuario_id' => $usuarioLogado['id']
                        ])->execute();
            
                    }
                }
            }
        }

        $this->redirect('/perfil');
        exit;
    }
}