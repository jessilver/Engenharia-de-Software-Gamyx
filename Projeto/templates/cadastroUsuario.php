<?php 
    require '../config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../static/css/cadastro.css">
    <?php
        require('linkrel.php');
        ?>
    <title>Cadastre-se</title>
</head>
<body id="cadastroUsuarioBody">

    <section id="sectionCadastroUsuario">
        <header id="headerCadastroUsuario">
            <img src="../static/img/GAMYX.png" alt="Logo do Gamyx">
            <h2>Bem Vindo</h2>
        </header>

        <div id="divFormCadastroUsuario" class="card shadow rounded">
            <div class="titulosCards">
                <h2 class="text-body-secondary">Cadastro de Usuário</h2>
            </div>
            <form action="../views/criarUsuario.php" method="POST" id="formCadastroUsuario">
                <div class="mb-3">
                    <label for="emailUsuario" class="form-label">Email:</label>
                    <input type="email" required name="email" class="form-control" id="emailUsuario">
                </div>

                <div class="mb-3">
                    <label for="nomeDeUsuario" class="form-label">Nome de Usuário:</label>
                    <input type="text" required name="nomeUsuario" class="form-control" id="nomeDeUsuario">
                </div>

                <div class="mb-3">
                    <label for="password1" class="form-label">Senha:</label>
                    <input type="password" required name="password" class="form-control" id="password1">
                </div>

                <div class="mb-3">
                    <label for="password2" class="form-label">Confirme sua senha:</label>
                    <input type="password" required onchange="validaSenha()" class="form-control" id="password2">
                </div>

                <div class="mb-4">
                    <label for="linkPortfolio" class="form-label">URL para portfólio pessoal (e.g., GitHub, itch.io):</label>
                    <input type="text" required name="portfolioUser" class="form-control" id="linkPortfolio">
                </div>

                <button type="submit" class="btn btn-cadastrar">Cadastrar-se</button>

            </form>
            <div class="other-options">
                <p>Já possui uma conta? <a href="login.php" class="bold-link">Entre agora</a></p>
            </div>
        </div>
    </section>
    
    <script src="../static/js/script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>