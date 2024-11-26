<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $render('header'); ?>
    <title>Inicio</title>
</head>
<body id="bodyFeedInicial">

    <header>
        <?php include __DIR__ . '/../partials/menu.php'; ?>
        <form action="<?=$base?>/perfil" method="POST" class="userSearchForm">
            <input type="text" placeholder="Procurar usuário" class="userSearchInput" name="search_query"/> 
            <button type="submit" class="userSearchSubmit">Buscar</button>
        </form>
    </header>

    <section id="sectionConteudoFeed">
        <div class="container card shadow rounded" id="content">

            <?php foreach($projetos as $projeto) : ?>
                <div class="card shadow rounded" id="post">
                    <div id="usuarioPost">
                        <img class="imagemPerfilUsuarioPost" src="<?= $base ?>/static/img/sem-imagem.png" alt="">
                        <div class="dadosUsuarioPost">
                            <h4><?= $projeto['nomeUsuario']; ?></h4>
                            <h6><?= $projeto['uniqueName']; ?></h6>
                        </div>
                    </div>
                    <h2><?= $projeto['nomeProjeto']; ?></h2>
                    <img class="card-img-top" src="<?= $base ?>/static/img/capasProjetos/<?= $projeto['fotoCapa']; ?>" alt="">
                    <div class="card-body">
                        <p class="card-text"> <?= $projeto['descricaoProjeto']; ?> </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div> 

        <div class="container card rounded shadow" id="perfilGeralUsuario">
            
            <img src="<?= $base ?>/static/img/sem-imagem.png" alt="" class="imagemPerfilGeralUsuario card-img-top">

            <p class="card-text"> 
                <h3>Jotta Gamer</h3>
                <h6>@jotta.jotta</h6>
            </p>

            

        </div>
    </section>

</body>
</html>