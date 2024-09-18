<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Cadastre-se</title>
</head>
<body id="cadastroUsuarioBody">

    <section id="sectionCadastroUsuario">
        <header id="headerCadastroUsuario">
            <img src="static/img/GAMYX.png" alt="Logo do Gamyx">
            <h2>Bem Vindo</h2>
        </header>

        <div id="divFormCadastroUsuario" class="card shadow rounded">
            <div class="titulosCards">
                <h2 class="text-body-secondary">Cadastro de Usuário</h2>
            </div>
            <form action="">
                <div class="mb-3">
                    <label for="emailUsuario" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="emailUsuario">
                </div>

                <div class="mb-3">
                    <label for="nomeDeUsuario" class="form-label">Nome de Usuário:</label>
                    <input type="text" class="form-control" id="nomeDeUsuario">
                </div>

                <div class="mb-3">
                    <label for="password1" class="form-label">Senha:</label>
                    <input type="password" class="form-control" id="password1">
                </div>

                <div class="mb-3">
                    <label for="password2" class="form-label">Confirme sua senha:</label>
                    <input type="password" class="form-control" id="password2">
                </div>

                <div class="mb-4">
                    <label for="linkPortfolio" class="form-label">URL para portfólio pessoal (e.g., GitHub, itch.io):</label>
                    <input type="text" class="form-control" id="linkPortfolio">
                </div>

                <button type="button" class="btn btn-cadastrar">Cadastrar-se</button>

            </form>
        </div>
    </section>
    
</body>
</html>