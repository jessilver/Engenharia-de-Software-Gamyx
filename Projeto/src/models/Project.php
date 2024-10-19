<?php
namespace src\models;
use \core\Model;

class Project extends Model {

    public static function selectProject($id, $fieldsl = []) : array{
        return self::select($fieldsl)->where('id', $id)->first();
    }

    public static function selectProjectByUserId($id, $fields = []) : array{
        return self::select($fields)
                    ->join('usuarios', 'usuarios.id', '=', 'projects.usuario_id')
                    ->where('projects.usuario_id', $id)
                    ->execute();
    }

    public static function updateProject($id, $fields) {
        return self::update($fields)
                    ->where('id', '=', $id)
                    ->execute();
    }
}