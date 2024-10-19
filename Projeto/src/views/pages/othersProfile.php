<?php $render('header'); ?>
    <link rel="stylesheet" href="<?=$base?>/static/css/variaveis.css"/>
    <link rel="stylesheet" href="<?=$base?>/static/css/othersProfile.css"/>    
    <title>Perfil de <?php echo $user['nomeUsuario'] ?> | Gamyx</title>

</head>
<body>
    <?php 
        include "menu.php"; 
    ?>
    <div class="visualizeProfilesScreen">
        <form action="<?=$base?>/perfil" method="POST" class="userSearchForm">
            <input type="text" placeholder="Procurar usuário" class="userSearchInput" name="search_query"/> 
            <button type="submit" class="userSearchSubmit">Buscar</button>
        </form>
        <header class="bannerContainer rounded">
            <img 
                src=""
                alt="Banner do perfil do usuário <?php echo $user['nomeUsuario'] ?>"
                class="bannerImage rounded"
            />
        </header>
        <main class="mainContent">
            <section class="profileInfoContainer">
                <div class="profileImageContainer">
                    <img 
                        src="<?=$base?>/static/img/perfil/imagem-perfil-Maria.png"
                        alt="Imagem de perfil do usuário <?php echo $user['nomeUsuario'] ?>"
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
                        <i class="fa-regular fa-folder"></i><span> 0 projetos • </span>
                        <i class="fa-solid fa-heart" id="heartIcon"></i><span id="spanHeartIcon"> 0 Likes</span>
                    </div>
                </div>
            </section>
            <hr class="bar"/>
            <h1 class="projectsTitle">Projetos</h1>
            <section class="projectsContainer rounded">
                <div class="lista-cards-projeto">
                    <!-- Os outros usuários ainda não foram populados com projetos  -->
                     <p>Este usuário ainda não possui projetos.</p>
                </div>
            </section>
            <hr class="bar"/>
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

    <script src="<?=$base?>/static/js/semImagem.js" defer></script>
</body>
</html>

<!-- 
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
