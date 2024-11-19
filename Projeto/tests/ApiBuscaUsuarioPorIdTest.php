<?php

namespace Tests;

use core\OutputColors;
use PHPUnit\Framework\TestCase;

class ApiBuscaUsuarioPorIdTest extends TestCase
{
    public function testBuscarUsuarioComIdValido(){
        $output = OutputColors::setColors();

        $id = 1;
        $url = "http://localhost/Engenharia-de-Software-Gamyx/Projeto/public/api/busca-usuario/{$id}?acao=buscar-usuario";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json'
        ]);
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Verificar se a resposta tem o código de status 200
        $this->assertEquals(200, $statusCode, "O código de status não é 200");

        // Decodificar a resposta JSON
        $data = json_decode($response, true);

        // Verificar se a resposta é um array
        $this->assertIsArray($data, "A resposta não é um array");

        if (count($data) > 0) {
            $this->assertArrayHasKey('id', $data[0], "O item não tem chave 'id'");
            $this->assertArrayHasKey('nomeUsuario', $data[0], "O item não tem chave 'nomeUsuario'");
            $this->assertArrayHasKey('arroba', $data[0], "O item não tem chave 'arroba'");
            $this->assertArrayHasKey('sobre', $data[0], "O item não tem chave 'sobre'");
        }

        $output->writeln('<success>Pass successful: Teste de busca de usuário na API com ID válido passou!</success>');
    }

    public function testBuscarUsuarioComIdInvalido(){
        $output = OutputColors::setColors();

        $id = 99999; 
        $url = "http://localhost/Engenharia-de-Software-Gamyx/Projeto/public/api/busca-usuario/{$id}?acao=buscar-usuario";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json'
        ]);
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $data = json_decode($response, true);

        $this->assertEquals(200, $statusCode, "O código de status não é 200");
        $this->assertNull($data, "A resposta não é null");

        $output->writeln('<success>Pass successful: Teste de busca de usuário na API com ID inválido passou!</success>');
    }

    public function testAcaoIncorreta(){
        $output = OutputColors::setColors();

        $id = 1;
        $acaoInvalida = "acao-invalida";
        $url = "http://localhost/Engenharia-de-Software-Gamyx/Projeto/public/api/busca-usuario/{$id}?acao={$acaoInvalida}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json'
        ]);
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->assertEquals(200, $statusCode, "O código de status não é 200");

        $data = json_decode($response, true);

        $this->assertIsArray($data, "A resposta não é um array");
        $this->assertCount(0, $data, "A resposta não deveria ter dados para uma ação inválida");

        $output->writeln('<success>Pass successful: Teste de busca de usuário na API com ação inválida passou!</success>');
    }
}

// ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/ApiBuscaUsuarioPorIdTest.php