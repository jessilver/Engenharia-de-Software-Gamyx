<?php
namespace src\controllers;

use \core\Controller;
use src\models\Project;
use \src\models\Usuario;

class ProjectController extends Controller {

    public function getAllProjects($id) {
        // Verifica se o ID é válido (pode ser um número ou string, dependendo da sua aplicação)
        $id = $id['id'];
        if (!is_numeric($id)) {
            echo json_encode(['error' => 'ID invalido, id: '. $id]);
            return;
        }

        // Recupera os projetos associados ao usuário com o ID fornecido
        $projetos = Project::select()->where('usuario_id', '=', $id)->execute();

        // Verifica se o usuário tem projetos
        if (count($projetos) > 0) {
            // Retorna os projetos em formato JSON
            header('Content-Type: application/json');
            echo json_encode($projetos);
        } else {
            // Caso não tenha projetos, retorna uma mensagem apropriada
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Nenhum projeto encontrado para este usuário']);
        }
    }

}