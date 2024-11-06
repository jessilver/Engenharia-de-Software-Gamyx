<?php
namespace src\models;
use \core\Model;
use Exception;

class Friend extends Model {
    public static function deleteFriend($friendId1, $friendId2) {
        $friendship = self::select()->where('friend_1', $friendId1)->where('friend_2', $friendId2)->orWhere('friend_1', $friendId2)->where('friend_2', $friendId1)->first();
        if (!empty($friendship)) {
            echo "<br>Amizade encontrada!<br>";
            var_dump($friendship);
            self::delete($friendship['id']);
            echo "Amizade deletada com sucesso!";
        }
    }
}