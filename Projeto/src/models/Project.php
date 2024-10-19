<?php
namespace src\models;
use \core\Model;

class Project extends Model {
    public static function deleteById($id) {
        return self::select()->delete()->where('id', $id)->execute();
    }
}