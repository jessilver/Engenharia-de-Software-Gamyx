<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    
</head>
<body>

    <h1>Test Page</h1>

    
    <?php include __DIR__ . '/../partials/menu.php'; ?>

   
    <div>
        <h2>Botão de Teste</h2>
        <button onclick="alert('Botão clicado!')">Clique Aqui</button>
    </div>

    <!-- Deletar Usuário -->
    <div>
        <h2>Deletar Usuário</h2>
        <form action="<?= $baseDir ?>/src/deleteUsuario" method="POST">
            <label for="deleteUserId">ID do Usuário:</label>
            <input type="text" id="deleteUserId" name="deleteUserId">
            <button type="submit">Deletar</button>
        </form>
    </div>

    <!-- Deletar Projeto -->
    <div>
        <h2>Deletar Projeto</h2>
        <form action="<?= $baseDir ?>/deleteProject.php" method="POST">
            <label for="deleteProjectId">ID do Projeto:</label>
            <input type="text" id="deleteProjectId" name="deleteProjectId">
            <button type="submit">Deletar</button>
        </form>
    </div>

    <script src="<?= $baseDir ?>/static/js/menu-script.js"></script> <!-- JS -->
</body>
</html>