<?php $render('header');
    session_destroy();
?>
    <link rel="stylesheet" href="/Engenharia-de-Software-Gamyx/Projeto/public/static/css/loginstyle.css">
    <title>Login - Gamyx</title>

</head>
<body>

    <div class="login-container">
        <!-- Logo e Título -->
        <div class="login-header">
            <img src="/Engenharia-de-Software-Gamyx/Projeto/public/static/img/GAMYX.png" alt="Logo" class="logo">
            <h1>BEM VINDO</h1>
            <p>Login para o Gamyx</p>
        </div>

        <!-- Caixa de login -->
        <div class="login-box">
            <div class="login-form">
                <form action="/Engenharia-de-Software-Gamyx/Projeto/public/login" method="POST">
                    <label for="email">Email ou Usuário</label>
                    <input type="text" id="login" name="login" required>

                    <div class="password-container">
                        <label for="password">Senha</label>
                        <a href="#" class="forgot-password">Esqueceu sua senha?</a>
                    </div>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Entrar</button>
                </form>
            </div>
        </div>
        <div class="other-options">
            <p>Novo no Gamyx? <a href="/Engenharia-de-Software-Gamyx/Projeto/public/cadastrarUsuario" class="bold-link">Criar uma nova conta</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('error')) {
                alert('Login ou Senha incorreta. Por favor, tente novamente.');
            }
        });
    </script>
</body>
</html>