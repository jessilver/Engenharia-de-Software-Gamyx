<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>testse</h1>

    <!-- Incluir o menu diretamente -->
    <?php include __DIR__ . '/../partials/menu.php'; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>nomeUsuario</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($user)): // Verifica se $user não está vazio ?>
                <tr>
                    <td><?= $user[0]['id']; ?></td>
                    <td><?= $user[0]['nomeUsuario']; ?></td>
                    <td><?= $user[0]['email']; ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="3">Usuário não encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h1>Projects</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>nomeProjeto</th>
                <th>linkDownload</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($projects)):?>
                <?php foreach($projects as $project): ?>
                <tr>
                    <td><?= $project['id']; ?></td>
                    <td><?= $project['nomeProjeto']; ?></td>
                    <td><?= $project['linkDownload']; ?></td>
                </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nenhum projeto encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
