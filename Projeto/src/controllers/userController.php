<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;

class userController extends Controller {

    public function index() {
        $this->render('test');
    }
    public function auth() {

        $email = htmlspecialchars(filter_input(INPUT_POST, 'email')) ;
        $password = htmlspecialchars(filter_input(INPUT_POST, 'password'));

        if($email && $password) {
            $data = Usuario::select()->where('email', $email)->where('password', md5($password))->one();

            if($data) {
                $_SESSION['userLogado'] = [
                    'id' => $data['id'],
                    'email' => $data['email']
                ];
                $this->redirect('/perfil');
            } else {
                $this->redirect('/login');
            }
        } else {
            $this->redirect('/login');
        }
    }

}