<?php $render('header'); ?>
<link rel="stylesheet" href="<?= $base ?>/static/css/variaveis.css" />
<link rel="stylesheet" href="<?= $base ?>/static/css/othersProfile.css" />
<title>Perfil de <?php echo $user['nomeUsuario'] ?> | Gamyx</title>

</head>

<body>
    <?php include __DIR__ . '/../partials/menu.php'; ?>
    <div class="visualizeProfilesScreen">
        <form action="<?= $base ?>/perfil" method="POST" class="userSearchForm">
            <input type="text" placeholder="Procurar usuário" class="userSearchInput" name="search_query" />
            <button type="submit" class="userSearchSubmit">Buscar</button>
        </form>
        <header class="bannerContainer rounded">
            <img
                src="<?php echo file_exists("./static/img/banners/imagem-banner-" . $user['nomeUsuario'] . ".jpg")
                            ? './static/img/banners/imagem-banner-' . $user['nomeUsuario'] . '.jpg'
                            : './static/img/sem-imagem.png'; ?>"
                alt="Imagem de perfil do usuário <?php echo $user['nomeUsuario']; ?>"
                class="bannerImage" />
        </header>
        <main class="mainContent">
            <section class="profileInfoContainer">
                <div class="profileImageContainer">
                    <img
                        src="<?php echo file_exists("./static/img/perfil/imagem-perfil-" . $user['nomeUsuario'] . ".jpg")
                                    ? './static/img/perfil/imagem-perfil-' . $user['nomeUsuario'] . '.jpg'
                                    : './static/img/sem-imagem.png'; ?>"
                        alt="Imagem de perfil do usuário <?php echo $user['nomeUsuario']; ?>"
                        class="profileImage" />
                </div>
                <div class="profileInfo">
                    <h1>
                        <?php echo $user['nomeUsuario'] ?>
                    </h1>
                    <span>
                        <?php echo $user['uniqueName'] ?>
                    </span>
                    <p class="userAbout">
                        <?php echo $user['about'] ?>
                    </p>
                    <h1 class="h1AUser">
                        <i class="fa-regular fa-folder"></i>
                        <?php
                            $projectsCount = $projects ? count($projects) : 0;
                            echo $projectsCount;
                        ?>
                        projects -
                        <i class="fa-solid fa-heart" id="heartIcon"></i>
                        <?php
                            $projectsCount = $projects ? count($projects) : 0;
                            echo $projectsCount;
                        ?>
                        likes
                    </h1>
                </div>
            </section>
            <hr class="bar" />
            <h1 class="projectsTitle">Projetos</h1>
            <section class="projectsContainer rounded">
                <div class="lista-cards-projeto" style="width: 100%; display: flex; gap: 60px;">
                    <!-- Os outros usuários ainda não foram populados com projetos  -->
                    <?php if (count($projects) > 0) : ?>
                        <?php foreach ($projects as $projeto) : ?>
                            <?php
                            $nomeProjeto = $projeto['nomeProjeto'] ?? 'Nome não disponível';
                            $fotoCapa = $projeto['fotoCapa'] ?? 'default-placeholder.png';
                            $linkProjeto = $projeto['id'];
                            ?>

                            <div class='projectItem'>
                                <a href="<?= $base ?>/projeto/<?= $projeto['id'] ?>">
                                    <div class='projectFoto'>
                                        <img src='<?= $base ?>/static/img/capasProjetos/<?= $fotoCapa ?>' alt='<?= $nomeProjeto ?>'>
                                    </div>
                                </a>
                                <h1 class='h1AUser' style='margin-bottom: 16px;'><?= $nomeProjeto ?></h1>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Nenhum projeto encontrado.</p>
                    <?php endif; ?>
                </div>
            </section>
            <hr class="bar" />
        </main>
        <div class="userProfileAmigos">
            <div class="amigosSearch">
                <h1 class="h1AUser">Amigos</h1>
            </div>
            <div class="amigosList">

            </div>
        </div>
    </div>

    </div>
</body>

</html>

<!-- Card projeto
    <a href="viewProject.php">
        <div class="card-projeto rounded">
            <img 
                src="./static/img/tetris.png"
                alt="Este projeto não tem imagem."
                class="projectImage"
            />                          
        </div>
    </a>
-->