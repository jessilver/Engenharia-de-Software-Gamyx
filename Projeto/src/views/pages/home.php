<?php $render('header'); 

$_SESSION['userLogado'] = [
    'id' => 1,
];

// unset($_SESSION['userLogado']);

?>

<?php header('Location: '. $base) ?>