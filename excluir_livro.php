<?php
require_once 'config.php';

// Verificar se o usuário está logado
if (!esta_logado()) {
    redirecionar('login.php');
}

$id = $_POST['id'] ?? null;

if ($id) {
    try {
        // Verificar se o livro pertence ao usuário
        $stmt = $pdo->prepare("SELECT * FROM livros WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $_SESSION['usuario_id']]);
        $livro = $stmt->fetch();

        if ($livro) {
            // Excluir o livro
            $stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
            $stmt->execute([$id]);
        }
    } catch (PDOException $e) {
        // Erro ao excluir, mas não vamos mostrar ao usuário
    }
}

redirecionar('livros.php');
