<?php
    session_start();
    require "config.php";  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require('linkrel.php');
    ?>
    <link rel="stylesheet" href="./static/css/variaveis.css"/>
    <link rel="stylesheet" href="./static/css/othersProfile.css"/>    
    <title>Perfil de <?php echo $_SESSION['userSearched']['nome']; ?> | Gamyx</title>

</head>
<body>
    <?php 
        include 'menu.php'; 
    ?>
    <div class="visualizeProfilesScreen">
        <form action="pesquisaUsuario.php" method="POST" class="userSearchForm">
            <input type="text" placeholder="Procurar usuário" class="userSearchInput" name="search_query"/> 
            <button type="submit" class="userSearchSubmit">Buscar</button>
        </form>
        <header class="bannerContainer rounded">
            <img 
                src=<?php 
                        $link = "./static/img/banners/imagem-banner-" . $_SESSION['userSearched']['nome'] . ".jpg";
                        $caminho = file_exists($link) ? $link : "semImagem";
                        echo $caminho;
                    ?>
                alt="Banner do perfil do usuário <?php echo $_SESSION['userSearched']['nome']; ?>"
                class="bannerImage rounded"
            />
        </header>
        <main class="mainContent">
            <section class="profileInfoContainer">
                <div class="profileImageContainer">
                    <img 
                        src=<?php 
                                $link = "./static/img/perfil/imagem-perfil-" . $_SESSION['userSearched']['nome'] . ".jpg";
                                $caminho = file_exists($link) ? $link : "semImagem";
                                echo $caminho;
                            ?>
                        alt="Imagem de perfil do usuário <?php echo $_SESSION['userSearched']['nome']; ?>"
                        class="profileImage"
                    />
                </div>
                <div class="profileInfo">
                    <h1>
                        <?php echo $_SESSION['userSearched']['nome']; ?>
                    </h1>
                    <span>
                        <?php echo $_SESSION['userSearched']['arroba']; ?>
                    </span>
                    <p class="userAbout">
                        <?php echo $_SESSION['userSearched']['about']; ?>
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
                    <a href="viewProject.php">
                        <div class="card-projeto rounded">
                            <img 
                                src=""
                                alt="Este projeto não tem imagem."
                                class="projectImage"
                            />                          
                        </div>
                    </a>
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

    <script src="./static/js/semImagem.js" defer></script>
</body>
</html>