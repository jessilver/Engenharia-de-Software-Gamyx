<?php
    // session_start();
    // require_once "../config.php";
    // // Resgatando o projeto pelo ID
    // if (isset($_GET['id'])) {
    //     $projetoId = $_GET['id'];
    //     // Preparar uma consulta SQL para buscar os dados do projeto
    //     $stmt = $pdo->prepare("SELECT nomeProjeto, descricaoProjeto, linkDownload, fotoCapa, sistemasOperacionaisSuportados, usuario_id FROM projetosUsuario WHERE id = :id");
    //     $stmt->bindParam(':id', $projetoId, PDO::PARAM_INT);
    //     $stmt->execute();
    //     // Verificar se o projeto foi encontrado
    //     if ($stmt->rowCount() > 0) {
    //         // Recuperar os dados do projeto
    //         $projeto = $stmt->fetch(PDO::FETCH_ASSOC);
    //         // Armazenar as informações do projeto em variáveis
    //         $nomeProjeto = htmlspecialchars($projeto['nomeProjeto']);
    //         $descricaoProjeto = htmlspecialchars($projeto['descricaoProjeto']);
    //         $linkDownload = htmlspecialchars($projeto['linkDownload']);
    //         $fotoCapa = htmlspecialchars($projeto['fotoCapa']);
    //         $sistemasOperacionaisString = htmlspecialchars($projeto['sistemasOperacionaisSuportados']);
    //         $sistemasOperacionais = explode(',', $sistemasOperacionaisString);
    //         $usuarioId = $projeto['usuario_id'];
    //         // Buscar informações do criador do projeto
    //         $stmtUser = $pdo->prepare("SELECT nomeUsuario, uniqueName, about FROM usuario WHERE id = :usuarioId");
    //         $stmtUser->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
    //         $stmtUser->execute();
    //         $criador = $stmtUser->fetch(PDO::FETCH_ASSOC);

    //         $criadorNome = htmlspecialchars($criador['nomeUsuario']);
    //         $criadorArroba = htmlspecialchars($criador['uniqueName']);
    //         $criadorAbout = htmlspecialchars($criador['about']);
    //         } else {
    //             // header("Location: viewProject.php?id=6" . $projetoId);
    //             exit();
    //         }
    //     } else {
    //         echo "<p>ID do projeto não fornecido.</p>";
    //         exit();
    //     }
?>
<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Project;

class viewProjectController extends Controller{

    public function index($id) {
        // Obtém o ID do projeto da URL
        $projetoId = $id['id']; // O ID virá da URL
        // Busca o projeto pelo ID
        $project = Project::select()
            ->where('id', $projetoId)
            ->execute();
        // Verifica se o projeto foi encontrado
        if (!empty($project)) {
            $project = $project[0]; // Extrai o primeiro resultado
            // Busca as informações do criador do projeto
            $usuarioId = $project['usuario_id'];
            $usuario = Usuario::select()
                ->where('id', $usuarioId)
                ->execute();
            // Prepara os dados para a view
            $context = [
                'project' => $project,
                'usuario' => !empty($usuario) ? $usuario[0] : null // Verifica se o usuário foi encontrado
            ];
            // Renderiza a view com os dados
            $this->render('viewProject', $context);
        } else {
            // echo "<p>Projeto não encontrado.</p>";
            $this->render('404');
            exit();
        }
    }
}