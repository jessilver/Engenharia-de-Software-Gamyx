<?php

namespace Tests;

require_once __DIR__ . '/MockUsuario.php';
require_once __DIR__ . '/MockProject.php';

use PHPUnit\Framework\TestCase;
use tests\MockUsuario;
use tests\MockProject;
use core\OutputColors;

class BuscaUsuarioOuProjetoTest extends TestCase{
    /**
     * Teste para seleção de usuário válido
     */
    public function testSelectUser()
    {
        $output = OutputColors::setColors();

        MockUsuario::setMockInstance(new MockUsuario());
        $result = MockUsuario::selectUser(1);
        $expectedData = [
            'id' => 1,
            'nomeUsuario' => 'Maria',
            'email' => 'maria@example.com',
            'senha' => password_hash('senhaSegura123', PASSWORD_DEFAULT)
        ];

        $this->assertEquals($expectedData['id'], $result['id'], 'ID não corresponde');
        $this->assertEquals($expectedData['nomeUsuario'], $result['nomeUsuario'], 'Nome do usuário não corresponde');
        $this->assertEquals($expectedData['email'], $result['email'], 'Email não corresponde');
        $this->assertTrue(password_verify('senhaSegura123', $result['senha']), 'Senha não corresponde');

        $output->writeln('<success>Pass successful: Usuário encontrado</success>');
    }
    /**
     * Teste para seleção de projeto válido
     */
    public function testSelectProject(){
        $output = OutputColors::setColors();

        MockProject::setMockInstance(new MockProject());
        $result = MockProject::selectProject(1);

        $expectedData = [
            'id' => 1,
            'nomeProjeto' => 'Projeto Exemplo',
            'descricaoProjeto' => 'Descrição de teste',
            'linkDownload' => 'http://example.com/download',
            'sistemasOperacionaisSuportados' => 'Windows, Mac',
            'fotoCapa' => '/images/capa.jpg',
            'usuario_id' => 1
        ];

        $this->assertEquals($expectedData['id'], $result['id'], 'ID do projeto não corresponde');
        $this->assertEquals($expectedData['nomeProjeto'], $result['nomeProjeto'], 'Nome do projeto não corresponde');
        $this->assertEquals($expectedData['descricaoProjeto'], $result['descricaoProjeto'], 'Descrição do projeto não corresponde');
        $this->assertEquals($expectedData['linkDownload'], $result['linkDownload'], 'Link de download não corresponde');
        $this->assertEquals($expectedData['sistemasOperacionaisSuportados'], $result['sistemasOperacionaisSuportados'], 'Sistemas operacionais suportados não correspondem');
        $this->assertEquals($expectedData['fotoCapa'], $result['fotoCapa'], 'Foto de capa não corresponde');
        $this->assertEquals($expectedData['usuario_id'], $result['usuario_id'], 'ID do usuário não corresponde');

        $output->writeln('<success>Pass successful: Projeto encontrado</success>');
    }
    /**
     * Teste para ver se a pesquisa por projeto inválido retorna null
     */
    public function testSelectNonExistentProject(){
        $output = OutputColors::setColors();

        // Mudando flag para retornar null
        MockProject::$returnNull = true;
        $result = MockProject::selectProject(999999); 

        $this->assertNull($result, 'Erro: deveria retornar null para projeto inexistente');

        $output->writeln('<success>Pass successful: Projeto inexistente retornou null</success>');
    }
    /**
     * Teste para ver se a pesquisa por todos os projetos de um usuário retorna seu array de projetos
     */
    public function testSelectProjectsByUser(){
        $output = OutputColors::setColors();
    
        MockProject::setMockInstance(new class extends MockProject {
            public function execute(){
                return [
                    [
                        'id' => 1,
                        'nomeProjeto' => 'Projeto 1',
                        'usuario_id' => 1
                    ],
                    [
                        'id' => 2,
                        'nomeProjeto' => 'Projeto 2',
                        'usuario_id' => 1
                    ]
                ]; 
            }
        });
        $result = MockProject::selectProjectByUserId(1);
    
        $this->assertCount(2, $result, 'Erro: quantidade de projetos retornados não corresponde');
        $this->assertEquals(1, $result[0]['usuario_id'], 'Erro: o usuário associado ao projeto não corresponde');

        $output->writeln('<success>Pass successful: Projetos do usuário retornados corretamente</success>');
    }
    /**
     * Teste para ver se a pesquisa de campos específicos funciona corretamente
     */
    public function testSelectSpecificFields(){
        $output = OutputColors::setColors();

        MockProject::setMockInstance(new class extends MockProject {
            public function first()
            {
                return ['id' => 1, 'nomeProjeto' => 'Projeto Exemplo']; // Retorna apenas campos selecionados
            }
        });

        $fields = ['id', 'nomeProjeto'];
        $result = MockProject::selectProject(1, $fields);

        $this->assertArrayHasKey('id', $result, 'Erro: campo "id" não retornado');
        $this->assertArrayHasKey('nomeProjeto', $result, 'Erro: campo "nomeProjeto" não retornado');
        $this->assertArrayNotHasKey('descricaoProjeto', $result, 'Erro: campo "descricaoProjeto" não deveria estar presente');
        
        $output->writeln('<success>Pass successful: Campos retornados corretamente</success>');
    }

}

// ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/BuscaUsuarioOuProjetoTest.php

