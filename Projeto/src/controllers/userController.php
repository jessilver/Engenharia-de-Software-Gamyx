<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;

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
                    'senha' => $senha,
                    'urlPortfolio' => $portfolioUser
                ])->execute();
            }

            $this->redirect('/cadastrarUsuario');
            exit;
        }

        $this->redirect('/cadastrarUsuario');
        exit;
    }
    public function auth() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = filter_input(INPUT_POST, 'login');
            $senha = filter_input(INPUT_POST, 'password');

            if ($login && $senha) {
                $usuario = Usuario::select()
                    ->where('email', $login)
                    ->orWhere('nomeUsuario', $login)
                    ->first();

                if ($usuario && password_verify($senha, $usuario['senha'])) {
                    $_SESSION['user_id'] = $usuario['id'];
                    $this->redirect('/perfilUsuario');
                    exit;
                } else {
                    echo "Credenciais inválidas.";
                }
            } else {
                echo "Por favor, preencha todos os campos.";
            }
        } else {
            $this->render('login');
        }
    }
    public function index() {
        $userId = $_SESSION['user_id'] ?? null;

        if ($userId) {
            $usuario = Usuario::select()->where('id', $userId)->first();

            if ($usuario) {
                $this->render('perfilUsuario', [
                    'usuario' => $usuario
                ]);
            } else {
                echo "Usuário não encontrado.";
            }
        } else {
            // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //     $usr = new UserController();
            //     $usr->login();
            // }
            $this->render('login');
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('/login');
        exit;
    }

}