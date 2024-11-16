<?php
namespace src\controllers;

use \core\Controller;
use src\models\Project;
use \src\models\Usuario;

class ProjectController extends Controller {

    public function getAllProjects($id) {
        $id = $id['id'];
        if (!is_numeric($id)) {
            echo json_encode(['error' => 'ID invalido, id: '. $id]);
            return;
        }

        $projetos = Project::select()->where('usuario_id', '=', $id)->execute();

        if (count($projetos) > 0) {
            header('Content-Type: application/json');
            return json_encode($projetos);
        } else {
            header('Content-Type: application/json');
            return json_encode(['message' => 'Nenhum projeto encontrado para este usuário']);
        }
    }

}