<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        require('linkrel.php');
    ?>
    <link rel="stylesheet" href="static/css/variaveis.css"/>
    <link rel="stylesheet" href="./static/css/viewProject.css"/>
    <title>Projeto | Gamyx</title>
</head>
<body>
    <?php 
        include 'menu.php'; 
    ?>
    <div class="viewProjectScreen">
        <main class="projectContainer rounded">
            <span class="projectTitle">Projeto Game Jam Waihuku</span>
            <div class="imageContainer">
                <img 
                    src="./static/img/banners/imagem-banner-Carlos.jpg"
                    alt=""
                    class="projectImage"
                />
            </div>
            <span class="projectCategory">Gêneros: Aventura, Educativo, Retro</span>
            <span class="projectTitle lower">Descrição</span>
            <p>Hello there, esse é um jogo que estou fazendo para a game jam do Waihuku, espero ganhar a competição!</p>
            <span class="projectTitle lower">Disponível para: Windows, Linux</span>
            <span class="projectTitle lower">Link para download</span>
            <div class="projectRepContainer rounded">
                <a href="https://github.com/jessilver/Engenharia-de-Software-Gamyx">https://github.com/jessilver/Engenharia-de-Software-Gamyx</a>
            </div>
        </main>
        <section class="creatorCardContainer rounded">
            <div class="creatorCardInfo">
                <div>
                    <img
                        src="./static/img/perfil/imagem-perfil-Mario.jpg"
                        alt="Imagem de perfil do usuário"
                        class="profileImage"
                    />
                    <h4>Nome_do_usuario</h4>
                    <p>@arroba_user</p>
                </div>
                <div class="cardInfoIcons">
                    <i class="fa-regular fa-folder"></i><span> 0 projetos • </span>
                    <i class="fa-solid fa-heart" id="heartIcon"></i><span id="spanHeartIcon"> 0 Likes</span>
                </div>
                <div>
                    <p class="userAbout">Aqui vai a descrição do usuário, não o texto completo mas uma ideia para dar um exemplo, acho que vou colocar um texto grande e ver como o container se comporta hummmmmm...</p>
                </div>
            </div>
        </section>
    </div>
    
</body>
</html>