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
    <div class="viewProjectScreen">
        <main class="projectContainer rounded">
            main
        </main>
        <section class="creatorCardContainer rounded">
            <div class="creatorCardInfo">
                <div>
                    <img
                        src="./static/img/perfil/imagem-perfil-Mario.jpg"
                        alt="Imagem de perfil do usuário"
                        class="profileImage"
                    />
                    <h3>Nome_do_usuario</h3>
                    <p>@arroba_user</p>
                </div>
                <div class="cardInfoIcons">
                    <i class="fa-regular fa-folder"></i><span> 0 projetos • </span>
                    <i class="fa-solid fa-heart" id="heartIcon"></i><span id="spanHeartIcon"> 0 Likes</span>
                </div>
                <div>
                    <p class="userAbout">Aqui vai a descrição do usuário, não o texto completo mas uma ideia para dar um exemplo...</p>
                </div>
            </div>
        </section>
    </div>
</body>
</html>