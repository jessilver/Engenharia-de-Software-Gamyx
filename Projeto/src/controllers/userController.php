<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;

class userController extends Controller {
    public function index() {
        $this->render('/login'); // Renderiza a página de login
    }

    public function auth() {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_or_username = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            // Verificar os dados usando o modelo Usuario
            $usuario = Usuario::select()
                ->where('email', $email_or_username)
                ->orWhere('nomeUsuario', $email_or_username)
                ->execute();
               
                var_dump($usuario['senha']);
                var_dump(password_verify($password, $usuario['senha']));
                exit(); 

            if ($usuario && password_verify($password, $usuario['senha'])) {
                $_SESSION['userLogado'] = [
                    'id' => $usuario['id'],
                    'email' => $usuario['email']
                ];
                $this->redirect('/testeG');
            }
        } else {
            $_SESSION['login_error'] = "Método de requisição inválido.";
            $this->render('/login');
        }
    }
}