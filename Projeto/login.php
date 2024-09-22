<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gamyx</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <!-- Logo e Título fora da caixa de login -->
        <div class="login-header">
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>BEM VINDO</h1>
            <p>Login para o Gamyx</p>
        </div>

        <!-- Caixa de login menor -->
        <div class="login-box">
            <div class="login-form">
                <form action="check_login.php" method="POST">
                    <label for="email">Usuário ou Email</label>
                    <input type="text" id="email" name="email" required>

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
            <p>Novo no Gamyx? <a href="#" class="bold-link">Criar uma nova conta</a></p>
        </div>
    </div>
</body>
</html>
