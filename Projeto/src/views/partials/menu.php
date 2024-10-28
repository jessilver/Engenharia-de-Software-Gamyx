<link rel="stylesheet" href="/Engenharia-de-Software-Gamyx/Projeto/public/static/css/menu-style.css">

<button id="menu-btn">☰</button>

<div id="overlay" class="overlay"></div>
<div id="sidebar" class="sidebar">
    <a href="../userProfile.php">Home</a>
    <a href="../perfil">Perfil</a>
    <a href="../projetos">Projetos</a>
    <form id="logout-form" action="/logout" method="POST" class="sidebar-link">
        <button type="submit">Deslogar</button>
    </form>
</div>

<script src="<?=$base?>/static/js/menu-script.js"></script>