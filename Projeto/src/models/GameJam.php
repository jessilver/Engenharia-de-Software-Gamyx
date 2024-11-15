<?php
namespace src\models;

use \core\Model;
use \src\models\Usuario;
use Exception;

class GameJam extends Model {

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
    public static function getHostById(int $hostId, array $fields = []): array {
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
            $result = self::insert([
                'host_id' => $hostId,
                'nomeJam' => $nome,
                'descricaoJam' => $descricao
            ])->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao criar uma nova Game Jam: ' . $e->getMessage());
        }
    }
    
}
