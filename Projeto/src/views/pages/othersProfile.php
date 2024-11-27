<?php $render('header'); ?>
<link rel="stylesheet" href="<?= $base ?>/static/css/variaveis.css" />
<link rel="stylesheet" href="<?= $base ?>/static/css/othersProfile.css" />
<title>Perfil de <?php echo $user['nomeUsuario'] ?> | Gamyx</title>

</head>

<body>
<?php if (isset($_SESSION['userLogado']['id'])): ?>
        <?php include __DIR__ . '/../partials/menu.php'; ?>
    <?php endif; ?>

    <div class="visualizeProfilesScreen">
        <form action="<?= $base ?>/perfil" method="POST" class="userSearchForm">
            <input type="text" placeholder="Procurar usuário" class="userSearchInput" name="search_query" />
            <button type="submit" class="userSearchSubmit">Buscar</button>
        </form>
        <header class="bannerContainer rounded">
            <img
                src="<?php echo file_exists("./static/img/banners/imagem-banner-" . $user['nomeUsuario'] . ".jpg")
                            ? './static/img/banners/imagem-banner-' . $user['nomeUsuario'] . '.jpg'
                            : './static/img/tetris.png'; ?>"
                alt="Imagem de perfil do usuário <?php echo $user['nomeUsuario']; ?>"
                class="bannerImage" />
        </header>
        <main class="mainContent">
            <section class="profileInfoContainer">
                <div class="profileImageContainer">
                    <img
                        src="<?php echo "./static/img/perfil/" . $user['fotoPerfil']; ?>"
                        alt="Imagem de perfil do usuário <?php echo $user['nomeUsuario']; ?>"
                        class="profileImage" 
                    />
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
                    <div class="profileInfoIcons">
                        <i class="fa-regular fa-folder"></i><span>
                          <?php
                            $projectsCount = $projects ? count($projects) : 0;
                            echo $projectsCount;
                          ?> 
                           projetos • 
                        </span>
                        <i class="fa-solid fa-heart" id="heartIcon"></i><span id="spanHeartIcon">
                          <?php
                            $projectsCount = $projects ? count($projects) : 0;
                            echo $projectsCount;
                        ?>
                           Likes
                        </span>
                        
                            <?php if (!$isFriend): ?>

                                <?php if ($_SESSION['userLogado']['id'] == $user['id']): ?>
                                    
                                <?php else: ?>
                                    <form action="<?=$base?>/add-friend" method="post">
                                        <input type="hidden" name="friendId" value="<?php echo $user['id'] ?>"/>
                                        <input type="hidden" name="userId" value="<?php echo $_SESSION['userLogado']['id'] ?>"/>
                                        <button type="submit" class="btn btn-primary">Add Friend</button>
                                    </form>
                                <?php endif; ?>

                            <?php else: ?>
                                <?php if ($_SESSION['userLogado']['id'] == $user['id']): ?>
                                    
                                <?php else: ?>
                                    <form action="<?=$base?>/deleteFriend" method="post">
                                        <input type="hidden" name="friendId" value="<?php echo $user['id'] ?>"/>
                                        <input type="hidden" name="userId" value="<?php echo $_SESSION['userLogado']['id'] ?>"/>
                                        <button type="submit" class="btn btn-primary">Delete Friend</button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                    </div>
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
                                <h1 class='h1AUser' style='margin-bottom: 16px; align-self: center;'><?= $nomeProjeto ?></h1>
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
                <?php if (count($friends) > 0) : ?>
                    <?php foreach ($friends as $friend) : ?>
                        <?php 
                            $nomeUsuario = $friend['nomeUsuario'] ?? 'Nome não disponível';
                            $id = $friend['id'];
                            $fotoAmigo = $friend['fotoPerfil'];
                        ?>
                        <?php if ($user['nomeUsuario'] != $nomeUsuario): ?>
                        <div class='amigosItem'>  
                            <form action="<?=$base?>/perfil" method="post"> 
                                <input type="hidden" name="search_query" value="<?=$nomeUsuario?>">
                                <button class="btn" type="submit" style="background:none;border:none;padding:0;margin:0;color:inherit;text-align:center;box-shadow:none;">
                                    <div>
                                        <img src="<?php echo file_exists("./static/img/perfil/" . $fotoAmigo)
                                            ? "./static/img/perfil/" . $fotoAmigo
                                            : './static/img/sem-imagem.png'; ?>" 
                                        alt='<?= $nomeUsuario ?>'
                                        class="amigosFoto" />
                                    </div>
                                    <h1 class='h1AUser' style='margin-bottom: 16px;'><?= $nomeUsuario ?></h1>
                                </button>
                            </form> 
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Nenhum amigo encontrado.</p>
                <?php endif; ?>
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
<!-- Ver foto 
$caminho = "__DIR__ . '/../../public/static/img/perfil/" . $fotoHost;                                       
echo file_exists($caminho) ? $caminho : "$base/static/img/sem-imagem.png"; 
-->