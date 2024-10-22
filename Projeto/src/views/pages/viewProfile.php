<?php $render('header');?>

<link rel="stylesheet" href="<?=$base?>/static/css/userProfile.css">

<body id="userProfileBody">
    
    <?php include __DIR__ . '/../partials/menu.php'; ?>

    <section id="userProfileSection">
        <form action="../views/pesquisaUsuario.php" method="POST" class="userSearchForm">
            <input type="text" placeholder="Procurar usuário" class="userSearchInput" name="search_query"/> 
            <button type="submit" class="userSearchSubmit">Buscar</button>
        </form>
        <div class="userProfileContainer">
            <div class="userProfileInfo">
                        
                        <div class="userProfileCapa rounded" style="width: 100%; object-fit: cover; overflow: hidden;">
                    <img 
                        src="<?=$base?>/static/img/tetris.png"
                        <?php 
                            // $link = "./static/img/banners/imagem-banner-" . $_SESSION['userLogado']['nome'] . ".jpg";
                            // $caminho = file_exists($link) ? $link : "semImagem";
                            // echo $caminho;
                        ?>
                        style="width: 100%;"
                        alt="Banner do perfil do usuário <?= $user['nomeUsuario']; ?>"
                        class="bannerImage"
                    />
                </div>
                <div class="userProfilePerfil">
                    <div class="userProfileFoto">
                        <img 
                            src=<?php 
                                    $link = $base."/static/img/perfil/imagem-perfil-".$user['nomeUsuario'].".jpg";
                                    // $caminho = file_exists($link) ? $link : "sem-imagem.png";

                                    echo $link;
                                ?>
                            alt="Imagem de perfil do usuário <?= $user['nomeUsuario']; ?>"
                            class="profileImage"
                        />
                    </div>
                    <div class="userProfileDados">
                        <h1 class="h1UserName"><?= $user['nomeUsuario']; ?></h1>
                        <h1 class="h1AUser"><?= $user['uniqueName']; ?> <i style="margin-left: 20px;color: white; font-size: 15px;" class="fa-solid fa-gear configButton" data-bs-toggle="modal" data-bs-target="#configModal"></i></h1>
                        <div class="h1AboutUserDiv">
                            <h1 class="h1AboutUser"><?= $user['about']; ?></h1>
                            <h1 class="h1AboutUserVerMais" data-bs-toggle="modal" data-bs-target="#sobreModal"> ...mais</h1>
                        </div>
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
                        <div class="profileButtons">
                            <button type="button" class="btn editProfile" data-bs-toggle="modal" data-bs-target="#editProfileModal"><h1 class="h1AUser">Edit Profile</h1></button>
                            <button type="button" class="btn viewProjects" onclick="window.location.href='cadastrarProjeto.php';"><h1 class="h1AUser">New Project</h1></button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <hr class="userHr">
        <div class="userProfileProjects">
            <div class="projectsSearch">
                <h1 class="h1AUser my-3">Meus projetos</h1>
                <i class="fa-solid fa-magnifying-glass" style="margin-left: 20px;color: white; font-size: 15px;"></i>
            </div>
        <!-- Projetos do usuário -->
            <div class="lista-cards-projeto" style="width: 100%; display: flex; gap: 60px;">
                <?php if (count($projects) > 0) : ?>
                    <?php foreach ($projects as $projeto) : ?>
                        <?php 
                            $nomeProjeto = $projeto['nomeProjeto'] ?? 'Nome não disponível';
                            $fotoCapa = $projeto['fotoCapa'] ?? 'default-placeholder.png';
                            $linkProjeto = $projeto['id'];
                        ?>
                        
                        <div class='projectItem'>
                            <a href= "<?=$base?>/perfil/<?=$linkProjeto?>">
                                <div class='projectFoto'>
                                    <img src='<?=$base?>/static/img/capasProjetos/<?= $fotoCapa ?>' alt='<?= $nomeProjeto ?>'> 
                                </div>
                            </a>
                            <h1 class='h1AUser' style='margin-bottom: 16px;'><?= $nomeProjeto ?></h1>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Nenhum projeto encontrado.</p>
                <?php endif; ?>
            </div>
        </div>
        <hr class="userHr">
        <div class="userProfileAmigos">
            <div class="amigosSearch">
                <h1 class="h1AUser">Meus amigos</h1>
                <i class="fa-solid fa-magnifying-glass" style="margin-left: 20px;color: white; font-size: 15px;"></i>
            </div>
            <div class="amigosList">
            </div>
        </div>
        <hr class="userHr">

    </section>

    <!-- Modal -->
    <div class="modal fade " id="configModal" tabindex="-1" role="dialog" aria-labelledby="configModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content configModalClass" >
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="configModalLongTitle">Configurações</h5>
                    <i class="fa-solid fa-xmark closeButton" data-bs-dismiss="modal"></i>
                </div>
                <div class="modal-body configModalBody">
                    <form action="<?=$base?>/perfil/logout" method="POST" id="formSair">
                        <button type="submit" class="btn btn-danger sairButton">Sair</button>
                    </form>
                    <form action="<?=$base?>/perfil/delete/<?=$HashUserId?>" method="POST" id="formDeleteAccount">
                        <a href="#" class="deleteButton" onclick="realyDeleteAccount('formDeleteAccount')">Deletar conta</a>
                    </form>
                </div>      
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="sobreModal" tabindex="-1" role="dialog" aria-labelledby="sobreModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content sobreModalClass" >
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="sobreModalLongTitle">Sobre</h5>
                    <i class="fa-solid fa-xmark closeButton" data-bs-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <p class="pNormalText"><?= $user['about']; ?></p>
                </div>      
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content editProfileModalClass" >
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="editProfileModalLongTitle">Edit profile</h5>
                    <i class="fa-solid fa-xmark closeButton" data-bs-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <form action="<?=$base?>/perfil/edit/<?=$HashUserId?>" method="POST" id="formEditProfile">
                        <div class="mb-3">
                            <label for="about" class="form-label">Sobre você:</label>
                            
                            <textarea class="form-control" name="about" id="about" rows="5"><?= $user['about']; ?></textarea>
                        </div>
                
                        <div class="mb-3">
                            <label for="linkPortfolio" class="form-label">URL para portfólio pessoal (e.g., GitHub, itch.io):</label>
                            <input type="text" name="linkPortfolio" class="form-control" id="linkPortfolio" value="<?= $user['urlPortfolio']; ?>">
                        </div>

                        <button type="submit" class="btn btn-cadastrar">Salvar</button>

                    </form>
                    
                </div>      
            </div>
        </div>
    </div>
</body>
<?php $render('footer');?>