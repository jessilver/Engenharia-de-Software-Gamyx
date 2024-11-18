<?php
namespace src\models;

use \core\Model;
use \src\models\Usuario;
use Exception;

class ParticipantesJam extends Model {
    /**
     * Retorna a tabela de participantes associada a uma Game Jam.
     *
     * @param int $jamId O ID da Game Jam.
     *
     * @return array A tabela de participantes associados à Game Jam.
     * @throws Exception Se houver falha ao recuperar os participantes.
     */
    public static function getParticipantsByJamId(int $jamId): array {
        try {
            // Recupera todos os campos da tabela de participantes para a Game Jam específica
            $query = self::select()->where('jam_id', $jamId)->limit(1);
            $result = $query->first();
            
            return $result;
        } catch (Exception $e) {
            throw new Exception('Erro ao recuperar a tabela de participantes da Game Jam: ' . $e->getMessage());
        }
    }
    /**
     * Adiciona o usuário da sessão atual na primeira vaga disponível na tabela de participantes.
     *
     * @param int $jamId O ID da Game Jam.
     * @param int $userId O ID do usuário da sessão.
     *
     * @return void
     * @throws Exception Se houver falha ao adicionar o participante.
     */
    public static function joinJam(int $jamId, int $userId): void {
        try {
            // Recupera o nome único do usuário (uniqueName)
            $user = Usuario::selectUser($userId, ['uniqueName']);
            if (!$user) {
                throw new \Exception('Usuário não encontrado.');
            }
            $uniqueName = $user['uniqueName'];
    
            // Recupera os participantes da Game Jam
            $participantes = self::getParticipantsByJamId($jamId);
            if (!$participantes) {
                throw new \Exception('Game Jam não encontrada.');
            }
    
            // Campos fixos de participantes
            $fields = [
                'participante_1', 'participante_2', 'participante_3',
                'participante_4', 'participante_5', 'participante_6',
                'participante_7', 'participante_8'
            ];
    
            // Verifica se o usuário já está participando
            foreach ($fields as $field) {
                if ($participantes[$field] === $uniqueName) {
                    throw new \Exception('Você já está participando desta Game Jam.');
                }
            }
    
            // Encontra o primeiro campo vazio
            $campoVazio = null;
            foreach ($fields as $field) {
                if (empty($participantes[$field])) {
                    $campoVazio = $field;
                    break;
                }
            }
    
            // Verifica se há vagas disponíveis
            if (!$campoVazio) {
                throw new \Exception('Não há vagas disponíveis para esta Game Jam.');
            }
    
            // Insere o usuário no primeiro campo vazio
            self::update([$campoVazio => $uniqueName])
                ->where('jam_id', $jamId)
                ->execute();
    
        } catch (\Exception $e) {
            // Relança a exceção para que o controlador capture
            throw new \Exception('Erro ao adicionar participante: ' . $e->getMessage());
        }
    }
    

    /**
     * Cria uma linha na tabela de participantes associada à Game Jam.
     *
     * @param int $gameJamId O ID da Game Jam para associar aos participantes.
     *
     * @return bool|Exception Retorna true se a linha for criada ou lança uma exceção em caso de erro.
     * @throws Exception Se houver falha ao inserir a linha na tabela de participantes.
     */
    public static function createTableOfParticipants($gameJamId){
        try {
            // Inserir uma linha na tabela de participantes associada à Game Jam
            self::insert([
                'jam_id' => $gameJamId,
                'participante_1' => null,
                'participante_2' => null,
                'participante_3' => null,
                'participante_4' => null,
                'participante_5' => null,
                'participante_6' => null,
                'participante_7' => null,
                'participante_8' => null,
            ])->execute();
            return true;
        } catch (Exception $e) {
            throw new Exception('Erro ao criar uma nova linha de participantes para a Game Jam: ' . $e->getMessage());
        }
    }
    /**
     * Deleta todos os participantes associados a uma Game Jam.
     *
     * @param int $jamId O ID da Game Jam.
     *
     * @return void
     * @throws Exception Se houver falha ao deletar os participantes.
     */
    public static function deleteParticipants(int $jamId): void {
        try {
            $participants = self::select(['id'])  // Apenas queremos os 'id' dos participantes
            ->where('jam_id', $jamId)
            ->get();  // Retorna todos os participantes da Game Jam

            self::delete($participants);  // Deleta os participantes da Game Jam
        } catch (Exception $e) {
            throw new Exception('Erro ao deletar participantes da Game Jam: ' . $e->getMessage());
        }
    }
}
