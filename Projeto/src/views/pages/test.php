<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Teste</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): // Verifica se $users não está vazio ?>
                <tr>
                    <td><?= $users[0]['id']; ?></td>
                    <td><?= $users[0]['nomeUsuario']; ?></td>
                    <td><?= $users[0]['email']; ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="3">Usuário não encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
