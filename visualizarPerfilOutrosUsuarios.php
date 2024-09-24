<?php
    require "./Projeto/index.php";

    // Lógica de busca de usuários
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['search_query'])) {
        $searchQuery = $_POST['search_query'];
        try {
            // Conexão com o banco de dados
            $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Consulta ao banco de dados (busca por nome, arroba ou email)
            $stmt = $pdo->prepare("SELECT * FROM usuario WHERE nome LIKE :searchQuery OR arroba LIKE :searchQuery OR email LIKE :searchQuery");
            $stmt->execute(['searchQuery' => "%$searchQuery%"]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $usuarioExibido = $user;
            } else {
                echo "<script>console.log('Nenhum usuário encontrado.')</script>";
                // Exibe o próprio usuário da sessão caso não encontre nada
                $usuarioExibido = $_SESSION['user'];
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        $usuarioExibido = $_SESSION['user'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/visualizarPerfilOutrosUsuarios.css"/>
    <title>Perfil de <?php echo $usuarioExibido['nome']; ?> | Gamyx</title>
</head>
<body>
    <div class="visualizeProfilesScreen">
        <form action="" method="POST" class="userSearchForm">
            <input type="text" placeholder="Procurar usuário" class="userSearchInput" name="search_query"/> 
            <button type="submit" class="userSearchSubmit">Buscar</button>
        </form>
        <header class="bannerContainer">
            <img 
                src=<?php 
                        $link = "public/imagens/banners/imagem-banner-" . $usuarioExibido['nome'] . ".jpg";
                        $caminho = file_exists($link) ? $link : "semImagem";
                        echo $caminho;
                    ?>
                alt="Banner do perfil do usuário <?php echo $usuarioExibido['nome']; ?>"
                class="bannerImage"
            />
        </header>
        <main class="mainContent">
            <section class="profileInfoContainer">
                <div class="profileImageContainer">
                    <img 
                        src=<?php 
                                $link = "public/imagens/perfil/imagem-perfil-" . $usuarioExibido['nome'] . ".jpg";
                                $caminho = file_exists($link) ? $link : "semImagem";
                                echo $caminho;
                            ?>
                        alt="Imagem de perfil do usuário <?php echo $usuarioExibido['nome']; ?>"
                        class="profileImage"
                    />
                </div>
                <div class="profileInfo">
                    <h1>
                        <?php echo $usuarioExibido['nome']; ?>
                    </h1>
                    <span>
                        <?php echo $usuarioExibido['arroba']; ?>
                    </span>
                    <p class="userAbout">
                        <?php echo $usuarioExibido['about']; ?>
                    </p>
                    <div class="profileInfoIcons">
                        <i class="fa-regular fa-folder"></i><span> 0 projetos • </span>
                        <i class="fa-solid fa-heart" id="heartIcon"></i><span id="spanHeartIcon"> 0 Likes</span>
                    </div>
                </div>
            </section>
            <hr class="bar"/>
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
            <hr class="bar"/>
        </main>
        <div class="userProfileAmigos">
            <div class="amigosSearch">
                <h1 class="h1AUser">Meus amigos</h1>
            </div>
            <div class="amigosList">
            
            </div>
        </div>
        </div>

    </div>

    <script src="./js/script.js"></script>
</body>
</html>