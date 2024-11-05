<?php
namespace src\controllers;

use core\Controller;
use src\models\Usuario;

class SearchProjectController extends Controller {

    public function apiSearch($filter, $data){
        $usuarios = []; // Inicializa a variável
    
        // Verificar o tipo de filtro
        switch ($filter) {
            case 'nome':
                $usuarios = Usuario::select()->where('nome', 'LIKE', '%' . $data . '%')->execute();
                break;
            case 'email':
                $usuarios = Usuario::select()->where('email', 'LIKE', '%' . $data . '%')->execute();
                break;
            case 'uniqueName':
                $usuarios = Usuario::select()->where('uniqueName', 'LIKE', '%' . $data . '%')->execute();
                break;
            default:
                http_response_code(400); // Bad request
                echo json_encode(['error' => 'Filtro inválido.']);
                return; // Encerra a execução
        }
    
        // Retorna os dados em formato JSON
        header('Content-Type: application/json');
    
        if (empty($usuarios)) {
            http_response_code(204); // No Content
            echo json_encode(['message' => 'Nenhum usuário encontrado.']);
        } else {
            echo json_encode($usuarios); // Retorna os usuários encontrados
        }
    }
    
    
}
