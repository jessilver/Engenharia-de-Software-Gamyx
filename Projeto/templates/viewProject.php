<?php
    session_start();

    require_once "../config.php";
    
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
    <link rel="stylesheet" href="../static/css/variaveis.css"/>
    <link rel="stylesheet" href="../static/css/viewProject.css"/>
    <title><?php echo $nomeProjeto ?> | Gamyx</title>
</head>
<body>
    <?php 
        include 'menu.php'; 
    ?>
    <div class="viewProjectScreen">
        <main class="projectContainer rounded">
        <div class="containerBotoes">    <span class="projectTitle"><?php echo $nomeProjeto  ?></span>
            <?php if ($_SESSION['userLogado']['id'] === $usuarioId) : ?>
    <div class="btn-container">
     
            <button class="btn-editar" data-toggle="modal" data-target="#editProjectModal">
                <img src="../static/img/pincel.png" alt="Editar projeto" class="btn-icon">
            </button>
       
            
        <form action="../views/deleteproject.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este projeto?');">
            <input type="hidden" name="projectId" value="<?php echo $projetoId; ?>" />
            <button type="submit" class="btn-excluir">
                <img src="../static/img/lixo.png" alt="Excluir projeto" class="btn-icon">
                </button>
        </form>
    </div>
<?php endif; ?>
</div>
            <div class="imageContainer">
                <img 
                    src="../static/img/capasProjetos/<?php echo $fotoCapa ?>"
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
                                $link = "../static/img/perfil/imagem-perfil-" . $criadorNome . ".jpg";
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

    
    <!-- Modal -->
    <div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content editProjectModalClass">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="editProjectModalLongTitle">Editar projeto</h5>
                    <i class="fa-solid fa-xmark closeButton" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <form action="../views/editProject.php" method="POST" id="formeditProject" enctype="multipart/form-data">
                        <input type="hidden" name="projectId" value="<?php echo $projetoId; ?>" />
                        <input type="hidden" name="userId" value="<?php echo $usuarioId; ?>" />

                        <div class="mb-3">
                            <label for="projectName" class="form-label">Nome do projeto:</label>
                            <input type="text" name="nomeProjeto" class="form-control" id="projectName" value="<?php echo $nomeProjeto; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="projectDesc" class="form-label">Descrição do projeto:</label>
                            <textarea class="form-control" name="descricaoProjeto" id="projectDesc" rows="5"><?php echo $descricaoProjeto; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="projectOs" class="form-label">Sistemas operacionais suportados:</label>
                            <div class="form-check">
                                <input class="form-check-input" name="windows" type="checkbox" value="windows" id="sistemaWindowsCheckbox" <?php echo in_array('windows', $sistemasOperacionais) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="sistemaWindowsCheckbox">Windows</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="linux" type="checkbox" value="linux" id="sistemaLinuxCheckbox" <?php echo in_array('linux', $sistemasOperacionais) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="sistemaLinuxCheckbox">Linux</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="mac" type="checkbox" value="mac" id="sistemaMacCheckbox" <?php echo in_array('mac', $sistemasOperacionais) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="sistemaMacCheckbox">Mac</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="projectDowl" class="form-label">Link para download:</label>
                            <input type="text" name="linkDownload" class="form-control" id="projectDowl" value="<?php echo $linkDownload; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="projectImg" class="form-label">Foto de capa:</label>
                            <input type="file" name="CapaProjeto" class="form-control" onchange="previewImagemSelecionada()" id="formFile" accept=".png, .jpg, .jpeg">
                        </div>

                        <div class="previewTrojectImg">
                            <h1 class="edtiPh1 mx-auto">Preview:</h1>
                            <img id="imagemFotoCapa" class="projectCapa" src="../static/img/capasProjetos/<?php echo $fotoCapa; ?>" alt="">
                        </div>

                        <button type="submit" class="btn btn-cadastrar">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    
    <script src="../static/js/semImagem.js" defer></script>
    <script src="./static/js/semImagem.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>