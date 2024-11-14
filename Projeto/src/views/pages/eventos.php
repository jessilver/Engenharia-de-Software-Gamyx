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
                    <?php foreach ($jams as $jam) : ?>
                        <?php
                        // $nomeProjeto = $projeto['nomeProjeto'] ?? 'Nome não disponível';
                        // $fotoCapa = $projeto['fotoCapa'] ?? 'default-placeholder.png';
                        // $linkProjeto = $projeto['id'];
                        ?>

                        <div class="jamItem d-flex flex-column col-3 rounded gap-2">
                            <div class="d-flex align-items-center p-2 gap-2">
                                <div class="flex-shrink-0">
                                    <img src="<?= $base ?>/static/img/perfil/imagem-perfil-Mario.jpg" alt="..." class="jamHostProfile">
                                </div>
                                <div class="flex-grow-1 ms-3 h4">Game jam de Mario Games</div>
                            </div>
                            <span class="text-muted">Hosteada por <u>@MarioGames</u></span>
                            <span class="pb-4">A Game Jam do Mario Games reúne desenvolvedores para criar jogos inspirados nos mundos e personagens de Mario, desafiando criatividade!</span>
                        </div>
                    <?php endforeach; ?>
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
                    <textarea class="cadastroJamLabel form-control" placeholder="Descrição breve" id="floatingTextarea" name="descricaoInput" required></textarea>
                    <label for="floatingTextarea">Descrição breve</label>
                </div>
            </div>
            <button type="submit" class="botaoCadastrarJam p-4">Criar minha game jam</button>
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
</body>

</html>