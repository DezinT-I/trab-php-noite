<?php
require_once 'config.php';

// Verificar se o usuário está logado
if (!esta_logado()) {
    redirecionar('login.php');
}

// Buscar livros do usuário
try {
    $stmt = $pdo->prepare("SELECT * FROM livros WHERE usuario_id = ? ORDER BY titulo");
    $stmt->execute([$_SESSION['usuario_id']]);
    $livros = $stmt->fetchAll();
} catch (PDOException $e) {
    $mensagem = "Erro ao carregar livros.";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="livros.php">Sistema de Livros</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="logout.php">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Meus Livros</h2>
            <a href="novo_livro.php" class="btn btn-primary">Novo Livro</a>
        </div>

        <?php if (isset($mensagem)): ?>
            <div class="alert alert-danger"><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <?php if (empty($livros)): ?>
            <div class="alert alert-info">Nenhum livro cadastrado ainda.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Ano</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($livros as $livro): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                                <td><?php echo $livro['ano_publicacao'] ?? '-'; ?></td>
                                <td>
                                    <a href="editar_livro.php?id=<?php echo $livro['id']; ?>" class="btn btn-sm btn-warning me-2">Editar</a>
                                    <form action="excluir_livro.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $livro['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
