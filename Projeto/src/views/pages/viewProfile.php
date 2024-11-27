<?php $render('header');?>
    <link rel="stylesheet" href="<?=$base?>/static/css/userProfile.css">
    <link rel="stylesheet" href="<?=$base?>/static/css/notes.css">
    <title>Meu perfil | Gamyx</title>

</head>
<body id="userProfileBody">
    
<?php if (isset($_SESSION['userLogado']['id'])): ?>
        <?php include __DIR__ . '/../partials/menu.php'; ?>
    <?php endif; ?>

    <section id="userProfileSection">
        <form action="<?=$base?>/perfil" method="POST" class="userSearchForm">
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
                        src="<?= $base ?>/static/img/perfil/<?= $user['fotoPerfil'] ?>" 
                        alt="Foto de perfil de <?= $user['nomeUsuario'] ?>" 
                        class="profileImage"
                    />
                    </div>
                    <div class="userProfileDados">
                        <h1 class="h1UserName"><?= $user['nomeUsuario']; ?></h1>
                        <h1 class="h1AUser"><?= $user['uniqueName']; ?> <i style="margin-left: 20px;color: white; font-size: 15px;" class="fa-solid fa-gear configButton" data-bs-toggle="modal" data-bs-target="#configModal"></i></h1>
                        <div class="h1AboutUserDiv">
                            <h1 class="h1AboutUser"><?= $user['about']; ?></h1>
                            <h1 class="h1AboutUserVerMais" data-bs-toggle="modal" data-bs-target="#sobreModal"> ...mais</h1>
                            <button id="openModalBtn" class="btn viewProjects">Ver Projetos e Notas</button>
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
                            <button type="button" class="btn viewProjects" onclick="window.location.href='<?= $base ?>/novoProjeto';"><h1 class="h1AUser">New Project</h1></button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <hr class="userHr">
        <div class="userProfileProjects">
            <div class="projectsSearch">
                
                
                <div class="colapse" style="display: flex; flex-direction: column;">
                    <div class="pesquisaHeader" style="flex-direction: row;">
                        <p class="d-inline-flex ">
                        <h1 class="h1AUser my-3 d-inline-flex">Meus projetos</h1>
                        
                        <a class="" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa-solid fa-magnifying-glass" style="margin-left: 20px;color: white; font-size: 15px;"></i>
                        </a>
                    </div>
                    
                    </p>
                    <div class="collapse" id="collapseExample" style="width: fit-content; box-sizing:border-box; ">
                    <form action="<?=$base?>/search" method="POST" class="userSearchForm row center">
                        <select name="filterProject" class="form-select col" style="height:50px; margin: 20px 0; background-color: #0D1117 !important; border: 1px solid #282F39; color: #FFFFFF;">
                            <option value="nomeProjeto">Nome</option>
                            <option value="sistemasOperacionais">Sistema Operacional</option>
                        </select>
                        <input type="text" name="projectSearchInput" class="userSearchInput col" placeholder="Pesquisar projeto"/>
                        <button type="submit" class="userSearchSubmit col" style="height:50px; margin: 20px 0;">Buscar</button>
                    </form>

                    </div>
                </div>
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
                            <a href= "<?=$base?>/projeto/<?=$projeto['id']?>">
                                <div class='projectFoto'>
                                    <img src='<?=$base?>/static/img/capasProjetos/<?= $fotoCapa ?>' alt='<?= $nomeProjeto ?>' class="rounded"> 
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
                                            class='amigosFoto' />
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
                    <form action="<?=$base?>/deleteUsuario" method="POST" id="formDeleteAccount">
                        <a href="#" class="deleteButton" onclick="realyDeleteAccount('formDeleteAccount')">Deletar conta</a>
                    </form>
                </div>      
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade "id="sobreModal" tabindex="-1" role="dialog" aria-labelledby="sobreModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content sobreModalClass" >
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="sobreModalLongTitle" style="color: #FFFFFF ">Sobre</h5>
                    <i class="fa-solid fa-xmark closeButton" data-bs-dismiss="modal" style="color: #FFFFFF" ></i>
                </div>
                <div class="modal-body">
                    <p class="pNormalText" style="color: #FFFFFF;"><?= $user['about']; ?></p>
                </div>      
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content editProfileModalClass" style="
    width: 100%;
" >
                <div class="modal-header" style="
    width: 100%;
">
                    <h5 class="modal-title mx-auto" id="editProfileModalLongTitle">Edit profile</h5>
                    <i class="fa-solid fa-xmark closeButton" data-bs-dismiss="modal"></i>
                </div>
                <div class="modal-body" style="
    width: 100%;
">
            <form action="<?=$base?>/perfil/changeProfilePicture" method="POST" id="formEditProfile" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="about" class="form-label">Sobre você:</label>
                    <textarea class="form-control" name="about" id="about" rows="5"><?= $user['about']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="fotoPerfil" class="form-label">Foto de Perfil:</label>
                    <input type="file" name="fotoPerfil" class="form-control" id="fotoPerfil" accept="image/png, image/jpeg">
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
    <div id="projectsModal" class="modal" style="display: none;">
    <!--  -->
    <div class="review__modal-content">
        <span class="close">&times;</span>
        <h2 style = "color: white">Projetos e Notas</h2>
        <div id="projectsContainer"></div>
    </div>
    <!--  -->
</div>

<script src="<?=$base?>/static/js/notas.js"></script>
<script>
document.getElementById('formEditProfile').addEventListener('submit', function(event) {
    const fileInput = document.getElementById('fotoPerfil');
    const file = fileInput.files[0];
    if (file) {
        const fileType = file.type;
        const validImageTypes = ['image/jpeg', 'image/png'];
        if (!validImageTypes.includes(fileType)) {
            alert('Por favor, envie um arquivo de imagem válido (PNG ou JPEG).');
            event.preventDefault();
        }
    }
});
</script>
</body>
<?php $render('footer');?>