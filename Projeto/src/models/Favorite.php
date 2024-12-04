<?php
namespace src\models;
use \core\Model;
use Exception;

class Favorite extends Model {
    
    public static function getAllFavorites(int $userId) {
        try {
            return self::select()
                ->join('projects', 'favorites.projeto_id', '=', 'projects.id')
                ->where('favorites.usuario_id', $userId)
                ->get();
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar favoritos: ' . $e->getMessage());
        }
    }
    
    public static function addFavorite(int $projectId, int $userId) {
        try {
            return self::insert([
                'usuario_id' => $userId,
                'projeto_id' => $projectId
            ])->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao adicionar favorito: ' . $e->getMessage());
        }
    }

    public static function removeFavorite(int $userId, int $projectId) {
        try {
            $id = self::select('id')->where('usuario_id', $userId)->where('projeto_id', $projectId)->first();
            return self::delete($id)->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao remover favorito: ' . $e->getMessage());
        }
    }

    public static function checkFavorite(int $projectId, int $userId) {
        $favorite = self::select()->where('usuario_id', $userId)->where('projeto_id', $projectId)->first();
        try {
            return $favorite ? true : false;
        } catch (Exception $e) {
            throw new Exception('Erro ao verificar favorito: ' . $e->getMessage());
        }
    }

}