<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$base?>/static/css/menu-style.css">
</head>
<body>
    <button id="menu-btn">☰</button>
   
    <div id="overlay" class="overlay"></div>

    <div id="sidebar" class="sidebar">
        <a href="userProfile.php">Home</a>
        <a href="#">Perfil</a>
        <a href="#">Projetos</a>
        <a href="login.php">Deslogar</a>
    </div>

    <script src="<?=$base?>/static/js/menu-script.js"></script> <!-- Link para o JS -->
</body>
</html>
