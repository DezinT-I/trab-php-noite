<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $email = $_POST['email'] ?? '';

    $erros = [];

    if (empty($username)) {
        $erros[] = "Usuário é obrigatório.";
    }
    if (empty($senha)) {
        $erros[] = "Senha é obrigatória.";
    }
    if (empty($email)) {
        $erros[] = "E-mail é obrigatório.";
    }

    if (empty($erros)) {
        try {
            // Verificar se o usuário já existe
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $erros[] = "Usuário já existe.";
            }

            if (empty($erros)) {
                // Criptografar a senha
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

                // Inserir novo usuário
                $stmt = $pdo->prepare("INSERT INTO usuarios (username, senha, email) VALUES (?, ?, ?)");
                $stmt->execute([$username, $senha_hash, $email]);

                // Login automático após cadastro
                $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = ?");
                $stmt->execute([$username]);
                $usuario = $stmt->fetch();
                $_SESSION['usuario_id'] = $usuario['id'];
                redirecionar('livros.php');
            }
        } catch (PDOException $e) {
            $erros[] = "Erro ao cadastrar usuário.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Cadastro</h3>
                    </div>
                    <div class="card-body">
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
                                <label for="username" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="login.php">Já tem conta? Faça login aqui</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
