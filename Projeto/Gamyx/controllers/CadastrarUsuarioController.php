<?php

namespace App\Controllers;

use Gamyx\Models\UserModel;
use Gamyx\Config\Database;

class ExemploController {
    private $model;

    public function __construct() {
        $database = new Database();
        $this->model = new UserModel($database->getConnection());
    }

    public function index() {
        $exemplos = $this->model->getAll();
        // Renderizar a view com os dados
    }
}
