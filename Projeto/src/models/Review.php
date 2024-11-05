<?php
namespace src\models;

use \core\Model;

class Review extends Model {
    public static function addReviews(int $usuarioId, int $projetoId, int $nota): bool {
        // Tente executar a inserção e retorne verdadeiro ou falso
        return self::insert([
            'usuario_id' => $usuarioId,
            'projeto_id' => $projetoId,
            'nota' => $nota
        ])->execute() !== false; // Verifica se a execução retornou falso
    }

    public static function getMediaReviews(int $projetoId): float {
        return self::select(['AVG(nota) AS media'])
            ->where('projeto_id', $projetoId)
            ->execute()[0]['media'] ?? 0;
    }

    public static function getReviewsUsuario(int $usuarioId, int $projetoId): ?array {
        // Execute a consulta para obter a avaliação
        $result = self::select(['nota'])
            ->where('usuario_id', $usuarioId)
            ->where('projeto_id', $projetoId)
            ->first();
    
        // Se o resultado for falso (sem registros), retorna null
        return $result ?: null; 
    }

    public static function updateNota(int $usuarioId, int $projetoId, int $nota): bool {
        return self::update(['nota' => $nota])
            ->where('usuario_id', $usuarioId)
            ->where('projeto_id', $projetoId)
            ->execute() !== false; // Retorna true ou false
    }
}