<?php
namespace src\controllers;

use \core\Controller;
use src\models\Project;
use \src\models\Usuario;

class ProjectController extends Controller {

    public function getAllProjects($id) {
        if (!is_array($id) || !isset($id['id'])) {
            echo json_encode(['error' => 'ID inválido ou ausente']);
            return;
        }
        $id = $id['id'];
        
        $projetos = Project::select()->where('usuario_id', '=', $id)->execute();

        if (count($projetos) > 0) {
            
            header('Content-Type: application/json');
            echo json_encode($projetos);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Nenhum projeto encontrado para este usuário']);
        }
    }

}