<?php $render('header');
$_SESSION['userLogado'] = [
    'id' => 2,
];

unset($_SESSION['userLogado']);
?>
<link rel="stylesheet" href="<?= $base ?>/static/css/variaveis.css" />
<link rel="stylesheet" href="<?= $base ?>/static/css/home.css" />
<title>Home</title>
</head>

<body>
    <?php include __DIR__ . '/../partials/menu.php'; ?>
    <div class="homeContainerScreen">
        <form action="<?= $base ?>/perfil" method="POST" class="userSearchForm">
            <input type="text" placeholder="Procurar usuário" class="userSearchInput" name="search_query" />
            <button type="submit" class="userSearchSubmit">Buscar</button>
        </form>
        <h1 class="userGreetings py-3 mt-5">Opa, <?php echo $_SESSION['userLogado']['nomeUsuario'] ?? "Usuário" ?></h1>
        <h4 class="userGreetingsSubtitle">Aqui estão alguns jogos que pode gostar</h4>

        <div class="projectsContainer my-3">
            <div class="row row-cols-3">


                <?php for ($i = 0; $i < count($projetos); $i++) : ?>
                    <?php
                    $projeto = $projetos[$i];
                    $usuarioDono = $usuarios[$i];

                    $nomeProjeto = $projeto['nomeProjeto'] ?? 'Nome não disponível';
                    $fotoCapa = $projeto['fotoCapa'] ?? 'default-placeholder.png';
                    $linkProjeto = $projeto['id'];
                    ?>

                    <div class="projectCard col">
                        <a href="<?= $base ?>/projeto/<?= $linkProjeto ?>" class="text-white text-decoration-none">
                            <!-- Placeholder  -->
                            <img src="<?= $base ?>/static/img/tetris.png" alt="" class="projectImage rounded">
                            <!-- **  -->
                            <div class="projectDescription py-2 d-flex gap-3">
                                <img src="<?php
                                    $caminho = "$base/static/img/perfil/imagem-perfil-" . $usuarioDono['nomeUsuario'] . ".jpg";
                                    echo !file_exists($caminho)
                                        ? $caminho
                                        : "$base/static/img/sem-imagem.png"; ?>"
                                    alt="Imagem de perfil do usuário <?php echo $usuarioDono['nomeUsuario']; ?>" 
                                    class="ownerProfile"
                                />
                                <div class="textDescription d-flex flex-column">
                                    <span><?= $usuarioDono['uniqueName'] ?></span>
                                    <span class="h2"><?= $nomeProjeto ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endfor; ?>



            </div>
        </div>

    </div>
</body>
<?php $render('footer'); ?>