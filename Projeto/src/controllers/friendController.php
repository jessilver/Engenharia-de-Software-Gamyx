<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Friend;

class friendController extends Controller {

    public function addFriend(){
        $user = filter_input(INPUT_POST, "userId");
        $friend = filter_input(INPUT_POST, "friendId");
        

        if($user && $friend){
            
            Friend::insert([
                'friend_1' => $user,
                'friend_2' => $friend,
            ])->execute();

            $this->redirect('/perfil');
            exit;
        }

        $this->redirect('/perfil');
        exit;
    }

    public function deleteFriend(){
        $user = filter_input(INPUT_POST, "userId");
        $friend = filter_input(INPUT_POST, "friendId");

        if($user && $friend){
            echo "entrou";
            Friend::deleteFriend($user, $friend);
            $this->redirect("/perfil");
            exit;
        }

        $this->redirect("/perfil");
        exit;
    }

    public function api($id){
        $friends = Friend::select()
                        ->where('friend_1', $id['id'])
                        ->orWhere('friend_2', $id['id'])
                        ->execute();

        $users = [];
        foreach($friends as $friend){
            if($friend['friend_1'] == $id['id']){
                $users[] = Usuario::selectUser($friend['friend_2']);
            } else {
                $users[] = Usuario::selectUser($friend['friend_1']);
            }
        }

        echo json_encode($users);
    }

}