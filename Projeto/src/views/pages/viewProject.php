<?php $render('header'); ?>
<?php require_once __DIR__ . '/../../models/Review.php'; ?>
<link rel="stylesheet" href="<?= $base ?>/static/css/variaveis.css" />
<link rel="stylesheet" href="<?= $base ?>/static/css/viewProject.css" />
<title><?php echo $project['nomeProjeto'] ?> | Gamyx</title>


</head>
<!-- Requisição para recuperar dados do usuário pela API -->
<?php
    $usuarioId = $project['usuario_id'];
    $apiUrl = "http://localhost/Engenharia-de-Software-Gamyx/Projeto/public/api/busca-usuario/{$usuarioId}?acao=buscar-usuario";
    // Inicializa uma sessão cURL
    $ch = curl_init($apiUrl);
    // Configura opções para a requisição
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Executa a requisição
    $response = curl_exec($ch);
    // Verifica se ocorreu algum erro
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    // Fecha a sessão cURL
    curl_close($ch);
    // Decodifica a resposta JSON
    $usuarioData = json_decode($response, true);

    // Exibe os dados do usuário, se disponível
    if (!empty($usuarioData)) {
        $usuario = $usuarioData[0];
    }
?>

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

                        <form action="<?= $base ?>/deleteProject" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este projeto?');">
                            <input type="hidden" name="projectId" value="<?php echo $project['id'] ?>" />
                            <input type="hidden" name="userId" value="<?php echo $usuario['id'] ?>" />
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
                    src="<?= $base ?>/static/img/capasProjetos/<?= $project['fotoCapa'] ?>"
                    alt=""
                    class="projectImage" />
            </div>
            <!-- <span class="projectCategory">Gêneros: Aventura, Educativo, Retro</span> -->
            <span class="projectTitle lower">Descrição</span>
            <p class="projectDesc"><?php echo $project['descricaoProjeto'] ?></p>
            <span class="projectTitle lower">Disponível para:
                <?= $project['sistemasOperacionaisSuportados']; ?>
            </span>
            <span class="projectTitle lower">Link para download</span>
            <div class="projectRepContainer rounded my-3">
                <a href="<?php echo $project['linkDownload']; ?>"><?php echo $project['linkDownload']; ?></a>
            </div>

            <!-- Avaliações  -->

    
        <!-- Adicione a seção de avaliações e comentários aqui -->
        <section class="review-section">
            <h2>Deixe sua Avaliação</h2>
            <form action="<?=$base?>/projeto/review" method="POST">
                <input type="hidden" name="projectId" value="<?= $project['id'] ?>">
                <div class="rating">
                    <input type="radio" id="star5" name="nota" value="5">
                    <label for="star5">&#9733;</label>
                    <input type="radio" id="star4" name="nota" value="4">
                    <label for="star4">&#9733;</label>
                    <input type="radio" id="star3" name="nota" value="3">
                    <label for="star3">&#9733;</label>
                    <input type="radio" id="star2" name="nota" value="2">
                    <label for="star2">&#9733;</label>
                    <input type="radio" id="star1" name="nota" value="1">
                    <label for="star1">&#9733;</label>
                </div>
                <textarea class="review-textarea" name="comentario" placeholder="Deixe um comentário..."></textarea>
                <button type="submit" class="btn-review">Enviar Review</button>
            </form>
        </section>

        <section class="reviews-section">
            <h2>Avaliações e Comentários</h2>
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review-item d-flex align-items-center gap-3" style="border-bottom: 2px solid var(--cor-cinza-borda); margin-bottom: 15px;">
                        <div class="d-flex flex-column w-100">
                            <div class="d-flex justify-content-between">
                                <p><strong><?= $review['uniqueName'] ?></strong></p>
                                <div class="rating-display">
                                    <?php for ($i = 0; $i < $review['nota']; $i++): ?>
                                        <span class="star">&#9733;</span>
                                    <?php endfor; ?>
                                    <?php for ($i = $review['nota']; $i < 5; $i++): ?>
                                        <span class="star empty">&#9733;</span>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="review-comment"><?= !empty($review['comentario']) ? $review['comentario'] : 'O usuário não comentou sobre o projeto' ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Não há avaliações ainda.</p>
            <?php endif; ?>
        </section>

        </main>
        <section class="creatorCardContainer rounded">
            <a href="<?= $base ?>/perfil" class="text-white text-decoration-none">
                <div class="creatorCardInfo">
                    <div>
                        <div class="profileImageContainer">
                            <img src="<?php
                                        $caminho = "$base/static/img/perfil/imagem-perfil-" . $usuario['nomeUsuario'] . ".jpg";
                                        echo !file_exists($caminho) ? $caminho : "$base/static/img/sem-imagem.png"; ?>"
                                alt="" class="profileImage" />
                        </div>
                        <h4><?php echo $usuario['nomeUsuario'] ?></h4>
                        <p><?php echo $usuario['arroba'] ?></p>
                    </div>
                    <div class="cardInfoIcons">
                        <i class="fa-regular fa-folder"></i><span> 0 projetos • </span>
                        <i class="fa-solid fa-heart" id="heartIcon"></i><span id="spanHeartIcon"> 0 Likes</span>
                    </div>
                    <div>
                        <p class="userAbout"><?php echo $usuario['sobre'] ?></p>
                    </div>
                </div>
            </a>
        </section>
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
                    <form action="<?= $base ?>/editProject" method="POST" id="formeditProject" enctype="multipart/form-data">
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
                                <input class="form-check-input" name="windows" type="checkbox" value="windows" id="sistemaWindowsCheckbox">
                                <label class="form-check-label" for="sistemaWindowsCheckbox">Windows</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="linux" type="checkbox" value="linux" id="sistemaLinuxCheckbox">
                                <label class="form-check-label" for="sistemaLinuxCheckbox">Linux</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="mac" type="checkbox" value="mac" id="sistemaMacCheckbox">
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