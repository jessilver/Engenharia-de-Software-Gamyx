<?php $render('header'); ?>
<link rel="stylesheet" href="<?= $base ?>/static/css/variaveis.css" />
<link rel="stylesheet" href="<?= $base ?>/static/css/eventos.css" />
<title>Game jam | Gamyx</title>
</head>

<body>
    <?php include __DIR__ . '/../partials/menu.php'; ?>

    <div class="eventsScreen d-flex flex-column">
        <div class="imagemBanner">
            <h1 class="tituloPrincipal">Participe de Game Jams</h1>
        </div>
        <span class="text-center h3 w-75 align-self-center">A melhor oportunidade para melhorar suas habilidades como desenvolvedor é praticar. Aqui estão algumas jams ativas que você pode entrar</span>
        <hr>
        <div class="jamContainer d-flex">
            <div class="row d-flex gap-5 align-items-center w-100">

                <?php if (count($jams) > 0) : ?>
                    <?php for ($i = 0; $i < count($jams); $i++) : ?>
                        <?php
                        $jam = $jams[$i];
                        $host = $usuariosHost[$i];
                        $participante = $participantes[$i];

                        $nomeJam = $jam['nomeJam'];
                        $descricao = $jam['descricaoJam'];
                        $data = date('d/m/Y', strtotime($jam['dataCriacao']));
                        $arrobaHost = $host['uniqueName'];
                        $nomeHost = $host['nomeUsuario'];
                        $fotoHost = $host['fotoPerfil'];

                        // Gerar um ID único para cada modal baseado no índice
                        $modalId = "modalGameJam" . $i;
                        ?>
                        <!-- Card da Game Jam -->
                        <div class="jamItem d-flex flex-column col-3 rounded gap-2">
                            <div class="d-flex align-items-center p-2 gap-2">

                                <div class="flex-shrink-0">
                                    <img src="
                                        <?php
                                        $caminho = "__DIR__ . '/../../public/static/img/perfil/" . $fotoHost;                                       
                                        echo file_exists($caminho) ? $caminho : "$base/static/img/sem-imagem.png";
                                        ?>"
                                        alt="Imagem de perfil do usuário host da jam, <?php echo $nomeHost; ?>"
                                        class="jamHostProfile" />
                                </div>
                                <div class="flex-grow-1 ms-3 h4"><?= $nomeJam ?></div>
                                <?php if ($_SESSION['userLogado']['id'] === $host['id']) : ?>
                                    <form action="<?= $base ?>/eventos/delete" method="POST" class="formExcluirJam" onsubmit="return confirm('Tem certeza que quer excluir a jam?');">
                                        <input type="hidden" name="jam_id" value="<?= $jam['id'] ?>">
                                        <button type="submit" class="botaoExcluirJam rounded">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <span class="text-muted">Hosteada por <u><?= $arrobaHost ?></u></span>
                            <span class="descricaoJam pb-4"><?= $descricao ?></span>
                            <button type="button" class="btn btn-primary p-1 mb-4 border-0" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
                                Ver mais
                            </button>
                        </div>

                        <!-- Modal para cada Game Jam -->
                        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                <div class="GameJamModal modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="<?= $modalId ?>Label"><?= $nomeJam ?></h1>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column align-items-center gap-4">
                                        <img src="
                                            <?php
                                            $caminho = "__DIR__ . '/../../public/static/img/perfil/" . $fotoHost;
                                            echo file_exists($caminho) ? $caminho : "$base/static/img/sem-imagem.png";
                                            ?>"
                                            alt="Imagem de perfil do usuário host da jam, <?php echo $nomeHost; ?>"
                                            class="jamHostProfile" />
                                        <p><?= $descricao ?></p>
                                        <div class="d-flex flex-column align-self-start">
                                            <span><strong>Host: </strong> <?= $arrobaHost ?></span>
                                            <span><strong>Status: </strong> Ativa</span>
                                            <span><strong>Criada em: </strong> <?= $data ?></span>
                                            <!-- Novo loop para exibir participantes -->
                                            <span><strong>Participantes:</strong></span>
                                            <ul class="list-unstyled">
                                                <?php
                                                foreach ($participante as $key => $value) {
                                                    if (strpos($key, 'participante_') === 0 && !empty($value)) { // Verifica se é um campo de participante e não é vazio
                                                        echo "<li>→ " . htmlspecialchars($value) . "</li>";
                                                    }
                                                }
                                                ?>
                                            </ul>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <form action="<?= $base ?>/eventos/join" method="POST">
                                            <input type="hidden" name="jam_id" value="<?= $jam['id'] ?>">
                                            <button type="submit" class="btn btn-primary">Quero participar!</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endfor; ?>
                <?php else : ?>
                    <span class="text-muted h3">Ops, parece que não há nenhuma jam ativa no momento.</span>
                <?php endif; ?>

            </div>
        </div>


        <span class="h1 align-self-center pt-4" style="border-top: 1px solid var(--cor-cinza-borda);">Quer hostear sua própria game jam? Cadastre aqui!</span>
        <form action="<?= $base ?>/eventos" method="POST" class="formularioCadastroJam align-self-center my-5">
            <div class="d-flex flex-column gap-3">
                <div class="form-floating">
                    <input type="text" class="cadastroJamLabel form-control" id="floatingInput" name="nomeInput" placeholder="Nome da jam" required>
                    <label for="floatingInput">Nome da jam</label>
                </div>
                <div class="form-floating mb-3">                 
                    <textarea class="cadastroJamLabel form-control" placeholder="Descrição breve" id="floatingTextarea" name="descricaoInput" required minlength="50"></textarea>
                    <label for="floatingTextarea">Descrição breve</label>
                </div>
            </div>
            <button type="submit" class="botaoCadastrarJam p-4" onsubmit="return confirm('Sua jam foi criada e já está disponível!');">Criar minha game jam</button>
        </form>

    </div>

    <script>
        //Faz o título aumentar ou diminuir baseado no scroll
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                document.querySelector('.tituloPrincipal').style.fontSize = "75px";
            } else {
                document.querySelector('.tituloPrincipal').style.fontSize = "110px";
            }
        }
    </script>
    <!-- Javascript do bootstrap  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>