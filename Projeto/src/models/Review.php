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

    public static function getReviewsWithUniqueName(int $projetoId): ?array {
        return self::select(['reviews.nota', 'usuarios.uniqueName'])
            ->join('usuarios', 'usuarios.id', '=', 'reviews.usuario_id')
            ->where('reviews.projeto_id', $projetoId)
            ->execute();
    }

    public static function getAllProjectsReviews(): ?array {
        return self::select(['reviews.nota', 'usuarios.uniqueName', 'projects.nomeProjeto'])
            ->join('projects', 'projects.id', '=', 'reviews.projeto_id')
            ->join('usuarios', 'usuarios.id', '=', 'reviews.usuario_id')
            ->execute();
    }
}