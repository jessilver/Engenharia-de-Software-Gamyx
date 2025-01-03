<?php
namespace src\models;
use \core\Model;
use Exception;

class Project extends Model {

    /**
     * Seleciona um projeto pelo ID fornecido.
     *
     * Este método recupera o projeto identificado pelo ID fornecido.
     *
     * @param int $id O ID do projeto a ser selecionado.
     * @param array $fields (opcional) Um array de campos a serem retornados.
     *                      Se não forem fornecidos, todos os campos do projeto serão retornados.
     * 
     *                      campos aceitos:
     *                    - 'id' (int) -> id do projeto      
     *                    - 'nomeProjeto' (string) -> Nome do projeto     
     *                    - 'descricaoProjeto' (string) -> Descrição do projeto
     *                    - 'linkDownload' (string) -> Link para o reposítório do projeto
     *                    - 'sistemasOperacionaisSuportados' (string) -> Sistemas opercionais que rodam o projeto
     *                    - 'fotoCapa' (string) -> path para a foto de capa do projeto  
     *                    - 'usuario_id' (int) -> FK id do Usuario                 
     *
     * @return array|Exception Se o projeto for encontrado, retorna um array associativo com os dados do projeto. 
     *                         Se ocorrer um erro durante a consulta, uma Exception será lançada.
     *
     * @throws Exception Se ocorrer um erro ao consultar o banco de dados.
     *
     */
    public static function selectProject($projectId) {
        return self::select(['id', 'nomeProjeto', 'descricaoProjeto', 'linkDownload', 'sistemasOperacionaisSuportados', 'fotoCapa', 'usuario_id'])
                   ->where('id', $projectId)
                   ->first();
    }
    
       /**
     * Seleciona todos os projetos, até um limite de 30.
     *
     * Este método recupera todos os projetos disponíveis, respeitando o limite máximo de 30 resultados.
     *
     * @param array $fields (opcional) Um array de campos a serem retornados.
     *                      Se não forem fornecidos, todos os campos dos projetos serão retornados.
     *
     *                      campos aceitos:
     *                    - 'id' (int) -> ID do projeto      
     *                    - 'nomeProjeto' (string) -> Nome do projeto     
     *                    - 'descricaoProjeto' (string) -> Descrição do projeto
     *                    - 'linkDownload' (string) -> Link para o repositório do projeto
     *                    - 'sistemasOperacionaisSuportados' (string) -> Sistemas operacionais que rodam o projeto
     *                    - 'fotoCapa' (string) -> Caminho para a foto de capa do projeto  
     *                    - 'usuario_id' (int) -> FK id do Usuario
     *
     * @return array|Exception Retorna um array associativo com os dados dos projetos.
     *                          Se ocorrer um erro durante a consulta, uma Exception será lançada.
     *
     * @throws Exception Se ocorrer um erro ao consultar o banco de dados.
     *
     */
    public static function selectAllProjects(array $fields = []): array|Exception {
        try {
            return self::select($fields)->limit(30)->get();
        } catch (Exception $e) {
            throw new Exception('Erro ao selecionar todos os projetos: ' . $e->getMessage());
        }
    }
    /**
     * Seleciona projetos associados a um usuário específico.
     *
     * Este método recupera os projetos que pertencem ao usuário identificado pelo ID fornecido.
     *
     * @param int $id O ID do usuário cujos projetos serão selecionados.
     * @param array $fields (opcional) Um array de campos a serem retornados.
     *                      Se não forem fornecidos, todos os campos dos projetos serão retornados.
     * 
     *                      campos aceitos:
     *                    - 'id' (int) -> id do projeto      
     *                    - 'nomeProjeto' (string) -> Nome do projeto     
     *                    - 'descricaoProjeto' (string) -> Descrição do projeto
     *                    - 'linkDownload' (string) -> Link para o reposítório do projeto
     *                    - 'sistemasOperacionaisSuportados' (string) -> Sistemas opercionais que rodam o projeto
     *                    - 'fotoCapa' (string) -> path para a foto de capa do projeto  
     *                    - 'usuario_id' (int) -> FK id do Usuario
     *
     * @return array|Exception Um array contendo os projetos associados ao usuário.
     *                         Se ocorrer um erro durante a consulta, uma Exception será lançada.
     *
     * @throws Exception Se ocorrer um erro ao consultar o banco de dados.
     *
     */
    // public static function selectProjectByUserId(int $id, array $fields = []): array|Exception {
    //     try {
    //         $fields = array_map(fn($field) => "projects.$field", $fields);
    //         return self::select($fields)
    //                     ->join('usuarios', 'usuarios.id', '=', 'projects.usuario_id')
    //                     ->where('projects.usuario_id', $id)
    //                     ->execute();
    //     } catch (Exception $e) {
    //         throw new Exception('Erro ao selecionar projetos: ' . $e->getMessage());
    //     }
    // }
    public static function selectProjectByUserId( $id, array $fields = []): array|Exception {
        try {
            return self::select($fields ?: '*')
                        ->where('usuario_id', $id)
                        ->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao selecionar projetos: ' . $e->getMessage());
        }
    }
    

    /**
     * Atualiza um projeto com os dados fornecidos.
     *
     * Este método atualiza o projeto identificado pelo ID com os campos especificados.
     *
     * @param int $id O ID do projeto a ser atualizado.
     * @param array $fields Um array associativo com os campos e valores a serem atualizados.
     * 
     *                      campos aceitos:
     *                    - 'id' (int) -> id do projeto      
     *                    - 'nomeProjeto' (string) -> Nome do projeto     
     *                    - 'descricaoProjeto' (string) -> Descrição do projeto
     *                    - 'linkDownload' (string) -> Link para o reposítório do projeto
     *                    - 'sistemasOperacionaisSuportados' (string) -> Sistemas opercionais que rodam o projeto
     *                    - 'fotoCapa' (string) -> path para a foto de capa do projeto  
     *                    - 'usuario_id' (int) -> FK id do Usuario
     *
     * @return int O número de registros afetados pela atualização.
     *
     * @throws Exception Se ocorrer um erro ao atualizar o banco de dados.
     *
     */
    public static function updateProject(int $id, array $fields) {
        try {
            return self::update($fields)
                        ->where('id', '=', $id)
                        ->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar projeto: ' . $e->getMessage());
        }
    }

    /**
     * Deleta um projeto pelo ID.
     *
     * @param int $id O ID do projeto a ser deletado.
     * @return bool|Exception Retorna true se a deleção for bem-sucedida, ou lança uma exceção em caso de erro.
     * @throws Exception Se ocorrer um erro ao tentar deletar o projeto.
     */
    public static function deleteProject(int $id): bool|Exception {
        try {
            self::delete($id);
            return true; // Retorna true se a deleção for bem-sucedida
        } catch (Exception $e) {
            throw new Exception('Erro ao deletar projeto: ' . $e->getMessage());
        }
    }

    public function deleteProjectInstance(int $id): bool|Exception {
        return self::deleteProject($id);
    }
    // Configurando mocks
    private static $mockInstance;

    public static function setMockInstance($mock) {
        self::$mockInstance = $mock;
    }

    public static function select($columns = ['*']) {
        if (self::$mockInstance) {
            return self::$mockInstance->select($columns);
        }
        return parent::select($columns);
    }

    /**
     * Realiza um INNER JOIN entre as tabelas 'projects' e 'usuarios' e retorna os resultados.
     *
     * Este método combina informações de projetos e usuários com base na chave estrangeira 'usuario_id'.
     *
     * @param array $fields Um array de campos a serem selecionados no formato:
     *                      - 'projects.campo' para campos da tabela 'projects'.
     *                      - 'usuarios.campo' para campos da tabela 'usuarios'.
     *                      Exemplo: ['projects.nomeProjeto', 'usuarios.nome']
     * @param array $conditions (opcional) Um array associativo de condições adicionais no formato:
     *                          ['campo' => 'valor'].
     * @return array|Exception Retorna um array com os resultados ou lança uma exceção em caso de erro.
     *
     * @throws Exception Se ocorrer um erro durante a consulta.
     */
    public static function selectProjectsWithUsers(array $fields = ['*'], array $conditions = []): array|Exception {
        try {
            // Inicializa a consulta com os campos fornecidos
            $query = self::select($fields)
                ->join('usuarios', 'usuarios.id', '=', 'projects.usuario_id'); // Define o INNER JOIN
            
            // Adiciona condições, se existirem
            foreach ($conditions as $field => $value) {
                $query = $query->where($field, '=', $value);
            }

            // Executa a consulta e retorna os resultados
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao realizar consulta com INNER JOIN: ' . $e->getMessage());
        }
    }
}