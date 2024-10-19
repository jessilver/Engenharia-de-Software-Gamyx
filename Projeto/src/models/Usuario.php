<?php
namespace src\models;
use \core\Model;

class Usuario extends Model {

    public static function selectUser($id, $fieldsl = []){
        return self::select($fieldsl)->where('id', $id)->first();
    }
    
    public static function updateUser($id, $fields) {
        return self::update($fields)
                    ->where('id', '=', $id)
                    ->execute();
    }

}