<?php
require_once 'config.php';

// Verificar se o usuário está logado
if (!esta_logado()) {
    redirecionar('login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $ano_publicacao = $_POST['ano_publicacao'] ?? null;

    $erros = [];

    if (empty($titulo)) {
        $erros[] = "Título é obrigatório.";
    }
    if (empty($autor)) {
        $erros[] = "Autor é obrigatório.";
    }
    if (empty($descricao)) {
        $erros[] = "Descrição é obrigatória.";
    }

    if (empty($erros)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, descricao, ano_publicacao, usuario_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$titulo, $autor, $descricao, $ano_publicacao, $_SESSION['usuario_id']]);
            redirecionar('livros.php');
        } catch (PDOException $e) {
            $erros[] = "Erro ao cadastrar livro.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Livro</title>
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
        <h2>Novo Livro</h2>
        
        <?php if (!empty($erros)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($erros as $erro): ?>
                        <li><?php echo $erro; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="ano_publicacao" class="form-label">Ano de Publicação</label>
                <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" min="1000" max="<?php echo date('Y'); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="livros.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
