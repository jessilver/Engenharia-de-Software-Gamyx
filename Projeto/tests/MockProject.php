<?php

namespace tests;

use src\models\Project;

class MockProject extends Project{
    public function where($column, $value){
        return $this;
    }

    public function orWhere($column, $value){
        return $this;
    }

    public static $returnNull = false; // Teste projeto inexistente

    public function first(){
        if (self::$returnNull) {
            return null; 
        }

        return [
            'id' => 1,
            'nomeProjeto' => 'Projeto Exemplo',
            'descricaoProjeto' => 'Descrição de teste',
            'linkDownload' => 'http://example.com/download',
            'sistemasOperacionaisSuportados' => 'Windows, Mac',
            'fotoCapa' => '/images/capa.jpg',
            'usuario_id' => 1
        ];
    }


    public static function select($columns = ['*']){
        return new static;
    }
}
