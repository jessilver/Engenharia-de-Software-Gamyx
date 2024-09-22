<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <?php
        require('linkrel.php');

        session_start(); // Inicia a sessão

        
    ?>
</head>
<body id="userProfileBody">

    <?php
        if (isset($_SESSION['user'])) {
            echo "Bem-vindo, " . $_SESSION['user']['nome'] . "!";
        } else {
            echo "Você não está logado.";
        }
    ?>

    <section id="userProfileSection">
        
        <div class="userProfileContainer">
            <div class="userProfileInfo">
                <div class="userProfileCapa">
                
                </div>
                <div class="userProfilePerfil">
                    <div class="userProfileFoto">

                    </div>
                    <div class="userProfileDados">
                        <h1 class="h1UserName"><?php echo $_SESSION['user']['nome']; ?></h1>
                        <h1 class="h1AUser"><?php echo $_SESSION['user']['arroba']; ?> - <?php echo count($_SESSION['user']['projects']); ?> projects</h1>
                        <div class="h1AboutUserDiv">
                            <h1 class="h1AboutUser"><?php echo $_SESSION['user']['about']; ?></h1>
                            <h1 class="h1AboutUserVerMais" data-toggle="modal" data-target="#sobreModal"> ...mais</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="userHr">
        <div class="userProfileProjects">
            <div class="projectsSearch">
                <h1 class="h1AUser">Meus projetos</h1>
                <i class="fa-solid fa-magnifying-glass" style="margin-left: 20px;color: white; font-size: 15px;"></i>
            </div>
            <div class="projectList">
                <?php
                foreach ($_SESSION['user']['projects'] as $projeto) {
                    print("
                        <div class='projectItem'>
                            <div class='projectFoto'>

                            </div>
                            <h1 class='h1AUser' style = 'margin-bottom: 16px;'>$projeto</h1>
                        </div>
                    ");
                }
                ?>
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
                foreach ($_SESSION['user']['friends'] as $amigo){
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
                    <p class="pNormalText"><?php echo $_SESSION['user']['about']; ?></p>
                </div>      
            </div>
        </div>
    </div>
    
    <script src="static/js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
