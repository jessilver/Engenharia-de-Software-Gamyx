<?php

namespace tests;

use src\models\Usuario;

class MockUsuario extends Usuario {
    public function where($column, $value) {
        return $this;
    }

    public function orWhere($column, $value) {
        return $this;
    }

    public function first() {
        return [
            'id' => 1,
            'nomeUsuario' => 'Maria',
            'email' => 'maria@example.com',
            'senha' => password_hash('senhaSegura123', PASSWORD_DEFAULT)
        ];
    }

    // Sobrescreva o método estático 'select' no mock
    public static function select($columns = ['*']) {
        return new static;
    }
}
