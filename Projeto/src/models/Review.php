<?php
namespace src\models;

use \core\Model;

class Review extends Model {
    public static function addReviews(int $usuarioId, int $projetoId, int $nota, string $uniqueName): bool {
        // Inclui o uniqueName ao registrar a avaliação
        return self::insert([
            'usuario_id' => $usuarioId,
            'projeto_id' => $projetoId,
            'nota' => $nota,
            'uniqueName' => $uniqueName // Adiciona o uniqueName na inserção
        ])->execute() !== false;
    }

    public static function getMediaReviews(int $projetoId): float {
        return self::select(['AVG(nota) AS media'])
            ->where('projeto_id', $projetoId)
            ->execute()[0]['media'] ?? 0;
    }

    public static function getReviewsUsuario(int $usuarioId, int $projetoId): ?array {
        $result = self::select(['nota'])
            ->where('usuario_id', $usuarioId)
            ->where('projeto_id', $projetoId)
            ->first();
    
        return $result ?: null; 
    }

    public static function updateNota(int $usuarioId, int $projetoId, int $nota): bool {
        return self::update(['nota' => $nota])
            ->where('usuario_id', $usuarioId)
            ->where('projeto_id', $projetoId)
            ->execute() !== false;
    }
}
