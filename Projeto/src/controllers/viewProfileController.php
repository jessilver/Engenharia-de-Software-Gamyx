<?php

namespace src\controllers;

use \core\Model;
use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;

class ViewProfileController extends Controller
{

    // public function index() {
    //     // $usuarioId = $_SESSION['userLogado']['id'];
    //     $usuarioId = $_SESSION['userLogado']['id'] ?? null;

    //     $usuario = Usuario::selectUser($usuarioId);
    //     $projects = Project::selectProjectByUserId($usuarioId);

    //     $friends = Usuario::select()
    //                     ->join('friends', function($join) use ($usuario) {
    //                         $join->on('friends.friend_1', '=', 'usuarios.id')
    //                              ->orOn('friends.friend_2', '=', 'usuarios.id');
    //                     })
    //                     ->where(function($query) use ($usuario) {
    //                         $query->where('friends.friend_1', '=', $usuario['id'])
    //                               ->orWhere('friends.friend_2', '=', $usuario['id']);
    //                     })
    //                     ->execute();

    //     // Filter out the logged-in user from the friends list
        
    //     $context = [
    //         'user' => $usuario,
    //         'HashUserId' => Model::encryptData($usuarioId),
    //         'projects' => $projects,
    //         'friends' => $friends
    //     ];
    
    //     $this->render('viewProfile', $context);
    // }

    public function index() {
        $usuarioId = $_SESSION['userLogado']['id'] ?? null;
    
        $usuario = Usuario::selectUser($usuarioId);
        $projects = $_SESSION['filteredProjects'] ?? Project::selectProjectByUserId($usuarioId);
    
        unset($_SESSION['filteredProjects']);
    
        $friends = Usuario::select()
                        ->join('friends', function($join) use ($usuario) {
                            $join->on('friends.friend_1', '=', 'usuarios.id')
                                 ->orOn('friends.friend_2', '=', 'usuarios.id');
                        })
                        ->where(function($query) use ($usuario) {
                            $query->where('friends.friend_1', '=', $usuario['id'])
                                  ->orWhere('friends.friend_2', '=', $usuario['id']);
                        })
                        ->execute();
    
        $context = [
            'user' => $usuario,
            'HashUserId' => Model::encryptData($usuarioId),
            'projects' => $projects,
            'friends' => $friends
        ];
    
        $this->render('viewProfile', $context);
    }
    
    
    public function edit($id)
    {
        if (is_array($id) && isset($id['id'])) {
            $usuarioId = Model::decryptData($id['id']);
            // echo "Decrypted ID: $usuarioId\n";
        } else {
            throw new \InvalidArgumentException('Formato de dados inválido: id deve ser um array com uma chave "id".');
        }
        
        $about = $_POST['about'] ?? null;
        $linkPortfolio = $_POST['linkPortfolio'] ?? null;
        
        if ($about === null || $linkPortfolio === null) {
            throw new \InvalidArgumentException('Dados POST obrigatórios ausentes.');
        }
        $fields = [
            'about' => $about,
            'urlPortfolio' => $linkPortfolio
        ];
        
        $updateSuccess = Usuario::updateUser($usuarioId, $fields);
        $this->redirect('/perfil');
    
        return $updateSuccess;
    }

    public function logout(){
        session_destroy();
        $this->redirect('/login');
    }

    public function delete($id){
        $usuarioId = Model::decryptData($id['id']);
        Usuario::deleteUser($usuarioId);
        // $this->redirect('/');
    }

    public function other() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['search_query'])) {
                $usuarioPesquisado = $_POST['search_query'];
                // Busca o usuário no banco de dados
                $usuario = Usuario::select()->where('nomeUsuario', $usuarioPesquisado)->execute();
                if (!empty($usuario)) {

                    $projects = Project::selectProjectByUserId($usuario[0]['id']);

                    $friends = Usuario::select()
                        ->join('friends', function($join) use ($usuario) {
                            $join->on('friends.friend_1', '=', 'usuarios.id')
                                 ->orOn('friends.friend_2', '=', 'usuarios.id');
                        })
                        ->where(function($query) use ($usuario) {
                            $query->where('friends.friend_1', '=', $usuario[0]['id'])
                                  ->orWhere('friends.friend_2', '=', $usuario[0]['id']);
                        })
                        ->execute();
                        
                    $isFriend = false;
                    foreach ($friends as $friend) {
                        if ($friend['friend_1'] == $_SESSION['userLogado']['id'] || $friend['friend_2'] == $_SESSION['userLogado']['id']) {
                            $isFriend = true;
                            break;
                        }
                    }
                    $context['isFriend'] = $isFriend;

                    $context = [
                        'user' => $usuario[0], //O [0] é porque a pesquisa retorna um array de usuarios, queremos somente o primeiro encontrado
                        'friends' => $friends,
                        'isFriend' => $isFriend,
                        'projects' => $projects
                    ];
                    $this->render('othersProfile', $context);
                    return;
                }
            }
            //Usuário não encontrado ou busca vazia, retorna para o perfil atual
            $this->index();
        }
    }

    public function changeProfilePicture() {
        $usuarioId = $_SESSION['userLogado']['id'] ?? null;

        if ($usuarioId === null) {
            $this->redirect('/login');
            return;
        }

        $fotoPerfil = $_FILES['fotoPerfil'] ?? null;

        if ($fotoPerfil && $fotoPerfil['error'] == 0) {
            $nomeArquivo = basename($fotoPerfil['name']);
            $diretorioDestino = __DIR__ . '/../../public/static/img/perfil/';
            $caminhoArquivo = $diretorioDestino . $nomeArquivo;

            // Verificar se o diretório de destino existe, se não, criar
            if (!is_dir($diretorioDestino)) {
                mkdir($diretorioDestino, 0777, true);
            }

            // Mover o arquivo para o diretório de destino
            if (!move_uploaded_file($fotoPerfil['tmp_name'], $caminhoArquivo)) {
                echo "Erro ao mover o arquivo.";
                exit();
            }

            // Atualizar o caminho da imagem no banco de dados
            Usuario::updateUser($usuarioId, ['fotoPerfil' => $nomeArquivo]);

            // Atualizar a sessão do usuário
            $_SESSION['userLogado']['fotoPerfil'] = $nomeArquivo;

            $this->redirect('/perfil');
        } else {
            echo "Erro ao enviar a imagem.";
        }
    }

}
