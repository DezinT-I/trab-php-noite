<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (empty($username) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, senha, privilegio FROM usuarios WHERE username = ?");
            $stmt->execute([$username]);
            $usuario = $stmt->fetch();

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_username'] = $username;
                $_SESSION['usuario_privilegio'] = $usuario['privilegio'];
                redirecionar('livros.php');
            } else {
                $erro = "Usuário ou senha inválidos. Tente novamente.";
            }
        } catch (PDOException $e) {
            $erro = "Erro ao fazer login.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($erro)): ?>
                            <div class="alert alert-danger"><?php echo $erro; ?></div>
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
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="cadastro.php">Não tem conta? Cadastre-se aqui</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
