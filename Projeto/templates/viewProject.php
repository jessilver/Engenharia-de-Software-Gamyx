<?php
    session_start();

    require_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        require('linkrel.php');
    ?>
    <link rel="stylesheet" href="../static/css/variaveis.css"/>
    <link rel="stylesheet" href="../static/css/viewProject.css"/>
    <title>Projeto | Gamyx</title>
</head>
<body>
    <?php 
        include '../menu.php'; 
    ?>
    <div class="viewProjectScreen">
        <main class="projectContainer rounded">
            <span class="projectTitle">Projeto Game Jam Waihuku</span>
            <div class="imageContainer">
                <img 
                    src="../static/img/tetris.png"
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
                        src=<?php 
                                $link = "../static/img/perfil/imagem-perfil-" . $_SESSION['userSearched']['nome'] . ".jpg";
                                $caminho = file_exists($link) ? $link : "semImagem";
                                echo $caminho;
                            ?>
                        alt="Imagem de perfil do usuário <?php echo $_SESSION['userSearched']['nome']; ?>"
                        class="profileImage"
                    />
                    <h4><?php echo $_SESSION['userSearched']['nome']; ?></h4>
                    <p><?php echo $_SESSION['userSearched']['arroba']; ?></p>
                </div>
                <div class="cardInfoIcons">
                    <i class="fa-regular fa-folder"></i><span> 0 projetos • </span>
                    <i class="fa-solid fa-heart" id="heartIcon"></i><span id="spanHeartIcon"> 0 Likes</span>
                </div>
                <div>
                    <p class="userAbout"><?php echo $_SESSION['userSearched']['about']; ?></p>
                </div>
            </div>
        </section>
    </div>
    
</body>
</html>