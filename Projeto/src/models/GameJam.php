<?php
namespace src\models;

use \core\Model;
use \src\models\Usuario;
use Exception;

class GameJam extends Model {

    /**
     * Retorna uma Game Jam pelo ID.
     *
     * Este método recupera os dados de uma Game Jam específica do banco de dados.
     *
     * @param int $jamId O ID da Game Jam a ser buscada.
     * @param array $fields (opcional) Um array de campos a serem retornados.
     *                      Se não fornecido, retorna todos os campos.
     *
     * @return array Retorna os dados da Game Jam como um array associativo.
     * @throws Exception Se não encontrar a Game Jam ou ocorrer erro na consulta.
     */
    public static function getJamById(int $jamId, array $fields = []): array {
        try {
            $query = self::select($fields)->where('id', $jamId)->limit(1);
            $result = $query->first();

            if (!$result) {
                throw new Exception('Game Jam não encontrada com o ID fornecido.');
            }

            return $result;
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar a Game Jam pelo ID: ' . $e->getMessage());
        }
    }

    /**
     * Retorna todas as Game Jams do banco de dados.
     *
     * Este método recupera todas as Game Jams existentes no banco de dados.
     *
     * @param array $fields (opcional) Um array de campos a serem retornados.
     *                      Se não fornecido, retorna todos os campos.
     *
     *                      Campos disponíveis:
     *                      - 'id' (int): ID da Game Jam
     *                      - 'host_id' (int): ID do usuário host
     *                      - 'nomeJam' (string): Nome da Game Jam
     *                      - 'descricaoJam' (string): Descrição da Game Jam
     *
     * @return array|Exception Retorna um array de Game Jams ou lança uma exceção em caso de erro.
     * @throws Exception Se houver falha ao consultar o banco de dados.
     */
    public static function getAllJams(): array {
        try {
            return self::select()->get();  // Retorna todos os registros da tabela 'gamejam'
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar todas as Game Jams: ' . $e->getMessage());
        }
    }

    /**
     * Retorna o usuário host de uma Game Jam.
     *
     * Este método recupera o host associado à Game Jam pelo `host_id`.
     *
     * @param int $hostId O ID do host.
     * @param array $fields (opcional) Um array de campos a serem retornados do usuário.
     *                      Se não fornecido, retorna todos os campos do usuário.
     *
     *                      Campos sugeridos:
     *                      - 'id' (int): ID do usuário
     *                      - 'uniqueName' (string): Nome único do usuário
     *                      - 'nomeUsuario' (string): Nome do usuário
     *                      - 'email' (string): Email do usuário
     *
     * @return array|Exception Retorna os dados do host ou lança uma exceção em caso de erro.
     * @throws Exception Se houver falha ao consultar o banco de dados.
     */
    public static function getHostById(int $hostId): array {
        try {
            return Usuario::selectUser($hostId);
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar o host da Game Jam: ' . $e->getMessage());
        }
    }
    /**
     * Insere uma nova Game Jam no banco de dados.
     *
     * @param int $hostId O ID do host da Game Jam.
     * @param string $nome O nome da Game Jam.
     * @param string|null $descricao A descrição da Game Jam (opcional).
     *
     * @return int|Exception Retorna o ID da Game Jam inserida ou lança uma exceção em caso de erro.
     * @throws Exception Se houver falha ao inserir a Game Jam no banco de dados.
     */
    public static function createJam(int $hostId, string $nome, string $descricao): void {
        try {
            $dataAtual = date('Y-m-d');

            self::insert([
                'host_id' => $hostId,
                'nomeJam' => $nome,
                'descricaoJam' => $descricao,
                'dataCriacao' => $dataAtual
            ])->execute();

            //Pega o id da útlima jam do usuário para criar a tabela de participantes
            $gameJamId = self::getLastJam($hostId);
            ParticipantesJam::createTableOfParticipants($gameJamId);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar uma nova Game Jam: ' . $e->getMessage());
        }
    }
    /**
     * Deleta uma Game Jam pelo ID.
     *
     * Este método utiliza o método padrão de deleção definido no model base.
     *
     * @param int $jamId O ID da Game Jam a ser deletada.
     *
     * @return void
     * @throws Exception Se houver falha ao deletar a Game Jam no banco de dados.
     */
    public static function deleteJamById(int $jamId): void {
        try {
            ParticipantesJam::deleteParticipants($jamId);
            self::delete($jamId);
        } catch (Exception $e) {
            throw new Exception('Erro ao deletar a Game Jam: ' . $e->getMessage());
        }
    }

    public static function getLastJam(int $hostId): int {
        try {
            $result = self::select(['id'])  
            ->where('host_id', $hostId)  
            ->orderBy('id', 'DESC')  // Ordenando pelo ID em ordem decrescente
            ->get(); 
    
            return $result[0]['id']; // Pegando a de maior id (mais recente)
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar a Game Jam pelo ID do host: ' . $e->getMessage());
        }

    }
}
