<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class ApiBuscarProjetosTest extends TestCase
{
    private $baseUrl = 'http://localhost/Engenharia-de-Software-Gamyx/Projeto/public/user/';

    public function testGetItems()
    {
        $id = 3;
        $url = $this->baseUrl .  $id .'/projetos';

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

        if (count($data) > 0) {
            $this->assertArrayHasKey('nomeProjeto', $data[0], "O item não tem chave 'nomeProjeto'");
            $this->assertArrayHasKey('descricaoProjeto', $data[0], "O item não tem chave 'descricaoProjeto'");
            $this->assertArrayHasKey('linkDownload', $data[0], "O item não tem chave 'linkDownload'");
            $this->assertArrayHasKey('sistemasOperacionaisSuportados', $data[0], "O item não tem chave 'sistemasOperacionaisSuportados'");
        }
    }
}
