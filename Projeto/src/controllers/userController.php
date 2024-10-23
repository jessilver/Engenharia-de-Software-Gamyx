<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;

class UserController extends Controller {

    public function cadastroUsuario() {
        $this->render('cadastroUsuario');
    }

    public function cadastroUsuarioAction(){
        $email = filter_input(INPUT_POST, "email");
        $nomeUsuario = filter_input(INPUT_POST, "nomeUsuario");
        $senha = filter_input(INPUT_POST, "password");
        $portfolioUser = filter_input(INPUT_POST, "portfolioUser");
        $uniqueName = "@".$nomeUsuario;

        if($email && $nomeUsuario && $portfolioUser && $senha){
            $emailExistente = Usuario::select()->where('email', $email)->execute();

            if(\count($emailExistente) === 0){
                Usuario::insert([
                    'email' => $email,
                    'nomeUsuario' => $nomeUsuario,
                    'uniqueName' => $uniqueName,
                    'senha' => password_hash($senha, PASSWORD_DEFAULT),
                    'urlPortfolio' => $portfolioUser
                ])->execute();
            }

            $this->redirect('/cadastrarUsuario');
            exit;
        }

        $this->redirect('/cadastrarUsuario');
        exit;
    }

    public function login(){
        if (!isset($_SESSION['user_id'])) {
                $this->render('login');
            }
    }

    public function loginAction() {

            $login = filter_input(INPUT_POST, 'login');
            $senha = filter_input(INPUT_POST, 'password');

            if ($login && $senha) {
                $usuario = Usuario::select()
                    ->where('email', $login)
                    ->orWhere('nomeUsuario', $login)
                    ->first();

                if ($usuario) {
                    // Verifique se a senha está correta
                    if (password_verify($senha, $usuario['senha'])) {
                        // Iniciar a sessão se ainda não estiver iniciada
                        // if (session_status() == PHP_SESSION_NONE) {
                        //     session_start();
                        // }
                        
                        // Defina a variável de sessão corretamente
                        unset($_SESSION['userLogado']);

                        $_SESSION['userLogado'] = [
                            'id' => $usuario['id'],
                            'nomeUsuario' => $usuario['nomeUsuario'],
                            'email' => $usuario['email']
                        ];

                        // var_dump($_SESSION['userLogado']);

                        // Redirecionar para a página de perfil do usuário
                        $this->redirect('/perfil');
                        exit;
                    } else {
                        echo "Senha inválida.";
                    }
                } else {
                    echo "Usuário não encontrado.";
                }
            } else {
                echo "Por favor, preencha todos os campos.";
            }
        
    }

    public function index() {
        
        // Iniciar a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        
        // Verifique se a variável de sessão está definida
        $userId = $_SESSION['userLogado']['id'] ?? null;
        

        if(!empty($_SESSION['userLogado']['id'])){
            $usuario = Usuario::select()->where('id', $userId)->first();
            echo "User data from database: ";
            var_dump($usuario);

            if ($usuario["id"] > 0) {
                echo "Usuário encontrado.";
                $projects = Project::selectProjectByUserId($userId);
                $context = [
                    'user'=> $usuario,
                    'projects' => $projects
                ];

                $this->render('viewProfile', $context);
            } else {
                echo "Usuário não encontrado.";
            }
        } else {
            if(isset($_SESSION['userLogado'])){
                echo "Usuário não está logado ou ID inválido.";
            }
            
        if (isset($_GET['login']) && isset($_GET['password']))
        {
            $login = $_GET['login'];
            $senha = $_GET['password'];

            $context = new UserController();
            $context->login($login, $senha);
        } else {
            $this->render('login');
        }
            // Redirecionar para a página de login ou exibir mensagem de erro
            //$this->render('login');
        }
    }

    public function logout() {
        session_destroy();
        // header('Location: /login');
        $this->redirect('/login');
        exit;
    }

    // Método para verificar se o usuário está autenticado
    // public function auth() {
    //     if (!isset($_SESSION['user_id'])) {
    //         $this->redirect('/login');
    //         exit;
    //     }
    // }
}