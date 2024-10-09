<?php 
    require 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/cadastro.css">
    <link rel="stylesheet" href="./static/css/cadastrarProjeto.css">
    <?php
        require('linkrel.php');
    ?>
    <title>Cadastrar Novo Projeto</title>
</head>
<body id="bodyCadastrarProjeto">

 <section id="conteudoCadastrarProjeto" class="rounded shadow">
    <div class="titulosCards mb-2">
        <h2 class="text-body-secondary">Cadastrar Novo Projeto</h2>
    </div>

    <form action="backendCadastrarProjeto.php" method="POST" id="formCadastrarProjeto" enctype="multipart/form-data">

        <div class="mb-3 mt-3">
            <label for="nomeProjeto" class="form-label">Nome do projeto:</label>
            <input type="text" required name="nomeProjeto" class="form-control" id="nomeProjeto">
        </div>

        <div class="mb-3">
            <label for="descricaoProjeto" class="form-label">Descrição:</label>
            <textarea required name="descricaoProjeto" class="form-control" id="descricaoProjeto"></textarea>
        </div>

        <div class="mb-3">
            <label for="linkDownload" class="form-label">Link para download:</label>
            <input type="text" required name="linkDownload" class="form-control" id="linkDownload">
        </div>

        <label for="sistemasOperacionais" class="form-label">Sistemas operacionais suportados:</label>
        <div id="sistemasOperacionais" class="mb-3">
            

            <div class="form-check">
                <input class="form-check-input" name="windows" type="checkbox" value="windows" id="sistemaWindowsCheckbox">
                <label class="form-check-label" for="sistemaWindowsCheckbox">
                    Windows
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" name="linux" type="checkbox" value="linux" id="sistemaLinuxCheckbox">
                <label class="form-check-label" for="sistemaLinuxCheckbox">
                    Linux
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" name="mac" type="checkbox" value="mac" id="sistemaMacCheckbox">
                <label class="form-check-label" for="sistemaMacCheckbox">
                    Mac
                </label>
            </div>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Foto de capa:</label>
            <div class="input-group">
                <button class="btn btn-secondary custom-btn" type="button">Upload</button>
                <input type="file" onchange="previewImagemSelecionada()" class="form-control" name="imagemCapaProjeto" id="formFile" accept="image/*">
            </div>
        </div>

        
        <label for="previewFotoCapa" class="form-label">Preview:</label>
        <div class="mb-3" id="previewFotoCapa">
            <img src="./static/img/tetris.png" alt="Preview da foto de capa selecionada"  class="img-fluid" id="imagemFotoCapa">
        </div>

        
        <button type="submit" class="btn btn-cadastrar mt-3">Cadastrar Projeto</button>

    </form>

    <div class="titulosCards mb-2">
        <!-- <h2 class="text-body-secondary">Cadastrar Novo Projeto</h2> -->
    </div>

 </section>

</body>
</html>