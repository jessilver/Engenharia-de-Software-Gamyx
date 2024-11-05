<?php
namespace src\controllers;

use core\Controller;
use src\models\Project;
use src\models\Usuario;

class SearchProjectController extends Controller {

    public function apiSearch($filter, $data){
        $projetos = []; // Inicializa a variável
    
        // Verificar o tipo de filtro
        switch ($filter) {
            case 'nomeProjeto':
                $projetos = Project::select()->where('nomeProjeto', $data)->execute();
                break;
            case 'sistemasOperacionais':
                $projetos = Project::select()->where('sistemasOperacionaisSuportados', 'LIKE', '%' . $data . '%')->execute();
                break;
            default:
                http_response_code(400); // Bad request
                echo json_encode(['error' => 'Filtro inválido.']);
                return; // Encerra a execução
        }
    
        // Retorna os dados em formato JSON
        header('Content-Type: application/json');
    
        if (empty($projetos)) {
            http_response_code(204); // No Content
            echo json_encode(['message' => 'Nenhum projeto encontrado.']);
        } else {
            echo json_encode($projetos); // Retorna os projetos encontrados
        }
    }
    
    
}
