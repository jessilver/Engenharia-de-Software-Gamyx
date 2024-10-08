<?php
    session_start();

    require_once "config.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="./static/css/userProfile.css">
    <?php
        require('linkrel.php');
        ?>
    <title>Meu Perfil</title>
</head>
<body id="userProfileBody">
    <?php
        if (!isset($_SESSION['userLogado'])) {
            header("Location: criarUsuario.php");
        }
    ?>
    <?php 
        include 'menu.php'; 
    ?>
    <section id="userProfileSection">
        <form action="pesquisaUsuario.php" method="POST" class="userSearchForm">
            <input type="text" placeholder="Procurar usuário" class="userSearchInput" name="search_query"/> 
            <button type="submit" class="userSearchSubmit">Buscar</button>
        </form>
        <div class="userProfileContainer">
            <div class="userProfileInfo">
                <div class="userProfileCapa rounded">
                    <img 
                        src=<?php 
                                $link = "./static/img/banners/imagem-banner-" . $_SESSION['userLogado']['nome'] . ".jpg";
                                $caminho = file_exists($link) ? $link : "semImagem";
                                echo $caminho;
                            ?>
                        alt="Banner do perfil do usuário <?php echo $_SESSION['userLogado']['nome']; ?>"
                        class="bannerImage"
                    />
                </div>
                <div class="userProfilePerfil">
                    <div class="userProfileFoto">
                        <img 
                            src=<?php 
                                    $link = "./static/img/perfil/imagem-perfil-" . $_SESSION['userLogado']['nome'] . ".jpg";
                                    $caminho = file_exists($link) ? $link : "semImagem";
                                    echo $caminho;
                                ?>
                            alt="Imagem de perfil do usuário <?php echo $_SESSION['userLogado']['nome']; ?>"
                            class="profileImage"
                        />
                    </div>
                    <div class="userProfileDados">
                        <h1 class="h1UserName"><?php echo $_SESSION['userLogado']['nome']; ?></h1>
                        <h1 class="h1AUser"><?php echo $_SESSION['userLogado']['arroba']; ?></h1>
                        <div class="h1AboutUserDiv">
                            <h1 class="h1AboutUser"><?php echo $_SESSION['userLogado']['about']; ?></h1>
                            <h1 class="h1AboutUserVerMais" data-toggle="modal" data-target="#sobreModal"> ...mais</h1>
                        </div>
                        <h1 class="h1AUser"><i class="fa-regular fa-folder"></i> <?php echo count($_SESSION['userLogado']['projects']); ?> projects - <i class="fa-solid fa-heart" id="heartIcon"></i> <?php echo count($_SESSION['userLogado']['projects']); ?> likes </h1>
                        <div class="profileButtons">
                            <button class="btn editProfile" data-toggle="modal" data-target="#editProfileModal"><h1 class="h1AUser">Edit Profile</h1></button>
                            <button class="btn viewProjects" onclick="window.location.href='cadastrarProjeto.php';"><h1 class="h1AUser">New Project</h1></button>
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
            <div class="lista-cards-projeto">
                <?php
                foreach ($_SESSION['userLogado']['projects'] as $projeto) {
                    print("
                        <div class='projectItem'>
                            <div class='projectFoto'>

                            </div>
                            <h1 class='h1AUser' style = 'margin-bottom: 16px;'>$projeto</h1>
                        </div>
                    ");
                }
                ?>             
                <a href="viewProject.php">
                    <div class="card-projeto rounded">
                        <img 
                            src="./static/img/tetris.png"
                            alt="Este projeto não tem imagem."
                            class="projectImage"
                        />                          
                    </div>
                </a>
            </div>
        </div>
        <hr class="userHr">
        <div class="userProfileAmigos">
            <div class="amigosSearch">
                <h1 class="h1AUser">Meus amigos</h1>
                <i class="fa-solid fa-magnifying-glass" style="margin-left: 20px;color: white; font-size: 15px;"></i>
            </div>
            <div class="amigosList">
            <?php
                foreach ($_SESSION['userLogado']['friends'] as $amigo){
                    print("
                        <div class='amigosItem'>
                            <div class='amigosFoto'>

                            </div>
                            <h1 class='h1AUser' style = 'margin-bottom: 16px;'>$amigo</h1>
                        </div>
                    ");
                }
                ?>
            </div>
        </div>
        <hr class="userHr">

    </section>

    <!-- Modal -->
    <div class="modal fade " id="sobreModal" tabindex="-1" role="dialog" aria-labelledby="sobreModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content sobreModalClass" >
                <div class="modal-header">
                    <h5 class="modal-title" id="sobreModalLongTitle">Sobre</h5>
                    <i class="fa-solid fa-xmark closeButton" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <p class="pNormalText"><?php echo $_SESSION['userLogado']['about']; ?></p>
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
                    <i class="fa-solid fa-xmark closeButton" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <form action="editProfile.php" method="POST" id="formEditProfile">
                        <input type="hidden" name="uniqueName" class="form-control" id="uniqueName" value="<?php echo $_SESSION['userLogado']['arroba']; ?>">

                        <div class="mb-3">
                            <label for="about" class="form-label">Sobre você:</label>
                            <!-- <input type="text" name="about" class="form-control" id="about" value="<?php echo $_SESSION['userLogado']['about']; ?>"> -->
                            <textarea class="form-control" name="about" id="about" rows="5"><?php echo $_SESSION['userLogado']['about']; ?></textarea>
                        </div>
                
                        <div class="mb-3">
                            <label for="linkPortfolio" class="form-label">URL para portfólio pessoal (e.g., GitHub, itch.io):</label>
                            <input type="text" name="linkPortfolio" class="form-control" id="linkPortfolio" value="<?php echo $_SESSION['userLogado']['urlPortfolio']; ?>">
                        </div>

                        <button type="submit" class="btn btn-cadastrar">Salvar</button>

                    </form>
                    <form action="deleteUsuario.php" method="POST" id="formDeleteAccount">
                        <input type="hidden" name="uniqueName" class="form-control" id="uniqueName" value="<?php echo $_SESSION['userLogado']['arroba']; ?>">

                        <button type="submit" class="btn btn-danger">Deletar conta</button>

                    </form>
                </div>      
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content editProjectModalClass" >
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="editProjectModalLongTitle">Edit project</h5>
                    <i class="fa-solid fa-xmark closeButton" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <form action="editProject.php" method="POST" id="formeditProject">
                        <input type="hidden" name="uniqueName" class="form-control" id="uniqueName" value="<?php echo $_SESSION['userLogado']['arroba']; ?>">

                        <div class="mb-3">
                            <label for="projectName" class="form-label">Nome do projeto:</label>
                            <input type="text" name="projectName" class="form-control" id="projectName" value="">
                        </div>
                
                        <div class="mb-3">
                            <label for="projectDesc" class="form-label">Descrição do projeto:</label>
                            <textarea class="form-control" name="projectDesc" id="projectDesc" rows="5"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="projectOs" class="form-label">Sistemas operacionais suportados:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="switches[]" value="Windows" id="Windows">
                                    <label class="form-check-label" for="Windows">
                                        Windows
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="switches[]" value="Linux" id="Linux">
                                    <label class="form-check-label" for="Linux">
                                        Linux
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="switches[]" value="Mac" id="Mac">
                                    <label class="form-check-label" for="Mac">
                                        Mac
                                    </label>
                                </div>
                        </div>

                        <div class="mb-3">
                            <label for="projectDowl" class="form-label">Link para dowload:</label>
                            <input type="text" name="projectDowl" class="form-control" id="projectDowl" value="">
                        </div>

                        <div class="mb-3">
                            <label for="projectImg" class="form-label">Foto de capa:</label>
                            <input type="file" name="projectImg" class="form-control" id="projectImg" value="" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="previewTrojectImg">
                            <h1 class="edtiPh1 mx-auto">Preview:</h1>
                            <img class="projectCapa" src="" alt="">
                        </div>
                        <button type="submit" class="btn btn-cadastrar">Salvar</button>

                    </form>
                </div>      
            </div>
        </div>
    </div>
    
    <!-- <script src="../static/js/script.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
