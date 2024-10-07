<?php 

    require 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $nomeProjeto = $_POST['nomeProjeto'];
        $descricaoProjeto = $_POST['descricaoProjeto'];
        $linkDownloado = $_POST['linkDownload'];
        if (isset($_POST['windows'])) {
            $sistemasOperacionais = 'windows';
        }
        if (isset($_POST['linux'])) {
            $sistemasOperacionais = 'linux';
        }
        if (isset($_POST['mac'])) {
            $sistemasOperacionais = 'mac';
        }
    }

?>