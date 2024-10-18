<?php
namespace src\models;
use \core\Model;
use \PDO;

class Usuario extends Model {
    public function deleteById($id) {
        $sql = "DELETE FROM usuario WHERE id = :id";
        $stmt = self::$_h->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        
        if ($result) {
            error_log("Usuário com ID: $id deletado com sucesso.");
        } else {
            error_log("Erro ao deletar usuário com ID: $id. Erro: " . implode(", ", $stmt->errorInfo()));
        }
        
        return $result;
    }
}

