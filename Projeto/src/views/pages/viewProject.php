<?php $render('header'); ?>
    <link rel="stylesheet" href="<?=$base?>/static/css/variaveis.css" />
    <link rel="stylesheet" href="<?=$base?>/static/css/viewProject.css" />
    <title><?php echo $project['nomeProjeto'] ?> | Gamyx</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/278bb2ddaf.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="<?=$base?>/static/js/script.js"></script>
</head>
<body>
    
    <?php include __DIR__ . '/../partials/menu.php'; ?>

    <div class="viewProjectScreen">
        <main class="projectContainer rounded">
            <div class="containerBotoes">
                <span class="projectTitle"><?php echo $project['nomeProjeto']  ?></span>
                <?php if ($_SESSION['userLogado']['id'] === $usuario['id']) : ?>
                    <div class="btn-container">
                        <button class="btn-editar" data-bs-toggle="modal" data-bs-target="#editProjectModal">
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        <form action="<?=$base?>/deleteProject" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este projeto?');">
                        <input type="hidden" id="projetoId" name="projetoId" value="<?php echo $projetoId; ?>" />
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
                    src="<?=$base?>/static/img/capasProjetos/<?=$project['fotoCapa']?>"
                    alt=""
                    class="projectImage" />
            </div>
            <!-- <span class="projectCategory">Gêneros: Aventura, Educativo, Retro</span> -->
            <span class="projectTitle lower">Descrição</span>
            <p><?php echo $project['descricaoProjeto'] ?></p>
            <span class="projectTitle lower">Disponível para:
                <?=$project['sistemasOperacionaisSuportados'];?>
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

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content editProjectModalClass">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="editProjectModalLongTitle">Editar projeto</h5>
                    <i class="fa-solid fa-xmark closeButton" data-bs-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <form action="<?=$base?>/editProject" method="POST" id="formeditProject" enctype="multipart/form-data">
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
                                <input class="form-check-input" name="windows" type="checkbox" value="windows" id="sistemaWindowsCheckbox" >
                                <label class="form-check-label" for="sistemaWindowsCheckbox">Windows</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="linux" type="checkbox" value="linux" id="sistemaLinuxCheckbox" >
                                <label class="form-check-label" for="sistemaLinuxCheckbox">Linux</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="mac" type="checkbox" value="mac" id="sistemaMacCheckbox" >
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
<?php $render('footer');?>