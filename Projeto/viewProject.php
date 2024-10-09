<?php
    session_start();

    require_once "config.php";
    
    // Resgatando o projeto pelo ID
    if (isset($_GET['id'])) {
        $projetoId = $_GET['id'];

        // Preparar uma consulta SQL para buscar os dados do projeto
        $stmt = $pdo->prepare("SELECT nomeProjeto, descricaoProjeto, linkDownload, fotoCapa, sistemasOperacionaisSuportados, usuario_id FROM projetosUsuario WHERE id = :id");
        $stmt->bindParam(':id', $projetoId, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar se o projeto foi encontrado
        if ($stmt->rowCount() > 0) {
            // Recuperar os dados do projeto
            $projeto = $stmt->fetch(PDO::FETCH_ASSOC);

            // Armazenar as informações do projeto em variáveis
            $nomeProjeto = htmlspecialchars($projeto['nomeProjeto']);
            $descricaoProjeto = htmlspecialchars($projeto['descricaoProjeto']);
            $linkDownload = htmlspecialchars($projeto['linkDownload']);
            $fotoCapa = htmlspecialchars($projeto['fotoCapa']);
            $sistemasOperacionaisString = htmlspecialchars($projeto['sistemasOperacionaisSuportados']);
            $sistemasOperacionais = explode(',', $sistemasOperacionaisString);

            $usuarioId = $projeto['usuario_id'];

            // Buscar informações do criador do projeto
            $stmtUser = $pdo->prepare("SELECT nomeUsuario, uniqueName, about FROM usuario WHERE id = :usuarioId");
            $stmtUser->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
            $stmtUser->execute();
            $criador = $stmtUser->fetch(PDO::FETCH_ASSOC);

            $criadorNome = htmlspecialchars($criador['nomeUsuario']);
            $criadorArroba = htmlspecialchars($criador['uniqueName']);
            $criadorAbout = htmlspecialchars($criador['about']);
            } else {
                echo "<p>Projeto não encontrado.</p>";
                exit();
            }
        } else {
            echo "<p>ID do projeto não fornecido.</p>";
            exit();
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        require('linkrel.php');
    ?>
    <link rel="stylesheet" href="./static/css/variaveis.css"/>
    <link rel="stylesheet" href="./static/css/viewProject.css"/>
    <title><?php echo $nomeProjeto ?> | Gamyx</title>
</head>
<body>
    <?php 
        include 'menu.php'; 
    ?>
    <div class="viewProjectScreen">
        <main class="projectContainer rounded">
            <span class="projectTitle"><?php echo $nomeProjeto ?></span>
            <div class="imageContainer">
                <img 
                    src="<?php echo $fotoCapa ?>"
                    alt=""
                    class="projectImage"
                />
            </div>
            <!-- <span class="projectCategory">Gêneros: Aventura, Educativo, Retro</span> -->
            <span class="projectTitle lower">Descrição</span>
            <p><?php echo $descricaoProjeto ?></p>
            <span class="projectTitle lower">Disponível para: 
                <?php 
                    foreach($sistemasOperacionais as $sistema){
                        echo $sistema . "\n";
                    }
                ?>
            </span>
            <span class="projectTitle lower">Link para download</span>
            <div class="projectRepContainer rounded">
                <a href="<?php echo $linkDownload; ?>"><?php echo $linkDownload; ?></a>
            </div>
        </main>
        <section class="creatorCardContainer rounded">
            <div class="creatorCardInfo">
                <div>
                    <img 
                        src=<?php 
                                $link = "./static/img/perfil/imagem-perfil-" . $criadorNome . ".jpg";
                                $caminho = file_exists($link) ? $link : "semImagem";
                                echo $caminho;
                            ?>
                        alt="Imagem de perfil do usuário <?php echo $criadorNome; ?>"
                        class="profileImage"
                    />
                    <h4><?php echo $criadorNome ?></h4>
                    <p><?php echo $criadorArroba  ?></p>
                </div>
                <div class="cardInfoIcons">
                    <i class="fa-regular fa-folder"></i><span> 0 projetos • </span>
                    <i class="fa-solid fa-heart" id="heartIcon"></i><span id="spanHeartIcon"> 0 Likes</span>
                </div>
                <div>
                    <p class="userAbout"><?php echo $criadorAbout ?></p>
                </div>
            </div>
        </section>
    </div>
    
    <script src="./static/js/semImagem.js" defer></script>
</body>
</html>