<<?php 
    function logout() {
        require_once '../src/controllers/userController.php';
        $userController = new \src\controllers\UserController();
        $userController->logout();
    }
?>

<link rel="stylesheet" href="/Engenharia-de-Software-Gamyx/Projeto/public/static/css/menu-style.css">

<button id="menu-btn">☰</button>

<div id="overlay" class="overlay"></div>
<div id="sidebar" class="sidebar">
    <a href="../userProfile.php">Home</a>
    <a href="../perfil">Perfil</a>
    <a href="../projetos">Projetos</a>
    <button onclick="<?=logout()?>">Deslogar</a>
</div>

<script src="/Engenharia-de-Software-Gamyx/Projeto/public/static/js/menu-script.js"></script> <!-- Link para o JS -->
