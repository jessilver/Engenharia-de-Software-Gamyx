<?php
namespace src\controllers;

use core\Controller;
use src\Config;

class MenuController extends Controller {
    public function index() {
        $baseDir = Config::BASE_DIR;
        $view = 'partials/menu'; 
        $data = ['baseDir' => $baseDir]; //
        $this->view($view, $data);
    }
}
