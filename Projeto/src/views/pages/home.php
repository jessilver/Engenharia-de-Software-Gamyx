<?php $render('header'); 

$_SESSION['userLogado'] = [
    'id' => 2,
];

unset($_SESSION['userLogado']);

?>


<!-- Opa, <?=$nome;?> -->