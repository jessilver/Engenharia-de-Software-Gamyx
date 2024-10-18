<?php
namespace src\models;
use \core\Model;

class Usuario extends Model {
    public function deleteById($id) {
        return self::delete($id);
    }
}