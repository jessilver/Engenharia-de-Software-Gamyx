<?php
    namespace src\controllers;

    use \core\Controller;
    use \src\models\Usuario;

    class apiBuscaUsuarioController extends Controller{
        public function index($id){
            $action = $_REQUEST['acao'];
            $return = array();

            if ($action === "buscar-usuario") {
                $idUsuario = $id;

                $usuario = Usuario::selectUser($idUsuario);

                if($usuario){
                    $return[] = array(
                        "id" => $usuario['id'],
                        "nomeUsuario" => $usuario['nomeUsuario'],
                        "arroba" => $usuario['uniqueName'],
                        "sobre" => $usuario['about'],
                        "perfil" => $usuario['fotoPerfil']
                    );
                }
            }

            // Retorna os dados em formato JSON e encerra
            die(json_encode($return));
        }
    }