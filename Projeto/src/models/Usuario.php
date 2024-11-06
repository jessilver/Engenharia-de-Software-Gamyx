<?php
namespace src\models;
use \src\models\Project;
use \core\Model;
use Exception;

class Usuario extends Model {

    /**
     * Seleciona um usuário pelo ID.
     *
     * Este método consulta o banco de dados para retornar os dados de um usuário específico.
     *
     * @param int $id O ID do usuário a ser selecionado.
     * @param array $fields (opcional) Um array de campos a serem retornados. Se vazio, retorna todos os campos.
     * 
     *                      campos aceitos:
     *                    - 'id' (int) -> id do usuario      
     *                    - 'uniqueName' (string) -> Nome único do usuario com @
     *                    - 'email' (string) -> email do usuario
     *                    - 'nomeUsuario' (string) -> Nome do usuario
     *                    - 'senha' (string) -> Hash da senha do usuario
     *                    - 'about' (string) -> sobre o usuario  
     *                    - 'urlPortfolio' (string) -> Link para o reposítóriodo  usuario
     *
     * @return array|Exception Retorna um array com os dados do usuário ou lança uma exceção em caso de erro.
     *
     * @throws Exception Lança uma exceção se ocorrer um erro durante a consulta.
     */
    public static function selectUser($id, $fields = []) : array|Exception {
        try {
            return self::select($fields)->where('id', $id)->first();
        } catch (Exception $e) {
            throw new Exception('Erro ao selecionar usuário: ' . $e->getMessage());
        }
    }

    /**
     * Atualiza um usuario com os dados fornecidos.
     *
     * Este método atualiza o usuario identificado pelo ID com os campos especificados.
     *
     * @param int $id O ID do usuario a ser atualizado.
     * @param array $fields Um array associativo com os campos e valores a serem atualizados.
     * 
     *                      campos aceitos:
     *                    - 'id' (int) -> id do usuario      
     *                    - 'uniqueName' (string) -> Nome único do usuario com @
     *                    - 'email' (string) -> email do usuario
     *                    - 'nomeUsuario' (string) -> Nome do usuario
     *                    - 'senha' (string) -> Hash da senha do usuario
     *                    - 'about' (string) -> sobre o usuario  
     *                    - 'urlPortfolio' (string) -> Link para o reposítóriodo  usuario
     *
     * @return int O número de registros afetados pela atualização.
     *
     * @throws Exception Se ocorrer um erro ao atualizar o banco de dados.
     *
     */
    public static function updateUser(int $id, array $fields = []): bool|Exception {
        try {
            self::update($fields)
                ->where('id', '=', $id)
                ->execute();
            return true;
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar usuário: ' . $e->getMessage());
        }
    }

    /**
 * Deleta um usuário pelo ID.
 *
 * @param int $id O ID do usuário a ser deletado.
 * @return bool|Exception Retorna true se a deleção for bem-sucedida, ou lança uma exceção em caso de erro.
 * @throws Exception Se ocorrer um erro ao tentar deletar o usuário.
 */
public static function deleteUser(int $id): bool|Exception {
    try {
        $projectIds = Project::selectProjectByUserId($id, ['id']);

        foreach($projectIds as $userProjectId){
            Project::deleteProject($userProjectId['id']);
        }

        self::delete($id);

        return true;
    } catch (Exception $e) {
        throw new Exception('Erro ao deletar usuário: ' . $e->getMessage());
    }
}

public static function getUserById(int $usuarioId): ?array {
    return self::select(['uniqueName'])
        ->where('id', $usuarioId)
        ->first();
}

}