<link rel="stylesheet" href="/Engenharia-de-Software-Gamyx/Projeto/public/static/css/menu-style.css">

<button id="menu-btn">☰</button>

<div id="overlay" class="overlay"></div>
<div id="sidebar" class="sidebar text-nowrap">
    <a href="<?=$base?>/">Home</a>
    <a href="<?=$base?>/perfil">Perfil</a>
    <a href="<?=$base?>/projetos">Projetos</a>
    <a href="<?=$base?>/eventos">Game jam</a>
    <form id="logout-form" action="<?=$base?>/logout" method="POST" class="sidebar-link">
        <button type="submit">Deslogar</button>
    </form>
</div>

<script src="<?=$base?>/static/js/menu-script.js"></script>