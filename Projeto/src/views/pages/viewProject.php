<?php $render('header'); ?>
    <link rel="stylesheet" href="<?=$base?>/static/css/variaveis.css" />
    <link rel="stylesheet" href="<?=$base?>/static/css/viewProject.css" />
    <title><?php echo $project['nomeProjeto'] ?> | Gamyx</title>

</head>
<body>
    
    <?php include __DIR__ . '/../partials/menu.php'; ?>

    <div class="viewProjectScreen">
        <main class="projectContainer rounded">
            <div class="containerBotoes">
                <span class="projectTitle"><?php echo $project['nomeProjeto']  ?></span>
                <?php if ($_SESSION['userLogado']['id'] === $usuario['id']) : ?>
                    <div class="btn-container">
                        <button class="btn-editar" data-toggle="modal" data-target="#editProjectModal">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <form action="/Engenharia-de-Software/Projeto/public/deleteProject" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este projeto?');">
            <input type="hidden" name="projectId" value="<?php echo $projetoId; ?>" />
            <button type="submit" class="btn-excluir">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
    </div>
<?php endif; ?>
            </div> 
            <!-- Botões  -->
            
        

            
            <div class="imageContainer">
                <img
                    src="<?=$base?>/static/img/capasProjetos/<?php echo $project['fotoCapa'] ?>"
                    alt=""
                    class="projectImage" />
            </div>
            <!-- <span class="projectCategory">Gêneros: Aventura, Educativo, Retro</span> -->
            <span class="projectTitle lower">Descrição</span>
            <p><?php echo $project['descricaoProjeto'] ?></p>
            <span class="projectTitle lower">Disponível para:
                <?php
                foreach ($project['sistemasOperacionaisSuportados'] as $sistema) {
                    echo $sistema . "\n";
                }
                ?>
            </span>
            <span class="projectTitle lower">Link para download</span>
            <div class="projectRepContainer rounded">
                <a href="<?php echo $project['linkDownload']; ?>"><?php echo $project['linkDownload']; ?></a>
            </div>
        </main>
        <section class="creatorCardContainer rounded">
            <div class="creatorCardInfo">
                <div>
                    <div class="profileImageContainer">
                        <img
                            src="<?php 
                            $caminho = "$base/static/img/perfil/imagem-perfil-" . $usuario['nomeUsuario'] . ".jpg";
                            echo !file_exists($caminho) 
                                ? $caminho 
                                : "$base/static/img/sem-imagem.png"; ?>"
                            alt="Imagem de perfil do usuário <?php echo $usuario['nomeUsuario']; ?>"
                            class="profileImage" 
                        />
                    </div>
                    <h4><?php echo $usuario['nomeUsuario'] ?></h4>
                    <p><?php echo $usuario['uniqueName']  ?></p>
                </div>
                <div class="cardInfoIcons">
                    <i class="fa-regular fa-folder"></i><span> 0 projetos • </span>
                    <i class="fa-solid fa-heart" id="heartIcon"></i><span id="spanHeartIcon"> 0 Likes</span>
                </div>
                <div>
                    <p class="userAbout"><?php echo $usuario['about'] ?></p>
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
                        <input type="hidden" name="projectId" value="<?php echo $project['id'] ?>" />
                        <input type="hidden" name="userId" value="<?php echo $usuario['id'] ?>" />

                        <div class="mb-3">
                            <label for="projectName" class="form-label">Nome do projeto:</label>
                            <input type="text" name="nomeProjeto" class="form-control" id="projectName" value="<?php echo $project['nomeProjeto'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="projectDesc" class="form-label">Descrição do projeto:</label>
                            <textarea class="form-control" name="descricaoProjeto" id="projectDesc" rows="5"><?php echo $project['descricaoProjeto'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="projectOs" class="form-label">Sistemas operacionais suportados:</label>
                            <div class="form-check">
                                <input class="form-check-input" name="windows" type="checkbox" value="windows" id="sistemaWindowsCheckbox" <?php echo in_array('windows', $project['sistemasOperacionaisSuportados']) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="sistemaWindowsCheckbox">Windows</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="linux" type="checkbox" value="linux" id="sistemaLinuxCheckbox" <?php echo in_array('linux', $project['sistemasOperacionaisSuportados']) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="sistemaLinuxCheckbox">Linux</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="mac" type="checkbox" value="mac" id="sistemaMacCheckbox" <?php echo in_array('mac', $project['sistemasOperacionaisSuportados']) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="sistemaMacCheckbox">Mac</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="projectDowl" class="form-label">Link para download:</label>
                            <input type="text" name="linkDownload" class="form-control" id="projectDowl" value="<?php echo $project['linkDownload']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="projectImg" class="form-label">Foto de capa:</label>
                            <input type="file" name="CapaProjeto" class="form-control" onchange="previewImagemSelecionada()" id="formFile" accept=".png, .jpg, .jpeg">
                        </div>

                        <div class="previewTrojectImg">
                            <h1 class="edtiPh1 mx-auto">Preview:</h1>
                            <img id="imagemFotoCapa" class="projectCapa" src="../static/img/capasProjetos/<?php echo $project['fotoCapa']; ?>" alt="">
                        </div>

                        <button type="submit" class="btn btn-cadastrar">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php $render('footer'); ?>