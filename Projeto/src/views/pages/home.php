<?php $render('header'); 

$_SESSION['userLogado'] = [
    'id' => 2,
];

unset($_SESSION['userLogado']);

?>


Opa, <?=$nome;?>
Projeto 
<?php foreach ($projetos as $projeto) : ?>
    <?php 
        $nomeProjeto = $projeto['nomeProjeto'] ?? 'Nome não disponível';
        $fotoCapa = $projeto['fotoCapa'] ?? 'default-placeholder.png';
        $linkProjeto = $projeto['id'];
    ?>
    
    <div class='projectItem'>
        <a href= "<?=$base?>/projeto/<?=$projeto['id']?>">
            <div class='projectFoto'>
                <img src='<?=$base?>/static/img/capasProjetos/<?= $fotoCapa ?>' alt='<?= $nomeProjeto ?>'> 
            </div>
        </a>
        <h1 class='h1AUser' style='margin-bottom: 16px;'><?= $nomeProjeto ?></h1>
    </div>
<?php endforeach; ?>