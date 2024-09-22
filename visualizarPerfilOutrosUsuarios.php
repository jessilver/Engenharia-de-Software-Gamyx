<?php
    require "./Projeto/index.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/styles.css"/>
    <title>Perfil de <?php echo $_SESSION['user']['nome']; ?> | Gamyx</title>
</head>
<body>
    <!-- Imagens links:
        public/imagens/placeholder.jpg
        ./Projeto/GAMYX.png
    -->
    <div class="visualizeProfilesScreen">
        <input type="text" placeholder="Procurar usuário" class="userSearchInput"/> 
        <header class="bannerContainer">
            <img 
                src="" 
                alt="Banner do perfil do usuário <?php echo $_SESSION['user']['nome']; ?>"
                class="bannerImage"
            />
        </header>
        <main class="mainContent">
            <section class="profileInfoContainer">
                <div class="profileImageContainer">
                    <img 
                        src=""
                        alt="Imagem de perfil do usuário <?php echo $_SESSION['user']['nome']; ?>"
                        class="profileImage"
                    />
                </div>
                <div class="profileInfo">
                    <h1>
                        <?php echo $_SESSION['user']['nome']; ?>
                    </h1>
                    <span>
                        <?php echo $_SESSION['user']['arroba']; ?>
                    </span>
                    <p class="userAbout">
                        <?php echo $_SESSION['user']['about']; ?>
                    </p>
                    <div class="profileInfoIcons">
                        <span><i class="fa-regular fa-folder"></i> 0 projetos • </span>
                        <span><i class="fa-solid fa-heart" id="heartIcon"></i> 0 Seguidores</span>
                    </div>
                </div>
            </section>
            <hr/>
            <h1 class="projectsTitle">Projetos</h1>
            <section class="projectsContainer">
                <ul class="projectsList">
                    <li class="projectItem">
                        <img 
                            src=""
                            alt="Este projeto não tem imagem."
                            class="projectImage"
                        />
                    </li>
                </ul>
            </section>
        </main>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>